<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shop()  {
        return $this->belongsTo(Shop::class);
    }
    public function order()  {
        return $this->belongsTo(Order::class);
    }
}
