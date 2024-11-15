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
    public $carADetail = [];
    public $carACarDetail = [];
    public $carBQuantity = 0;
    public $carBDetail = [];
    public $carBCarDetail = [];
    public $carCQuantity = 0;
    public $carCDetail = [];
    public $carCCarDetail = [];
    // public $carCategory = '';
    public $carPlanuid = 0;
    public $savedcarplan = 0;
    public $isForSaved = 1;
    public $message;


    public function mount($delegationUid)
    {
        $this->delegationUid = $delegationUid;
        $carsPlan = CarPlan::where('delegation_uid', $this->delegationUid)->first();
        // $carsPlan = !$this->isForSaved ? CarPlan::where('delegation_uid', $this->delegationUid)->first():0;
        if ($carsPlan) {
            $this->isForSaved = 0;
            $this->carAQuantity = $carsPlan->car_category_a;
            $this->carBQuantity = $carsPlan->car_category_b;
            $this->carCQuantity = $carsPlan->car_category_c;
            $this->carADetail = json_decode($carsPlan->car_category_a_details);
            $this->carBDetail = json_decode($carsPlan->car_category_b_details);
            $this->carCDetail = json_decode($carsPlan->car_category_c_details);
            $this->carACarDetail = json_decode($carsPlan->car_category_a_car_details);
            $this->carBCarDetail = json_decode($carsPlan->car_category_b_car_details);
            $this->carCCarDetail = json_decode($carsPlan->car_category_c_car_details);
            $this->carPlanuid = $carsPlan->car_plan_uid;
        }

    }

    public function rendering(){
        $carsPlan = CarPlan::where('delegation_uid', $this->delegationUid)->first();
        if ($carsPlan) {
            $this->isForSaved = 0;
            $this->carAQuantity = $carsPlan->car_category_a;
            $this->carBQuantity = $carsPlan->car_category_b;
            $this->carCQuantity = $carsPlan->car_category_c;
            $this->carADetail = json_decode($carsPlan->car_category_a_details);
            $this->carBDetail = json_decode($carsPlan->car_category_b_details);
            $this->carCDetail = json_decode($carsPlan->car_category_c_details);
            $this->carACarDetail = json_decode($carsPlan->car_category_a_car_details);
            $this->carBCarDetail = json_decode($carsPlan->car_category_b_car_details);
            $this->carCCarDetail = json_decode($carsPlan->car_category_c_car_details);
            $this->carPlanuid = $carsPlan->car_plan_uid;
        }
    }


    public function save()
    {
        $this->message = '';
        $carPlan = new CarPlan();
        $carPlan->car_plan_uid = (string) Str::uuid();
        $carPlan->car_category_a = $this->carAQuantity;
        $carPlan->car_category_a_details = json_encode($this->carADetail) ?? [];
        $carPlan->car_category_a_car_details = json_encode($this->carACarDetail) ?? [];
        $carPlan->car_category_b = $this->carBQuantity;
        $carPlan->car_category_b_details = json_encode($this->carBDetail) ?? [];
        $carPlan->car_category_b_car_details = json_encode($this->carBCarDetail) ?? [];
        $carPlan->car_category_c = $this->carCQuantity;
        $carPlan->car_category_c_details = json_encode($this->carCDetail) ?? [];
        $carPlan->car_category_c_car_details = json_encode($this->carCCarDetail) ?? [];
        $carPlan->delegation_uid = $this->delegationUid;
        try {
            $this->savedcarplan = $carPlan->save();
            if ($this->savedcarplan) {
                $this->message = "Plan has been Updated Successfully";
                $this->dispatch('carplansaved')->self();
                $this->js("alert('" . $this->message . "')");
                // $this->reset();
                return response()->json(['success' => true, 'requestStatus' => 'Plan has been Updated Successfully'], 200);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->message = "Error:" . $exception->errorInfo[2];
            $this->js("alert('" . $this->message . "')");
            // $this->reset();
            $this->dispatch('carplansaved')->self();
            return response()->json(['success' => false, 'requestStatus' => $exception->errorInfo[2]], 404);
        }
    }

    public function update()
    {
        try {
            $carsPlan = CarPlan::where('car_plan_uid', $this->carPlanuid)->update(
                [
                    'car_category_a' => $this->carAQuantity,
                    'car_category_b' => $this->carBQuantity,
                    'car_category_c' => $this->carCQuantity,
                    'car_category_a_details' => json_encode($this->carADetail) ?? [],
                    'car_category_b_details' => json_encode($this->carBDetail) ?? [],
                    'car_category_c_details' => json_encode($this->carCDetail) ?? [],
                    'car_category_a_car_details' => json_encode($this->carACarDetail) ?? [],
                    'car_category_b_car_details' => json_encode($this->carBCarDetail) ?? [],
                    'car_category_c_car_details' => json_encode($this->carCCarDetail) ?? [],
                ]
            );
            if ($carsPlan) {
                $this->message = "Plan has been Updated Successfully";
                // $this->reset();
                $this->dispatch('carplansaved')->self();
                $this->js("alert('" . $this->message . "')");
                return response()->json(['success' => true, 'requestStatus' => 'Plan has been Updated Successfully'], 200);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->message = "Error:" . $exception->errorInfo[2];
            $this->dispatch('carplansaved')->self();
            $this->js("alert('" . $this->message . "')");
            // $this->reset();
            return response()->json(['success' => false, 'requestStatus' => $exception->errorInfo[2]], 404);
        }
    }

    #[On('carplansaved')]
    public function render()
    {
        // $carsPlan = CarPlan::where('delegation_uid', $this->delegationUid)->first();
        // // $carsPlan = !$this->isForSaved ? CarPlan::where('delegation_uid', $this->delegationUid)->first():0;
        // if ($carsPlan) {
        //     $this->isForSaved = 0;
        //     $this->carAQuantity = $carsPlan->car_category_a;
        //     $this->carBQuantity = $carsPlan->car_category_b;
        //     $this->carCQuantity = $carsPlan->car_category_c;
        //     $this->carADetail = $carsPlan->car_category_a_details;
        //     $this->carBDetail = $carsPlan->car_category_b_details;
        //     $this->carCDetail = $carsPlan->car_category_c_details;
        //     $this->carPlanuid = $carsPlan->car_plan_uid;
        // }
        return view('livewire.car-plan-component');
    }
}
