<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function addLiasonPage()
    {
        return view('pages.addLiasons');
    }

    public function liasonsData()
    {
        $delegations = DB::table('liasons')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'liasons.liason_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'liasons.liason_delegation')
            ->select('liasons.*', 'delegations.country', 'delegates.last_Name', 'vips.name')
            ->get();
        return $delegations;
    }
    
    public function addLiason(Request $req)
    {
        $delegation = new Liason();
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
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }




}
