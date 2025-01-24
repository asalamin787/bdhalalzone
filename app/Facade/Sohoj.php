<?php

namespace App\Facade;

use App\Models\Earning;
use Cart;
use Voyager;
use App\Models\Shipping;
use Codeboxr\PathaoCourier\Facade\PathaoCourier;

class Sohoj
{
    public function price($price)
    {
        return  $this->round_num($price) . "Tk";
    }
    public function tax()
    {
        $total =  Cart::getSubTotal() - $this->discount();
        $tax = ((Voyager::setting('admin.tax')) * $total) / 100;

        return $tax;
    }
    public function discount()
    {
        if (session()->has('discount')) {
            return session()->get('discount');
        }
        return 0;
    }
    public function discount_code()
    {
        if (session()->has('discount_code')) {
            return session()->get('discount_code');
        }
        return null;
    }
    public function shipping_method()
    {
        if (session()->has('shipping_method')) {
            return session()->get('shipping_method');
        } else {
            $shipping = Shipping::first();
            return $shipping->Shipping_method;
        }
    }
    public function shipping()
    {
        // if (session()->has('shipping_method')) {
        //     return session()->get('shipping_cost');
        // } else {
        //     $shipping = Shipping::first();
        //     return $shipping->shipping_cost;
        // }
        // $shipping=Voyager::setting('admin.shipping');
        // return $shipping * Cart::getTotalQuantity();
        $cart = Cart::getContent();

        $totalShippingCost = 0;

        foreach ($cart as $item) {
            $shippingCost = $item->model->shipping_cost;
            $totalShippingCost += $shippingCost;
        }

        return $totalShippingCost;
    }
    public function newItemTotal()
    {
        return Cart::getSubTotal();
    }
    public function newSubtotal()
    {
        return (Cart::getSubTotal()) - $this->discount();
    }
    public function newTotal()
    {
        return ($this->newSubtotal());
        // return ($this->newSubtotal() + $this->shipping());
    }
    public function round_num($price)
    {
        return round($price);
    }
    public function average_rating($ratings)
    {
        if ($ratings->count() > 0) {
            return $ratings->sum('rating') / $ratings->count();
        }
        return 0.00;
    }

    public function flatCommision($price)
    {
        if ($price < 30) {
            return  1.95;
        } elseif ($price > 30 && $price < 300) {
            return  3.75;
        } elseif ($price > 300 && $price < 1000) {
            return  7.95;
        } else {
            return  20;
        }
    }
    public function vendorprice($price)
    {
        // return $price;

        $tenPercent = $price * .06;
        $sixPercent = $price * .06;
        if ($price < 1000) {
            return ($price - $tenPercent);
        } else {
            return ($price - $sixPercent);
        }
    }

    public function shippingCost()
    {
        $total = 0;

        foreach (Cart::getContent() as $product) {


            $response =   PathaoCourier::order()->priceCalculation([
                "store_id" => $product->attributes['store_id'],
                "item_type" => 2,
                "delivery_type" => 48,
                "item_weight" => $product->attributes['weight'] * $product->quantity,
                "recipient_city" => 1,
                "recipient_zone" => 2
            ]);

            $total += $response->final_price;
        }
    }

    public function shopWoned($order)
    {
        $cost_percentage =  $order->subtotal *  ($order->shop->percentage_cost / 100);
        return $order->subtotal - $cost_percentage;
    }
    public function adminOwned($order)
    {

        if ($order->shop->percentage_cost !== null) {
            return $order->subtotal * ($order->shop->percentage_cost / 100);
        }
        return 0;
    }
    public function marchentigerOwned($order)
    {
        $adminOwned = 0;
        $affilateIncome = 0;
        if ($order->shop?->percentage_cost !== null) {
            $adminOwned = $order->subtotal *  ($order->shop->percentage_cost / 100);
        }
        if ($order->shop?->retailer?->percentage_cost !== null) {

            $affilateIncome = $adminOwned *  ($order->shop->retailer->percentage_cost / 100);
        }
        return $adminOwned - $affilateIncome;
    }
    public function shopTotalEarn($shop)
    {
        return $shop->earnings->sum('shop_earn');
    }
    public function retailTotalEarn($retailer)
    {
        return $retailer->earnings->sum('retailer_earn');
    }

    public function adminTotalEarn()
    {

        return Earning::sum('admin_earn');
    }
}
