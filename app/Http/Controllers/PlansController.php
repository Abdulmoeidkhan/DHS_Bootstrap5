<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarPlan;
use App\Models\HotelPlan;

class PlansController extends Controller
{
    // Plan Start

    public function getCarPlan($id)
    {
        $carPlan = CarPlan::where('delegation_uid', $id)->get();
        return $carPlan;
    }
    public function getHotelPlan($id)
    {
        $hotelPlan = DB::table('hotel_plans')
            ->leftJoin('hotels', 'hotel_plans.hotel_uid', '=', 'hotels.hotel_uid')
            ->select('hotel_plans.*', 'hotels.hotel_names')
            ->where('delegation_uid', $id)
            ->get();
        return $hotelPlan;
    }

    public function addPlanRender($id)
    {
        // $carPlan = CarPlan::where('delegation_uid', $id)->first();
        // $hotelPlan = HotelPlan::where('delegation_uid', $id)->first();
        // return view('pages.addPlan', ['carPlan' => $carPlan, 'hotelPlan' => $hotelPlan]);
        return view('pages.addPlan', ['id' => $id]);
    }

    public function deleteHotelPlan($id)
    {
        $hotelPlan = HotelPlan::where('hotel_plan_uid', $id)->delete();
        return $hotelPlan ? redirect()->back()->with('message', "Hotel Plan Deleted Successfully") : redirect()->back()->with('error', "Something Went Wrong");
    }
    public function deleteCarPlan($id)
    {
        $carPlan = CarPlan::where('car_plan_uid', $id)->delete();
        return $carPlan ? redirect()->back()->with('message', "Car Plan Deleted Successfully") : redirect()->back()->with('error', "Something Went Wrong");
    }

    // public function addPlan(Request $req)
    // {
    //     $carcategory = new Plan();
    //     $carcategory->car_category_uid = (string) Str::uuid();
    //     foreach ($req->all() as $key => $value) {
    //         if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
    //             $carcategory[$key] = $value;
    //         }
    //     }
    //     try {
    //         $savedcarcategory = $carcategory->save();
    //         if ($savedcarcategory) {
    //             return redirect()->back()->with('message', "Car Category Added Successfully");
    //         }
    //     } catch (\Illuminate\Database\QueryException $exception) {
    //         return  redirect()->back()->with('error', $exception->errorInfo[2]);
    //     }
    // }

    // public function updatePlan(Request $req, $id)
    // {
    //     try {
    //         $arrayToBeUpdate = [];
    //         foreach ($req->all() as $key => $value) {
    //             if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
    //                 $arrayToBeUpdate[$key] = $value;
    //             }
    //         }
    //         $oldCar = Car::where('car_uid', $id)->first();
    //         $updateCar = Car::where('car_uid', $id)->update($arrayToBeUpdate);
    //         if ($updateCar) {
    //             if ($oldCar->driver_uid != $req->driver_uid) {
    //                 $oldDriver = Driver::where('driver_uid', $oldCar->driver_uid)->update(['driver_status' => 1]);
    //             }
    //             $newDriver = Driver::where('driver_uid', $req->driver_uid)->update(['driver_status' => 0]);
    //             return $newDriver ? redirect()->back()->with('message', "Car Updated Successfully") : redirect()->back()->with('error', "Something Went Wrong");
    //         }
    //     } catch (\Illuminate\Database\QueryException $exception) {
    //         return  redirect()->back()->with('error', $exception->errorInfo[2]);
    //     }
    // }

    // Plan End
}
