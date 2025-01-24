<?php

namespace App\Http\Livewire;

use Codeboxr\PathaoCourier\Facade\PathaoCourier;
use Illuminate\Support\Collection;
use Livewire\Component;
use Cart;
use Sohoj;

class Checkout extends Component
{

    public $cities = [];
    public $zones = [];
    public $areas = [];
    public $areasWithOption = [];

    public $selectedCity = null;
    public $selectedZone = null;
    public $selectedArea = null;

    public $shippingCost = 0;
    public $orderPaymentInfo = [];


    public function mount()
    {

        $this->cities = $this->getCities();
    }

    public function updatedSelectedCity($city)
    {
        $this->zones = $this->getZones($city);
        $this->selectedZone = null;
        $this->areas = [];
    }

    public function updatedSelectedZone($zone)
    {

        $this->areas = $this->getAreas($zone);
    }

    public function updatedSelectedArea()
    {

        $this->getShippingCost();
    }

    public function getCities()
    {
        // Replace with your actual city data fetching logic
        return (new Collection(PathaoCourier::area()->city()->data))->mapWithKeys(fn($city) => [$city->city_id . '-' . $city->city_name => $city->city_name])->toArray();
    }

    public function getZones($city)
    {

        $id = explode('-', $city);
        // Replace with your actual zone data fetching logic based on city
        $zones = (new Collection(PathaoCourier::area()->zone($id[0])->data))->mapWithKeys(fn($zone) => [$zone->zone_id . '-' . $zone->zone_name => $zone->zone_name])->toArray();

        return $zones ?? [];
    }

    public function getAreas($zone)
    {

        $id = explode('-', $zone);
        $data = (new Collection(PathaoCourier::area()->area($id[0])->data));

        // Replace with your actual area data fetching logic based on zone
        $areas = $data->mapWithKeys(fn($area) => [$area->area_id . '-' . $area->area_name => $area->area_name])->toArray();
        $this->areasWithOption = $data->mapWithKeys(fn($area) => [$area->area_id => ['home_delivery_available' => $area->home_delivery_available, 'pickup_available' => $area->pickup_available]])->toArray();
        return $areas ?? [];
    }



    public function getShippingCost()
    {


        $total = 0;
        $data = [];
        foreach (Cart::getContent() as $product) {
            $response =   PathaoCourier::order()->priceCalculation([
                "store_id" => $product->attributes['store_id'],
                "item_type" => 2,
                "delivery_type" => 48,
                "item_weight" => ($product->attributes['weight']  ? minValue($product->attributes['weight'], 0.1) : 0.5) * $product->quantity,
                "recipient_city" => explode('-', $this->selectedCity)[0],
                "recipient_zone" => explode('-', $this->selectedZone)[0]
            ]);



            $total += $response->final_price;
        }


        session()->put('order_payment_info', ['shipping' => $total, 'subtotal' => Sohoj::newSubtotal(), 'total' => Sohoj::newSubtotal() + $total]);
        $this->orderPaymentInfo = ['shipping' => $total, 'subtotal' => Sohoj::newSubtotal(), 'total' => Sohoj::newSubtotal() + $total];
        $this->shippingCost = $total;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
