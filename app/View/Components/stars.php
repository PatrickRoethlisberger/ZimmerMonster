<?php

namespace App\View\Components;

use Illuminate\View\Component;

class stars extends Component
{
    /**
     * Amount of stars to display
     *
     * @var string
     */
    public $stars;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($stars)
    {
        $this->stars = $stars;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stars');
    }
}
