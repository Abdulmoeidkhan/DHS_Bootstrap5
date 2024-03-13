<?php

namespace App\Http\Controllers;

use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Flightsegment;
use App\Models\Itinerary;
use App\Models\Member;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    public function render()
    {
        return view('pages.flights');
    }

    public function addItineraryRender()
    {
        return view('pages.addFlights');
    }

    public function getItinerary()
    {
        $itineraries = Itinerary::where('itinerary_status', 1)->get();
        return $itineraries;
    }

    public function viewItinerary($id)
    {
        $itineraries = Itinerary::where('itinerary_uid', $id)->first();
        $flightsegments = Flightsegment::where('itinerary_uid', $id)->get();
        return view('pages.viewItinerary', ['itineraries' => $itineraries, 'flightsegments' => $flightsegments]);
    }

    public function addItinerary(Request $req)
    {
        $itinerary = new Itinerary();
        $itinerary->itinerary_uid = (string) Str::uuid();
        $itinerary->itinerary_name = $req->itineraryName;
        $itinerary->itinerary_remarks = $req->itineraryRemarks;
        $segments = [];
        try {
            $savedItinerary = $itinerary->save();
            if ($savedItinerary) {
                for ($i = 0; $i < $req->rows; $i++) {
                    $segment = [];
                    $segment['flight_no'] = $req["segment-" . $i + 1 . "-flightNo"];
                    $segment['airline'] = $req["segment-" . $i + 1 . "-airline"];
                    $segment['arrival_city'] = $req["segment-" . $i + 1 . "-arrCity"];
                    $segment['arrival_date'] = $req["segment-" . $i + 1 . "-arrDate"];
                    $segment['arrival_time'] = $req["segment-" . $i + 1 . "-arrTime"];
                    $segment['departure_city'] = $req["segment-" . $i + 1 . "-depCity"];
                    $segment['departure_date'] = $req["segment-" . $i + 1 . "-depDate"];
                    $segment['departure_time'] = $req["segment-" . $i + 1 . "-depTime"];
                    $segment['itinerary_uid'] = $itinerary->itinerary_uid;
                    $segment['flightsegment_uid'] = (string) Str::uuid();
                    array_push($segments, $segment);
                }
                Flightsegment::insert($segments);
                return redirect()->back()->with('message', "Itinerary Updates Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function updateItinerary(Request $req)
    {
        try {
            for ($i = 0; $i < $req->rows; $i++) {
                $segments = [];
                $segments['airline'] = $req['segment-' . $i + 1 . '-airline'];
                $segments['flight_no'] = $req['segment-' . $i + 1 . '-flightNo'];
                $segments['departure_city'] = $req['segment-' . $i + 1 . '-depCity'];
                $segments['departure_date'] = $req['segment-' . $i + 1 . '-depDate'];
                $segments['departure_time'] = $req['segment-' . $i + 1 . '-depTime'];
                $segments['arrival_city'] = $req['segment-' . $i + 1 . '-arrCity'];
                $segments['arrival_date'] = $req['segment-' . $i + 1 . '-arrDate'];
                $segments['arrival_time'] = $req['segment-' . $i + 1 . '-arrTime'];
                Flightsegment::where("flightsegment_uid", $req["segment-" . $i + 1 . "-uid"])->update($segments);
            }
            return redirect()->back()->with('message', "Itinerary Updates Successfully");
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }

        return $req->all();
    }

    public function getTickets()
    {
        $tickets = Ticket::where('ticket_status', 1)->get();
        return $tickets;
    }

    public function addTicketRender()
    {
        $delegates = Delegate::where('status', 1)->whereNotNull('first_Name')->get();
        $member = Member::where('member_status', 1)->get();
        $itinerary = Itinerary::where('itinerary_status', 1)->get();
        $passengers = [...$delegates, ...$member];
        return view('pages.addtickets', ['passengers' => $passengers, 'itineraries' => $itinerary]);
    }

    public function addTicket(Request $req)
    {
        $ticket = new Ticket();
        $ticket->ticket_uid = (string) Str::uuid();
        $ticket->ticket_remarks = $req->ticket_remarks;
        $ticket->ticket_number = $req->ticket_number;
        $ticket->itinerary_uid = $req->itinerary_uid;
        $ticket->passenger_uid = $req->passenger_uid;
        try {
            $savedTicket = $ticket->save();
            if ($savedTicket) {
                return redirect()->back()->with('message', "Itinerary Updates Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function viewPassenger(Request $req, $id)
    {
        // return Member::where('member_uid', $id)->first();
        $isMember = Member::where('member_uid', $id)->first() ? true : false;
        return $isMember ? redirect()->route('pages.memberFullProfile', $id) : redirect()->route('pages.renderSpeceficDelegateProfile', $id);
    }

    public function addFlightPage(Request $req, $id)
    {
        $flight = DelegateFlight::where('delegate_uid', $id)->first();
        $member = Delegate::where('delegates_uid', $id)->first();
        return view('pages.addFlight', ['flight' => $flight, 'member' => $member, 'id' => $id]);
    }
}
