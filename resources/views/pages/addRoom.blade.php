@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Room Assignment</h5>
                <div class="table-responsive">
                    <form name="roomInfo" id="roomInfo" method="POST" action="{{ !empty($selectedRoom) ? route('request.updateRoom',$selectedRoom->room_uid) : route('request.assignedRoom')}}">
                        <fieldset>
                            <legend>Add Room</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="hotel_plan_uid" class="form-label">Room Plan</label>
                                <select class="form-select" aria-label="Rooms" id="hotel_plan_uid" name="hotel_plan_uid" required>
                                    @foreach($rooms as $key=>$room)
                                    <option value="{{$room->hotel_plan_uid}}">{{$room->hotel_names}} - {{$room->room_type}} - {{$room->hotel_quantity}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_nos" class="form-label">Room No.</label>
                                <input type="text" class="form-control" id="room_nos" name="room_nos" placeholder="302" value="{{!empty($selectedRoom) && $selectedRoom->room_nos ? $selectedRoom->room_nos : ''}}" />
                            </div>
                            <!-- <div class="mb-3">
                                <label for="hotel_uid" class="form-label">Hotel Name</label>
                                <select class="form-select" aria-label="Hotel Name" id="hotel_uid" name="hotel_uid" required>
                                    <option value="" selected disabled hidden> Select Hotel</option>
                                    @foreach($hotels as $key=>$hotel)
                                    @if(!empty($hotel) && !empty($selectedRoom) && $selectedRoom->hotel_uid === $hotel->hotel_uid)
                                    <option value="{{$hotel->hotel_uid}}" selected> {{$hotel->hotel_names}}</option>
                                    @else
                                    <option value="{{$hotel->hotel_uid}}"> {{$hotel->hotel_names}}</option>
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
                                    <option value="{{$guest->delegates_uid}}" selected> {{$guest->first_Name}} {{$guest->last_Name}} ({{$guest->guestType}}) - ({{$guest->delegationCode}}) </option>
                                    @else
                                    <option value="{{$guest->delegates_uid}}"> {{$guest->first_Name}} {{$guest->last_Name}} ({{$guest->guestType}}) - ({{$guest->delegationCode}})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div> -->
                            <div class="mb-3">
                                <label for="checked_in" class="form-label">Check-In</label>
                                <input type="date" class="form-control" id="checked_in" name="checked_in" value="{{!empty($selectedRoom) &&$selectedRoom->checked_in?$selectedRoom->room_checkin:''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="checked_out" class="form-label">Check-Out</label>
                                <input type="date" class="form-control" id="checked_out" name="checked_out" value="{{!empty($selectedRoom) &&$selectedRoom->checked_out?$selectedRoom->room_checkout:''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="checked_in_time" class="form-label">Check-In Time</label>
                                <input type="time" class="form-control" id="checked_in_time" name="checked_in_time" value="{{!empty($selectedRoom) &&$selectedRoom->checked_in_time?$selectedRoom->checked_in_time:''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="checked_out_time" class="form-label">Check-Out Time</label>
                                <input type="time" class="form-control" id="checked_out_time" name="checked_out_time" value="{{!empty($selectedRoom) &&$selectedRoom->checked_out_time?$selectedRoom->checked_out_time:''}}" />
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