<?php

namespace App\View\Components;

use App\Models\Prodcat;
use App\Services\DependencyVariables;
use Illuminate\View\Component;

class app extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public $categories;
    public function __construct()
    {
        // $this->categories = ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.app');
    }
}
