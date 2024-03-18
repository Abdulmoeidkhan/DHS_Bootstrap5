@auth
@extends('layouts.layout')
@section("content")

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">New Event</h5>
                    <div class="table-responsive">
                        <form name="eventBasicInfo" id="eventBasicInfo" method="POST" action="{{route('request.addEventRequest')}}" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Add Event Form</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="eventName" class="form-label">Event Name</label>
                                    <input name="eventName" type="text" class="form-control" id="eventName" placeholder="Event Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Event Start Date</label>
                                    <input name="startDate" type="date" class="form-control" id="startDate" placeholder="Event Start Date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">Event End Date</label>
                                    <input name="endDate" type="date" class="form-control" id="endDate" placeholder="Event End Date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="days" class="form-label">Number Of Days</label>
                                    <input name="days" type="number" class="form-control" id="days" placeholder="Event Number Of Days" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventVenue" class="form-label">Event Venue</label>
                                    <input name="eventVenue" type="text" class="form-control" id="eventVenue" placeholder="Event Venure" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventDescription" class="form-label">Event Description</label>
                                    <input name="eventDescription" type="text" class="form-control" id="eventDescription" placeholder="Event Description">
                                </div>
                                <div class="mb-3">
                                    <label for="eventBanner" class="form-label">Event Banner</label>
                                    <input type="file" class="form-control" id="eventBanner" name="eventBanner" accept="image/png, image/jpeg" required>
                                </div>
                                <input type="hidden" name="uid" value="{{session('user')->uid}}" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Event" />
                            </fieldset>
                        </form>
                    </div>
                    <br />
                    <script async src="{{asset('assets/js/formValidations.js')}}"></script>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth