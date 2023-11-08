@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Room</h5>
                <div class="table-responsive">
                    <form name="roomInfo" id="roomInfo" method="POST" action="{{!empty($selectedRoom)?route('request.updateRoom',$selectedRoom->room_uid):route('request.addRoom')}}">
                        <fieldset>
                            <legend>Add Room</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="room_type" class="form-label">Room Type</label>
                                <select class="form-select" aria-label="Room Type" id="room_type" name="room_type" required>
                                    <option value="" selected disabled hidden> Select Room Type</option>
                                    @foreach($roomTypes as $key=>$roomType)
                                    @if(!empty($selectedRoom) && $selectedRoom->room_type === $roomType->room_type_uid)
                                    <option value="{{$roomType->room_type_uid}}" selected> {{$roomType->room_type}}-{{$roomType->rooms_quantity}} Rooms </option>
                                    @else
                                    <option value="{{$roomType->room_type_uid}}"> {{$roomType->room_type}} - {{$roomType->rooms_quantity}} Rooms ({{$roomType->hotel_name->hotel_names}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_no" class="form-label">Room No.</label>
                                <input name="room_no" type="number" class="form-control" id="room_no" value="{{!empty($selectedRoom) && $selectedRoom->room_no?$selectedRoom->room_no:''}}" placeholder="Room Number" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="assign_to" class="form-label">Guest</label>
                                <select class="form-select" aria-label="Room Asigned To" id="assign_to" name="assign_to" required>
                                    <option value="" selected disabled hidden> Select Guest </option>
                                    @foreach($guests as $key=>$guest)
                                    @if(!empty($selectedRoom) && $selectedRoom->assign_to === $guest->uid )
                                    <option value="{{$guest->uid}}" selected> {{$guest->first_Name}} {{$guest->last_Name}} ({{$guest->guestType}}) - ({{$guest->delegationCode}}) </option>
                                    @else
                                    <option value="{{$guest->uid}}"> {{$guest->first_Name}} {{$guest->last_Name}} ({{$guest->guestType}}) - ({{$guest->delegationCode}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_checkin" class="form-label">Check-In</label>
                                <input type="date" class="form-control" id="room_checkin" name="room_checkin" value="{{!empty($selectedRoom) &&$selectedRoom->room_checkin?$selectedRoom->room_checkin:''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="room_checkout" class="form-label">Check-Out</label>
                                <input type="date" class="form-control" id="room_checkout" name="room_checkout" value="{{!empty($selectedRoom) &&$selectedRoom->room_checkout?$selectedRoom->room_checkout:''}}" />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($selectedRoom)?'Update Room':'Add Room'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth