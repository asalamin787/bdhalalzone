<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function earnings() {
        $earnings=Earning::where('shop_id',auth()->user()->shop->id)->latest()->get();
        return view('auth.seller.earnings',compact('earnings'));
    }
}
