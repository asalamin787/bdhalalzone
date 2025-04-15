<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Email;
use App\Models\Order;
use App\Models\Prodcat;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Shop;
use App\Models\User;
use App\Slider;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Page;

class PageController extends Controller
{
    public function homeOne(){
        return View('coming_soon');
    }
    public function home()
    {
        $division = session()->get('division', 'Bangladesh');
        $bestSellingCategories = Cache::remember($division . '_best_selling_categories', 100, function () {
            // Step 1: Get the categories with all child categories and their products
            $categories = Prodcat::where('featured', true)
                ->with([
                    'childrens.products:id,name,slug,image,price',
                    'childrens.childrens.products:id,name,slug,image,price' // for grandchild categories
                ])
                ->has('products')
                ->take(50)
                ->orderBy('role', 'asc')
                ->get();

            // Step 2: Manually limit products in memory (across parent, children, and grandchildren)
            $categories->each(function ($category) {
                // Collect products from parent, child, and grandchild categories
                $allProducts = collect($category->products)
                    ->merge($category->childrens->flatMap(function ($child) {
                        return $child->products->merge($child->childrens->flatMap(function ($grandchild) {
                            return $grandchild->products;
                        }));
                    }));

                // Limit to 11 products and set the relation
                $category->setRelation('products', $allProducts->take(50));
            });

            return $categories;
        });



        $categories = Prodcat::whereNull('parent_id')->has('childrens')->get();


        $latest_products = Cache::remember($division . '_latest_products', 100, function () {
            return Product::with('ratings')->orderBy('views', 'desc')->where("status", 1)
                ->whereHas('shop', function ($q) {
                    $q->where('status', 1);
                })->latest()->limit(50)->whereNull('parent_id')->get();
        });

        $bestsaleproducts = Cache::remember($division . '_best_sale_products', 100, function () {
            return Product::with('ratings')->orderBy('total_sale', 'desc')
                ->whereHas('shop', function ($q) {
                    $q->where('status', 1);
                })->latest()->limit(50)->whereNull('parent_id')->get();
        });

        $featuredproducts = Cache::remember($division . '_featured_products', 100, function () {
            return Product::with('ratings')->where('featured', '1')
                ->whereHas('shop', function ($q) {
                    $q->where('status', 1);
                })->latest()->limit(50)->whereNull('parent_id')->get();
        });

        $latest_shops = Cache::remember($division . '_latest_shops', 100, function () {
            return Shop::where("status", 1)->latest()->limit(8)->select(['id', 'slug', 'banner', 'name', 'logo'])->withCount('products')->get();
        });
        $clients = Cache::remember($division . '_clients', 100, function () {
            return Shop::where("status", 1)->pluck('logo', 'id')->toArray();
        });

        $prodcats = Cache::remember($division . '_product_categories', 100, function () {
            return Prodcat::where('parent_id', null)->where('featured', 1)->get();
        });

        $sliders = Cache::remember($division . '_sliders', 100, function () {
            return Slider::latest()->get();
        });

        return view('pages.home', compact(
            'latest_products',
            'bestsaleproducts',
            'latest_shops',
            'prodcats',
            'sliders',
            'featuredproducts',
            'bestSellingCategories',
            'clients',
            'categories'
        ));
    }
    public function shops()
    {

        $parent = null;
        $filters = collect([]);
        if (request()->filled('parent')) {
            $parent = Prodcat::where('slug', request()->parent)->first();
            $filters = $filters->merge($parent->filters);
        }

        if (request()->filled('category')) {
            $category = Prodcat::where('slug', request()->category)->first();
            $filters = $filters->merge($category->filters);
        }

        $filters = $filters->unique('id');



        $products = Product::where("status", 1)->whereNull('parent_id')->whereHas('shop', function ($q) {
            $q->where('status', 1);
        })->when(request()->filled('parent'), function ($query) {
            $query->whereHas('prodcats', fn($query) => $query->whereHas('allParentCategories', fn($q) => $q->where('slug', request()->parent)));
        })->filter()->limit(500)->get();


        $categories = Cache::remember('shops_categories',1000,function(){
            return Prodcat::when(request()->filled('parent'), function ($query) {
                $query->whereHas('parent', fn($query) => $query->where('slug', request()->parent));
            })->withCount('products')->whereNotNull('parent_id')->orderBy('name', 'asc')->get();
        });

        return view('pages.shops', compact('products', 'categories', 'parent', 'filters'));
    }
    public function product_details($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::whereNull('parent_id')->limit(16)->get();
        $product->increment('views');


        $recommand = session()->get('recommand', []);

        if (!in_array($product->id, $recommand)) {
            $recommand[] = $product->id;
            session()->put('recommand', $recommand);
        }
        return view('pages.product_details', compact('related_products', 'product'));
    }
    public function cart()
    {
        $latest_shops =  Shop::where("status", 1)
            ->whereHas('products', function ($query) {
                $query->whereNull('parent_id');
            })->latest()->limit(8)->get();
        return view('pages.cart', compact('latest_shops'));
    }


    public function dashboard()
    {
        // $intent = auth()->user()->createSetupIntent();
        $intent = null;
        return view('auth.user.dashboard', compact('intent'));
    }
    public function addressEdit(Address $address)
    {
        return view('auth.user.information', ['address' => $address]);
    }
    public function addressDestroy(Address $address)
    {

        $address->delete($address);

        return back()->with('success_msg', 'Address has been removed!');
    }



    public function order_index()
    {
        $latest_orders = Order::where('user_id', auth()->user()->id)->where('status', 0)->orWhere('status', 3)->latest()->get();
        $past_orders = Order::where('user_id', auth()->user()->id)->where('status', 1)->latest()->get();

        return view('auth.user.order.index', compact('latest_orders', 'past_orders'));
    }


    public function checkout()
    {

        return view('pages.checkout');
    }
    public function store_front($slug)
    {
        // Cache the shop details and related products
        $shop = Cache::remember("shop_{$slug}", 60, function () use ($slug) {
            return Shop::where('slug', $slug)->with('products')->firstOrFail();
        });

        // $products = Cache::remember("shop_{$slug}_products", 60, function () use ($shop) {
            $products= $shop->products()->filter()->orderBy('featured', 'desc')->get();
        // });

        // Initialize arrays to ensure they are not null even if no products are present
        $bestSellingProducts = [];
        $featuredproducts = [];
        $reviews = Cache::remember("shop_{$slug}_reviews", 60, function () use ($shop) {
            return $shop->ratings()->latest()->get();
        });

        // Check if the shop has any products
        if ($shop->products->isNotEmpty()) {
            // Retrieve best-selling products (top 3)
            $bestSellingProducts = Cache::remember("shop_{$slug}_best_selling", 60, function () use ($shop) {
                return $shop->products()
                    ->orderBy('total_sale', 'desc')
                    ->limit(3)
                    ->whereNull('parent_id')
                    ->get();
            });

            // Retrieve featured products (top 3)
            $featuredproducts = Cache::remember("shop_{$slug}_featured", 60, function () use ($shop) {
                return $shop->products()
                    ->where('featured', 1)
                    ->latest()
                    ->limit(3)
                    ->whereNull('parent_id')
                    ->get();
            });
        }

        return view('pages.store_front', compact('shop', 'bestSellingProducts', 'featuredproducts', 'reviews', 'products'));
    }



    // public function order_page()
    // {
    //     return view('pages.order_page');
    // }
    public function thankyou()
    {
        $latest_products = Product::where("status", 1)->latest()->limit(24)->whereNull('parent_id')->get();
        return view('pages.thankyou', compact('latest_products'));
    }
    public function rating(Request $request)
    {
        //return $request->all();
        $product = Product::find($request->product_id);
        Rating::create([
            "name" => $request->name,
            "email" => $request->email,
            "rating" => intval($request->rating),
            "review" => $request->review,
            "product_id" => $product->id,
            'user_id' => Auth()->id(),
            'shop_id' => $product->shop->id,
        ]);
        return back()->with('success_msg', 'Thanks for your review');
        //return back()->withErrors('Sorry! One of the items in your cart is no longer Available!');
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'unique:emails,email'],
        ], [
            'email.unique' => 'You already subscribed'
        ]);
        Email::create([
            "email" => $request->email,
        ]);
        return back()->with('subscribeEmail', 'Thanks for your subscription');
    }
    public function quickview()
    {
        $product = Product::where('id', request()->product_id)->first();
        return view('layouts.quick_view', compact('product'));
    }

    public function vendors(Request $request)
    {
        // if (auth()->check() && $request->type == 'liked') {
        //     $shops = auth()->user();
        // } else {
        //     $shops = Shop::active();
        // }
        // $shops = $shops->with(['products' => function ($query) {
        //     $query->whereHas('prodcats', function ($query) {
        //         $query->where('slug', request()->category);
        //     });
        // }])
        //     ->when($request->filled('category'), function ($query) {
        //         $query->whereHas('products', function ($query) {
        //             $query->whereHas('prodcats', function ($query) {
        //                 $query->where('slug', request()->category);
        //             });
        //         });
        //     })->when(Session::has('post_city'), function ($q) {
        //         $post_city = Session::get('post_city');
        //         return $q->where(function ($qp) use ($post_city) {
        //             $qp->where('post_code', 'like', '%' . $post_city . '%')->orWhere('city', 'like', '%' . $post_city . '%');
        //         });
        //     })->when(Session::has('state'), function ($q) {
        //         $state = Session::get('state');
        //         return $q->where('state', 'like', '%' . $state . '%');
        //     })
        //     ->get();
        $shops = Shop::active()->orderBy('score','desc')->shop()->latest()->get();
        return view('pages.vendors', compact('shops'));
    }

    public function follow(Shop $shop)
    {
        $user = auth()->user();

        $user->followedShops()->toggle($shop->id);

        if ($user->follows($shop)) {
            return redirect()->back()->with('success_msg', 'You are now following ' . $shop->name);
        } else {
            return redirect()->back()->with('success_msg', 'You have unfollowed ' . $shop->name);
        }
    }
    public function getPage($slug = null)
    {
        $page = Page::where('slug', $slug)->where('status', 'active');
        $page = $page->firstOrFail();
        return view('pages.page')->with('page', $page);
    }
    public function followShops()
    {
        return view('pages.likedShop');
    }
    public function setLocation(Request $request)
    {
        $postcodes = $request->input('postcodes');
        $lng = $request->input('lng');
        $lat = $request->input('lat');
        $radius = $request->input('radius');
        $state = $request->input('state');
        $uniquePostcodes = array_unique($postcodes);

        // Process the data as needed

        // Return the response
        $response = [
            'postcode' => $uniquePostcodes,
            'lng' => $lng,
            'lat' => $lat,
            'radius' => $radius,
            'state' => $state,
        ];
        Session::put('location', $response);

        return response()->json($response);
    }
    public function locationReset()
    {
        Session::forget('post_city');
        Session::forget('state');
        return back()->with('success_msg', 'Location reset Success');
    }
    public function locationSearchQuery(Request $request)
    {
        if ($request->filled('post_city')) {
            $postCityArray = session()->get('post_city', []);
            $updatedArray = array_merge($postCityArray, $request->input('post_city'));
            session()->put('post_city', $updatedArray);
        }
        if ($request->filled('state')) {
            session()->put('state', $request->input('state'));
        }
        return redirect(route('shops'));
    }
    public function getShops(Request $request)
    {
        $state = $request->input('state');
        $shops = Shop::where('state', $state)->pluck('city', 'city');
        // dd($shops);
        return response()->json($shops);
    }


    public function selectDivision(Request $request)
    {
    
        $request->validate([
            'division' => 'required|string'
        ]);

        Session::put('division', $request->division);
        return response()->json(['success' => true]);
    }
}
