<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Image;
use App\Models\ImageBlob;
use App\Models\Liason;
use App\Models\Officer;
use App\Models\Rank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LiasonsController extends Controller
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

    public function renderLiasons()
    {
        return view('pages.liasons');
    }

    public function renderSpecificLiason()
    {
        // $delegationUid = Delegate::where('user_uid', session()->get('user')->uid)->first('delegation');
        $officer = Officer::where('officer_delegation', session()->get('user')->delegationUid)->first();
        // return $liason;
        return view('pages.liason', ['delegationUid' => session()->get('user')->delegationUid, 'officer' => $officer]);
    }

    public function addLiasonPage()
    {
        return view('pages.addLiasons');
    }

    public function specificLiasonData($id)
    {
        $officers = DB::table('officers')
            ->leftJoin('delegations', 'delegations.uid', '=', 'officers.officer_delegation')
            ->where('officer_delegation', $id)
            ->select('officers.*', 'delegations.country')
            ->get();
        foreach ($officers as $key => $officer) {
            $officers[$key]->rank = Rank::where('ranks_uid', $officer->officer_rank)->first('ranks_name');
        }
        return $officers;
    }

    public function liasonsData($id = null)
    {
        $liasons = $id ? DB::table('liasons')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'liasons.liason_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'liasons.liason_delegation')
            ->where('liason_delegation', $id)
            ->select('liasons.*', 'delegations.country', 'delegates.last_Name', 'delegates.first_Name')
            ->get() : DB::table('liasons')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'liasons.liason_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'liasons.liason_delegation')
            ->select('liasons.*', 'delegations.country', 'delegates.last_Name', 'delegates.first_Name')
            ->get();
        return $liasons;
    }

    public function specificLiasonsData($id = null)
    {
        $officer = $id ? DB::table('officers')
            ->leftJoin('delegations', 'delegations.uid', '=', 'officers.officer_delegation')
            ->where('officers.officer_delegation', $id)
            ->orWhere('officers.officer_uid', $id)
            ->orWhere('officers.officer_user', $id)
            ->select('officers.*', 'delegations.country')
            ->first() : null;
        $officer->image = $id && $officer->officer_user ? ImageBlob::where('uid', $officer->officer_uid)->first() : 'null';
        return view('pages.liasonProfile', ['officer' => $officer]);
    }

    public function addLiason(Request $req)
    {
        $liason = new Liason();
        $liason->liason_uid  = (string) Str::uuid();
        $liason->liason_rank = $req->liason_rank;
        $liason->liason_designation = $req->liason_designation;
        $liason->liason_first_name = $req->liason_first_name;
        $liason->liason_last_name = $req->liason_last_name;
        $liason->liason_contact = $req->liason_contact;
        $liason->liason_identity = $req->liason_identity;
        $liason->liasonCode  = $this->badge(8, "LO");
        try {
            $liasonSaved = $liason->save();
            if ($liasonSaved) {
                return redirect()->back()->with('message', 'Liason has been added Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  redirect()->back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  redirect()->back()->with('error', $exception->errorInfo[2]);
            }
        }
    }

    public function updateOfficerRequest(Request $req, $id)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {
            $updatedOfficer = Officer::where('officer_uid', $id)->update($arrayToBeUpdate);
            if ($updatedOfficer) {
                return redirect()->back()->with('message', 'Liason Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function attachLiason(Request $req)
    {
        try {
            $updateLiason = Liason::where('liason_uid', $req->liasonSelect)->update(['liason_delegation' => $req->delegationUid_liason, 'liason_assign' => 1]);
            if ($updateLiason) {
                // $updateDelegation = Delegation::where('uid', $req->delegationUid)->update(['liasons' => $req->liasonSelect]);
                return redirect()->back()->with('message', 'Liason has been attach Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  redirect()->back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  redirect()->back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
}
