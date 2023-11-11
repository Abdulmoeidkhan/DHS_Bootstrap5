@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Journey</h5>
                <div class="table-responsive">
                    <form name="journeyInfo" id="journeyInfo" method="POST" action="{{!empty($selectedJourney)?route('request.updateJourney',$selectedJourney->journey_uid):route('request.addJourney')}}">
                        <fieldset>
                            <legend>Add Journey</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="car_uid" class="form-label">Car</label>
                                <select class="form-select" aria-label="Car" id="car_uid" name="car_uid" required>
                                    <option value="" selected disabled hidden>Select Car</option>
                                    @foreach($cars as $key=>$car)
                                    @if(!empty($selectedJourney) && $car->car_uid ===$selectedJourney->car_uid )
                                    <option value="{{$car->car_uid}}" selected> {{$car->car_makes}}-{{$car->car_number}} - ({{$car->car_model}})</option>
                                    @else
                                    <option value="{{$car->car_uid}}"> {{$car->car_makes}}-{{$car->car_number}} - ({{$car->car_model}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="journey_assign_to" class="form-label">Guest</label>
                                <select class="form-select" aria-label="Journey Asigned To" id="journey_assign_to" name="journey_assign_to" required>
                                    <option value="" selected disabled hidden> Select Guest </option>
                                    @foreach($guests as $key=>$guest)
                                    @if(!empty($selectedJourney) && $selectedJourney->journey_assign_to === $guest->uid )
                                    <option value="{{$guest->uid}}" selected> {{$guest->first_Name}} {{$guest->last_Name}} ({{$guest->guestType}}) - ({{$guest->delegationCode}}) </option>
                                    @else
                                    <option value="{{$guest->uid}}"> {{$guest->first_Name}} {{$guest->last_Name}} ({{$guest->guestType}}) - ({{$guest->delegationCode}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="journey_pickup" class="form-label">Pick Up</label>
                                <input name="journey_pickup" type="text" class="form-control" id="journey_pickup" value="{{!empty($selectedJourney) && $selectedJourney->journey_pickup?$selectedJourney->journey_pickup:''}}" placeholder="Journey Pickup" required>
                            </div>
                            <div class="mb-3">
                                <label for="journey_dropoff" class="form-label">Drop Off</label>
                                <input name="journey_dropoff" type="text" class="form-control" id="journey_dropoff" value="{{!empty($selectedJourney) && $selectedJourney->journey_dropoff?$selectedJourney->journey_dropoff:''}}" placeholder="Journey Drop Off" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($selectedJourney)?'Update Journey':'Add Journey'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth