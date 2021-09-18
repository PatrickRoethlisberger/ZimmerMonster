<?php

namespace App\Filters;

use LaravelViews\Filters\BaseFilter;

class FromUntilFilter extends BaseFilter
{
    public $type = 'dates';

    public $view = 'dates-filter';

    public function passValuesFromRequestToFilter($value)
    {
        return $value;
    }
}
