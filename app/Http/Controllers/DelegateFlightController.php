<?php

namespace App\Http\Controllers;

use App\Models\DelegateFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DelegateFlightController extends Controller
{
    public function getFlight()
    {
        return;
    }
    public function setFlight(Request $req)
    {
        if ($req->flightsegment_uid) {
            $delegateFlight = [];
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != 'flightsegment_uid' && $key != 'delegate_uid' && $key != '_token' && strlen($value) > 0) {
                    $delegateFlight[$key] = $value;
                }
            }
            try {
                $delegateFlightUpdate = DelegateFlight::where('delegate_uid', $req->delegate_uid)->update($delegateFlight);
                if ($delegateFlightUpdate) {
                    return back()->with('message', "Flight Segment Successfully");
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        } else {
            $delegateFlight = new DelegateFlight();
            $delegateFlight->flightsegment_uid = (string) Str::uuid();
            foreach ($req->all() as $key => $value) {
                if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                    $delegateFlight[$key] = $value;
                }
            }
            try {
                $savedDelegateFlight = $delegateFlight->save();
                if ($savedDelegateFlight) {
                    return back()->with('message', "Flight Segment Successfully");
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
}
