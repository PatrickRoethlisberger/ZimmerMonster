<?php

namespace App\Filters;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class RoomEquipmentFilter extends Filter
{
    public $title =  "Ausrüstungs Filter";
    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param Array $value Associative array with the boolean value for each of the options
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('equipments', function ($query) use ($value) {
            $query->where('equipment_id', $value);
        });
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): Array
    {
        $options = Equipment::all()->pluck('id', 'name', 'id')->toArray();
        return $options;
    }
}
