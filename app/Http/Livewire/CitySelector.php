<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class CitySelector extends Component
{

    public $city_id;
    public $plz;
    public $cities;

    public function mount()
    {
        if(!$this->city_id) {
            $this->reset('cities');
            $this->cities = collect();
        } else {
            $this->cities = City::where('id', $this->city_id)->get();
            $this->plz = $this->cities->first()->plz;
        }
    }

    public function updatedPLZ($plz)
    {
        $this->cities = City::where('PLZ', $plz)->get();
    }

}
