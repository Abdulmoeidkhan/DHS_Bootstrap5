@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <h5 class="card-title fw-semibold mb-4">Officer Info</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">S.No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Rank</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Designation</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">First Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Last Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Contact Number</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($officers as $index => $officer)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$index+1}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1 text-capitalize">
                                            @if($renderRank=\App\Models\Rank::where('ranks_uid',$officer->officer_rank)->first())
                                            {{$renderRank->ranks_name}}
                                            @endif
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$officer->officer_designation}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$officer->officer_first_name}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$officer->officer_last_name}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$officer->officer_contact}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <h5 class="card-title fw-semibold mb-4">Delegation Info</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">S.No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Delegation Code</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Country</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Delegation Response</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No. Of Delegate</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Invited By</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($delegationInfos as $index => $delegationInfo)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$index+1}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1 text-capitalize">{{$delegationInfo->delegationCode}}</h6>
                                        <span class="fw-normal"></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegationInfo->country}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegationInfo->delegation_response}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegationInfo->delegateCount}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegationInfo->vipsRank->ranks_name}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <h5 class="card-title fw-semibold mb-4">Delegate Info</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">S.No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Rank</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">First Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Last Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Designation</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($delegates as $index => $delegate)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$index+1}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1 text-capitalize">
                                            @if($renderRank=\App\Models\Rank::where('ranks_uid',$delegate->rank)->first())
                                            {{$renderRank->ranks_name}}
                                            @endif
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegate->first_Name}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegate->last_Name}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegate->designation}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$delegate->delegation_type != 'Member' ? 'Head' :'Member'}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <h5 class="card-title fw-semibold mb-4">Plan</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">S.No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Hotel Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Standard</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Suite</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Superior</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Double Occupancy</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotelPlans as $index => $hotelPlan)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$index+1}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1 text-capitalize">{{$hotelPlan->hotelName['hotel_names']}}</h6>
                                        <span class="fw-normal"></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$hotelPlan->hotel_roomtype_standard}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$hotelPlan->hotel_roomtype_suite}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$hotelPlan->hotel_roomtype_superior}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{$hotelPlan->hotel_roomtype_doubleOccupancy}}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Room Assignment</h5>
                <div class="table-responsive">
                    <form name="roomInfo" id="roomInfo" method="POST" action="{{$assignHotel?route('request.updateRoom',$assignHotel->room_uid):route('request.assignedRoom')}}">
                        <fieldset>
                            <legend>Add Room</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="room_type" class="form-label">Room Type</label>
                                <select class="form-select" aria-label="Rooms" id="room_type" name="room_type" required>
                                    @foreach($renderRank=\App\Models\Roomtype::all() as $key=>$roomtype)
                                    <option value="{{$roomtype->room_type_uid}}" {{!empty($assignHotel)&& $assignHotel->room_type == $roomtype->room_type_uid?'selected':''}}>{{$roomtype->room_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="hotel_uid" value="{{$hotelPlans[0]->hotel_uid}}" />
                            <input type="hidden" name="assign_to" value="{{$id}}" />
                            @if(!empty($assignHotel)&& $assignHotel->room_type)
                            <input type="hidden" name="room_uid" value="{{$assignHotel->room_uid}}" />
                            @endif
                            <div class="mb-3">
                                <label for="room_no" class="form-label">Room No.</label>
                                <input type="text" class="form-control" id="room_no" name="room_no" placeholder="302" value="{{!empty($assignHotel) && $assignHotel->room_no ? $assignHotel->room_no : ''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="room_checkin" class="form-label">Check-In</label>
                                <input type="date" class="form-control" id="room_checkin" name="room_checkin" value="{{!empty($assignHotel) &&$assignHotel->room_checkin?$assignHotel->room_checkin:''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="checked_in_time" class="form-label">Check-In Time</label>
                                <input type="time" class="form-control" id="checked_in_time" name="checked_in_time" value="{{!empty($assignHotel) &&$assignHotel->checked_in_time?$assignHotel->checked_in_time:''}}" step="1" inputmode="numeric" />
                            </div>
                            <div class="mb-3">
                                <label for="room_checkout" class="form-label">Check-Out</label>
                                <input type="date" class="form-control" id="room_checkout" name="room_checkout" value="{{!empty($assignHotel) &&$assignHotel->room_checkout?$assignHotel->room_checkout:''}}" />
                            </div>
                            <div class="mb-3">
                                <label for="checked_out_time" class="form-label">Check-Out Time</label>
                                <input type="time" class="form-control" id="checked_out_time" name="checked_out_time" value="{{!empty($assignHotel) &&$assignHotel->checked_out_time?$assignHotel->checked_out_time:''}}" step="1" inputmode="numeric" />
                            </div>

                            <input type="submit" name="submit" class="btn btn-{{!empty($assignHotel)?'success':'primary'}}" value="{{!empty($assignHotel)?'Update Room':'Add Room'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#checked_in_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        flatpickr("#checked_out_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    });
</script>
@endsection
@endauth