<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use App\Models\Liason;
use App\Models\Member;
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
            ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.self', 'delegates.delegates_uid', 'vips.name','liasons.liason_uid')
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
        return view('pages.delegations', ['liasons' => $liasons]);
    }
    public function singleDelegation()
    {
        $delegation = Delegation::where('delegates', session()->get('user')->uid)->first();
        $delegation->vip = Vips::where('uid', $delegation->invited_by)->first();
        // return $delegation;
        return view('pages.delegation', ['delegation' => $delegation]);
    }
    public function delegationAssigned()
    {
        $liason = Liason::where('liason_officer', session()->get('user')->uid)->first();
        $delegation = Delegation::where('uid', $liason->liason_delegation)->first();
        $delegation->vip = Vips::where('uid', $delegation->invited_by)->first();
        return view('pages.delegationAssigned', ['delegation' => $delegation]);
    }
}
