<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Liason;
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
        $delegationUid = Delegate::where('user_uid', session()->get('user')->uid)->first('delegation');
        return view('pages.liason', ['delegationUid' => $delegationUid]);
    }

    public function addLiasonPage()
    {
        return view('pages.addLiasons');
    }

    public function liasonsData()
    {
        $delegations = DB::table('liasons')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'liasons.liason_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'liasons.liason_delegation')
            ->select('liasons.*', 'delegations.country', 'delegates.last_Name')
            ->get();
        return $delegations;
    }

    public function specificLiasonsData($id)
    {
        $delegations = DB::table('liasons')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'liasons.liason_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'liasons.liason_delegation')
            ->where('liasons.liason_delegation', $id)
            ->select('liasons.*', 'delegations.country', 'delegates.last_Name')
            ->get();
        return $delegations;
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
                return back()->with('message', 'Liason has been added Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
    public function attachLiason(Request $req)
    {
        try {
            $updateLiason = Liason::where('liason_uid', $req->liasonSelect)->update(['liason_delegation' => $req->delegationUid, 'liason_assign' => 1]);
            if ($updateLiason) {
                $updateDelegation = Delegation::where('uid', $req->delegationUid)->update(['liasons' => $req->liasonSelect]);
                return back()->with('message', 'Liason has been attach Successfully');
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
