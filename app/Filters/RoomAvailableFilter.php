<?php

namespace App\Filters;

use App\Filters\FromUntilFilter as FiltersFromUntilFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class RoomAvailableFilter extends FiltersFromUntilFilter
{
    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param Carbon $date Carbon instance with the date selected
     * @return Builder Query modified
     */
    public function apply(Builder $query, $date, $request): Builder
    {
        // dd($request);
        // $query->where('', $value);
    }
}
