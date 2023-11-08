@auth
@extends('layouts.layout')
@section("content")
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center gap-2">
        <a type="button" href="{{route('pages.addHotel')}}" class="btn btn-outline-success">Add Hotel</a>
        <a type="button" href="{{route('pages.addRoomType')}}" class="btn btn-outline-warning">Add Room Type</a>
        <a type="button" href="{{route('pages.addRoom')}}" class="btn btn-outline-primary">Add Room</a>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Hotels</h5>
            <div class="table-responsive">
                <table id="table" data-flat="true" data-search="true" data-show-refresh="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getHotels')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="hotel_names">Hotel Name</th>
                            <th data-field="hotel_address">Hotel Address</th>
                            <th data-field="contact_person">Contact Person</th>
                            <th data-field="contact_number">Contact Number</th>
                            <th data-field="hotel_remarks">Remarks</th>
                            <th data-field="hotel_uid" data-formatter="hotelOperator">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Room Types</h5>
            <div class="table-responsive">
                <table id="table" data-flat="true" data-search="true" data-show-refresh="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getRoomTypes')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="room_type">Room Type</th>
                            <th data-field="rooms_quantity">Number of Rooms</th>
                            <th data-field="hotel_name.hotel_names">Hotel Name</th>
                            <th data-field="room_type_status">Status</th>
                            <th data-field="room_type_uid" data-formatter="operateRoomType">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Rooms</h5>
            <div class="table-responsive">
                <table id="table" data-flat="true" data-search="true" data-show-refresh="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getRooms')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="room_type">Room Type</th>
                            <th data-field="room_no">Room Number</th>
                            <th data-field="room_checkin">Check-In</th>
                            <th data-field="room_checkout">Check-Out</th>
                            <th data-field="assign_to" data-formatter="operateAssignedTo">Assigned To</th>
                            <th data-field="room_logged_by" data-formatter="operateAssignedBy">Assigned By</th>
                            <th data-field="room_uid" data-formatter="operateRoom">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function hotelOperator(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addHotelPage/' + value + '">',
                '<span><i class="ti ti-edit" style="font-size:22px"></i></span>',
                '</a>',
                '</div>'
            ].join('');
        }
    }
    function operateRoomType(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addRoomTypePage/' + value + '">',
                '<span><i class="ti ti-edit" style="font-size:22px"></i></span>',
                '</a>',
                '</div>'
            ].join('');
        }
    }

    function operateAssignedTo(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="viewItinerary/' + value + '">',
                '<span><i class="ti ti-paperclip" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ];
        }
    }

    function operateAssignedBy(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-accessible" href="viewItinerary/' + value + '">',
                '<span><i class="ti ti-edit" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ];
        }
    }

    function operateRoom(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="viewItinerary/' + value + '">',
                '<span><i class="ti ti-edit" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ];
        }
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth