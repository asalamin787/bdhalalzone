<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'variations' => 'array',
    ];
    protected $with = ['ratings', 'shop'];
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function discount()
    {
        $discount_amount  = $this->price - $this->sale_price;
        $discount_percantage = ($discount_amount / $this->price) * 100;
        return round($discount_percantage);
    }
    public function prodcats()
    {
        return $this->belongsToMany(Prodcat::class)->withTimestamps();
    }
    public function parentproduct()
    {
        return $this->belongsTo(Product::class, 'parent_id', 'id');
    }
    public function path()
    {

        return route('product_details', $this);
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function subproducts()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }
    public function subproductsuser()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id')->where('price', '>', 0)->whereNotNull('variations');
    }
    public function scopeFilter($query)
    {
        //new
        return $query
            ->when(request()->filled('category'), function ($q) {
                return $q->whereHas('prodcats', function ($query) {
                    $query->where('slug', request()->category);
                });
            })
            ->when(request()->has('search'), function ($q) {
                return $q->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('short_description', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('search_key', 'LIKE', '%' . request()->search . '%')
                        ->orWhereHas('prodcats', function ($query) {
                            return $query->where('name', request()->search);
                        });
                });
            })
            ->when(request()->has('featured'), function ($q) {
                return $q->where('featured', 1);
            })
            ->when(request()->has('shop'), function ($q) {
                return $q->whereHas('shop', function ($query) {
                    $query->where('name', request()->shop);
                });
            })
            ->when(
                request()->has('ratings'),
                function ($q) {
                    return  $q->whereHas('ratings', function ($q) {
                        $q->where('rating', request()->ratings);
                    });
                }
            )

            ->when(request()->has('filter_products') && request()->filter_products == 'price-low-high', function ($q) {
                return $q->orderBy('price', 'asc');
            })
            ->when(request()->has('filter_products') && request()->filter_products == 'price-high-low', function ($q) {
                return $q->orderBy('price', 'desc');
            })
            ->when(request()->has('filter_products') && request()->filter_products == 'most-popular', function ($q) {
                return $q->orderBy('total_sale', 'desc');
            })
            ->when(request()->has('filter_products') && request()->filter_products == 'trending', function ($q) {
                return $q->orderBy('views', 'desc');
            })
            ->when(request()->has(['priceMin', 'priceMax']), function ($q) {
                return $q->whereBetween('price', [request('priceMin'), request('priceMax')]);
            })

            ->when(Session::has('post_city'), function ($q) {
                $post_city = Session::get('post_city');
                return $q->whereHas('shop', function ($qr) use ($post_city) {
                    $qr->where(function ($qp) use ($post_city) {
                        $qp->whereIn('city', $post_city);
                    });
                });
            })->when(Session::has('state'), function ($q) {
                $state = Session::get('state');
                return $q->whereHas('shop', function ($qr) use ($state) {
                    $qr->where('state', 'like', '%' . $state . '%');
                });
            });
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class)->where('status', 1)->latest();
    }
    public function scopeParentProduct($query)
    {
        return $query->whereNUll('parent_id');
    }
    public function scopeChildProduct($query)
    {
        return $query->whereNotNUll('parent_id');
    }

    public function setVariationsAttribute($value)
    {
        $this->attributes['variations'] = json_encode($value);
    }
    public function getVariationsAttribute($value)
    {

        if ($value) {
            return json_decode($value);
        }
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }


    public function getImage()
    {
        if ($this->image) {
            return $this->image;
        }
        if ($this->parent_id) {
            return $this->parent->getImage();
        }
    }
    public function getName()
    {
        if ($this->image) {
            return $this->name;
        }
        if ($this->parent_id) {
            return $this->parent->getName();
        }
    }

    public function getWeight()
    {
        return sprintf('%.3f', $this->weight / 1000);
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function (Builder $builder) {
            $builder->whereHas('shop', fn($query) => $query->complete());
        });

        if (Route::is('homepage') || Route::is('shops') || Route::is('vendors')) {


            static::addGlobalScope('mostSold', function (Builder $builder) {
                $builder->orderBy('total_sale');
            });
            static::addGlobalScope('division', function (Builder $builder) {
                $division = session()->get('division');
                if ($division && $division !== 'Bangladesh') {
                    $builder->whereHas('shop', function ($q) use ($division) {
                        $q->where('division', $division);
                    });
                }
            });
        }
    }
}
