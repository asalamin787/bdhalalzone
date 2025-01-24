<?php

namespace App\Models;

use App\Models\Traits\Chargeable;
use App\Models\Traits\HasMeta;
use Carbon\Carbon;
use Codeboxr\PathaoCourier\Facade\PathaoCourier;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Chargeable,HasMeta;


    protected $meta_attributes = [
        'consignment_id',
        'merchant_order_id',
        'order_status',
        'delivery_fee',
    ];
    protected $casts = ['created_at'=>'datetime'];
    protected $guarded = [];
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }


    public function childs()
    {
        return $this->hasMany(Order::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Order::class, 'parent_id');
    }
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'order_id');
    }
    
    public function getFirstNameAttribute()
    {
        return @explode(' ', json_decode($this->shipping)->name)[0] ?? '';
    }
    public function getEmailAttribute()
    {
        return json_decode($this->shipping)->email;
    }
    public function getPhoneAttribute()
    {
        return @json_decode($this->shipping)->phone;
    }
    public function getPostCodeAttribute()
    {
        return @json_decode($this->shipping)->post_code;
    }
    public function getCityAttribute()
    {       
        return @json_decode($this->shipping)->city->name;
    }
    public function getZoneAttribute()
    {
        return @json_decode($this->shipping)->zone->name;
    }
    public function getAreaAttribute()
    {
        return @json_decode($this->shipping)->area->name;
    }
    public function getAddressAttribute()
    {
        return @json_decode($this->shipping)->address;
    }
    public function getLastNameAttribute()
    {
        return @explode(' ', json_decode($this->shipping)->name)[1] ?? '';
    }
    public function getFullNameAttribute()
    {
        return @json_decode($this->shipping)->name;
    }



    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
    public function scopeFilter($query)
    {
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        $startMonth = Carbon::now()->startOfMonth();
        $EndMonth = Carbon::now()->endOfMonth();

        return $query
            ->when(request('sales') == 2, function ($query) {
                $query->whereYear('created_at', '=', Carbon::now()->year);
            })
            ->when(request('sales') == 3, function ($query) {
                $query->where('created_at', Carbon::now());
            })
            ->when(request('sales') == 1, function ($query) use ($currentWeekStart, $currentWeekEnd) {
                $query->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd]);
            })
            ->when(request('sales') == 4, function ($query) use ($startMonth, $EndMonth) {
                $query->whereBetween('created_at', [$startMonth, $EndMonth]);
            });
    }
    public function scopeCountFilter($query)
    {
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        $startMonth = Carbon::now()->startOfMonth();
        $EndMonth = Carbon::now()->endOfMonth();

        return $query
            ->when(request('orders') == 2, function ($query) {
                $query->whereYear('created_at', '=', Carbon::now()->year);
            })
            ->when(request('orders') == 3, function ($query) {
                $query->where('created_at', Carbon::now());
            })
            ->when(request('orders') == 1, function ($query) use ($currentWeekStart, $currentWeekEnd) {
                $query->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd]);
            })
            ->when(request('orders') == 4, function ($query) use ($startMonth, $EndMonth) {
                $query->whereBetween('created_at', [$startMonth, $EndMonth]);
            });
    }
    public function scopeChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id')->whereHas('childs');
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 1:
                return [
                    'label' => 'Processing',
                    'color' => "#ffa500",
                ];
            case 2:
                return [
                    'label' => "On it's way",
                    'color' => "#0000ff",
                ];
            case 3:
                return [
                    'label' => 'Canceled',
                    'color' => "#ff0000",
                ];
            case 4:
                return [
                    'label' => 'Delivered',
                    'color' => "#008000",
                ];
            case 5:
                return [
                    'label' => 'Refund Request',
                    'color' => "#c0610e",
                ];
            default:
                return [
                    'label' => 'Pending',
                    'color' => "#cd5c5c",
                ];
        }
    }
}
