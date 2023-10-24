<?php

namespace App\Livewire;

use Livewire\Component;

class CountrySelectComponent extends Component
{
    public $selectmodel='';
    public function render()
    {
        return view('livewire.country-select-component');
    }
}
