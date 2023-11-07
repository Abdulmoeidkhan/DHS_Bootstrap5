<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function render()
    {
        return view('pages.hotels');
    }

    public function getHotels()
    {
        $hotels = Hotel::get();
        return $hotels;
    }

    public function getRooms()
    {
        $rooms = Room::get();
        return $rooms;
    }

    public function Roomtypes()
    {
        $roomtypes = Roomtype::get();
        return $roomtypes;
    }

    public function addHotelRender($id = null)
    {
        if ($id) {
            $hotel = Hotel::where('hotel_uid', $id)->first();
            return view('pages.addHotel', ['hotel' => $hotel]);
        } else {
            return view('pages.addHotel');
        }
    }

    public function addHotel(Request $req)
    {
        $hotel = new Hotel();
        $hotel->hotel_uid = (string) Str::uuid();
        $hotel->hotel_names = $req->hotelName;
        $hotel->hotel_address = $req->hotelAddress;
        $hotel->contact_person = $req->contactPerson;
        $hotel->contact_number = $req->contactNumber;
        $hotel->hotel_remarks = $req->hotelRemarks;
        try {
            $savedhotel = $hotel->save();
            if ($savedhotel) {
                return back()->with('message', "Hotels Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateHotel(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $updateHotel = Hotel::where('hotel_uid', $id)->update($arrayToBeUpdate);
            if ($updateHotel) {
                return back()->with('message', "Hotels Updated Successfully");
            }
            // return $arrayToBeUpdate;
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
}
