<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use App\Models\Interpreter;
use App\Models\Liason;
use App\Models\Member;
use App\Models\Receiving;
use App\Models\Vips;
use Illuminate\Support\Facades\DB;

class DelegationsPageController extends Controller
{
    public function delegationData()
    {
        $delegations = DB::table('delegations')
            ->leftJoin('delegates', 'delegations.uid', '=', 'delegates.delegation')
            ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.uid')
            ->leftJoin('liasons', 'delegations.uid', '=', 'liasons.liason_delegation')
            ->leftJoin('receivings', 'delegations.uid', '=', 'receivings.receiving_delegation')
            ->leftJoin('interpreters', 'delegations.uid', '=', 'interpreters.interpreter_delegation')
            ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.self', 'delegates.delegates_uid', 'vips.name', 'liasons.liason_uid', 'receivings.receiving_uid', 'interpreters.interpreter_uid')
            ->orderBy('delegations.country', 'asc')
            ->get();
        foreach ($delegations as $key => $delegation) {
            $delegations[$key]->member_count = Member::where('delegation', $delegation->uid)->count();
            $delegations[$key]->member_count = $delegations[$key]->member_count ? $delegations[$key]->member_count + 1 : 0;
        }
        return $delegations;
    }
    public function render()
    {
        $liasons = Liason::whereNull('liason_delegation')->get();
        $interpreters = Interpreter::whereNull('interpreter_delegation')->get();
        $receivings = Receiving::whereNull('receiving_delegation')->get();
        return view('pages.delegations', ['liasons' => $liasons, 'interpreters' => $interpreters, 'receivings' => $receivings]);
    }
    public function singleDelegation()
    {
        $delegation = Delegation::where('delegates', session()->get('user')->uid)->first();
        $delegation->vip = Vips::where('uid', $delegation->invited_by)->first();
        return view('pages.delegation', ['delegation' => $delegation]);
    }
    public function delegationAssigned()
    {
        $delegationUid = 0;
        switch (session()->get('user')->roles[0]->name) {
            case "liason":
                $officers = Liason::where('liason_officer', session()->get('user')->uid)->first('liason_delegation');
                $delegationUid = $officers ? $officers->liason_delegation : 0;
                break;
            case "receiving":
                $officers = Receiving::where('receiving_uid', session()->get('user')->uid)->first('receiving_delegation');
                $delegationUid = $officers ? $officers->receiving_delegation : 0;
                break;
            case "interpreter":
                $officers = Interpreter::where('interpreter_uid', session()->get('user')->uid)->first('interpreter_delegation');
                $delegationUid = $officers ? $officers->interpreter_delegation : 0;
                break;
            default:
                return back()->with('error', 'Something Went Wrong');
        }

        $delegation = Delegation::where('uid', $delegationUid)->first();
        $delegation->vip = Vips::where('uid', $delegation->invited_by)->first();
        return view('pages.delegationAssigned', ['delegation' => $delegation]);
    }
}
