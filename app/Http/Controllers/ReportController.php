<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\Flightsegment;
use App\Models\Rank;
use App\Models\Room;
use App\Models\Vips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Delegation Attendance Start
    public function delegationAttendanceData(Request $req)
    {
        $delegations = Delegation::distinct('country')->get('country');

        foreach ($delegations as  $key => $delegation) {
            $delegations[$key]->count = Delegation::where('country', $delegation->country)->count();
            foreach (Delegation::where('country', $delegation->country)->get(['uid']) as $index => $delegataionUid) {
                $delegations[$key]->arrivedCount = $delegations[$key]->arrivedCount + DelegateFlight::where([['delegation_uid', $delegataionUid->uid], ['arrived', 1]])->count() ? 1 : 0;
            }
        }
        return $delegations;
    }
    // Delegation Attendance End

    //  Country Report Start

    public function countryReport()
    {
        return view('pages.reports.countryReport');
    }

    public function countryData()
    {
        $countries = Delegation::distinct('country')->get('country');
        foreach ($countries as $countrieskey => $country) {
            $countries[$countrieskey]->count = Delegation::where('country', $country->country)->count();
            $countries[$countrieskey]->regretted = Delegation::where([['country', $country->country], ['delegation_response', 'Regretted']])->count();
            $countries[$countrieskey]->accepted = Delegation::where([['country', $country->country], ['delegation_response', 'Accepted']])->count();
            $countries[$countrieskey]->awaited = Delegation::where([['country', $country->country], ['delegation_response', 'Awaited']])->count();
        }
        return $countries;
    }

    // Country Report End

    // Vip Start

    public function vipDelegationReport()
    {
        return view('pages.reports.delegationByVip');
    }

    public function vipDelegationData()
    {
        $invitees = Delegation::distinct('invited_by')->get('invited_by');
        foreach ($invitees as $inviteeskey => $invitee) {
            $invitees[$inviteeskey]->name = Vips::where('vips_uid', $invitee->invited_by)->first('vips_designation');
            $invitees[$inviteeskey]->count = Delegation::where('invited_by', $invitee->invited_by)->count();
            $invitees[$inviteeskey]->regretted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Regretted']])->count();
            $invitees[$inviteeskey]->accepted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Accepted']])->count();
            $invitees[$inviteeskey]->awaited = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Awaited']])->count();
        }
        return $invitees;
    }

    // Vip End

    // Country And Vip Start

    public function countryAndVipReport()
    {
        $vips = Vips::get();
        // foreach ($vips as $key => $vip) {
        //     $vips[$key]->rankDetails = Rank::where('ranks_uid', $vip->vips_rank)->first();
        // }
        return view('pages.reports.countryAndVipReport', ['vips' => $vips]);
    }

    public function countryAndVipData()
    {

        $countries = Delegation::distinct('country')->get('country');
        // $vips = Vips::get();
        foreach ($countries as $countrieskey => $country) {
            $delegations = Delegation::where('country', $country->country)->distinct('invited_by')->get('invited_by');
            $delegationsCount = Delegation::where('country', $country->country)->count('invited_by');
            $countArray = [];
            foreach ($delegations as $delegationsKey => $delegation) {
                $designation = Delegation::where([['invited_by', $delegation->invited_by], ['country', $country->country]])->count();
                $vip = Vips::where('vips_uid', $delegation->invited_by)->first('vips_designation');
                $delegations[$delegationsKey]->designation = $vip->vips_designation;
                $delegations[$delegationsKey]->designationCount = $designation;
                // $renameArray = [$vip->vips_designation => $designation];
                // array_push($countArray, [...$renameArray]);
            }
            // foreach ($delegations as $delegationsKey => $delegation) {
            //     $vip = Vips::where('vips_uid', $delegation->invited_by)->first('vips_rank');
            //     $rank = Rank::where('ranks_uid', $vip->vips_rank)->first('ranks_name');
            //     $renameArray = [$rank->ranks_name => 1];
            //     array_push($countArray, [...$renameArray]);
            // }
            // foreach ($delegations as $delegationsKey => $delegation) {
            //     $vip = Vips::where('vips_uid', $delegation->invited_by)->first();
            //     $renameArray = [$vip->vips_designation => 1];
            //     array_push($countArray, [...$renameArray]);
            // }
            $countries[$countrieskey]->totalCount = $delegationsCount;
            $countries[$countrieskey]->delegations = $delegations;
            // foreach ($vips as $vipsKey => $vip) {
            //     $vips[$vipsKey]->rankName = Rank::where('ranks_uid', $vip->vips_rank)->first('ranks_name');
            //     array_push($vipArray, $vips[$vipsKey]);
            //     $countries[$countrieskey]->vip = $vipArray;
            //     $countries[$countrieskey]->count = Delegation::where([['invited_by', $vip->vips_uid], ['country', $country->country]])->count();
            // }
        }
        return $countries;
    }

    // Country And Vip End

    // Self/Rep Start
    public function selfRepReport()
    {
        return view('pages.reports.selfRepReport');
    }

    public function selfRepData()
    {
        $invitees = Delegation::distinct('invited_by')->get('invited_by');
        foreach ($invitees as $inviteeskey => $invitee) {
            $invitees[$inviteeskey]->name = Vips::where('vips_uid', $invitee->invited_by)->first('vips_designation');
            $invitees[$inviteeskey]->count = Delegation::where('invited_by', $invitee->invited_by)->count();
            $accepted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Accepted']])->first();
            $invitees[$inviteeskey]->awaited = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Awaited']])->count();
            $invitees[$inviteeskey]->regretted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Regretted']])->count();
            $invitees[$inviteeskey]->self = $accepted ? Delegate::where([['delegation', $accepted->uid], ['delegation_type', 'Self'], ['self', 1]])->count() : 0;
            $invitees[$inviteeskey]->rep = $accepted ? Delegate::where([['delegation', $accepted->uid], ['delegation_type', 'Rep'], ['self', 1]])->count() : 0;
        }
        return $invitees;
    }

    // Self/Rep End

    // Delegation Arrival Status Start

    public function delegationArrivalStatusReport()
    {
        $flights = DelegateFlight::distinct('arrival_date')->get('arrival_date');
        return view('pages.reports.delegationArrivalStatus', ['flights' => $flights]);
    }

    public function delegationArrivalStatusData()
    {
        $countries = Delegation::distinct('country')->get('country');
        $flights = DelegateFlight::distinct('arrival_date')->get('arrival_date');
        foreach ($countries as $keyCountry => $country) {
            $arrivals = [];
            foreach ($flights as $keyFlights => $flight) {
                $arrivals[$keyFlights] = DB::table('delegate_flights')
                    ->leftJoin('delegations', 'delegations.uid', '=', 'delegate_flights.delegation_uid')
                    ->where([['delegations.country', $country->country], ['delegate_flights.arrival_date', $flight->arrival_date], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegations.country', 'delegations.uid')
                    ->count();
            }
            $countries[$keyCountry]->totalCount = array_sum($arrivals);
            $countries[$keyCountry]->arrivals = $arrivals;
        }

        return $countries;
    }
    // Delegation Arrival Status End

    // Delegation Arrival Status VIP Start

    public function delegationArrivalStatusVIPReport()
    {
        $flights = DelegateFlight::distinct('arrival_date')->get('arrival_date');
        return view('pages.reports.delegationArrivalStatusVIP', ['flights' => $flights]);
    }
    public function delegationArrivalStatusVIPData()
    {
        $invitees = Delegation::distinct('invited_by')->get('invited_by');
        $flights = DelegateFlight::distinct('arrival_date')->get('arrival_date');
        foreach ($invitees as $keyInvitees => $invitee) {
            $invitees[$keyInvitees]->name = Vips::where([['vips_uid', $invitee->invited_by], ['vips_status', 1]])->first('vips_designation');
            $arrivals = [];
            foreach ($flights as $keyFlights => $flight) {
                $arrivals[$keyFlights] = DB::table('delegate_flights')
                    ->leftJoin('delegations', 'delegations.uid', '=', 'delegate_flights.delegation_uid')
                    ->where([['delegations.invited_by', $invitee->invited_by], ['delegate_flights.arrival_date', $flight->arrival_date], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegations.invited_by', 'delegations.uid')
                    ->count();
            }
            $invitees[$keyInvitees]->totalCount = array_sum($arrivals);
            $invitees[$keyInvitees]->arrivals = $arrivals;
        }


        return $invitees;
    }

    // Delegation Arrival Status VIP End

    // Delegation ArrivalDetail Report Start

    public function delegationArrivalDetailReport()
    {
        return view('pages.reports.arrivalDetailReport');
    }

    // Delegation ArrivalDeatil Report End

    // Delegation Departure Status Start

    public function delegationDepartureStatusReport()
    {
        $flights = DelegateFlight::distinct('departure_date')->get('departure_date');
        return view('pages.reports.delegationDepartureStatus', ['flights' => $flights]);
    }

    public function delegationDepartureStatusData()
    {
        $countries = Delegation::distinct('country')->get('country');
        $flights = DelegateFlight::distinct('departure_date')->get('departure_date');
        foreach ($countries as $keyCountry => $country) {
            $departures = [];
            foreach ($flights as $keyFlights => $flight) {
                $departures[$keyFlights] = DB::table('delegate_flights')
                    ->leftJoin('delegations', 'delegations.uid', '=', 'delegate_flights.delegation_uid')
                    ->where([['delegations.country', $country->country], ['delegate_flights.departure_date', $flight->departure_date], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegations.country', 'delegations.uid')
                    ->count();
            }
            $countries[$keyCountry]->totalCount = array_sum($departures);
            $countries[$keyCountry]->departures = $departures;
        }

        return $countries;
    }
    // Delegation Arrival Status End

    // Delegation Arrival Status VIP Start

    public function delegationDepartureStatusVIPReport()
    {
        $flights = DelegateFlight::distinct('departure_date')->get('departure_date');
        return view('pages.reports.delegationDepartureStatusVIP', ['flights' => $flights]);
    }
    public function delegationCheckInStatusVIPData()
    {
        $invitees = Delegation::distinct('invited_by')->get('invited_by');
        $flights = DelegateFlight::distinct('departure_date')->get('departure_date');
        foreach ($invitees as $keyInvitees => $invitee) {
            $invitees[$keyInvitees]->name = Vips::where([['vips_uid', $invitee->invited_by], ['vips_status', 1]])->first('vips_designation');
            $departure = [];
            foreach ($flights as $keyFlights => $flight) {
                $arrivals[$keyFlights] = DB::table('delegate_flights')
                    ->leftJoin('delegations', 'delegations.uid', '=', 'delegate_flights.delegation_uid')
                    ->where([['delegations.invited_by', $invitee->invited_by], ['delegate_flights.departure_date', $flight->departure_date], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegations.invited_by', 'delegations.uid')
                    ->count();
            }
            $invitees[$keyInvitees]->totalCount = array_sum($departure);
            $invitees[$keyInvitees]->departure = $departure;
        }


        return $invitees;
    }

    // Delegation Arrival Status VIP End


    // Delegation DepartureDetail Report Start
    public function delegationDepartureDetailReport()
    {
        return view('pages.reports.departureDetailReport');
    }
    // Delegation DepartureDetail Report End


    // Delegation Check-In Status Report Start

    public function delegationCheckInStatus()
    {
        $rooms = Room::distinct('room_checkin')->get('room_checkin');
        return view('pages.reports.delegationCheckInStatus', ['rooms' => $rooms]);
    }

    public function delegationCheckInStatusData()
    {
        $countries = Delegation::distinct('country')->get('country');
        $rooms = Room::distinct('room_checkin')->get('room_checkin');
        foreach ($countries as $keyCountry => $country) {
            $room_checkin = [];
            foreach ($rooms as $keyRooms => $room) {
                $room_checkin[$keyRooms] = DB::table('rooms')
                    ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                    ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
                    ->where([['delegations.country', $country->country], ['rooms.room_checkin', $room->room_checkin], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegations.country', 'delegations.uid')
                    ->count();
            }
            $countries[$keyCountry]->totalCount = array_sum($room_checkin);
            $countries[$keyCountry]->room_checkin = $room_checkin;
        }

        return $countries;
    }

    // Delegation Check-In Status Report End

    // Delegation Check-In Status VIP Report Start

    public function delegationCheckInStatusVIPReport()
    {
        $rooms = Room::distinct('room_checkin')->get('room_checkin');
        return view('pages.reports.delegationCheckInStatusVIP', ['rooms' => $rooms]);
    }
    public function checkInDelegationStatusVIPData()
    {
        $invitees = Delegation::distinct('invited_by')->get('invited_by');
        $rooms = Room::distinct('room_checkin')->get('room_checkin');
        foreach ($invitees as $keyInvitees => $invitee) {
            $invitees[$keyInvitees]->name = Vips::where([['vips_uid', $invitee->invited_by], ['vips_status', 1]])->first('vips_designation');
            $room_checkin = [];
            foreach ($rooms as $keyRooms => $room) {
                $room_checkin[$keyRooms] = DB::table('rooms')
                    ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'rooms.assign_to')
                    ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
                    ->where([['delegations.invited_by', $invitee->invited_by], ['rooms.room_checkin', $room->room_checkin], ['delegations.delegation_response', 'Accepted']])
                    ->select('delegations.country', 'delegations.uid')
                    ->count();
            }
            $invitees[$keyInvitees]->totalCount = array_sum($room_checkin);
            $invitees[$keyInvitees]->room_checkin = $room_checkin;
        }


        return $invitees;
    }

    // Delegation Check-In Status VIP Report End


    // Delegation Arrival Status VIP Start

    // public delegationArrivalStatusVIPData(){
    //     $vips = Vips::distinct('vips_designation')->get('vips_uid');
    //     $flights = DelegateFlight::distinct('arrival_date')->get('arrival_date');
    //     foreach ($vips as $keyVip => $vip) {
    //         $vips[$keyVip]->totalCount = Delegation::where('country', $vip->vips_uid)->count();
    //         $delegations = Delegation::where('country', $country->country)->get('uid');
    //         $countries[$keyCountry]->$delegations = $delegations;
    //     }
    //     return $countries;
    // }

    // Delegation Arrival Status VIP End

    public function listOfAllDelegation()
    {
        return view('pages.reports.listOfAllDelegation');
    }

    public function listOfAllDelegates()
    {
        return view('pages.reports.listOfAllDelegates');
    }

    public function delegationAttendance()
    {
        return view('pages.reports.delegationAttendance');
    }
}
