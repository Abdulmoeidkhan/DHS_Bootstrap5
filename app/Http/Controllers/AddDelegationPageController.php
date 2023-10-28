<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Delegation;
use Illuminate\Support\Str;

class AddDelegationPageController extends Controller
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
    public function render()
    {
        $events = Event::where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        return view('pages.addDelegation', ['events' => $events]);
    }
    public function addDelegation(Request $req)
    {
        $delegation = new Delegation();
        $delegation->uid = (string) Str::uuid();
        $delegation->country = $req->country;
        $delegation->invited_by = $req->invitedBy;
        $delegation->address = $req->address;
        $delegation->address = $req->address;
        $delegation->exhibition = $req->eventSelect;
        $delegation->delegationCode = $this->badge(8, "DL");
        try {
            $delegationSaved = $delegation->save();
            if ($delegationSaved) {
                return back()->with('message', 'Delegation has been added Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
    public function updateDelegation(Request $req)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {
            $updatedDelegate = Delegate::where('uid', $req->uid)->update($arrayToBeUpdate);
            if ($updatedDelegate) {
                return back()->with('message', 'Delegation has been updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
}
