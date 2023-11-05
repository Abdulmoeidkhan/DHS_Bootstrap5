<?php

namespace App\Http\Controllers;

use App\Models\Flightsegment;
use App\Models\Itinerary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    public function render()
    {

        return view('pages.addFlights');
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
                // return $req->rows;
                // $i=1;
                // return $req["segment-".$i."-airline"];
                // return $req->all();
                return back()->with('message', "Itinerary Updates Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
            // return  $exception->errorInfo[2];
        }
    }
}
