<?php

namespace App\Http\Controllers;

use App\Models\CarPlan;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Hotel;
use App\Models\HotelPlan;
use App\Models\Interpreter;
use App\Models\Liason;
use App\Models\Member;
use App\Models\Rank;
use App\Models\Receiving;
use App\Models\Vips;
use Illuminate\Support\Facades\DB;

class DelegationsPageController extends Controller
{
    public function delegationData()
    {
        $delegations = DB::table('delegations')
            ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
            ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
            // ->leftJoin('car_plans', 'delegations.uid', '=', 'car_plans.delegation_uid')
            // ->leftJoin('officers', 'delegations.uid', '=', 'officers.officer_delegation')
            // ->leftJoin('liasons', 'delegations.uid', '=', 'liasons.liason_delegation')
            // ->leftJoin('receivings', 'delegations.uid', '=', 'receivings.receiving_delegation')
            // ->leftJoin('interpreters', 'delegations.uid', '=', 'interpreters.interpreter_delegation')
            // ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_name', 'vips.vips_rank', 'liasons.liason_uid', 'liasons.liason_contact', 'liasons.liason_first_name', 'liasons.liason_last_name', 'receivings.receiving_uid', 'interpreters.interpreter_uid')
            ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_name', 'vips.vips_rank')
            ->orderBy('delegations.country', 'asc')
            ->orderBy('vips.vips_rank', 'asc')
            ->get();
        foreach ($delegations as $key => $delegation) {
            $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Representative']])->count();
            $delegations[$key]->rankName = Rank::where('ranks_uid', $delegation->rank)->first('ranks_name');
            $delegations[$key]->carA = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', '61346491-983a-40ed-8477-2d9ed84e6767']])->first(['car_quantity','car_plan_uid']);
            $delegations[$key]->carB = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', 'a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->first(['car_quantity','car_plan_uid']);
            $delegations[$key]->standard = HotelPlan::where([['delegation_uid', $delegation->uid], ['room_type_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4f']])->first(['hotel_uid','hotel_quantity','hotel_plan_uid']);
            $delegations[$key]->suite = HotelPlan::where([['delegation_uid', $delegation->uid], ['room_type_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4g']])->first(['hotel_uid','hotel_quantity','hotel_plan_uid']);
            $delegations[$key]->superior = HotelPlan::where([['delegation_uid', $delegation->uid], ['room_type_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4h']])->first(['hotel_uid','hotel_quantity','hotel_plan_uid']);
            $delegations[$key]->dOccupancy = HotelPlan::where([['delegation_uid', $delegation->uid], ['room_type_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4i']])->first(['hotel_uid','hotel_quantity','hotel_plan_uid']);
            $delegations[$key]->hotel= Hotel::where('hotel_uid',$delegations[$key]->standard->hotel_uid)->first('hotel_names');
            // $delegations[$key]->member_count = $delegations[$key]->member_count ? $delegations[$key]->member_count + 1 : 1;
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
        $delegate = Delegate::where('user_uid', session()->get('user')->uid)->first();
        $delegation = Delegation::where('delegates', $delegate->delegates_uid)->first();
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
