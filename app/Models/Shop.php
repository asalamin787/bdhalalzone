<?php

namespace App\Models;

use App\Models\Traits\HasMeta;
use Darryldecode\Cart\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

class Shop extends Model
{
    use HasFactory, HasMeta;
    protected $guarded = [];
    protected $with = ['ratings'];
    protected $meta_attributes = [
        "image1",
        "title1",
        "category1",
        "link1",
        "image2",
        "title2",
        "category2",
        "link2",
        "facebook",
        "linkedin",
        "instagram",
        "twitter",
        "menuTitle1",
        "menuLink1",
        "menuTitle2",
        "menuLink2",
        'upzilla',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class)->whereNull('parent_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function retailer()
    {
        return $this->belongsTo(Retailer::class, 'referral_id');
    }
    public function massages()
    {
        return $this->hasMany(Massage::class, 'reciver_id');
    }
    public function shopPolicy()
    {
        return $this->hasOne(ShopPolicy::class);
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function scopeProducts($query)
    {

        return $query->when(Session::has('location'), function ($q) {
            $postcode = Session::get('location.postcode');
            $q->whereIn('post_code', $postcode);
        })
            // ->when(auth()->check(), function ($q) {
            //     $q->where('post_code', Auth()->user()->shopAddress->post_code);
            // })
            ->with(['products' => function ($query) {
                $query->when(request()->filled('category'), function ($q) {
                    $q->whereHas('prodcats', function ($query) {
                        $query->where('slug', request()->category);
                    });
                })->when(request()->has('search'), function ($q) {
                    return $q->where(function ($query) {
                        $query->where('name', 'LIKE', '%' . request()->search . '%')
                            ->orWhere('short_description', 'LIKE', '%' . request()->search . '%');
                    });
                })
                    ->when(request()->has('search'), function ($q) {
                        $q->orWhereHas('shop', function ($query) {
                            $query->where('name', request()->search);
                        });
                    })
                    ->when(request()->has('shop_products') && request()->shop_products == 'price-low-hight', function ($q) {
                        $q->orderBy('price', 'asc');
                    })
                    ->when(request()->has('shop_products') && request()->shop_products == 'price-high-low', function ($q) {
                        $q->orderBy('price', 'desc');
                    })
                    ->when(request()->has('shop_products') && request()->shop_products == 'most-popular', function ($q) {
                        $q->orderBy('total_sale', 'desc');
                    });
            }])
            ->has('products');
    }
    public function scopeShop($query)
    {
        return $query
            ->when(request()->has('search'), function ($q) {
                return $q->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . request()->search . '%');
                });
            })
            ->when(request()->has('shop_products') && request()->shop_products == 'price-low-hight', function ($q) {
                return $q->orderBy('price', 'asc');
            })
            ->when(request()->has('shop_products') && request()->shop_products == 'price-high-low', function ($q) {
                return $q->orderBy('price', 'desc');
            })
            ->when(request()->has('shop_products') && request()->shop_products == 'most-popular', function ($q) {
                return $q->orderBy('total_sale', 'desc');
            })
            ->when(request()->has('division'), function ($q) {
                return $q->where('division', request()->division);
            })
            ->when(request()->has('district'), function ($q) {
                return $q->where('district', request()->district);
            })
            ->when(
                request()->has('reviews'),
                function ($q) {
                    return  $q->whereHas('ratings', function ($q) {
                        $q->where('rating', request()->reviews);
                    });
                }
            )

            ->orderBy('created_at', 'desc');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'shop_user', 'shop_id', 'user_id')->withTimestamps();
    }
    public function monthlyCharge()
    {
        $chargeable_product_count = $this->products()->count() - 10;
        $per_product_charge = 75;

        return (max($chargeable_product_count, 0) * $per_product_charge);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class)->where('status', 1)->latest();
    }
    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
    public function notifications()
    {
        return $this->hasmany(Notification::class, 'shop_id');
    }
    public function scopeComplete($query)
    {
        return $query->where('status', 1)->where('is_shipping_enabled', true);
    }

    public function isComplete(): bool
    {
        return $this->status && $this->is_shipping_enabled;
    }
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
    public function earnings()
    {
        return $this->hasMany(Earning::class, 'shop_id');
    }

    protected static function boot()
    {
        parent::boot();

        if (Route::is('homepage') || Route::is('shops') || Route::is('vendors')) {

            static::addGlobalScope('division', function (Builder $builder) {
                $division = session()->get('division');
                if ($division && $division !== 'Bangladesh') {
                    $builder->where('division', $division);
                }
            });
        }
    }
}
