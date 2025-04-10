<?php

namespace App\Livewire;

use App\Models\HotelPlan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class HotelPlanComponent extends Component
{
    public $delegationUid;
    public $hotelUid = '';
    public $suiteQuantity = 0;
    public $hotelSuiteDetail = [];
    public $deluxQuantity = 0;
    public $hotelDeluxDetail = [];
    public $execQuantity = 0;
    public $hotelExecDetail = [];
    public $standardQuantity = 0;
    public $hotelStandardDetail = [];
    public $dOccupancyQuantity = 0;
    public $hotelDoubleDetail = [];
    public $hotelPlanuid = 0;
    public $savedhotelplan = 0;
    public $isForSaved = 1;
    public $message;


    public function mount($delegationUid)
    {
        $this->delegationUid = $delegationUid;
        $hotelPlan = HotelPlan::where('delegation_uid', $this->delegationUid)->first();
        // $hotelPlan = !$this->isForSaved ? HotelPlan::where('delegation_uid', $this->delegationUid)->first() : 0;
        if ($hotelPlan) {
            $this->isForSaved = 0;
            $this->suiteQuantity = $hotelPlan->hotel_roomtype_suite;
            $this->deluxQuantity = $hotelPlan->hotel_roomtype_delux;
            $this->execQuantity = $hotelPlan->hotel_roomtype_exec;
            $this->standardQuantity = $hotelPlan->hotel_roomtype_standard;
            $this->dOccupancyQuantity = $hotelPlan->hotel_roomtype_doubleOccupancy;
            $this->hotelSuiteDetail = json_decode($hotelPlan->hotel_roomtype_suite_details);
            $this->hotelDeluxDetail = json_decode($hotelPlan->hotel_roomtype_delux_details);
            $this->hotelExecDetail = json_decode($hotelPlan->hotel_roomtype_exec_details);
            $this->hotelStandardDetail = json_decode($hotelPlan->hotel_roomtype_standard_details);
            $this->hotelDoubleDetail = json_decode($hotelPlan->hotel_roomtype_doubleOccupancy_details);
            $this->hotelUid = $hotelPlan->hotel_uid;
            $this->hotelPlanuid = $hotelPlan->hotel_plan_uid;
        }

    }

    public function save()
    {
        $this->message = '';
        $hotelPlan = new HotelPlan();
        $hotelPlan->hotel_plan_uid = (string) Str::uuid();
        $hotelPlan->hotel_uid = $this->hotelUid;
        $hotelPlan->delegation_uid = $this->delegationUid;
        $hotelPlan->hotel_roomtype_suite = $this->suiteQuantity;
        $hotelPlan->hotel_roomtype_suite_details = json_encode($this->hotelSuiteDetail) ?? [];
        $hotelPlan->hotel_roomtype_delux = $this->deluxQuantity;
        $hotelPlan->hotel_roomtype_delux_details = json_encode($this->hotelDeluxDetail) ?? [];
        $hotelPlan->hotel_roomtype_exec = $this->execQuantity;
        $hotelPlan->hotel_roomtype_exec_details = json_encode($this->hotelExecDetail) ?? [];
        $hotelPlan->hotel_roomtype_standard = $this->standardQuantity;
        $hotelPlan->hotel_roomtype_standard_details = json_encode($this->hotelStandardDetail) ?? [];
        $hotelPlan->hotel_roomtype_doubleOccupancy = $this->dOccupancyQuantity;
        $hotelPlan->hotel_roomtype_doubleOccupancy_details = json_encode($this->hotelDoubleDetail) ?? [];
        try {
            $this->savedhotelplan = $hotelPlan->save();
            if ($this->savedhotelplan) {
                $this->message = "Plan has been Updated Successfully";
                $this->dispatch('hotelplansaved')->self();
                $this->js("alert('" . $this->message . "')");
                // $this->reset();
                return response()->json(['success' => true, 'requestStatus' => 'Plan has been Updated Successfully'], 200);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->message = "Error:" . $exception->errorInfo[2];
            $this->dispatch('hotelplansaved')->self();
            $this->js("alert('" . $this->message . "')");
            // $this->reset();
            return response()->json(['success' => false, 'requestStatus' => $exception->errorInfo[2]], 404);
        }
    }

    public function update()
    {
        try {
            $hotelsPlan = HotelPlan::where('hotel_plan_uid', $this->hotelPlanuid)->update(
                [
                    'hotel_uid' => $this->hotelUid,
                    'hotel_roomtype_suite' => $this->suiteQuantity,
                    'hotel_roomtype_delux' => $this->deluxQuantity,
                    'hotel_roomtype_exec' => $this->execQuantity,
                    'hotel_roomtype_standard' => $this->standardQuantity,
                    'hotel_roomtype_doubleOccupancy' => $this->dOccupancyQuantity,
                    'hotel_roomtype_suite_details' => json_encode($this->hotelSuiteDetail) ?? [],
                    'hotel_roomtype_delux_details' => json_encode($this->hotelDeluxDetail) ?? [],
                    'hotel_roomtype_exec_details' => json_encode($this->hotelExecDetail) ?? [],
                    'hotel_roomtype_standard_details' => json_encode($this->hotelStandardDetail) ?? [],
                    'hotel_roomtype_doubleOccupancy_details' => json_encode($this->hotelDoubleDetail) ?? [],
                ]
            );
            if ($hotelsPlan) {
                $this->message = "Plan has been Updated Successfully";
                $this->dispatch('hotelplansaved')->self();
                $this->js("alert('" . $this->message . "')");
                // $this->reset();
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

    #[On('hotelplansaved')]
    public function render()
    {

        return view('livewire.hotel-plan-component');
    }
}
