<?php

namespace App\Http\Controllers;
use App\Models\Delegation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DelegationsPageController extends Controller
{
    public function delegationData()
    {
        $delegations = DB::table('delegations')
            ->leftJoin('delegates', 'delegations.uid', '=', 'delegates.delegation')
            ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.uid')
            ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'vips.name')
            ->get();
        return $delegations;
    }
    public function render()
    {
        return view('pages.delegations');
    }
    public function singleDelegation()
    {
        $delegation = Delegation::where('delegates',session()->get('user')->uid);
        return $delegation;
        // return view('pages.delegation');
    }
}
