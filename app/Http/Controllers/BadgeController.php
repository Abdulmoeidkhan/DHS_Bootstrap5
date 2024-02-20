<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\Hotel;
use App\Models\HotelPlan;
use App\Models\Officer;
use App\Models\Vips;

class BadgeController extends Controller
{
    public function renderBadges()
    {
        return view('pages.badges.badge');
    }

    public function renderListEBadge()
    {
        $delegation = Delegation::where([['user_uid', session()->get('user')->uid], ['delegation_status', 1]])->first();
        $delegates = Delegate::where([['delegation', $delegation->uid], ['status', 1]])->get();
        return view('pages.badges.e-badgeList', ['delegates' => $delegates]);
        // return $delegates;
    }

    public function renderEBadge($id)
    {
        $delegates = Delegate::where('delegates_uid', $id)->get();
        $delegations = Delegation::where('uid', $delegates[0]->delegation)->get();
        $invitedBys = Vips::where('vips_uid', $delegations[0]->invited_by)->get();
        $officers = Officer::where('officer_delegation', $delegates[0]->delegation)->get();
        $hotelPlan = HotelPlan::where('delegation_uid', $delegates[0]->delegation)->get('hotel_uid');
        $hotelNames = Hotel::where('hotel_uid', $hotelPlan[0]->hotel_uid)->get();
        $flightDetails = DelegateFlight::where('delegate_uid', $id)->get();
        // return $delegations->delegationCode;
        return view('pages.badges.e-badge', ['delegations' => $delegations, 'delegates' => $delegates, 'invitedBys' => $invitedBys, 'officers' => $officers, 'hotelNames' => $hotelNames, 'flightDetails' => $flightDetails]);
    }
}
