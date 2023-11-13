<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    // Plan Start

    public function getPlan()
    {
        $carcategory = Plan::get();
        return $carcategory;
    }

    public function addCarCategoriesRender($id = null)
    {
        if ($id) {
            $carcategory = Plan::where('car_uid', $id)->first();
            return view('pages.addPlan', ['carcategory' => $carcategory]);
        } else {
            return view('pages.addPlan');
        }
    }

    public function addPlan(Request $req)
    {
        $carcategory = new Plan();
        $carcategory->car_category_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $carcategory[$key] = $value;
            }
        }
        try {
            $savedcarcategory = $carcategory->save();
            if ($savedcarcategory) {
                return back()->with('message', "Car Category Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updatePlan(Request $req, $id)
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
                return $newDriver ? back()->with('message', "Car Updated Successfully") : back()->with('error', "Something Went Wrong");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    // Plan End
}
