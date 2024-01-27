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
    public $standardQuantity = 0;
    public $suiteQuantity = 0;
    public $superiorQuantity = 0;
    public $dOccupancyQuantity = 0;
    public $hotelPlanuid = 0;
    public $savedhotelplan = 0;
    public $isForSaved = 1;

    public function save()
    {
        $hotelPlan = new HotelPlan();
        $hotelPlan->hotel_plan_uid = (string) Str::uuid();
        $hotelPlan->hotel_uid = $this->hotelUid;
        $hotelPlan->delegation_uid = $this->delegationUid;
        $hotelPlan->hotel_roomtype_standard = $this->standardQuantity;
        $hotelPlan->hotel_roomtype_suite = $this->suiteQuantity;
        $hotelPlan->hotel_roomtype_superior = $this->superiorQuantity;
        $hotelPlan->hotel_roomtype_doubleOccupancy = $this->dOccupancyQuantity;
        $this->savedhotelplan = $hotelPlan->save();
        // $hotelPlan->hotel_roomtpye_uid = $this->hotelRoomtypeUid;
        // $hotelPlan->hotel_quantity = $this->hotelQuantity;
        // $this->reset();
        $this->dispatch('hotelplansaved')->self();
        $this->js("alert('Plan saved!')");
    }

    public function update()
    {
        $hotelsPlan = HotelPlan::where('hotel_plan_uid', $this->hotelPlanuid)->update(['hotel_uid' => $this->hotelUid, 'hotel_roomtype_standard' => $this->standardQuantity,'hotel_roomtype_suite' => $this->suiteQuantity,'hotel_roomtype_superior' => $this->superiorQuantity,'hotel_roomtype_doubleOccupancy' => $this->dOccupancyQuantity]);
        if ($hotelsPlan) {
            $this->js("alert('Plan Updated!')");
            $this->dispatch('hotelplansaved')->self();
        }
    }

    #[On('hotelplansaved')]
    public function render()
    {
        $hotelPlan = HotelPlan::where('delegation_uid', $this->delegationUid)->first();
        // $hotelPlan = !$this->isForSaved ? HotelPlan::where('delegation_uid', $this->delegationUid)->first() : 0;
        if ($hotelPlan) {
            $this->isForSaved = 0;
            $this->standardQuantity = $hotelPlan->hotel_roomtype_standard;
            $this->suiteQuantity = $hotelPlan->hotel_roomtype_suite;
            $this->superiorQuantity = $hotelPlan->hotel_roomtype_superior;
            $this->dOccupancyQuantity = $hotelPlan->hotel_roomtype_doubleOccupancy;
            $this->hotelUid = $hotelPlan->hotel_uid;
            $this->hotelPlanuid = $hotelPlan->hotel_plan_uid;
        }
        return view('livewire.hotel-plan-component');
    }
}
