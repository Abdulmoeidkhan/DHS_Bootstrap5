<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function render()
    {
        return view('pages.hotels');
    }
    public function Hotels()
    {
        $hotels = Hotel::get();
        return $hotels;
    }

    public function Rooms()
    {
        $rooms = Room::get();
        return $rooms;
    }
    public function Roomtypes()
    {
        $roomtypes = Roomtype::get();
        return $roomtypes;
    }
}
