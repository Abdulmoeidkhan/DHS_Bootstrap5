<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPlan;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Driver;
use App\Models\Hotel;
use App\Models\HotelPlan;
use App\Models\Interpreter;
use App\Models\Liason;
use App\Models\Officer;
use App\Models\Rank;
use App\Models\Receiving;
use App\Models\Vips;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DelegationsPageController extends Controller
{
    public function delegationData($status = null)
    {
        if ($status == 1) {
            $delegations = DB::table('delegations')
                ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
                ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
                ->where([['delegations.delegation_response', 'Accepted'], ['delegations.delegation_status', '1']])
                ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_uid')
                ->orderBy('delegations.country', 'asc')
                ->orderBy('vips.vips_rank', 'asc')
                ->get();

            foreach ($delegations as $key => $delegation) {
                $delegations[$key]->standard = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4f']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->superior = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4h']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->dOccupancy = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4i']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->officers = DB::table('officers')->leftJoin('ranks', 'officers.officer_rank', '=', 'ranks.ranks_uid')->where('officer_delegation', $delegation->uid)->select('officers.*', 'ranks.ranks_name')->get();
                $delegations[$key]->suite = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4g']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->carA = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', '61346491-983a-40ed-8477-2d9ed84e6767']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->carB = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', 'a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Representative'], ['status', 1]])->count();
                $delegations[$key]->members = Delegate::where([['delegation', $delegation->uid], ['delegation_type', 'Member'], ['status', 1]])->get();
                $delegations[$key]->rankName = Rank::where('ranks_uid', $delegation->rank)->first('ranks_name');
                $delegations[$key]->vips = Vips::where('vips_uid', $delegation->vips_uid)->first();
                $delegations[$key]->vips->rank = Rank::where('ranks_uid', $delegations[$key]->vips->vips_rank)->first('ranks_name');
                $delegations[$key]->cars = Car::where('car_delegation', $delegation->uid)->get();
                foreach ($delegations[$key]->members as $memberkey => $members) {
                    $delegations[$key]->members[$memberkey]->rank = Rank::where('ranks_uid', $members->rank)->first('ranks_name');
                }
                foreach ($delegations[$key]->cars as $keyCar => $car) {
                    $delegations[$key]->cars[$keyCar]->driver = Driver::where('driver_uid', $car->driver_uid)->first();
                }
                $delegations[$key]->hotelData = $delegations[$key]->standard ? Hotel::where('hotel_uid', $delegations[$key]->standard?->hotel_uid)->first('hotel_names') : null;
                // $delegations[$key]->vips->rank = array_filter($ranks->toArray(),fn ($rank) => $rank['ranks_uid'] == $delegations[$key]->vips->vips_rank);
                // $delegations[$key]->vips->rank = Rank::where('vips_uid', $delegations[$key]->vips['vips_rank'])->first('ranks_name');
                // $delegations[$key]->member_count = $delegations[$key]->member_count ? $delegations[$key]->member_count + 1 : 1;
            }
            return $delegations;
        } else if ($status == null) {
            $delegations = DB::table('delegations')
                ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
                ->leftJoin('vips', 'vips.vips_uid', '=', 'delegations.invited_by')
                ->where('delegations.delegation_status', '1')
                ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_uid')
                ->orderBy('delegations.country', 'asc')
                ->orderBy('vips.vips_rank', 'asc')
                ->get();
            foreach ($delegations as $key => $delegation) {
                $delegations[$key]->standard = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4f']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->superior = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4h']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->dOccupancy = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4i']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->suite = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4g']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->officers = DB::table('officers')->leftJoin('ranks', 'officers.officer_rank', '=', 'ranks.ranks_uid')->where('officer_delegation', $delegation->uid)->select('officers.*', 'ranks.ranks_name')->get();
                $delegations[$key]->carA = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', '61346491-983a-40ed-8477-2d9ed84e6767']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->carB = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', 'a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Representative'], ['status', 1]])->count();
                $delegations[$key]->members = Delegate::where([['delegation', $delegation->uid], ['status', 1], ['self', 1], ['delegation_type', '!=', 'Self']])->get();
                $delegations[$key]->rankName = Rank::where('ranks_uid', $delegation->rank)->first('ranks_name');
                $delegations[$key]->vips = Vips::where('vips_uid', $delegation->vips_uid)->first();
                $delegations[$key]->vips->rank = Rank::where('ranks_uid', $delegations[$key]->vips->vips_rank)->first('ranks_name');
                $delegations[$key]->cars = Car::where('car_delegation', $delegation->uid)->get();
                $delegations[$key]->hotelPlan = HotelPlan::where('delegation_uid', $delegation->uid)->first(['hotel_uid']);
                foreach ($delegations[$key]->members as $memberkey => $members) {
                    $delegations[$key]->members[$memberkey]->rank = Rank::where('ranks_uid', $members->rank)->first('ranks_name');
                }
                foreach ($delegations[$key]->cars as $keyCar => $car) {
                    $delegations[$key]->cars[$keyCar]->driver = Driver::where('driver_uid', $car->driver_uid)->first();
                }
                $delegations[$key]->hotelData = $delegations[$key]->hotelPlan ? Hotel::where('hotel_uid', $delegations[$key]->hotelPlan->hotel_uid)->first('hotel_names') : '';
            }
            return $delegations;
        } else if ($status == 0) {
            $delegations = DB::table('delegations')
                ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
                ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
                ->where([['delegations.delegation_response', 'Awaited'], ['delegations.delegation_status', '1']])
                ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_uid')
                ->orderBy('delegations.country', 'asc')
                ->orderBy('vips.vips_rank', 'asc')
                ->get();
            foreach ($delegations as $key => $delegation) {
                $delegations[$key]->standard = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4f']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->superior = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4h']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->dOccupancy = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4i']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->officers = DB::table('officers')->leftJoin('ranks', 'officers.officer_rank', '=', 'ranks.ranks_uid')->where('officer_delegation', $delegation->uid)->select('officers.*', 'ranks.ranks_name')->get();
                $delegations[$key]->suite = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4g']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->carA = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', '61346491-983a-40ed-8477-2d9ed84e6767']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->carB = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', 'a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Representative'], ['status', 1]])->count();
                $delegations[$key]->members = Delegate::where([['delegation', $delegation->uid], ['delegation_type', 'Member'], ['status', 1]])->get();
                $delegations[$key]->rankName = Rank::where('ranks_uid', $delegation->rank)->first('ranks_name');
                $delegations[$key]->vips = Vips::where('vips_uid', $delegation->vips_uid)->first();
                $delegations[$key]->vips->rank = Rank::where('ranks_uid', $delegations[$key]->vips->vips_rank)->first('ranks_name');
                $delegations[$key]->cars = Car::where('car_delegation', $delegation->uid)->get();
                foreach ($delegations[$key]->members as $memberkey => $members) {
                    $delegations[$key]->members[$memberkey]->rank = Rank::where('ranks_uid', $members->rank)->first('ranks_name');
                }
                foreach ($delegations[$key]->cars as $keyCar => $car) {
                    $delegations[$key]->cars[$keyCar]->driver = Driver::where('driver_uid', $car->driver_uid)->first();
                }
                $delegations[$key]->hotelData = $delegations[$key]->standard ? Hotel::where('hotel_uid', $delegations[$key]->standard?->hotel_uid)->first('hotel_names') : null;
                // $delegations[$key]->vips->rank = array_filter($ranks->toArray(),fn ($rank) => $rank['ranks_uid'] == $delegations[$key]->vips->vips_rank);
                // $delegations[$key]->vips->rank = Rank::where('vips_uid', $delegations[$key]->vips['vips_rank'])->first('ranks_name');
                // $delegations[$key]->member_count = $delegations[$key]->member_count ? $delegations[$key]->member_count + 1 : 1;
            }
            return $delegations;
        } else if ($status == 2) {
            $delegations = DB::table('delegations')
                ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
                ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
                ->where([['delegations.delegation_response', 'Regretted'], ['delegations.delegation_status', '1']])
                ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_uid')
                ->orderBy('delegations.country', 'asc')
                ->orderBy('vips.vips_rank', 'asc')
                ->get();
            foreach ($delegations as $key => $delegation) {
                $delegations[$key]->standard = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4f']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->superior = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4h']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->dOccupancy = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4i']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->officers = DB::table('officers')->leftJoin('ranks', 'officers.officer_rank', '=', 'ranks.ranks_uid')->where('officer_delegation', $delegation->uid)->select('officers.*', 'ranks.ranks_name')->get();
                $delegations[$key]->suite = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4g']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->carA = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', '61346491-983a-40ed-8477-2d9ed84e6767']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->carB = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', 'a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Representative'], ['status', 1]])->count();
                $delegations[$key]->members = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Self'], ['status', 1]])->get();
                $delegations[$key]->rankName = Rank::where('ranks_uid', $delegation->rank)->first('ranks_name');
                $delegations[$key]->vips = Vips::where('vips_uid', $delegation->vips_uid)->first();
                $delegations[$key]->vips->rank = Rank::where('ranks_uid', $delegations[$key]->vips->vips_rank)->first('ranks_name');
                $delegations[$key]->cars = Car::where('car_delegation', $delegation->uid)->get();
                foreach ($delegations[$key]->members as $memberkey => $members) {
                    $delegations[$key]->members[$memberkey]->rank = Rank::where('ranks_uid', $members->rank)->first('ranks_name');
                }
                foreach ($delegations[$key]->cars as $keyCar => $car) {
                    $delegations[$key]->cars[$keyCar]->driver = Driver::where('driver_uid', $car->driver_uid)->first();
                }
                $delegations[$key]->hotelData = $delegations[$key]->standard ? Hotel::where('hotel_uid', $delegations[$key]->standard?->hotel_uid)->first('hotel_names') : null;
                // $delegations[$key]->vips->rank = array_filter($ranks->toArray(),fn ($rank) => $rank['ranks_uid'] == $delegations[$key]->vips->vips_rank);
                // $delegations[$key]->vips->rank = Rank::where('vips_uid', $delegations[$key]->vips['vips_rank'])->first('ranks_name');
                // $delegations[$key]->member_count = $delegations[$key]->member_count ? $delegations[$key]->member_count + 1 : 1;
            }
            return $delegations;
        } else if ($status == 3) {
            $delegations = DB::table('delegations')
                ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
                ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
                ->where('delegations.delegation_status', '0')
                ->select('delegations.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.rank', 'delegates.self', 'delegates.delegates_uid', 'delegates.designation', 'vips.vips_uid')
                ->orderBy('delegations.country', 'asc')
                ->orderBy('vips.vips_rank', 'asc')
                ->get();
            foreach ($delegations as $key => $delegation) {
                $delegations[$key]->standard = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4f']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->superior = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4h']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->dOccupancy = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4i']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->officers = DB::table('officers')->leftJoin('ranks', 'officers.officer_rank', '=', 'ranks.ranks_uid')->where('officer_delegation', $delegation->uid)->select('officers.*', 'ranks.ranks_name')->get();
                $delegations[$key]->suite = HotelPlan::where([['delegation_uid', $delegation->uid], ['hotel_roomtpye_uid', '7548a2ec-7eaf-4e85-a957-3749d6d69e4g']])->first(['hotel_uid', 'hotel_quantity', 'hotel_plan_uid']);
                $delegations[$key]->carA = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', '61346491-983a-40ed-8477-2d9ed84e6767']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->carB = CarPlan::where([['delegation_uid', $delegation->uid], ['car_category_uid', 'a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->first(['car_quantity', 'car_plan_uid']);
                $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Representative'], ['status', 1]])->count();
                $delegations[$key]->members = Delegate::where([['delegation', $delegation->uid], ['delegation_type', '!=', 'Self'], ['status', 1]])->get();
                $delegations[$key]->rankName = Rank::where('ranks_uid', $delegation->rank)->first('ranks_name');
                $delegations[$key]->vips = Vips::where('vips_uid', $delegation->vips_uid)->first();
                $delegations[$key]->vips->rank = Rank::where('ranks_uid', $delegations[$key]->vips->vips_rank)->first('ranks_name');
                $delegations[$key]->cars = Car::where('car_delegation', $delegation->uid)->get();
                foreach ($delegations[$key]->members as $memberkey => $members) {
                    $delegations[$key]->members[$memberkey]->rank = Rank::where('ranks_uid', $members->rank)->first('ranks_name');
                }
                foreach ($delegations[$key]->cars as $keyCar => $car) {
                    $delegations[$key]->cars[$keyCar]->driver = Driver::where('driver_uid', $car->driver_uid)->first();
                }
                $delegations[$key]->hotelData = $delegations[$key]->standard ? Hotel::where('hotel_uid', $delegations[$key]->standard?->hotel_uid)->first('hotel_names') : null;
                // $delegations[$key]->vips->rank = array_filter($ranks->toArray(),fn ($rank) => $rank['ranks_uid'] == $delegations[$key]->vips->vips_rank);
                // $delegations[$key]->vips->rank = Rank::where('vips_uid', $delegations[$key]->vips['vips_rank'])->first('ranks_name');
                // $delegations[$key]->member_count = $delegations[$key]->member_count ? $delegations[$key]->member_count + 1 : 1;
            }
            return $delegations;
        }
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
        // $delegate = Delegate::where('delegation', session()->get('user')->delegationUid)->first();
        $delegation = Delegation::where('uid', session()->get('user')->delegationUid)->first();
        $delegation->vip = Vips::where('vips_uid', $delegation->invited_by)->first();
        foreach ($delegation as $delegate) {
            $delegation->vip->rank_name = Rank::where('ranks_uid', $delegation->vip->vips_rank)->first('ranks_name');
        }
        // return $delegation->vips_rank;
        return view('pages.delegation', ['delegation' => $delegation]);
    }

    public function delegationAssigned()
    {
        $delegationUid = 0;
        switch (session()->get('user')->roles[0]->name) {
            case "liason" || "receiving" || "interpreter":
                $officers = Officer::where('officer_user', session()->get('user')->uid)->first('officer_delegation');
                $delegationUid = $officers ? $officers->officer_delegation : 0;
                break;
            // case "receiving":
            //     $officers = Receiving::where('receiving_uid', session()->get('user')->uid)->first('receiving_delegation');
            //     $delegationUid = $officers ? $officers->receiving_delegation : 0;
            //     break;
            // case "interpreter":
            //     $officers = Interpreter::where('interpreter_uid', session()->get('user')->uid)->first('interpreter_delegation');
            //     $delegationUid = $officers ? $officers->interpreter_delegation : 0;
            //     break;
            default:
                return back()->with('error', 'Something Went Wrong');
        }

        $delegation = Delegation::where('uid', $delegationUid)->first();
        $delegation->vip = Vips::where('vips_uid', $delegation->invited_by)->first();
        // return $delegation;
        return view('pages.delegationAssigned', ['delegation' => $delegation]);
    }

    public function updateStatus($id)
    {
        $status = Delegation::where('uid', $id)->first('delegation_status');
        $updatedStatus = $status->delegation_status ? Delegation::where('uid', $id)->update(['delegation_status' => 0]) : Delegation::where('uid', $id)->update(['delegation_status' => 1]);
        return $updatedStatus ? back()->with('message', 'Delegation Status Updated Successfully') : back()->with('error', 'Something Went Wrong');
    }

    public function delegateStatusChanger($id)
    {
        $status = Delegate::where('delegates_uid', $id)->first('status');
        $updatedStatus = $status->status ? Delegate::where('delegates_uid', $id)->update(['status' => 0]) : Delegate::where('delegates_uid', $id)->update(['status' => 1]);
        return $updatedStatus ? back()->with('message', 'Delegate Status Updated Successfully') : back()->with('error', 'Something Went Wrong');
    }
}
