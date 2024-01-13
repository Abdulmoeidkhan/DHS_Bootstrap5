@auth
@extends('layouts.layout')
@section("content")
<!-- @if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center gap-2">
        <a type="button" href="{{route('pages.addRoom')}}" class="btn btn-outline-primary">Add Room</a>
    </div>
</div>
<br />
@endif -->
<div class="row">
    <div class="d-flex justify-content-center">
        <div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="addRoom" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action='{{route("request.roomUpdate")}}'>
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="assign_to" value="" id="delegationUid" />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="number" placeholder="Room Number" name="room_no" value="" id="room_no" />
                            </div>
                            <div class="mb-3">
                                <label for="hotel" class="form-label">Hotel</label>
                                <select class="form-select" aria-label="hotel" id="hotel_uid" name="hotel_uid" required>
                                    @foreach (\App\Models\Hotel::all() as $hotel)
                                    <option value="{{$hotel->hotel_uid}}"> {{$hotel->hotel_names}} {{$hotel->hotel_address}} {{$hotel->contact_person}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_type" class="form-label">Room Type</label>
                                <select class="form-select" aria-label="room_type" id="room_type" name="room_type" required>
                                    @foreach (\App\Models\Roomtype::all() as $key=>$roomType)
                                    <option value="{{$roomType->room_type_uid}}"> {{$roomType->room_type}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_checkin" class="form-label">Check In</label>
                                <input name="room_checkin" type="date" class="form-control" id="room_checkin" placeholder="Check In" value="{{date('Y-m-d');}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="room_checkout" class="form-label">Check Out</label>
                                <input name="room_checkout" type="date" class="form-control" id="room_checkout" placeholder="Check Out">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateRoom" tabindex="-1" aria-labelledby="updateRoom" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateRoomModalLabel">Update Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action='{{route("request.invitaionNumberUpdate")}}'>
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="delegationUid" value="" id="delegationUid" />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="number" placeholder="Invitation Number" name="invitaionNumber" value="" id="invitaionNumber" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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

    // function operateRoom(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-outline-success" href="addRoomPage/' + value + '">',
    //             '<span><i class="ti ti-edit" style="font-size:22px"></i></span>',
    //             '</a>',
    //             '</div>',
    //         ].join('');
    //     }
    // }

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
        console.log(value)
        if (value != null) {
            return [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + value + '" data-bs-target="#updateRoom">',
                '<span><i class="ti ti-key" style="font-size:22px"></i></span>',
                '</button>',
                '</div>',
            ].join('');
        } else {
            return [
                '<div class="left">',
                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-delegation="' + row.delegates_uid + '" data-bs-target="#addRoom">',
                '<span><i class="ti ti-door" style="font-size:22px"></i></span>',
                '</button>',
                '</div>',
            ].join('');
        }
        // return value !== null ? "Edit " + value + "" : "Add " + row.delegates_uid + "";
    }

    const officerModal = document.getElementById('addRoom')
    officerModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = officerModal.querySelector('.modal-body #delegationUid')
        modalBodyInput.value = delegation
    })
</script>
@include("layouts.tableFoot")
@endsection
@endauth