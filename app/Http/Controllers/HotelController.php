<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Hotel;
use App\Models\Member;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    // Main Display
    public function render()
    {
        return view('pages.hotels');
    }

    // Hotels Start
    public function getHotels()
    {
        $hotels = Hotel::get();
        return $hotels;
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
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $hotel[$key] = $value;
            }
        }
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
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
    // Hotels End
    // Room Types Start

    public function getRoomtypes()
    {
        $roomtypes = Roomtype::get();
        foreach ($roomtypes as $key => $roomType) {
            $roomtypes[$key]->hotel_name = Hotel::where('hotel_uid', $roomType->hotel_uid)->first('hotel_names');
            $roomtypes[$key]->room_type_status = $roomtypes[$key]->room_type_status == 1 ? 'Active' : 'InActive';
        }
        return $roomtypes;
    }

    public function addRoomTypeRender($id = null)
    {
        $hotel = Hotel::get();
        if ($id) {
            $roomType = Roomtype::where('room_type_uid', $id)->first();
            return view('pages.addRoomTypes', ['hotels' => $hotel, 'roomType' => $roomType]);
        } else {
            return view('pages.addRoomTypes', ['hotels' => $hotel]);
        }
    }

    public function addRoomType(Request $req)
    {
        $roomtype = new Roomtype();
        $roomtype->room_type_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $roomtype[$key] = $value;
            }
        }
        try {
            $savedRoomType = $roomtype->save();
            if ($savedRoomType) {
                return back()->with('message', "Room Type Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateRoomType(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $updateRoomType = Roomtype::where('room_type_uid', $id)->update($arrayToBeUpdate);
            if ($updateRoomType) {
                return back()->with('message', "Room Type Updated Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Room Types End

    // Room  Start

    public function getRooms()
    {
        $rooms = Room::get();
        // foreach ($rooms as $key => $rooms) {
        //     $rooms[$key]->hotel_name = Hotel::where('hotel_uid', $roomType->hotel_uid)->first('hotel_names');
        //     $rooms[$key]->room_type_status = $roomtypes[$key]->room_type_status == 1 ? 'Active' : 'InActive';
        // }
        return $rooms;
    }

    public function addRoomRender($id = null)
    {
        $rooms = Room::get();
        $hotels = Hotel::get();
        $roomTypes = Roomtype::get();
        // $members = Member::where('member_status', 1)->get();
        $members = DB::table('members')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'members.delegation')
            ->where('member_status', 1)
            ->select('members.*', 'delegations.country', 'delegations.delegationCode', 'delegates.first_Name', 'delegates.last_Name')
            ->get();
        $delegates = DB::table('delegates')
            ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
            ->where('status', 1)
            ->select('delegates.*', 'delegations.country', 'delegations.delegationCode')
            ->get();
        $delegates = Delegate::where('status', 1)->whereNotNull('first_Name')->get();
        foreach ($members as $key => $member) {
            $members[$key]->guestType = 'Member';
            $members[$key]->uid = $members[$key]->member_uid;
            $members[$key]->first_Name = $members[$key]->member_first_Name;
            $members[$key]->last_Name = $members[$key]->member_last_Name;
        }
        foreach ($delegates as $key => $delegate) {
            $delegates[$key]->guestType = 'Delegate';
        }
        foreach ($roomTypes as $key => $roomType) {
            $roomTypes[$key]->hotel_name = Hotel::where('hotel_uid', $roomType->hotel_uid)->first('hotel_names');
            // $rooms[$key]->room_type_status = $roomtypes[$key]->room_type_status == 1 ? 'Active' : 'InActive';
        }
        $guests = [...$delegates, ...$members];
        if ($id) {
            $selectedRoom = Room::where('hotel_uid', $id)->first();
            return view('pages.addRoom', ['selectedRoom' => $selectedRoom, 'rooms' => $rooms, 'hotels' => $hotels, 'roomTypes' => $roomTypes, 'guests' => $guests]);
        } else {
            return $guests;
            // return view('pages.addRoom', ['rooms' => $rooms, 'hotels' => $hotels, 'roomTypes' => $roomTypes,  'guests' => $guests]);
        }
    }

    public function addRoom(Request $req)
    {
        $room = new Room();
        $room->room_uid = (string) Str::uuid();
        $room->room_logged_by = session()->get('user')->uid;
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $roomtype[$key] = $value;
            }
        }
        try {
            $savedRoomType = $roomtype->save();
            if ($savedRoomType) {
                return back()->with('message', "Room Type Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Room End

}
