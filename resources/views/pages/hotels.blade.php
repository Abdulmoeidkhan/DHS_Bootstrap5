@auth
@extends('layouts.layout')
@section("content")
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center gap-2">
        <a type="button" href="{{route('pages.addRoom')}}" class="btn btn-outline-primary">Add Room</a>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Rooms</h5>
            <div class="table-responsive">
                <table id="table" data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-auto-refresh-interval="60" data-filter-control="true" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getRoomsForDelegate')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-formatter="operateSerial">S.No</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true">Country</th>
                            <th data-filter-control="input" data-field="ranks_name" data-sortable="true">Rank</th>
                            <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                            <th data-filter-control="input" data-field="first_Name" data-sortable="true">First Name</th>
                            <th data-filter-control="input" data-field="last_Name" data-sortable="true">Last Name</th>
                            <th data-filter-control="input" data-field="passport" data-sortable="true">Passport</th>
                            <th data-filter-control="input" data-field="delegation_type" data-sortable="true" data-formatter="operateDelegateType">Delegation Type</th>
                            <th data-filter-control="input" data-field="hotel_names" data-sortable="true">Hotel</th>
                            <th data-filter-control="input" data-field="room_no" data-sortable="true">Room</th>
                            <th data-filter-control="input" data-field="room_type" data-formatter="true">Room Type</th>
                            <th data-filter-control="input" data-field="arrival_date" data-formatter="true">Arrival Date</th>
                            <th data-filter-control="input" data-field="arrival_time" data-formatter="true">Arrival Time</th>
                            <th data-filter-control="input" data-field="arrived" data-formatter="operateFlghtStatus">Arrived</th>
                            <th data-filter-control="input" data-formatter="operateRoomCheckInStatus">Room Check-In</th>
                            <th data-filter-control="input" data-field="room_checkin" data-formatter="true">Room Check-In Date</th>
                            <th data-filter-control="input" data-formatter="operateRoomCheckOutStatus">Room Check-Out</th>
                            <th data-filter-control="input" data-field="room_checkout" data-formatter="true">Room Check-Out Date</th>
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

    function operateFlghtStatus(value, row, index) {
        return value == 1 ? "Yes" : "No";
    }

    function operateRoomCheckInStatus(value, row, index) {
        return row.room_checkin !== null ? "Yes" : "No";
    }

    function operateRoomCheckOutStatus(value, row, index) {
        return row.room_checkout !== null ? "Yes" : "No";
    }

    function operateDelegateType(value, row, index) {
        return value == "Self" ? "Head" : value;
    }

    function operateRoom(value, row, index) {
        return value !== null ? "Edit " + value + "" : "Add " + row.delegates_uid + "";
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth