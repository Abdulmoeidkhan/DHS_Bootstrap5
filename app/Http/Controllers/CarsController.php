<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarCategory;
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

    // CarCategory Start

    public function getCarCategory()
    {
        $carcategory = CarCategory::get();
        return $carcategory;
    }

    public function addCarCategoriesRender($id = null)
    {
        if ($id) {
            $carcategory = CarCategory::where('car_uid', $id)->first();
            return view('pages.addCarCategory', ['carcategory' => $carcategory]);
        } else {
            return view('pages.addCarCategory');
        }
    }

    public function addCarCategory(Request $req)
    {
        $carcategory = new CarCategory();
        $carcategory->car_category_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $carcategory[$key] = $value;
            }
        }
        try {
            $savedcarcategory = $carcategory->save();
            if ($savedcarcategory) {
                return redirect()->back()->with('message', "Car Category Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateCarCategory(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $oldCar = Car::where('car_uid', $id)->first();
            $updateCar = Car::where('car_uid', $id)->update($arrayToBeUpdate);
            if ($updateCar) {
                if ($oldCar->driver_uid != $req->driver_uid) {
                    $oldDriver = Driver::where('driver_uid', $oldCar->driver_uid)->update(['driver_status' => 1]);
                }
                $newDriver = Driver::where('driver_uid', $req->driver_uid)->update(['driver_status' => 0]);
                return $newDriver ? redirect()->back()->with('message', "Car Updated Successfully") : redirect()->back()->with('error', "Something Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    // CarCategory End

    // Car Start

    public function getCars()
    {
        $car = Car::get();
        return $car;
    }

    public function addCarRender($id = null)
    {
        $driver = Driver::get();
        $carcategorys = CarCategory::get();
        // return $carcategorys;
        if ($id) {
            $car = Car::where('car_uid', $id)->first();
            return view('pages.addCar', ['car' => $car, 'drivers' => $driver, 'carcategorys' => $carcategorys]);
        } else {
            return view('pages.addCar', ['drivers' => $driver, 'carcategorys' => $carcategorys]);
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
            $updateDriver = Driver::where('driver_uid', $car->driver_uid)->update(['driver_status' => 0]);
            if ($savedcar && $updateDriver) {
                return redirect()->back()->with('message', "Car Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
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
            $oldCar = Car::where('car_uid', $id)->first();
            $updateCar = Car::where('car_uid', $id)->update($arrayToBeUpdate);
            if ($updateCar) {
                if ($oldCar->driver_uid != $req->driver_uid) {
                    $oldDriver = Driver::where('driver_uid', $oldCar->driver_uid)->update(['driver_status' => 1]);
                }
                $newDriver = Driver::where('driver_uid', $req->driver_uid)->update(['driver_status' => 0]);
                return $newDriver ? redirect()->back()->with('message', "Car Updated Successfully") : redirect()->back()->with('error', "Something Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Car End

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
                return redirect()->back()->with('message', "Drivers Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
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
                return redirect()->back()->with('message', "Driver Updated Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }
    // Drivers End

    // Journey  Start

    public function getJourneys()
    {
        $journeys = Journey::get();
        foreach ($journeys as $key => $journey) {
            $journeys[$key]->car_uid = Car::where('car_uid', $journey->car_uid)->first();
            $journeys[$key]->driver_uid = Driver::where('driver_uid', $journeys[$key]->car_uid->driver_uid)->first();
            $journeys[$key]->journey_assign_to = Delegate::where('delegates_uid', $journeys[$key]->journey_assign_to)->first('uid') ? Delegate::where('delegates_uid', $journeys[$key]->journey_assign_to)->first('uid') : Member::where('member_uid', $journeys[$key]->journey_assign_to)->first('member_uid');
            $journeys[$key]->journey_assign_to = $journeys[$key]->journey_assign_to->uid ? 'delegateProfile/' . $journeys[$key]->journey_assign_to->uid . '' : 'members/memberFullProfile/' . $journeys[$key]->journey_assign_to->member_uid . '';
            $journeys[$key]->journey_logged_by = User::where('uid', $journey->journey_logged_by)->first('name');
        }
        return $journeys;
    }

    public function addJourneyRender($id = null)
    {
        $cars = $id ? Car::get() : Car::where('car_status', 1)->get();
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
                ->whereNull('members.car_accomodated')
                ->select('members.*', 'delegations.country', 'delegations.delegationCode', 'delegates.first_Name', 'delegates.last_Name')
                ->get();
            $delegates = DB::table('delegates')
                ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
                ->where('status',  1)
                ->whereNull('car_accomodated')
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
        foreach ($cars as $key => $car) {
            $cars[$key]->driver_uid = Driver::where('driver_uid', $car->driver_uid)->first('driver_name');
        }
        $guests = [...$delegates, ...$members];
        if ($id) {
            $selectedJourney = Journey::where('journey_uid', $id)->first();
            return view('pages.addJourney', ['selectedJourney' => $selectedJourney, 'cars' => $cars, 'guests' => $guests]);
        } else {
            return view('pages.addJourney', ['cars' => $cars, 'guests' => $guests]);
        }
    }

    public function addJourney(Request $req)
    {
        $journey = new Journey();
        $journey->journey_uid = (string) Str::uuid();
        $journey->journey_logged_by = session()->get('user')->uid;
        $journey_assign_to = Member::where('member_uid', $req->journey_assign_to)->first();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $journey[$key] = $value;
            }
        }
        try {
            $savedJourney = $journey->save();
            $updateCar = Car::where('car_uid', $req->car_uid)->update(['car_status' => 0]);
            $guestUidUpdate = $journey_assign_to ? Member::where('member_uid', $req->journey_assign_to)->update(['car_accomodated' => $journey->journey_uid]) : Delegate::where('delegates_uid', $req->journey_assign_to)->update(['car_accomodated' => $journey->journey_uid]);
            if ($savedJourney && $guestUidUpdate && $updateCar) {
                return redirect()->back()->with('message', "Journey Assigned Successfully");
            } else {
                return redirect()->back()->with('error', "SomeThing Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateJourney(Request $req, $id)
    {
        try {
            $arrayToBeUpdate = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $arrayToBeUpdate[$key] = $value;
                }
            }
            $oldJourney = Journey::where('journey_uid', $id)->first();
            $updateJourney = Journey::where('journey_uid', $id)->update($arrayToBeUpdate);
            $journey_assign_to = Member::where('member_uid', $req->journey_assign_to)->first();
            if ($updateJourney) {
                if ($oldJourney->journey_assign_to != $req->journey_assign_to) {
                    $journey_assign_to_Old = Member::where('member_uid', $oldJourney->journey_assign_to)->first();
                    $oldGuestUidUpdate = $journey_assign_to_Old ? Member::where('member_uid', $oldJourney->journey_assign_to)->update(['car_accomodated' => null]) : Delegate::where('delegates_uid', $oldJourney->journey_assign_to)->update(['car_accomodated' => null]);
                }
                if ($oldJourney->car_uid != $req->car_uid) {
                    $oldCarUidUpdate = Car::where('car_uid', $oldJourney->car_uid)->update(['car_status' => 1]);
                }
                $carUidUpdate = Car::where('car_uid', $req->car_uid)->update(['car_status' => 0]);
                $guestUidUpdate = $journey_assign_to ? Member::where('member_uid', $req->journey_assign_to)->update(['car_accomodated' => $id]) : Delegate::where('delegates_uid', $req->journey_assign_to)->update(['car_accomodated' => $id]);
                return $guestUidUpdate && $carUidUpdate ? redirect()->back()->with('message', "Journey Updated Successfully") : redirect()->back()->with('error', "Something Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Journey End

    // Attach car

    public function attachCar(Request $req)
    {
        $updatedCarSelect = $req->carASelect ? Car::where('car_uid', $req->carASelect)->update(['car_delegation' => $req->delegationUid_car]) : Car::where('car_uid', $req->carBSelect)->update(['car_delegation' => $req->delegationUid_car]);
        return $updatedCarSelect ? redirect()->back()->with('message', "Car Attach Successfully") : redirect()->back()->with('error', "Something Went Wrong");
    }

    public function detachCarData($id)
    {
        $cars = Car::where('car_delegation', $id)->get();
        return $cars;
    }


    public function deattachCar(Request $req)
    {
        // return $req->all();
        $cars = $req->deattachCarSelect;
        $delegationUid = $req->delegationUid_dis_car;
        foreach ($cars as $key => $car) {
            Car::where([['car_delegation', $delegationUid], ['car_uid', $car]])->update(['car_delegation' => null]);
        }
        return redirect()->back()->with('message', 'Car has been deattach Successfully');
    }

    // Attach Car
}
