<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateRooms;
use App\Models\Delegation;
use App\Models\Hotel;
use App\Models\HotelOperator;
use App\Models\HotelPlan;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Rank;
use App\Models\Room;
use App\Models\Roomtype;
use App\Models\User;
use App\Models\Vips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    protected function badge($characters, $prefix)
    {
        $possible = '0123456789';
        $code = $prefix;
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if ($i < $characters - 1) {
                $code .= "";
            }
            $i++;
        }
        return $code;
    }


    // Main Display
    public function categoryRender()
    {
        return view('pages.category');
    }

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
        $hotel->hotel_code = $this->badge(8, "HL");
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != 'submitMore' && $key != '_token' && strlen($value) > 0) {
                $hotel[$key] = $value;
            }
        }
        try {
            $savedhotel = $hotel->save();
            if ($savedhotel) {
                return $req->submitMore ? redirect()->back()->with('message', "Hotels Added Successfully") : redirect()->route('pages.category');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateHotel(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != 'submitMore' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $updateHotel = Hotel::where('hotel_uid', $id)->update($arrayToBeUpdate);
            if ($updateHotel) {
                return $req->submitMore ? redirect()->back()->with('message', "Hotels Updated Successfully") : redirect()->route('pages.category');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
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
                return redirect()->back()->with('message', "Room Type Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
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
                return redirect()->back()->with('message', "Room Type Updated Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Room Types End

    // Room  Start

    // public function getRooms()
    // {
    // $rooms = Room::get();
    // foreach ($rooms as $key => $room) {
    //     $rooms[$key]->room_type = Roomtype::where('room_type_uid', $room->room_type)->first(['room_type']);
    //     $rooms[$key]->hotel_names = Hotel::where('hotel_uid', $room->hotel_uid)->first(['hotel_names', 'hotel_uid']);
    //     $rooms[$key]->assign_to = Delegate::where('delegates_uid', $rooms[$key]->assign_to)->first('uid') ? Delegate::where('delegates_uid', $rooms[$key]->assign_to)->first('uid') : Member::where('member_uid', $rooms[$key]->assign_to)->first('member_uid');
    //     $rooms[$key]->assign_to = $rooms[$key]->assign_to->uid ? 'delegateProfile/' . $rooms[$key]->assign_to->uid . '' : 'members/memberFullProfile/' . $rooms[$key]->assign_to->member_uid . '';
    //     $rooms[$key]->room_logged_by = User::where('uid', $room->room_logged_by)->first('name');
    // }
    // return $rooms;
    // $rooms = DelegateRooms::orderBy('checked_in_time', 'asc')->get();
    // $rooms = DB::table('delegate_rooms')
    //     ->leftJoin('hotel_plans', 'delegate_rooms.hotel_plan_uid', '=', 'hotel_plans.hotel_plan_uid')
    //     ->leftJoin('hotels', 'hotel_plans.hotel_uid', '=', 'hotels.hotel_uid')
    //     ->leftJoin('roomtypes', 'hotel_plans.hotel_roomtpye_uid', '=', 'roomtypes.room_type_uid')
    //     ->leftJoin('delegations', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
    //     ->select('delegate_rooms.*', 'hotel_plans.*', 'hotels.*', 'roomtypes.*', 'delegations.delegationCode', 'delegations.country')
    //     ->get();
    // foreach ($rooms as $key => $room) {
    //     $rooms[$key]->plan = HotelPlan::where('hotel_plan_uid', $room->hotel_plan_uid)->first();
    // }
    // return $rooms;
    // }

    public function getRoomsForDelegate($id = null)
    {
        if ($id) {
            $hotelOperator = HotelOperator::where('hotel_operator_user', $id)->first();
            $delegatesWithRooms = DB::table('delegates')
                ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                ->leftJoin('hotel_plans', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
                ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'hotel_plans.hotel_uid')
                ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                ->leftJoin('delegate_flights', 'delegates.delegates_uid', '=', 'delegate_flights.delegate_uid')
                ->leftJoin('ranks', 'delegates.rank', '=', 'ranks.ranks_uid')
                ->select('delegates.*', 'rooms.*', 'hotels.*', 'delegate_flights.*', 'delegations.delegationCode', 'delegations.country', 'ranks.ranks_name', 'roomtypes.room_type')
                ->where([['delegations.delegation_response', 'Accepted'], ['delegates.self', 1], ['hotels.hotel_uid', $hotelOperator->hotel_uid]])
                ->get();

            foreach ($delegatesWithRooms as $key => $delegatesWithRoom) {
                $delegatesWithRooms[$key]->officers = Officer::where('officer_delegation', $delegatesWithRoom->delegation)->get(['officer_rank', 'officer_first_name', 'officer_last_name', 'officer_contact']);
                $delegatesWithRooms[$key]->hotel_name = DB::table('hotel_plans')
                    ->leftJoin('hotels', 'hotel_plans.hotel_uid', '=', 'hotels.hotel_uid')
                    ->where('hotel_plans.delegation_uid', $delegatesWithRoom->delegation)
                    ->select('hotels.hotel_names')
                    ->first();
            }
            return $delegatesWithRooms;
        } else {
            $delegatesWithRooms = DB::table('delegates')
                ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'rooms.hotel_uid')
                ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                ->leftJoin('delegate_flights', 'delegates.delegates_uid', '=', 'delegate_flights.delegate_uid')
                ->leftJoin('ranks', 'delegates.rank', '=', 'ranks.ranks_uid')
                ->select('delegates.*', 'rooms.*', 'hotels.*', 'delegate_flights.*', 'delegations.delegationCode', 'delegations.country', 'ranks.ranks_name', 'roomtypes.room_type')
                ->where([['delegations.delegation_response', 'Accepted'], ['delegates.self', 1]])
                ->get();

            foreach ($delegatesWithRooms as $key => $delegatesWithRoom) {
                $delegatesWithRooms[$key]->officers = Officer::where('officer_delegation', $delegatesWithRoom->delegation)->get(['officer_rank', 'officer_first_name', 'officer_last_name', 'officer_contact']);
                // $delegatesWithRooms[$key]->hotel_plans = DB::table('hotel_plans')
                //     ->leftJoin('roomtypes', 'hotel_plans.hotel_roomtpye_uid', '=', 'roomtypes.room_type_uid')
                //     ->where('hotel_plans.delegation_uid', $delegatesWithRoom->delegation)
                //     ->select('roomtypes.room_type')
                //     ->get();
                $delegatesWithRooms[$key]->hotel_name = DB::table('hotel_plans')
                    ->leftJoin('hotels', 'hotel_plans.hotel_uid', '=', 'hotels.hotel_uid')
                    ->where('hotel_plans.delegation_uid', $delegatesWithRoom->delegation)
                    ->select('hotels.hotel_names')
                    ->first();
            }
            return $delegatesWithRooms;
        }
    }

    public function addRoomRender($id = null)
    {
        // return 1;
        $delegates = Delegate::where([['delegates_uid', $id], ['self', 1]])->get();
        $delegationInfo = Delegation::where('uid', $delegates[0]->delegation)->get();
        $delegationInfo[0]->delegateCount = Delegate::where([['delegation', $delegates[0]->delegation], ['self', 1]])->count();
        $delegationInfo[0]->invitedBy = Vips::where('vips_uid', $delegationInfo[0]->invited_by)->first();
        $delegationInfo[0]->vipsRank = Rank::where('ranks_uid', $delegationInfo[0]->invitedBy->vips_rank)->first();
        $officer = Officer::where('officer_delegation', $delegates[0]->delegation)->get();

        $assignHotel = $delegates[0]->accomodated ? Room::where('room_uid', $delegates[0]->accomodated)->first() : '';


        $hotelPlans = HotelPlan::where('delegation_uid', $delegates[0]->delegation)->get();
        $hotelPlans[0]->hotelName = Hotel::where('hotel_uid', $hotelPlans[0]->hotel_uid)->first('hotel_names');
        // return $delegationInfo;
        // return $id;
        return view('pages.assignHotel', ['hotelPlans' => $hotelPlans, 'delegationInfos' => $delegationInfo, 'officers' => $officer, 'delegates' => $delegates, 'id' => $id, 'assignHotel' => $assignHotel]);
    }

    // public function addRoomRender($id = null)
    // {
    //     $hotels = Hotel::get();
    //     $rooms = DB::table('hotel_plans')
    //         ->leftJoin('hotels', 'hotel_plans.hotel_uid', '=', 'hotels.hotel_uid')
    //         ->leftJoin('roomtypes', 'hotel_plans.hotel_roomtpye_uid', '=', 'roomtypes.room_type_uid')
    //         ->leftJoin('delegations', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
    //         ->select('hotel_plans.*', 'hotels.hotel_names', 'roomtypes.room_type', 'delegations.*')
    //         ->where('plan_status', 0)
    //         ->get();
    //     $roomTypes = Roomtype::get();
    //     if ($id) {
    //         $members = DB::table('members')
    //             ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
    //             ->leftJoin('delegations', 'delegations.uid', '=', 'members.delegation')
    //             ->where('member_status', 1)
    //             ->select('members.*', 'delegations.country', 'delegations.delegationCode', 'delegates.first_Name', 'delegates.last_Name')
    //             ->get();
    //         $delegates = DB::table('delegates')
    //             ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
    //             ->where('status',  1)
    //             ->whereNotNull('first_Name')
    //             ->select('delegates.*', 'delegations.country', 'delegations.delegationCode')
    //             ->get();
    //     } else {
    //         $members = DB::table('members')
    //             ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
    //             ->leftJoin('delegations', 'delegations.uid', '=', 'members.delegation')
    //             ->where('member_status', 1)
    //             ->whereNull('members.accomodated')
    //             ->select('members.*', 'delegations.country', 'delegations.delegationCode', 'delegates.first_Name', 'delegates.last_Name')
    //             ->get();
    //         $delegates = DB::table('delegates')
    //             ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
    //             ->where('status',  1)
    //             ->whereNull('accomodated')
    //             ->whereNotNull('first_Name')
    //             ->select('delegates.*', 'delegations.country', 'delegations.delegationCode')
    //             ->get();
    //     }
    //     foreach ($members as $key => $member) {
    //         $members[$key]->guestType = 'Member';
    //         $members[$key]->uid = $members[$key]->member_uid;
    //         $members[$key]->first_Name = $members[$key]->member_first_Name;
    //         $members[$key]->last_Name = $members[$key]->member_last_Name;
    //     }
    //     foreach ($delegates as $key => $delegate) {
    //         $delegates[$key]->guestType = 'Delegate';
    //     }
    //     foreach ($roomTypes as $key => $roomType) {
    //         $roomTypes[$key]->hotel_name = Hotel::where('hotel_uid', $roomType->hotel_uid)->first('hotel_names');
    //         // $rooms[$key]->room_type_status = $roomtypes[$key]->room_type_status == 1 ? 'Active' : 'InActive';
    //     }
    //     $guests = [...$delegates, ...$members];
    //     if ($id) {
    //         $selectedRoom = Room::where('room_uid', $id)->first();
    //         return view('pages.addRoom', ['selectedRoom' => $selectedRoom, 'hotels' => $hotels, 'roomTypes' => $roomTypes, 'guests' => $guests, 'rooms' => $rooms]);
    //     } else {
    //         return view('pages.addRoom', ['hotels' => $hotels, 'roomTypes' => $roomTypes,  'guests' => $guests, 'rooms' => $rooms]);
    //     }
    // }

    public function assignedRoom(Request $req)
    {
        $delegateRoom = new Room();
        $delegateRoom->room_uid = (string) Str::uuid();
        $delegateRoom->room_logged_by = session()->get('user')->uid;
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $delegateRoom[$key] = $value;
            }
        }
        try {
            $savedRoom = $delegateRoom->save();
            $delegateAccomodated = Delegate::where('delegates_uid', $req->assign_to)->update(['accomodated' => $delegateRoom->room_uid]);
            if ($savedRoom && $delegateAccomodated) {
                return redirect()->back()->with('message', "Room Assigned Successfully");
            } else {
                return redirect()->back()->with('error', "SomeThing Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
        // return $req->all();
    }

    public function assignedRoomUpdate(Request $req)
    {
    }

    public function addRoom(Request $req)
    {
        $room = new Room();
        $room->room_uid = (string) Str::uuid();
        $room->room_logged_by = session()->get('user')->uid;
        $assign_to = Member::where('member_uid', $req->assign_to)->first();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $room[$key] = $value;
            }
        }
        try {
            $savedRoom = $room->save();
            $guestUidUpdate = $assign_to ? Member::where('member_uid', $req->assign_to)->update(['accomodated' => $room->room_uid]) : Delegate::where('delegates_uid', $req->assign_to)->update(['accomodated' => $room->room_uid]);
            if ($savedRoom && $guestUidUpdate) {
                return redirect()->back()->with('message', "Room Assigned Successfully");
            } else {
                return redirect()->back()->with('error', "SomeThing Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }
    public function updateRoom(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0 && $key != 'assign_to' && $key != 'room_uid') {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            // $oldRoom = Room::where('room_uid', $id)->first();
            $updateRoom = Room::where('room_uid', $req->room_uid)->update($arrayToBeUpdate);
            // return $arrayToBeUpdate;
            // if ($oldRoom->assign_to != $req->assign_to) {
            //     $assign_toOld = Member::where('member_uid', $oldRoom->assign_to)->first();
            //     $oldGuestUidUpdate = $assign_toOld ? Member::where('member_uid', $oldRoom->assign_to)->update(['accomodated' => null]) : Delegate::where('delegates_uid', $oldRoom->assign_to)->update(['accomodated' => null]);
            //     $assign_to = Member::where('member_uid', $req->assign_to)->first();
            //     $guestUidUpdate = $assign_to ? Member::where('member_uid', $req->assign_to)->update(['accomodated' => $id]) : Delegate::where('delegates_uid', $req->assign_to)->update(['accomodated' => $id]);
            // } else {
            //     $assign_to = Member::where('member_uid', $req->assign_to)->first();
            //     $guestUidUpdate = $assign_to ? Member::where('member_uid', $req->assign_to)->update(['accomodated' => $id]) : Delegate::where('delegates_uid', $req->assign_to)->update(['accomodated' => $id]);
            // }
            if ($updateRoom) {
                return redirect()->back()->with('message', "Room Updated Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function roomUpdate(Request $req)
    {
        if ($req->room_uid) {
            $updateRoom = [];
            $updateRoom['room_logged_by'] = Auth::user()->uid;
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && $key != 'room_uid' && strlen($value) > 0) {
                    $updateRoom[$key] = $value;
                }
            }
            // return $updateRoom;
            try {
                $updatedRoom = Room::where('room_uid', $req->room_uid)->update($updateRoom);
                if ($updatedRoom) {
                    return redirect()->back()->with('message', "Room Updated Successfully");
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                return  redirect()->back()->with('error', $exception->errorInfo[2]);
            }
        } else {
            $addRoom = new Room();
            $addRoom->room_uid = (string) Str::uuid();
            $addRoom->room_logged_by = Auth::user()->uid;
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $addRoom[$key] = $value;
                }
            }
            $addRoom->room_checkout = $req->room_checkout;
            try {
                $roomAdded = $addRoom->save();
                if ($roomAdded) {
                    Delegate::where('delegates_uid', $req->assign_to)->update(['accomodated' => $addRoom->room_uid]);
                    return redirect()->back()->with('message', "Room Added Successfully");
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                return  redirect()->back()->with('error', $exception->errorInfo[2]);
            }
        }
    }

    public function deleteRoom(Request $req)
    {
        try {
            $roomToBeDelete = Room::where('room_uid', $req->room_uid)->first();
            $roomDeleted = Room::where('room_uid', $req->room_uid)->delete();
            if ($roomDeleted) {
                Delegate::where('delegates_uid', $roomToBeDelete->assign_to)->update(['accomodated' => null]);
                return redirect()->back()->with('error', "Room Deleted Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Room End


    // Hotel Plans for Liaons Start

    public function hotelPlans()
    {
        $officerDelegation = Officer::where('officer_user', session()->get('user')->uid)->orWhere('officer_uid', session()->get('user')->officerUid?->officer_uid)->first('officer_delegation');
        $hotelPlans = $officerDelegation ? HotelPlan::where('delegation_uid', $officerDelegation->officer_delegation)->first() : null;
        $hotelPlans ? $hotelPlans->hotelName = Hotel::where('hotel_uid', $hotelPlans?->hotel_uid)->first('hotel_names') : null;
        // return $officerDelegation;
        return view('pages.hotelPlan', ['hotelPlans' => $hotelPlans]);
    }

    // Hotel Plans for Liaons End
}
