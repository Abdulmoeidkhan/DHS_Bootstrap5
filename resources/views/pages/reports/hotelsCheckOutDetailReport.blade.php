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
                                <input class="form-control" type="number" placeholder="Room Number" name="room_no" value="" id="room_no" required />
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
                            <button type="submit" class="btn btn-primary">Add Room</button>
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
                    <form method="POST" action='{{route("request.roomUpdate")}}'>
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="room_uid" value="" id="room_uid" />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="number" placeholder="Room Number" name="room_no" value="" id="room_no_update" required />
                            </div>
                            <div class="mb-3">
                                <label for="hotel" class="form-label">Hotel</label>
                                <select class="form-select" aria-label="hotel" id="hotel_uid_update" name="hotel_uid" required>
                                    @foreach (\App\Models\Hotel::all() as $hotel)
                                    <option value="{{$hotel->hotel_uid}}"> {{$hotel->hotel_names}} {{$hotel->hotel_address}} {{$hotel->contact_person}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_type" class="form-label">Room Type</label>
                                <select class="form-select" aria-label="room_type" id="room_type_update" name="room_type" required>
                                    @foreach (\App\Models\Roomtype::all() as $key=>$roomType)
                                    <option value="{{$roomType->room_type_uid}}"> {{$roomType->room_type}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room_checkin" class="form-label">Check In</label>
                                <input name="room_checkin" type="date" class="form-control" id="room_checkin_update" placeholder="Check In" required>
                            </div>
                            <div class="mb-3">
                                <label for="room_checkout" class="form-label">Check Out</label>
                                <input name="room_checkout" type="date" class="form-control" id="room_checkout_update" placeholder="Check Out">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteRoom" tabindex="-1" aria-labelledby="deleteRoom" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoomModalLabel">Deleet Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action='{{route("request.deleteroom")}}'>
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="room_uid" value="" id="room_uid_delete" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeBtn" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-badar">Delete</button>
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
            <h5 class="card-title fw-semibold mb-4">Hotels</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100]" data-url="{{route('request.getRoomsForDelegate',session()->get('user')->roles[0]->name === 'hotels'?session()->get('user')->uid:null)}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-formatter="operateSerial">S.No</th>
                            <th data-filter-control="input" data-field="delegationCode" data-sortable="true">Delegation Code</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true">Country</th>
                            <th data-filter-control="input" data-field="ranks_name" data-sortable="true">Rank</th>
                            <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                            <th data-filter-control="input" data-field="first_Name" data-sortable="true">First Name</th>
                            <th data-filter-control="input" data-field="last_Name" data-sortable="true">Last Name</th>
                            <th data-filter-control="input" data-field="passport" data-sortable="true">Passport</th>
                            <th data-filter-control="input" data-field="delegation_type" data-sortable="true" data-formatter="operateDelegateType">Delegation Type</th>
                            <th data-filter-control="input" data-field="officers" data-formatter="operateOfficer" data-sortable="true">Officer</th>
                            <th data-filter-control="input" data-field="hotel_name" data-formatter="operateHotel" data-sortable="true">Hotel</th>
                            <th data-filter-control="input" data-field="room_type" data-formatter="true">Room Type</th>
                            <th data-filter-control="input" data-field="room_no" data-sortable="true">Room</th>
                            <th data-filter-control="input" data-field="arrival_date" data-formatter="true">Arrival Date</th>
                            <th data-filter-control="input" data-field="arrival_time" data-formatter="true">Arrival Time</th>
                            <th data-filter-control="input" data-field="arrived" data-formatter="operateFlghtStatus">Arrived</th>
                            <th data-filter-control="input" data-field="departure_date" data-formatter="true">Departure Date</th>
                            <th data-filter-control="input" data-field="departure_time" data-formatter="true">Departure Time</th>
                            <th data-filter-control="input" data-field="departed" data-formatter="operateFlghtStatus">Departed</th>
                            <!-- <th data-filter-control="input" data-formatter="operateRoomCheckInStatus">Room Check-In</th>
                            <th data-filter-control="input" data-field="room_checkin" data-formatter="true">Room Check-In Date</th>
                            <th data-filter-control="input" data-field="checked_in_time" data-formatter="true">Room Check-In Time</th> -->
                            <th data-filter-control="input" data-formatter="operateRoomCheckOutStatus">Room Check-Out</th>
                            <th data-filter-control="input" data-field="room_checkout" data-formatter="true">Room Check-Out Date</th>
                            <th data-filter-control="input" data-field="checked_out_time" data-formatter="true">Room Check-Out Time</th>
                            <!-- <th data-field="room_uid" data-formatter="deleteRoom">Delete</th> -->
                            <th data-field="delegates_uid" data-formatter="operateRoom">Add/Edit</th>
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
                '<button type="button" class="btn btn-badar" data-bs-toggle="modal" data-bs-roomToBeDelete="' + value + '" data-bs-target="#deleteRoom">',
                '<span><i class="ti ti-trash" style="font-size:22px"></i></span>',
                '</button>',
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

    function operateOfficer(value, row, index) {
        if (value) {
            return value.map((val) => `${val.officer_first_name} ${val.officer_last_name} - ${val.officer_contact}`)
        }
    }

    function operateHotel(value, row, index) {
        if (value) {
            return value.hotel_names;
        }
    }

    // function operateRoomType(value, row, index) {
    //     if (value) {
    //         return value.map((val) => `${val.room_type}`)
    //     }
    // }

    // function operateRoom(value, row, index) {
    //     if (value == null) {
    //         return [
    //             '<div class="left">',
    //             '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-delegation="' + row.delegates_uid + '" data-bs-target="#addRoom">',
    //             '<span><i class="ti ti-door" style="font-size:22px"></i></span>',
    //             '</button>',
    //             '</div>',
    //         ].join('');
    //     } else {
    //         let {
    //             room_no,
    //             hotel_uid,
    //             room_type,
    //             room_type_uid,
    //             room_uid,
    //             room_checkin,
    //             room_checkout
    //         } = row;

    //         return [
    //             '<div class="left">',
    //             '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-roomcheckout="' + room_checkout + '"  data-bs-roomcheckin="' + room_checkin + '" data-bs-roomuid="' + room_uid + '" data-bs-room="' + room_no + '" data-bs-hoteluid="' + hotel_uid + '"  data-bs-roomtypeuid="' + room_type_uid + '" data-bs-target="#updateRoom">',
    //             '<span><i class="ti ti-key" style="font-size:22px"></i></span>',
    //             '</button>',
    //             '</div>',
    //         ].join('');
    //     }
    //     // return value !== null ? "Edit " + value + "" : "Add " + row.delegates_uid + "";
    // }

    const addroomModal = document.getElementById('addRoom')
    addroomModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = addroomModal.querySelector('.modal-body #delegationUid')
        modalBodyInput.value = delegation
    })
    const deleteroomModal = document.getElementById('deleteRoom')
    deleteroomModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-roomToBeDelete')
        const modalBodyDeleteRoom = deleteroomModal.querySelector('.modal-body #room_uid_delete')
        modalBodyDeleteRoom.value = delegation
    })

    const updateRoomModal = document.getElementById('updateRoom')
    updateRoomModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const roomNo = button.getAttribute('data-bs-room')
        const modalBodyRoomNoInput = updateRoomModal.querySelector('.modal-body #room_no_update')
        modalBodyRoomNoInput.value = roomNo;

        const hotel = button.getAttribute('data-bs-hoteluid')
        const modalBodyHotelInput = updateRoomModal.querySelector('.modal-body #hotel_uid_update')
        modalBodyHotelInput.value = hotel;

        const roomType = button.getAttribute('data-bs-roomtypeuid')
        const modalBodyRoomTypeInput = updateRoomModal.querySelector('.modal-body #room_type_update')
        modalBodyRoomTypeInput.value = roomType;

        const room = button.getAttribute('data-bs-roomuid')
        const modalBodyRoomUid = updateRoomModal.querySelector('.modal-body #room_uid')
        modalBodyRoomUid.value = room;

        const roomCheckIn = button.getAttribute('data-bs-roomcheckin')
        const modalBodyroomCheckIn = updateRoomModal.querySelector('.modal-body #room_checkin_update')
        modalBodyroomCheckIn.value = roomCheckIn;

        const roomCheckOut = button.getAttribute('data-bs-roomcheckout')
        const modalBodyroomCheckOut = updateRoomModal.querySelector('.modal-body #room_checkout_update')
        modalBodyroomCheckOut.value = roomCheckOut;

    })
</script>
@include("layouts.tableFoot")
@endsection
@endauth