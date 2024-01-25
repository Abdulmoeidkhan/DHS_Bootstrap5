<?php

namespace App\Livewire;

use App\Models\CarPlan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class CarPlanComponent extends Component
{
    public $delegationUid;
    public $carAQuantity = 0;
    public $carBQuantity = 0;
    // public $carCategory = '';
    public $carPlanuid = 0;
    public $savedcarplan = 0;
    public $isForSaved = 1;

    public function save()
    {
        $carPlan = new CarPlan();
        $carPlan->car_plan_uid = (string) Str::uuid();
        $carPlan->car_category_a = $this->carAQuantity;
        $carPlan->car_category_b = $this->carBQuantity;
        $carPlan->delegation_uid = $this->delegationUid;
        $this->savedcarplan = $carPlan->save();
        // $this->reset();
        $this->dispatch('carplansaved')->self();
        $this->js("alert('Plan saved!')"); 
    }

    public function update()
    {
        $carsPlan = CarPlan::where('car_plan_uid', $this->carPlanuid)->update(['car_category_a' => $this->carAQuantity, 'car_category_b' => $this->carBQuantity]);
        if ($carsPlan) {
            // $this->reset();
            $this->js("alert('Plan Updated!')"); 
            $this->dispatch('carplansaved')->self();
        }
    }

    #[On('carplansaved')]
    public function render()
    {
        $carsPlan=CarPlan::where('delegation_uid', $this->delegationUid)->first();
        // $carsPlan = !$this->isForSaved ? CarPlan::where('delegation_uid', $this->delegationUid)->first():0;
        if ($carsPlan) {
            $this->isForSaved=0;
            $this->carAQuantity = $carsPlan->car_category_a;
            $this->carBQuantity = $carsPlan->car_category_b;
            $this->carPlanuid = $carsPlan->car_plan_uid;
        }
        return view('livewire.car-plan-component');
    }
}
