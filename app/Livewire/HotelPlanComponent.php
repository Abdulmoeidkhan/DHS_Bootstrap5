<?php

namespace App\Livewire;

use App\Models\HotelPlan;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class HotelPlanComponent extends Component
{
    public $delegationUid;
    public $hotelQuantity = 0;
    public $hotelUid = '';
    public $hotelRoomtypeUid = '';
    public $hotelPlanuid = 0;
    public $savedhotelplan = 0;
    public $isForSaved = 1;

    public function save()
    {
        $hotelPlan = new HotelPlan();
        $hotelPlan->hotel_plan_uid = (string) Str::uuid();
        $hotelPlan->hotel_roomtpye_uid = $this->hotelRoomtypeUid;
        $hotelPlan->hotel_uid = $this->hotelUid;
        $hotelPlan->hotel_quantity = $this->hotelQuantity;
        $hotelPlan->delegation_uid = $this->delegationUid;
        $this->savedhotelplan = $hotelPlan->save();
        // $this->reset();
        $this->dispatch('hotelplansaved')->self();
        $this->js("alert('Plan saved!')");
    }

    public function update()
    {
        $hotelsPlan = HotelPlan::where('hotel_plan_uid', $this->hotelPlanuid)->update(['hotel_roomtpye_uid' => $this->hotel_roomtpye_uid, 'hotel_uid' => $this->hotelCategory, 'hotel_quantity' => $this->hotelQuantity]);
        if ($hotelsPlan) {
            $this->js("alert('Plan Updated!')");
            $this->dispatch('hotelplansaved')->self();
        }
    }

    #[On('hotelplansaved')]
    public function render()
    {
        $hotelPlan = !$this->isForSaved ? HotelPlan::where('delegation_uid', $this->delegationUid)->first() : 0;
        if ($hotelPlan) {
            $this->hotelQuantity = $hotelPlan->hotel_quantity;
            $this->hotelUid = $hotelPlan->hotel_uid;
            $this->hotelRoomtypeUid = $hotelPlan->hotel_roomtpye_uid;
            $this->hotelPlanuid = $hotelPlan->hotel_plan_uid;
        }
        return view('livewire.hotel-plan-component');
    }
}
