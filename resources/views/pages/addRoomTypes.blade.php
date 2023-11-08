@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Room Type</h5>
                <div class="table-responsive">
                    <form name="RoomTypeBasicInfo" id="RoomTypeBasicInfo" method="POST" action="{{!empty($roomType)?route('request.updateRoomType',$roomType->room_type_uid):route('request.addRoomType')}}">
                        <fieldset>
                            <legend>Add Room Type</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="room_type" class="form-label">Room Type</label>
                                <input name="room_type" type="text" class="form-control" id="room_type" value="{{!empty($roomType)?$roomType->room_type:''}}" placeholder="Room Type" required>
                            </div>
                            <div class="mb-3">
                                <label for="rooms_quantity" class="form-label">Room Type Quantity</label>
                                <input name="rooms_quantity" type="number" class="form-control" id="rooms_quantity" value="{{!empty($roomType)?$roomType->rooms_quantity:''}}" placeholder="Room Type Quantity" min="1" max="99" required>
                            </div>
                            <div class="mb-3">
                                <label for="hotel_uid" class="form-label">Hotels</label>
                                <select class="form-select" aria-label="Hotel Select" id="hotel_uid" name="hotel_uid" required>
                                    <option value="" selected disabled hidden> Select Hotel </option>
                                    @foreach($hotels as $key=>$hotel)
                                    @if(!empty($roomType) && $hotel->hotel_uid === $roomType->hotel_uid)
                                    <option value="{{$hotel->hotel_uid}}" selected>{{$hotel->hotel_names}}</option>
                                    @else
                                    <option value="{{$hotel->hotel_uid}}"> {{$hotel->hotel_names}} </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_type_status" class="form-label">Status</label>
                                <select class="form-select" aria-label="Status" id="room_type_status" name="room_type_status" required>
                                    <option value="1" <?php echo !empty($roomType) && $roomType->room_type_status === 1 ? 'selected' : '' ?>> Active </option>
                                    <option value="0" <?php echo !empty($roomType) && $roomType->room_type_status === 0 ? 'selected' : '' ?>> InActive </option>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($roomType)?'Update RoomType':'Add RoomType'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth