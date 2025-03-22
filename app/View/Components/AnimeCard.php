<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnimeCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $info;



    public function __construct($info)
    {

        $this->info = $info;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anime-card');
    }
}
