<?php

namespace App\Http\Livewire;

use Codeboxr\PathaoCourier\Facade\PathaoCourier;
use Illuminate\Support\Collection;
use Livewire\Component;

class PathaoForm extends Component
{
    public $cities = [];
    public $zones = [];
    public $areas = [];
    public $areasWithOption = [];

    public $selectedCity = null;
    public $selectedZone = null;
    public $selectedArea = null;

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

    public function getCities()
    {
        // Replace with your actual city data fetching logic
        return (new Collection(PathaoCourier::area()->city()->data))->pluck('city_name', 'city_id')->toArray();
    }

    public function getZones($city)
    {

        // Replace with your actual zone data fetching logic based on city
        $zones = (new Collection(PathaoCourier::area()->zone($city)->data))->pluck('zone_name', 'zone_id')->toArray();

        return $zones ?? [];
    }

    public function getAreas($zone)
    {
        $data = (new Collection(PathaoCourier::area()->area($zone)->data));

        // Replace with your actual area data fetching logic based on zone
        $areas = $data->pluck('area_name', 'area_id')->toArray();
        $this->areasWithOption = $data->mapWithKeys(fn ($area) => [$area->area_id => ['home_delivery_available' => $area->home_delivery_available, 'pickup_available' => $area->pickup_available]])->toArray();
        return $areas ?? [];
    }
    public function render()
    {
        return view('livewire.pathao-form');
    }
}
