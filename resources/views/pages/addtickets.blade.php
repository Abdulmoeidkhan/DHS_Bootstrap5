@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Add Tickets</h5>
                <div class="table-responsive">
                    <form name="addTicketInfo" id="addTicketInfo" method="POST" action="{{route('request.addTicket')}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Ticket Form</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="passenger_uid" class="form-label">Passenger</label>
                                <select id="passenger_uid" name="passenger_uid" class="form-select" required>
                                    <option value="" selected disabled hidden>Select Passenger</option>
                                    @foreach($passengers as $passenger)
                                    <option value="{{$passenger->uid?$passenger->uid:$passenger->member_uid}}">{{$passenger->first_Name?$passenger->first_Name:$passenger->member_first_Name}}&nbsp;{{$passenger->first_Name?$passenger->last_Name:$passenger->member_last_Name}}&nbsp; &#40;{{$passenger->designation?$passenger->designation:$passenger->member_designation}}&#41;</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="itinerary_uid" class="form-label">Select Itinerary</label>
                                <select id="itinerary_uid" name="itinerary_uid" class="form-select" required>
                                    <option value="" selected disabled hidden>Select Itinerary</option>
                                    @foreach($itineraries as $itinerary)
                                    <option value="{{$itinerary->itinerary_uid}}">{{$itinerary->itinerary_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ticket_number" class="form-label">Ticket No.</label>
                                <input name="ticket_number" type="text" class="form-control" id="ticket_number" placeholder="Ticket No." />
                            </div>
                            <div class="mb-3">
                                <label for="ticket_remarks" class="form-label">Ticket Remarks</label>
                                <textarea name="ticket_remarks" class="form-control" id="ticket_remarks" placeholder="Ticket Remarks"></textarea>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Attach Ticket" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{asset('assets/js/flights.js')}}"></script>
@endsection
@endauth