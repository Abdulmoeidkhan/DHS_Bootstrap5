@auth
@extends('layouts.layout')
@section("content")
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center gap-2">
        <a type="button" href="{{route('pages.addHotel')}}" class="btn btn-outline-success">Add Hotel</a>
        <a type="button" href="{{route('pages.addRoomType')}}" class="btn btn-outline-warning">Add Room Type</a>
        <!-- <a type="button" href="{{route('pages.addRoom')}}" class="btn btn-outline-primary">Add Room</a> -->
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Hotels</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getHotels')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="hotel_names" data-sortable="true">Hotel Name</th>
                            <th data-field="hotel_address">Hotel Address</th>
                            <th data-field="contact_person" data-sortable="true">Contact Person</th>
                            <th data-field="contact_number" data-sortable="true">Contact Number</th>
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
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getRoomTypes')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="room_type" data-sortable="true">Room Type</th>
                            <th data-field="room_type_status">Status</th>
                            <th data-field="room_type_uid" data-formatter="operateRoomType">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Rooms</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="route('request.getRooms')">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-formatter="operateSerial">S.No</th>
                            <th data-filter-control="input" data-field="hotel_names" data-sortable="true">Hotel Name</th>
                            <th data-filter-control="input" data-field="room_type" data-sortable="true">Room Types</th>
                            <th data-filter-control="input" data-field="room_nos" data-sortable="true">Room Number</th>
                            <th data-filter-control="input" data-field="delegationCode" data-sortable="true">Delegation Code</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true">Delegation Country</th>
                            <th data-filter-control="input" data-field="hotel_quantity" data-sortable="true">Room Quantity</th>
                            <th data-filter-control="input" data-field="checked_in" data-sortable="true">Check In</th>
                            <th data-filter-control="input" data-field="checked_in_time" data-sortable="true">Checked In Time</th>
                            <th data-filter-control="input" data-field="checked_out" data-sortable="true">Checked Out</th>
                            <th data-filter-control="input" data-field="checked_out_time" data-formatter="true">Checked Out Time</th>
                            <th data-field="room_booked_uid" data-formatter="deleteRoom">Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> -->
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
                '<a class="btn btn-outline-success" href="' + value + '">',
                '<span><i class="ti ti-paperclip" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }

    function operateRoom(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addRoomPage/' + value + '">',
                '<span><i class="ti ti-edit" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }
    function deleteRoom(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-badar" href="deleteRoom/' + value + '">',
                '<span><i class="ti ti-trash" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth