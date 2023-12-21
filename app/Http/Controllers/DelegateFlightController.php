<?php

namespace App\Http\Controllers;

use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DelegateFlightController extends Controller
{
    public function getFlight($status = 0)
    {
        $flights = '';
        switch ($status) {
            case 0:
                $flights = DelegateFlight::where([['arrived', 0], ['departed', 0]])->get();
                break;
            case 1:
                $flights = DelegateFlight::where([['arrived', 1], ['departed', 0]])->orWhere([['arrived', 0], ['departed', 1]])->get();
                break;
            case 2:
                $flights = DelegateFlight::where([['arrived', 1], ['departed', 1]])->get();
                break;
            case 3:
                $flights = DelegateFlight::get();
                break;
            default:
                break;
        }

        foreach ($flights as $key => $flight) {
            $flights[$key]->delegate = Delegate::where('delegates_uid', $flight->delegate_uid)->first(['rank', 'delegation_type', 'last_Name', 'first_Name', 'designation', 'delegation']);
            $flights[$key]->country = Delegation::where('uid', $flights[$key]->delegate->delegation)->first('country');
            $flights[$key]->rank = Rank::where('ranks_uid', $flights[$key]->delegate->rank)->first('ranks_name');
        }

        return $flights;
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
    public function render(Request $req)
    {
        return view('pages.airport');
    }

    public function departureStatusChanger($id, $status)
    {
        $update = DelegateFlight::where('delegate_uid', $id)->update(['departed' => $status]);
        return $update ? back()->with('message', 'Flight Status has been updated Successfully') : back()->with('error', 'Something went wrong');
    }
    public function arrivalStatusChanger($id, $status)
    {
        $update = DelegateFlight::where('delegate_uid', $id)->update(['arrived' => $status]);
        return $update ? back()->with('message', 'Flight Status has been updated Successfully') : back()->with('error', 'Something went wrong');
    }
}
