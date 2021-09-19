<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class RoomFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name($name)
    {
        return $this->where(function($q) use ($name)
        {
            return $q->where('name', 'LIKE', "%$name%");
        });
    }

    public function hotel($hotel)
    {
        return $this->where('hotel_id', $hotel)->orWhere('slug', $hotel);
    }

    public function equipments($equipments)
    {
        $query = $this->whereHas('equipments');
        foreach($equipments as $equipment){
            $query->whereHas('equipments', function($q) use ($equipment){
                $q->where('equipment_id', $equipment);
            });
        }

        return $query->get();
    }

    public function availability($dates)
    {
        if(isset($dates['from']) && isset($dates['until'])){
            $from = Carbon::parse($dates['from']);
            $until = Carbon::parse($dates['until']);
            if($from->gte($until)){
                // Do not return anything if the from date is after the until date
                return $this->where('id', null);
            } else {
                return $this->available($from, $until);
            }
        } else  {
            return $this;
        }
    }

    public function stars($stars)
    {
        return $this->whereHas('hotel', function($q) use ($stars)
        {
            $q->where('stars', '>=', $stars);
        });
    }

    public function price($price)
    {
        return $this->where('price', '<=', $price);
    }

}
