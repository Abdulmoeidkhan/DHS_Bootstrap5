<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Delegate;
use App\Models\Driver;
use App\Models\Journey;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{
    // Main Display
    public function render()
    {
        return view('pages.cars');
    }

    // Drivers Start
    public function getDrivers()
    {
        $drivers = Driver::get();
        return $drivers;
    }

    public function addDriverRender($id = null)
    {
        if ($id) {
            $driver = Driver::where('driver_uid', $id)->first();
            return view('pages.addDriver', ['driver' => $driver]);
        } else {
            return view('pages.addDriver');
        }
    }

    public function addDriver(Request $req)
    {
        $driver = new Driver();
        $driver->driver_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $driver[$key] = $value;
            }
        }
        try {
            $saveddriver = $driver->save();
            if ($saveddriver) {
                return back()->with('message', "Drivers Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateDriver(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $updateDriver = Driver::where('driver_uid', $id)->update($arrayToBeUpdate);
            if ($updateDriver) {
                return back()->with('message', "Driver Updated Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Drivers Start

    public function getCars()
    {
        $car = Car::get();
        return $car;
    }

    public function addCarRender($id = null)
    {
        if ($id) {
            $car = Car::where('car_uid', $id)->first();
            return view('pages.addCar', ['car' => $car]);
        } else {
            return view('pages.addCar');
        }
    }

    public function addCar(Request $req)
    {
        $car = new Car();
        $car->car_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $car[$key] = $value;
            }
        }
        try {
            $savedcar = $car->save();
            if ($savedcar) {
                return back()->with('message', "Car Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateCar(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $updateCar = Car::where('car_uid', $id)->update($arrayToBeUpdate);
            if ($updateCar) {
                return back()->with('message', "Car Updated Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Drivers End

    // Journey  Start

    public function getjourneys()
    {
        $journeys = Journey::get();
        foreach ($journeys as $key => $journey) {
            $journeys[$key]->car_uid = Car::where('car_uid', $journey->car_uid)->first();
            $journeys[$key]->driver_uid = Driver::where('driver_uid', $journeys[$key]->driver_uid)->first();
            $journeys[$key]->car_assign_to = Delegate::where('uid', $journeys[$key]->car_assign_to)->first('uid') ? Delegate::where('uid', $journeys[$key]->car_assign_to)->first('uid') : Member::where('member_uid', $journeys[$key]->car_assign_to)->first('member_uid');
            $journeys[$key]->car_assign_to = $journeys[$key]->assign_to->uid ? 'delegateProfile/' . $journeys[$key]->assign_to->uid . '' : 'memberFullProfile/' . $journeys[$key]->assign_to->member_uid . '';
            $journeys[$key]->journey_logged_by = User::where('uid', $journey->journey_logged_by)->first('name');
        }
        return $journeys;
    }

    public function addJourneyRender($id = null)
    {
        $journeys = Journey::get();
        $car = Car::get();
        $driver = Driver::get();
        if ($id) {
            $members = DB::table('members')
                ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
                ->leftJoin('delegations', 'delegations.uid', '=', 'members.delegation')
                ->where('member_status', 1)
                ->select('members.*', 'delegations.country', 'delegations.delegationCode', 'delegates.first_Name', 'delegates.last_Name')
                ->get();
            $delegates = DB::table('delegates')
                ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
                ->where('status',  1)
                ->whereNotNull('first_Name')
                ->select('delegates.*', 'delegations.country', 'delegations.delegationCode')
                ->get();
        } else {
            $members = DB::table('members')
                ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
                ->leftJoin('delegations', 'delegations.uid', '=', 'members.delegation')
                ->where('member_status', 1)
                ->whereNull('members.accomodated')
                ->select('members.*', 'delegations.country', 'delegations.delegationCode', 'delegates.first_Name', 'delegates.last_Name')
                ->get();
            $delegates = DB::table('delegates')
                ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
                ->where('status',  1)
                ->whereNull('accomodated')
                ->whereNotNull('first_Name')
                ->select('delegates.*', 'delegations.country', 'delegations.delegationCode')
                ->get();
        }
        foreach ($members as $key => $member) {
            $members[$key]->guestType = 'Member';
            $members[$key]->uid = $members[$key]->member_uid;
            $members[$key]->first_Name = $members[$key]->member_first_Name;
            $members[$key]->last_Name = $members[$key]->member_last_Name;
        }
        foreach ($delegates as $key => $delegate) {
            $delegates[$key]->guestType = 'Delegate';
        }
        foreach ($journeyTypes as $key => $journeyType) {
            $journeyTypes[$key]->hotel_name = Hotel::where('hotel_uid', $journeyType->hotel_uid)->first('hotel_names');
            // $journeys[$key]->journey_type_status = $journeytypes[$key]->journey_type_status == 1 ? 'Active' : 'InActive';
        }
        $guests = [...$delegates, ...$members];
        if ($id) {
            $selectedJourney = Journey::where('journey_uid', $id)->first();
            return view('pages.addJourney', ['selectedJourney' => $selectedJourney, 'journeys' => $journeys, 'hotels' => $hotels, 'journeyTypes' => $journeyTypes, 'guests' => $guests]);
        } else {
            return view('pages.addJourney', ['journeys' => $journeys, 'hotels' => $hotels, 'journeyTypes' => $journeyTypes,  'guests' => $guests]);
        }
    }

    // public function addJourney(Request $req)
    // {
    //     $journey = new Journey();
    //     $journey->journey_uid = (string) Str::uuid();
    //     $journey->journey_logged_by = session()->get('user')->uid;
    //     $assign_to = Member::where('member_uid', $req->assign_to)->first();
    //     foreach ($req->all() as $key => $value) {
    //         if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
    //             $journey[$key] = $value;
    //         }
    //     }
    //     try {
    //         $savedJourney = $journey->save();
    //         $guestUidUpdate = $assign_to ? Member::where('member_uid', $req->assign_to)->update(['accomodated' => $journey->journey_uid]) : Delegate::where('uid', $req->assign_to)->update(['accomodated' => $journey->journey_uid]);
    //         if ($savedJourney && $guestUidUpdate) {
    //             return back()->with('message', "Journey Assigned Successfully");
    //         } else {
    //             return back()->with('error', "SomeThing Went Wrong");
    //         }
    //     } catch (\Illuminate\Database\QueryException $exception) {
    //         return  back()->with('error', $exception->errorInfo[2]);
    //     }
    // }
    // public function updateJourney(Request $req, $id)
    // {
    //     try {
    //         $arrayToBeUpdate = [];
    //         foreach ($req->all() as $key => $value) {
    //             if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
    //                 $arrayToBeUpdate[$key] = $value;
    //             }
    //         }
    //         $oldJourney = Journey::where('journey_uid', $id)->first();
    //         $updateJourney = Journey::where('journey_uid', $id)->update($arrayToBeUpdate);
    //         if ($oldJourney->assign_to != $req->assign_to) {
    //             $assign_toOld = Member::where('member_uid', $oldJourney->assign_to)->first();
    //             $oldGuestUidUpdate = $assign_toOld ? Member::where('member_uid', $oldJourney->assign_to)->update(['accomodated' => null]) : Delegate::where('uid', $oldJourney->assign_to)->update(['accomodated' => null]);
    //             $assign_to = Member::where('member_uid', $req->assign_to)->first();
    //             $guestUidUpdate = $assign_to ? Member::where('member_uid', $req->assign_to)->update(['accomodated' => $id]) : Delegate::where('uid', $req->assign_to)->update(['accomodated' => $id]);
    //         } else {
    //             $assign_to = Member::where('member_uid', $req->assign_to)->first();
    //             $guestUidUpdate = $assign_to ? Member::where('member_uid', $req->assign_to)->update(['accomodated' => $id]) : Delegate::where('uid', $req->assign_to)->update(['accomodated' => $id]);
    //         }
    //         if ($updateJourney) {
    //             return back()->with('message', "Journey Type Updated Successfully");
    //         }
    //     } catch (\Illuminate\Database\QueryException $exception) {
    //         return  back()->with('error', $exception->errorInfo[2]);
    //     }
    // }

    // Journey End
}
