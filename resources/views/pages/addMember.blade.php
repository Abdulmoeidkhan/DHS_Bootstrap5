@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Member</h5>
                <div class="table-responsive">
                    <form name="memberBasicInfo" id="memberBasicInfo" method="POST" action="{{route('request.updateMemberRequest',$id)}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Members Form</legend>
                            @csrf
                            <div class="mb-3">
                                <!-- <label for="rank" class="form-label">Rank</label>
                                <input name="rank" type="text" class="form-control" id="rank" placeholder="Rank" required> -->
                                <label for="rank" class="form-label">Rank</label>
                                <select name="rank" id="rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $renderRank->ranks_uid===$member->rank ?'selected':''?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First Name" value="{{$member->first_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last Name" value="{{$member->last_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input name="designation" type="text" class="form-control" id="designation" placeholder="Designation" value="{{$member->designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="organistaion" class="form-label">Organisation</label>
                                <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organisation" value="{{$member->organisation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input name="picture" type="file" class="form-control" id="picture" accept="image/png, image/jpeg">
                            </div>
                            <div class="mb-3">
                                <label for="pdf" class="form-label">Document</label>
                                <input name="pdf" type="file" class="form-control" id="pdf" accept="application/pdf">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="update Member" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Flight Information</h5>
                <div class="table-responsive">
                    <form name="flightBasicInfo" id="flightBasicInfo" method="POST" action="{{route('request.addDelegationFlight',$id)}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add FlightInfo Form</legend>
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="arrival_date" class="form-label">Arrival Date</label>
                                            <input name="arrival_date" type="date" class="form-control" id="arrival_date" value="" placeholder="Arrival Date" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="arrival_time" class="form-label">Arrival Time</label>
                                            <input name="arrival_time" type="time" class="form-control" id="arrival_time" value="" placeholder="Arrival Time" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_date" class="form-label">Departure Date</label>
                                            <input name="departure_date" type="date" class="form-control" id="departure_date" value="" placeholder="Departure Date" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_time" class="form-label">Departure Time</label>
                                            <input name="departure_time" type="time" class="form-control" id="departure_time" value="" placeholder="Departure Time" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col align-self-center">
                                        <div class="mb-3">
                                            <label for="passport" class="form-label">Passport</label>
                                            <input name="passport" type="text" class="form-control" id="passport" placeholder="Passport" required>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <div class="mb-3">
                                            <label class="form-label">Arrived : </label>
                                            <input class="form-check-input" type="radio" name="arrived" id="arrived" value="1" <?php echo $flight?->arrived ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="arrived">
                                                Yes
                                            </label>
                                            &nbsp;
                                            <input class="form-check-input" type="radio" name="arrived" id="notArrived" value="0" <?php echo !$flight?->arrived ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="notArrived">
                                                No
                                            </label>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            <label class="form-label">Departed : </label>
                                            <input class="form-check-input" type="radio" name="departed" id="departed" value="1" <?php echo $flight?->departed ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="departed">
                                                Yes
                                            </label>
                                            &nbsp;
                                            <input class="form-check-input" type="radio" name="departed" id="notDeparted" value="0" <?php echo !$flight?->departed ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="notDeparted">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="organistaion" class="form-label">Organisation</label>
                                <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organisation" required>
                            </div> -->
                            <br />
                            <input name="delegation" type="hidden" id="delegation" value="{{$id}}" required>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update Flight" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth