@auth
@extends('layouts.layout')
@section("content")
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-outline-success">Add Delegations</a>
    </div>
</div>
<br />
@endif
<div class="modal fade" id="DetachModal" tabindex="-1" aria-labelledby="DetachModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officerDetachModalLabel">Officer Detach Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.detachOfficer")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="officerSelect" class="col-form-label">Officers :</label>
                        <select class="form-select" multiple aria-label="Officer To Be Detach" id="officerSelect" name="officerSelect[]" required>
                            <option value="" selected disabled hidden> Select Officer To Be Detach </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_officer" value="" id="delegationUid_officer" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="OfficerModal" tabindex="-1" aria-labelledby="OfficerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officerModalLabel">Officer Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.attachOfficer")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="liasonSelect" class="col-form-label">Liason Officer :</label>
                        <select class="form-select" multiple aria-label="Officer To Be Associate" id="liasonSelect" name="liasonSelect[]" required>
                            <option value="" selected disabled hidden> Select Officer To Be Associate </option>
                            @foreach(\App\Models\Officer::where([['officer_assign',0],['officer_type','Liason']])->get() as $key=>$officer)
                            <option class="text-capitalize" value="{{$officer->officer_uid}}"> {{$officer->officer_first_name.' '.$officer->officer_last_name.' - '.$officer->officer_type}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recievingSelect" class="col-form-label">Recieving Officer :</label>
                        <select class="form-select" multiple aria-label="Officer To Be Associate" id="recievingSelect" name="recievingSelect[]" required>
                            <option value="" selected disabled hidden> Select Officer To Be Associate </option>
                            @foreach(\App\Models\Officer::where([['officer_assign',0],['officer_type','Receiving']])->get() as $key=>$officer)
                            <option class="text-capitalize" value="{{$officer->officer_uid}}"> {{$officer->officer_first_name.' '.$officer->officer_last_name.' - '.$officer->officer_type}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="interpreterSelect" class="col-form-label">Interpreter Officer :</label>
                        <select class="form-select" multiple aria-label="Officer To Be Associate" id="interpreterSelect" name="interpreterSelect[]" required>
                            <option value="" selected disabled hidden> Select Officer To Be Associate </option>
                            @foreach(\App\Models\Officer::where([['officer_assign',0],['officer_type','Interpreter']])->get() as $key=>$officer)
                            <option class="text-capitalize" value="{{$officer->officer_uid}}"> {{$officer->officer_first_name.' '.$officer->officer_last_name.' - '.$officer->officer_type}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_officer" value="" id="delegationUid_officer" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="LiasonModal" tabindex="-1" aria-labelledby="LiasonModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Liason Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.attachLiason")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="liasonSelect" class="col-form-label">Liason :</label>
                        <select class="form-select" aria-label="Liason To Be Associate" id="liasonSelect" name="liasonSelect" required>
                            <option value="" selected disabled hidden> Select Liason To Be Associate </option>
                            @foreach($liasons as $key=>$liason)
                            <option value="{{$liason->liason_uid}}"> {{$liason->liason_first_name.' '.$liason->liason_last_name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_liason" value="" id="delegationUid_liason" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ReceivingModal" tabindex="-1" aria-labelledby="ReceivingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ReceivingModalLabel">Receiving Officer Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.attachReceiving")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="receivingOfficerSelect" class="col-form-label">Receiving Officer :</label>
                        <select class="form-select" aria-label="Receiving Officer To Be Associate" id="receivingOfficerSelect" name="receivingOfficerSelect">
                            <option value="" selected disabled hidden> Select Receiving Officer To Be Associate </option>
                            @foreach($receivings as $key=>$receiving)
                            <option value="{{$receiving->receiving_uid}}"> {{$receiving->receiving_first_name.' '.$receiving->receiving_last_name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_receiving" value="" id="delegationUid_receiving" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="InterpreterModal" tabindex="-1" aria-labelledby="InterpreterModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Interpreter Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.attachInterpreter")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="interpreterSelect" class="col-form-label">Interpreter :</label>
                        <select class="form-select" aria-label="Interpreter To Be Associate" id="interpreterSelect" name="interpreterSelect">
                            <option value="" selected disabled hidden> Select Interpreter To Be Associate </option>
                            @foreach($interpreters as $key=>$interpreter)
                            <option value="{{$interpreter->interpreter_uid}}"> {{$interpreter->interpreter_first_name.' '.$interpreter->interpreter_last_name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_interpreter" value="" id="delegationUid_interpreter" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Delegations</h5>
            <div class="table-responsive">
                <table id="table" data-auto-refresh-interval="60" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegates')}}">
                    <thead>
                        <tr>
                            <th data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-field="country" data-sortable="true">Country</th>
                            <th data-field="rankName.ranks_name" data-sortable="true">Rank</th>
                            <th data-field="first_Name" data-sortable="true">First Name</th>
                            <th data-field="last_Name" data-sortable="true">Last Name</th>
                            <th data-field="designation" data-sortable="true">Designation</th>
                            <th data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                            <th data-field="delegation_response" data-sortable="true">Response</th>
                            <th data-field="self" data-formatter="operateSelf">Status</th>
                            <th data-field="member_count" data-sortable="true">Number Of Person</th>
                            <th data-field="carA.car_quantity" data-sortable="true">Car A</th>
                            <th data-field="carB.car_quantity" data-sortable="true">Car B</th>
                            <th data-field="hotelData.hotel_names">Hotel Name</th>
                            <th data-field="standard.hotel_quantity">Standard</th>
                            <th data-field="suite.hotel_quantity">Suite</th>
                            <th data-field="superior.hotel_quantity">Superior</th>
                            <th data-field="dOccupancy.hotel_quantity">Double Occupancy</th>
                            <!-- <th data-field="exhibition" data-sortable="true">Exhibition</th> -->
                            <!-- <th data-field="delegates_uid" data-formatter="operateFormatter">Profile</th> -->
                            <th data-field="delegationCode">Delegation Code</th>
                            <th data-field="liason_first_name" data-sortable="true">Officer Name</th>
                            <th data-field="liason_contact" data-sortable="true">Officer Contact</th>
                            <th data-field="created_at" data-sortable="true">Created At</th>
                            <th data-field="updated_at" data-sortable="true">Last Updated</th>
                            <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                            <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                            <th data-field="uid" data-formatter="operateMember">Member</th>
                            <th data-field="officer_uid" data-formatter="operateOfficer">Officer</th>
                            <th data-field="uid" data-formatter="detachOfficer">Detach Officer</th>
                            <!-- <th data-field="liason_uid" data-formatter="operateLiason">Liason</th>
                            <th data-field="receiving_uid" data-formatter="operateReceiving">Receiving</th>
                            <th data-field="interpreter_uid" data-formatter="operateInterpreter">Interpreter</th> -->
                            <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateInvitaion(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="invitation/' + value + '">',
                '<span>',
                '<i class="ti ti-mail" style="font-size:24px;"></i>',
                '</span>',
                '</a>',
                '</div>',
            ].join('')
        }
    }

    // function operateFormatter(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-outline-success" href="delegateProfile/' + value + '">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
    //             '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
    //             '</svg>',
    //             '</a>',
    //             '</div>',
    //         ].join('')
    //     }
    // }

    function operateMember(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="members/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-warning" href="members/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
    }

    function operateInvitedBy(value, row, index) {
        // let arrayToRank = value.rank;
        // let rank = arrayToRank.map((val) => val.ranks_name);
        console.log(value);
        if (value) {
            return [
                // value.rank[0].ranks_name + '-' + value.vips_name + '-',
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-warning" href="members/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
    }


    function operateOfficer(value, row, index) {

        return [
            '<div class="left">',
            '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#OfficerModal">',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
            '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
            '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
            '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
            '</svg>',
            '</button>',
            '</div>'
        ].join('')
    }

    function detachOfficer(value, row, index) {
        return [
            '<div class="left">',
            '<button type="button" class="btn btn-outline-warning"  data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DetachModal">',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
            '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
            '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
            '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
            '</svg>',
            '</button>',
            '</div>'
        ].join('')
    }

    function operateLiason(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="liasonSpecificProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#LiasonModal">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('')
        }
    }

    function operateReceiving(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="specificReceivingData/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#ReceivingModal">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('')
        }
    }

    function operateInterpreter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="liasonSpecificProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#InterpreterModal">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('')
        }
    }

    function operatePlan(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addPlan/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M4 16l6 -7l5 5l5 -6" />',
                '<path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateDelegation(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addDelegationPage/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateSelf(value, row, index) {
        return !value ? 'Rep' : 'Self';
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }

    const officerModal = document.getElementById('OfficerModal')
    officerModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = officerModal.querySelector('.modal-body #delegationUid_officer')
        modalBodyInput.value = delegation
    })

    const officerDetachModal = document.getElementById('DetachModal')
    officerDetachModal.addEventListener('show.bs.modal', event => {
        $('#DetachModal').on('shown.bs.modal', function() {
            let targetElement = document.getElementById('officerSelect');
            let officerDeSelect = document.getElementById('delegationUid_officer').value;
            targetElement.innerHTML = '';
            axios.get('/detachOfficerData/' + officerDeSelect + '')
                .then(function(response) {
                    let data = response.data;
                    let data2 = [];
                    data.map((val) => {
                        data2.push(`<option class="text-capitalize" value="${val.officer_uid}">${val.officer_first_name} ${val.officer_last_name} - ${val.officer_type} </option>`)
                    })
                    targetElement.innerHTML = data2;
                })
                .catch(function(error) {
                    console.log(error);
                })
        })
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = officerDetachModal.querySelector('.modal-body #delegationUid_officer')
        modalBodyInput.value = delegation
    })

    const exampleModal = document.getElementById('LiasonModal')
    exampleModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = exampleModal.querySelector('.modal-body #delegationUid_liason')
        modalBodyInput.value = delegation
    })

    const receivingModal = document.getElementById('ReceivingModal')
    receivingModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = receivingModal.querySelector('.modal-body #delegationUid_receiving')
        modalBodyInput.value = delegation
    })

    const interpreterModal = document.getElementById('InterpreterModal')
    interpreterModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = receivingModal.querySelector('.modal-body #delegationUid_interpreter')
        modalBodyInput.value = delegation
    })

    const operateModal = document.getElementById('OperateModal')
    operateModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = operateModal.querySelector('.modal-body #delegationUid')
        modalBodyInput.value = delegation
    })
</script>
<script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
@include("layouts.tableFoot")
@endsection
@endauth