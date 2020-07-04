<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class Viz extends Component
{
    public $colors;

    public function mount(){
        $this->randomGradient();

    }

    public function render()
    {
        return view('livewire.viz');
    }

    public function addColor(){
        $this->colors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function subColor(){
        array_pop($this->colors);
//      
    }

    public function randomGradient(){
        $this->colors = config('gradients')->random()['colors'];
    }
}
