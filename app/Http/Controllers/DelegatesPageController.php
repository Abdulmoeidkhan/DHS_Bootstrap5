<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\ForeignImageValidator;
use App\Models\Officer;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DelegatesPageController extends Controller
{
    public function render()
    {
        return view('pages.delegates');
    }

    public function delegatesData($status = null)
    {
        if ($status == 1) {
            if (session()->get('user')->roles[0]->name == "admin") {
                $delegates = DB::table('delegates')
                    ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                    ->leftJoin('vips', 'vips.vips_uid', '=', 'delegations.invited_by')
                    ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                    ->leftJoin('hotel_plans', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
                    ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'hotel_plans.hotel_uid')
                    ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                    ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                    // ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                    ->where([['delegates.first_Name', '!=', null], ['delegates.status', '1'], ['delegates.self', '1']])
                    ->select('delegates.*', 'delegate_flights.*', 'rooms.*', 'hotels.*', 'roomtypes.*', 'delegations.country', 'delegations.delegation_response', 'delegations.delegationCode', 'delegations.delegation_status', 'delegations.invited_by', 'vips.*')
                    ->orderBy('delegations.country', 'asc')
                    ->get();
            } elseif (session()->get('user')->roles[0]->name == "dho") {
                $delegates = DB::table('delegates')
                    ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                    ->leftJoin('vips', 'vips.vips_uid', '=', 'delegations.invited_by')
                    ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                    // ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                    ->leftJoin('hotel_plans', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
                    ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'hotel_plans.hotel_uid')
                    ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                    ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                    ->where([['delegates.first_Name', '!=', null], ['delegates.status', '1'], ['delegates.self', '1'], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegates.*', 'delegate_flights.*', 'rooms.*', 'hotels.*', 'roomtypes.*',  'delegations.country', 'delegations.delegation_response', 'delegations.delegationCode', 'delegations.delegation_status', 'delegations.invited_by', 'vips.*')
                    ->orderBy('delegations.country', 'asc')
                    ->get();
            }


            foreach ($delegates as $key => $delegate) {
                $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
                $delegates[$key]->invited_by_name = Rank::where('ranks_uid', $delegate->invited_by)->first('ranks_name');
                $delegates[$key]->img_blob = 'https://res.cloudinary.com/dhkm5xmpn/image/upload/v' . time() . '/Images/' . $delegate->delegates_uid . '.png';
                $delegates[$key]->imagePresent = ForeignImageValidator::where('image_uid', $delegate->delegates_uid)->first('image_exist');
                $delegates[$key]->isHead = $delegate->delegation_type !== "Member" ? "Yes" : "No";
                $delegates[$key]->officers = Officer::where('officer_delegation', $delegate->delegation)->get(['officer_first_name', 'officer_last_name', 'officer_contact', 'officer_rank', 'officer_type']);
                foreach ($delegates[$key]->officers as $officerKey => $officer) {
                    $delegates[$key]->officers[$officerKey]->rank = Rank::where('ranks_uid', $officer->officer_rank)->first('ranks_name');
                }
            }
            return $delegates;
        } else if ($status == 0) {
            $delegates = DB::table('delegates')
                ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
                ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                // ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                ->leftJoin('hotel_plans', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
                ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'hotel_plans.hotel_uid')
                ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                ->leftJoin('officers', 'delegates.delegation', '=', 'officers.officer_delegation')
                ->where([['delegates.first_Name', '!=', null], ['delegates.status', '0'], ['self', '1']])
                ->select('delegates.*', 'delegate_flights.*', 'rooms.*', 'hotels.*', 'roomtypes.*', 'image_blobs.uid', 'delegations.country', 'delegations.delegation_response', 'delegations.invited_by', 'vips.*')
                ->orderBy('delegations.country', 'asc')
                ->get();

            foreach ($delegates as $key => $delegate) {
                $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate[$key]->rank)->first('ranks_name');
                $delegates[$key]->invited_by->name = Rank::where('ranks_uid', $delegate[$key]->invited_by->name)->first('ranks_name');
                $delegates[$key]->img_blob = 'https://res.cloudinary.com/dhkm5xmpn/image/upload/v' . time() . '/Images/' . $delegate->delegates_uid . '.png';
                $delegates[$key]->imagePresent = ForeignImageValidator::where('image_uid', $delegate->delegates_uid)->first('image_exist');
                $delegates[$key]->officers = Officer::where('officer_delegation', $delegate->delegation)->get(['officer_first_name', 'officer_last_name', 'officer_contact', 'officer_rank', 'officer_type']);
                foreach ($delegates[$key]->officers as $officerKey => $officer) {
                    $delegates[$key]->officers[$officerKey]->rank = Rank::where('ranks_uid', $officer->officer_rank)->first('ranks_name');
                }
            }
            return $delegates;
        } else if ($status == 2) {
            if (session()->get('user')->roles[0]->name == "admin") {
                $delegates = DB::table('delegates')
                    ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                    ->leftJoin('vips', 'vips.vips_uid', '=', 'delegations.invited_by')
                    ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                    ->leftJoin('hotel_plans', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
                    ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'hotel_plans.hotel_uid')
                    ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                    ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                    // ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                    ->where([['delegates.first_Name', '!=', null], ['delegates.status', '1'], ['delegates.self', '1'], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegates.*', 'delegate_flights.*', 'rooms.*', 'hotels.*', 'roomtypes.*', 'delegations.country', 'delegations.delegation_response', 'delegations.delegationCode', 'delegations.delegation_status', 'delegations.invited_by', 'vips.*')
                    ->orderBy('delegations.country', 'asc')
                    ->get();
            } elseif (session()->get('user')->roles[0]->name == "dho") {
                $delegates = DB::table('delegates')
                    ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                    ->leftJoin('vips', 'vips.vips_uid', '=', 'delegations.invited_by')
                    ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                    // ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                    ->leftJoin('hotel_plans', 'hotel_plans.delegation_uid', '=', 'delegations.uid')
                    ->leftJoin('hotels', 'hotels.hotel_uid', '=', 'hotel_plans.hotel_uid')
                    ->leftJoin('rooms', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                    ->leftJoin('roomtypes', 'rooms.room_type', '=', 'roomtypes.room_type_uid')
                    ->where([['delegates.first_Name', '!=', null], ['delegates.status', '1'], ['delegates.self', '1'], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegates.*', 'delegate_flights.*', 'rooms.*', 'hotels.*', 'roomtypes.*',  'delegations.country', 'delegations.delegation_response', 'delegations.delegationCode', 'delegations.delegation_status', 'delegations.invited_by', 'vips.*')
                    ->orderBy('delegations.country', 'asc')
                    ->get();
            }


            foreach ($delegates as $key => $delegate) {
                $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
                $delegates[$key]->invited_by_name = Rank::where('ranks_uid', $delegate->invited_by)->first('ranks_name');
                $delegates[$key]->img_blob = 'https://res.cloudinary.com/dhkm5xmpn/image/upload/v' . time() . '/Images/' . $delegate->delegates_uid . '.png';
                $delegates[$key]->imagePresent = ForeignImageValidator::where('image_uid', $delegate->delegates_uid)->first('image_exist');
                $delegates[$key]->isHead = $delegate->delegation_type !== "Member" ? "Yes" : "No";
                $delegates[$key]->officers = Officer::where('officer_delegation', $delegate->delegation)->get(['officer_first_name', 'officer_last_name', 'officer_contact', 'officer_rank', 'officer_type']);
                foreach ($delegates[$key]->officers as $officerKey => $officer) {
                    $delegates[$key]->officers[$officerKey]->rank = Rank::where('ranks_uid', $officer->officer_rank)->first('ranks_name');
                }
            }
            return $delegates;
        }
    }

    public function getDelegatesStats()
    {
        $accepted = Delegation::where('delegation_response', 'Accepted')->count();
        $awaited = Delegation::where('delegation_response', 'Awaited')->count();
        $regretted = Delegation::where('delegation_response', 'Regretted')->count();
        return ['names' => ['Accepted', 'Awaited', 'Regretted'], 'values' => [$accepted, $awaited, $regretted]];
    }


    public function getDelegationStats()
    {
        $countries = Delegation::distinct('country')->orderBy('country', 'asc')->get('country');
        foreach ($countries as $key => $country) {
            $countries[$key]->accepted = Delegation::where([['delegation_response', 'Accepted'], ['delegation_status', 1], ['country', $country->country]])->count();
            $countries[$key]->regretted = Delegation::where([['delegation_response', 'Regretted'], ['delegation_status', 1], ['country', $country->country]])->count();
            $countries[$key]->awaited = Delegation::where([['delegation_response', 'Awaited'], ['delegation_status', 1], ['country', $country->country]])->count();
            $countries[$key]->invitation = Delegation::where('country', $country->country)->count();
        }
        // $countries->response = 'success';
        return $countries;
    }

    public function getDelegateSummary()
    {
        $active = Delegate::where('status', 1)->whereNotNull('rank')->count();
        $inActive = Delegate::where('status', 0)->whereNotNull('rank')->count();
        return ['names' => ['Active', 'InActive'], 'values' => [$active, $inActive]];
    }

    public function getDelegateGolfSummary()
    {
        $player = Delegation::where([['golf_player', 1], ['delegation_status', 1]])->count();
        $nonPlayer = Delegation::where([['golf_player', 0], ['delegation_status', 1]])->count();
        return ['names' => ['Player', 'Non Player'], 'values' => [$player, $nonPlayer]];
    }

    public function invitationUpdate(Request $req)
    {
        $updatedDelegate = Delegate::where('delegates_uid', $req->delegationUid)->update(['invitation_number' => $req->invitaionNumber]);
        return $updatedDelegate ? redirect()->back()->with('message', 'Invitation Number Updated Successfully') : redirect()->back()->with('error', 'Something Went Wrong');
    }
}
