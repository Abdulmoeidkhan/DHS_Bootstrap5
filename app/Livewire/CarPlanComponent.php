<?php

namespace App\Livewire;

use App\Models\CarPlan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class CarPlanComponent extends Component
{
    public $delegationUid;
    public $carQuantity = 0;
    public $carCategory = '';
    public $carPlanuid = 0;
    public $savedcarplan = 0;
    public $isForSaved = 1;

    public function save()
    {
        $carPlan = new CarPlan();
        $carPlan->car_plan_uid = (string) Str::uuid();
        $carPlan->car_category_uid = $this->carCategory;
        $carPlan->car_quantity = $this->carQuantity;
        $carPlan->delegation_uid = $this->delegationUid;
        $this->savedcarplan = $carPlan->save();
        $this->reset();
        $this->dispatch('carplansaved')->self();
        $this->js("alert('Plan saved!')"); 
    }

    public function update()
    {
        $carsPlan = CarPlan::where('car_plan_uid', $this->carPlanuid)->update(['car_category_uid' => $this->carCategory, 'car_quantity' => $this->carQuantity]);
        if ($carsPlan) {
            // $this->reset();
            $this->js("alert('Plan Updated!')"); 
            $this->dispatch('carplansaved')->self();
        }
    }

    #[On('carplansaved')]
    public function render()
    {
        $carsPlan = !$this->isForSaved ? CarPlan::where('delegation_uid', $this->delegationUid)->first():0;
        if ($carsPlan) {
            $this->carQuantity = $carsPlan->car_quantity;
            $this->carCategory = $carsPlan->car_category_uid;
            $this->carPlanuid = $carsPlan->car_plan_uid;
        }
        return view('livewire.car-plan-component');
    }
}
