<?php

namespace App\Livewire;

use App\Http\Controllers\SummaryController;
use Livewire\Component;
use Livewire\Attributes\On;


class SummaryCardComponent extends Component
{

    public $firstCol;
    public $secondCol;
    public $heading;
    public $dataFunc;
    public $childComp;
    public $calcultedValue;

    public function mount($comp)
    {
        $this->firstCol = $comp['firstCol'];
        $this->secondCol = $comp['secondCol'];
        $this->heading = $comp['heading'];
        $this->dataFunc = $comp['dataFunc'];
        $controller = new SummaryController;
        $data = call_user_func([$controller, $comp['dataFunc']]);
        $this->calcultedValue = $data;
        if (isset($comp['childComp'])) {
            $this->childComp = $comp['childComp'];
        }
    }

    public function update()
    {
        $this->calcultedValue = '';
        $controller = new SummaryController;
        $data = call_user_func([$controller, $this->dataFunc]);
        $this->calcultedValue = $data;
        $this->dispatch('updatedData')->self();
    }

    #[On('updatedData')]
    public function render()
    {
        return view('livewire.summary-card-component');
    }
}
