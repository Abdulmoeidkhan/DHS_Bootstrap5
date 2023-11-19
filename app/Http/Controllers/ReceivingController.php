<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Image;
use App\Models\Receiving;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ReceivingController extends Controller
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

    public function renderReceivings()
    {
        return view('pages.receivings');
    }

    public function renderSpecificReceiving()
    {
        $delegationUid = Delegate::where('user_uid', session()->get('user')->uid)->first('delegation');
        $receiving = Delegation::where('uid', $delegationUid->delegation)->first('receiving');
        // return $receiving;
        return view('pages.receiving', ['delegationUid' => $delegationUid, 'receiving' => $receiving]);
    }

    public function addReceivingPage()
    {
        return view('pages.addReceivings');
    }

    public function receivingsData()
    {
        $delegations = DB::table('receiving')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'receiving.receiving_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'receiving.receiving_delegation')
            ->select('receiving.*', 'delegations.country', 'delegates.last_Name', 'delegates.first_Name')
            ->get();
        return $delegations;
    }

    public function specificReceivingsData($id = null)
    {
        $receiving = $id ? DB::table('receiving')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'receiving.receiving_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'receiving.receiving_delegation')
            ->where('receiving.receiving_uid', $id)
            ->orWhere('receiving.receiving', $id)
            ->select('receiving.*', 'delegations.country', 'delegates.last_Name', 'delegates.first_Name')
            ->first() : null;
        $receiving->image = $id ? Image::where('uid', $receiving->receiving)->first() : 'null';
        // return $receiving;
        return view('pages.receivingProfile', ['receiving' => $receiving]);
    }

    public function addReceiving(Request $req)
    {
        $receiving = new Receiving();
        $receiving->receiving_uid  = (string) Str::uuid();
        $receiving->receiving_rank = $req->receiving_rank;
        $receiving->receiving_designation = $req->receiving_designation;
        $receiving->receiving_first_name = $req->receiving_first_name;
        $receiving->receiving_last_name = $req->receiving_last_name;
        $receiving->receiving_contact = $req->receiving_contact;
        $receiving->receiving_identity = $req->receiving_identity;
        $receiving->receivingCode  = $this->badge(8, "RO");
        try {
            $receivingSaved = $receiving->save();
            if ($receivingSaved) {
                return back()->with('message', 'Receiving has been added Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }

    public function updateReceivingRequest(Request $req, $id)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {
            $updatedReceiving = Receiving::where('receiving_uid', $id)->update($arrayToBeUpdate);
            if ($updatedReceiving) {
                return back()->with('message', 'Receiving Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function attachReceiving(Request $req)
    {
        try {
            $updateReceiving = Receiving::where('receiving_uid', $req->receivingSelect)->update(['receiving_delegation' => $req->delegationUid, 'receiving_assign' => 1]);
            if ($updateReceiving) {
                // $updateDelegation = Delegation::where('uid', $req->delegationUid)->update(['receiving' => $req->receivingSelect]);
                return back()->with('message', 'Receiving has been attach Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
}
