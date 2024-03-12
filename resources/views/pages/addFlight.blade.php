@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Flight Information</h5>
                <div class="table-responsive">
                    <form name="flightBasicInfo" id="flightBasicInfo" method="POST" action="{{route('request.addDelegationFlight',$id)}}">
                        <fieldset>
                            <legend>Add FlightInfo Form</legend>
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="arrival_flight" class="form-label">Arrival Flight</label>
                                            <input name="arrival_flight" type="text" class="form-control" id="arrival_flight" value="{{$flight?->arrival_flight}}" placeholder="Arrival Flight">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="arrival_date" class="form-label">Arrival Date</label>
                                            <input name="arrival_date" type="date" class="form-control" id="arrival_date" value="{{$flight?->arrival_date}}" placeholder="Arrival Date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="arrival_time" class="form-label">Arrival Time</label>
                                            <input name="arrival_time" type="time" step="1" inputmode="numeric" class="form-control" id="arrival_time" value="{{$flight?->arrival_time}}" placeholder="Arrival Time">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_flight" class="form-label">Departure Flight</label>
                                            <input name="departure_flight" type="text" class="form-control" id="departure_flight" value="{{$flight?->departure_flight}}" placeholder="Departure Flight">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_date" class="form-label">Departure Date</label>
                                            <input name="departure_date" type="date" class="form-control" id="departure_date" value="{{$flight?->departure_date}}" placeholder="Departure Date">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_time" class="form-label">Departure Time</label>
                                            <input name="departure_time" type="time" step="1" inputmode="numeric" class="form-control" id="departure_time" value="{{$flight?->departure_time}}" placeholder="Departure Time">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col align-self-center">
                                        <div class="mb-3">
                                            <label for="passport" class="form-label">Passport</label>
                                            <input name="passport" type="text" class="form-control" value="{{$flight?->passport}}" id="passport" placeholder="Passport">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <input name="delegate_uid" type="hidden" id="delegate_uid" value="{{$id}}" required>
                            <input name="delegation_uid" type="hidden" id="delegation_uid" value="{{$member->delegation}}" required>
                            <input name="flightsegment_uid" type="hidden" id="flightsegment_uid" value="{{$flight?->flightsegment_uid}}">
                            <input type="submit" name="submit" class="btn btn-primary" value="Update Flight" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#arrival_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        flatpickr("#departure_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    });
</script>
@endsection
@endauth