@auth
@extends('layouts.layout')
@section("content")
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
<style>
    .active {
        color: green;
        font-weight: bold;
    }

    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 0px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    .rejected {
        background-color: var(--bs-badar);
        font-weight: bold;
        color: black;
    }

    .accepted {
        background-color: var(--bs-success);
        font-weight: bold;
        color: white;
    }
</style>

<div class="row">
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_status',1)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Awaited</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_response','Awaited')->where('delegation_status',1)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Accepted</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_response','Accepted')->where('delegation_status',1)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Regretted</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_response','Regretted')->where('delegation_status',1)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Response</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_response','Accepted')->where('delegation_status',1)->count()+App\Models\Delegation::where('delegation_response','Regretted')->where('delegation_status',1)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Deactivated</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_status',0)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card overflow-hidden mb-1">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Members</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Http\Controllers\DelegationsPageController::memberCountAccepted()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DetachModal" tabindex="-1" aria-labelledby="DetachModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officerDetachModalLabel">Unassign Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.detachOfficer")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="officerSelect" class="col-form-label">Officers :</label>
                        <select class="form-select" multiple aria-label="Officer To Be Detach" id="officerSelect" name="officerSelect[]" required>
                            <option value="" selected disabled hidden> Select Officer To Be Detach </option>
                            <select class="form-select" multiple aria-label="Officer To Be Associate" id="recievingSelect" name="recievingSelect[]" required>
                                <option value="" selected disabled hidden> Select Officer To Be Associate </option>
                            </select>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_dis_officer" value="" id="delegationUid_dis_officer" />
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
                <h5 class="modal-title" id="officerModalLabel">Assign Officer</h5>
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
<div class="modal fade" id="AttachCar" tabindex="-1" aria-labelledby="AttachCar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Attach Car Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.attachCar")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="carSelect" class="col-form-label">Car A:</label>
                        <select class="form-select" aria-label="Car A To Be Associate" id="carASelect" name="carASelect">
                            <option value="" selected disabled hidden> Select Car A To Be Associate </option>
                            @foreach(\App\Models\Car::where([['car_status',1],['car_delegation',null],['car_category','61346491-983a-40ed-8477-2d9ed84e6767']])->get() as $key=>$car)
                            <option value="{{$car->car_uid}}">
                                {{$car->car_makes.' '.$car->car_model.' '}}
                                (
                                @foreach(\App\Models\CarCategory::where('car_category_uid',$car->car_category)->get('car_category') as $carkey=>$carcat)
                                {{$carcat->car_category}}
                                @endforeach
                                )
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="liasonSelect" class="col-form-label">Car B :</label>
                        <select class="form-select" aria-label="Car B To Be Associate" id="carBSelect" name="carBSelect">
                            <option value="" selected disabled hidden> Select Car B To Be Associate </option>
                            @foreach(\App\Models\Car::where([['car_status',1],['car_delegation',null],['car_category','a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->get() as $key=>$car)
                            <option value="{{$car->car_uid}}">
                                {{$car->car_makes.' '.$car->car_model.' '}}
                                (
                                @foreach(\App\Models\CarCategory::where('car_category_uid',$car->car_category)->get('car_category') as $carkey=>$carcat)
                                {{$carcat->car_category}}
                                @endforeach
                                )
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="liasonSelect" class="col-form-label">Car C :</label>
                        <select class="form-select" aria-label="Car C To Be Associate" id="carCSelect" name="carCSelect">
                            <option value="" selected disabled hidden> Select Car C To Be Associate </option>
                            @foreach(\App\Models\Car::where([['car_status',1],['car_delegation',null],['car_category','a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee']])->get() as $key=>$car)
                            <option value="{{$car->car_uid}}">
                                {{$car->car_makes.' '.$car->car_model.' '}}
                                (
                                @foreach(\App\Models\CarCategory::where('car_category_uid',$car->car_category)->get('car_category') as $carkey=>$carcat)
                                {{$carcat->car_category}}
                                @endforeach
                                )
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_car" value="" id="delegationUid_car" />
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
<div class="modal fade" id="DeattachCar" tabindex="-1" aria-labelledby="DeattachCar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">De-Attach Car Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.deattachCar")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="deattachCarSelect" class="col-form-label">Car :</label>
                        <select class="form-select" aria-label="Car To Be De-Attach" id="deattachCarSelect" name="deattachCarSelect[]">
                            <option value="" selected disabled hidden> Select Car To Be Disassociate </option>
                            @foreach(\App\Models\Car::where([['car_status',1],['car_delegation','!=',null]])->get() as $key=>$car)
                            <option value="{{$car->car_uid}}">
                                {{$car->car_makes.' '.$car->car_model.' '}}
                                (
                                @foreach(\App\Models\CarCategory::where('car_category_uid',$car->car_category)->get('car_category') as $carkey=>$carcat)
                                {{$carcat->car_category}}
                                @endforeach
                                )
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_dis_car" value="" id="delegationUid_dis_car" />
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
<div class="modal fade" id="statusChangerModal" tabindex="-1" aria-labelledby="statusChangerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Status Changer Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.deattachCar")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_dis_car" value="" id="delegationUid_dis_car" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-danger" href="statusChanger/' + row.uid + '"></a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="LiasonModal" tabindex="-1" aria-labelledby="LiasonModal" aria-hidden="true">
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
</div> -->

<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <!-- <h5 class="card-title fw-semibold mb-4"></h5>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Accepted</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Awaited</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">All</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-3" data-bs-toggle="tab" href="#simple-tabpanel-3" role="tab" aria-controls="simple-tabpanel-3" aria-selected="false">Regretted</a>
                </li>
            </ul>
            <div class="tab-content pt-5" id="tab-content">
                <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                    <div class="table-responsive">
                        <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',1)}}">
                            <thead>
                                <tr>
                                    <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                    <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true">Country</th>
                                    <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true">Rank</th>
                                    <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true">First Name</th>
                                    <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true">Last Name</th>
                                    <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                                    <th data-filter-control="input" data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                    <th data-filter-control="input" data-field="delegation_response" data-sortable="true">Response</th>
                                    <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th> 
                                    <th data-filter-control="input" data-field="member_count" data-sortable="true">Number Of Person</th>
                                    <th data-filter-control="input" data-field="carA.car_quantity" data-sortable="true">Car A</th>
                                    <th data-filter-control="input" data-field="carB.car_quantity" data-sortable="true">Car B</th>
                                    <th data-filter-control="input" data-field="hotelData.hotel_names">Hotel Name</th>
                                    <th data-filter-control="input" data-field="standard.hotel_quantity">Standard</th>
                                    <th data-filter-control="input" data-field="suite.hotel_quantity">Suite</th>
                                    <th data-filter-control="input" data-field="superior.hotel_quantity">Superior</th>
                                    <th data-filter-control="input" data-field="dOccupancy.hotel_quantity">Double Occupancy</th>
                                    <th data-filter-control="input" data-field="delegationCode">Delegation Code</th>
                                    <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                    <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                    <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                    <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                    <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                    <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                    <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                    <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                    <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                    <th data-field="uid" data-formatter="operateMember">Member</th>
                                    <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                    <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                    <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                    <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                    <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                    <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
                    <div class="table-responsive">
                        <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',0)}}">
                            <thead>
                                <tr>
                                    <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                    <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true">Country</th>
                                    <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true">Rank</th>
                                    <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true">First Name</th>
                                    <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true">Last Name</th>
                                    <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                                    <th data-filter-control="input" data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                    <th data-filter-control="input" data-field="delegation_response" data-sortable="true">Response</th>
                                    <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th> 
                                    <th data-filter-control="input" data-field="member_count" data-sortable="true">Number Of Person</th>
                                    <th data-filter-control="input" data-field="carA.car_quantity" data-sortable="true">Car A</th>
                                    <th data-filter-control="input" data-field="carB.car_quantity" data-sortable="true">Car B</th>
                                    <th data-filter-control="input" data-field="hotelData.hotel_names">Hotel Name</th>
                                    <th data-filter-control="input" data-field="standard.hotel_quantity">Standard</th>
                                    <th data-filter-control="input" data-field="suite.hotel_quantity">Suite</th>
                                    <th data-filter-control="input" data-field="superior.hotel_quantity">Superior</th>
                                    <th data-filter-control="input" data-field="dOccupancy.hotel_quantity">Double Occupancy</th>
                                    <th data-filter-control="input" data-field="delegationCode">Delegation Code</th>
                                    <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                    <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                    <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                    <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                    <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                    <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                    <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                    <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                    <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                    <th data-field="uid" data-formatter="operateMember">Member</th>
                                    <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                    <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                    <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                    <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                    <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                    <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">
                    <div class="table-responsive">
                        <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation')}}">
                            <thead>
                                <tr>
                                    <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                    <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true">Country</th>
                                    <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true">Rank</th>
                                    <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true">First Name</th>
                                    <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true">Last Name</th>
                                    <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                                    <th data-filter-control="input" data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                    <th data-filter-control="input" data-field="delegation_response" data-sortable="true">Response</th>
                                    <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th> 
                                    <th data-filter-control="input" data-field="member_count" data-sortable="true">Number Of Person</th>
                                    <th data-filter-control="input" data-field="carA.car_quantity" data-sortable="true">Car A</th>
                                    <th data-filter-control="input" data-field="carB.car_quantity" data-sortable="true">Car B</th>
                                    <th data-filter-control="input" data-field="hotelData.hotel_names">Hotel Name</th>
                                    <th data-filter-control="input" data-field="standard.hotel_quantity">Standard</th>
                                    <th data-filter-control="input" data-field="suite.hotel_quantity">Suite</th>
                                    <th data-filter-control="input" data-field="superior.hotel_quantity">Superior</th>
                                    <th data-filter-control="input" data-field="dOccupancy.hotel_quantity">Double Occupancy</th>
                                    <th data-filter-control="input" data-field="delegationCode">Delegation Code</th>
                                    <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                    <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                    <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                    <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                    <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                    <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                    <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                    <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                    <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                    <th data-field="uid" data-formatter="operateMember">Member</th>
                                    <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                    <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                    <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                    <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                    <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                    <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="simple-tabpanel-3" role="tabpanel" aria-labelledby="simple-tab-3">
                    <div class="table-responsive">
                        <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',2)}}">
                            <thead>
                                <tr>
                                    <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                    <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true">Country</th>
                                    <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true">Rank</th>
                                    <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true">First Name</th>
                                    <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true">Last Name</th>
                                    <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                                    <th data-filter-control="input" data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                    <th data-filter-control="input" data-field="delegation_response" data-sortable="true">Response</th>
                                    <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                    <th data-filter-control="input" data-field="member_count" data-sortable="true">Number Of Person</th>
                                    <th data-filter-control="input" data-field="carA.car_quantity" data-sortable="true">Car A</th>
                                    <th data-filter-control="input" data-field="carB.car_quantity" data-sortable="true">Car B</th>
                                    <th data-filter-control="input" data-field="hotelData.hotel_names">Hotel Name</th>
                                    <th data-filter-control="input" data-field="standard.hotel_quantity">Standard</th>
                                    <th data-filter-control="input" data-field="suite.hotel_quantity">Suite</th>
                                    <th data-filter-control="input" data-field="superior.hotel_quantity">Superior</th>
                                    <th data-filter-control="input" data-field="dOccupancy.hotel_quantity">Double Occupancy</th>
                                    <th data-filter-control="input" data-field="delegationCode">Delegation Code</th>
                                    <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                    <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                    <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                    <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                    <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                    <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                    <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                    <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                    <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                    <th data-field="uid" data-formatter="operateMember">Member</th>
                                    <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                    <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                    <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                    <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                    <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                    <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> -->
            <div class="tab">
                @if(session()->get('user')->roles[0]->name === "admin")
                <button class="tablinks active" onclick="openCity(event, 'All')">All</button>
                <button class="tablinks" onclick="openCity(event, 'Awaited')">Awaited</button>
                <button class="tablinks" onclick="openCity(event, 'Accepted')">Accepted</button>
                <button class="tablinks" onclick="openCity(event, 'Regretted')">Regretted</button>
                <button class="tablinks" onclick="openCity(event, 'Deactive')">Deactive</button>
                @endif
            </div>
            <div id="All" class="tabcontent" style="{{session()->get('user')->roles[0]->name != 'dho'?'display: block;':''}}" >
                @if(session()->get('user')->roles[0]->name === "admin")
                <div class="row">
                    <div class="d-flex" style="position: absolute;top: 95px;">
                        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-primary">Add Delegations</a>
                    </div>
                </div>
                <!-- <br /> -->
                <div class="table-responsive">
                    <table id="table4" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table4" data-flat="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-row-style="rowStyle" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation')}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th>
                                <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="vips.vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-width="450" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateFirstAndLastName">Dignitry Name</th>
                                <!-- <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th> -->
                                <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                                <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                <th data-filter-control="input" data-field="member_count" data-sortable="true" data-formatter="operateText">Number Of Person</th>
                                <th data-filter-control="input" data-field="email_address" data-sortable="true" data-formatter="operateText">Email</th>
                                <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                <th data-filter-control="input" data-field="golf_player" data-sortable="true" data-formatter="statusFormatter">Golf Player</th>
                                <th data-filter-control="input" data-field="car.car_category_a" data-sortable="true" data-formatter="operateText">Car A</th>
                                <th data-filter-control="input" data-field="car.car_category_b" data-sortable="true" data-formatter="operateText">Car B</th>
                                <th data-filter-control="input" data-field="car.car_category_c" data-sortable="true" data-formatter="operateText">Car C</th>
                                <th data-filter-control="input" data-field="hotelData.hotel_names" data-formatter="operateText">Hotel Name</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_standard" data-formatter="operateText">Standard</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_suite" data-formatter="operateText">Suite</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_superior" data-formatter="operateText">Superior</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_doubleOccupancy" data-formatter="operateText">Double Occupancy</th>
                                <!-- <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th> -->
                                <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                <th data-filter-control="input" data-field="interests" data-formatter="operateInterets">Interested Programs</th>
                                <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                <!-- <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th> -->
                                <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                <th data-field="uid" data-formatter="operateMember">Member</th>
                                <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                @endif
            </div>
            <div id="Accepted" class="tabcontent" style="{{session()->get('user')->roles[0]->name == 'dho'?'display: block;':''}}">
                @if(session()->get('user')->roles[0]->name === "admin")
                <div class="row">
                    <div class="d-flex" style="position: absolute;top: 95px;">
                        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-primary">Add Delegations</a>
                    </div>
                </div>
                @endif
                <!-- <br /> -->
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true"
                     data-filter-control="true" data-toggle="table" data-flat="true" data-pagination="true" data-show-toggle="true" data-show-export="true"
                      data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" 
                      data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',1)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th>
                                <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="vips.vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-width="450" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateFirstAndLastName">Dignitry Name</th>
                                <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                                <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                <th data-filter-control="input" data-field="member_count" data-sortable="true" data-formatter="operateText">Number Of Person</th>
                                <th data-filter-control="input" data-field="email_address" data-sortable="true" data-formatter="operateText">Email</th>
                                <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                <!-- <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th> -->
                                <th data-filter-control="input" data-field="golf_player" data-sortable="true" data-formatter="statusFormatter">Golf Player</th>
                                <th data-filter-control="input" data-field="car.car_category_a" data-sortable="true" data-formatter="operateText">Car A</th>
                                <th data-filter-control="input" data-field="car.car_category_b" data-sortable="true" data-formatter="operateText">Car B</th>
                                <th data-filter-control="input" data-field="car.car_category_c" data-sortable="true" data-formatter="operateText">Car C</th>
                                <th data-filter-control="input" data-field="hotelData.hotel_names" data-formatter="operateText">Hotel Name</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_standard" data-formatter="operateText">Standard</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_suite" data-formatter="operateText">Suite</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_superior" data-formatter="operateText">Superior</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_doubleOccupancy" data-formatter="operateText">Double Occupancy</th>
                                <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                <th data-filter-control="input" data-field="interests" data-formatter="operateInterets">Interested Programs</th>
                                <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                @if(session()->get('user')->roles[0]->name === "admin")
                                <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                <!-- <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th> -->
                                <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                <th data-field="uid" data-formatter="operateMember">Member</th>
                                @endif
                                <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                @if(session()->get('user')->roles[0]->name === "admin")
                                <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @if(session()->get('user')->roles[0]->name === "admin")
            <div id="Awaited" class="tabcontent">
                @if(session()->get('user')->roles[0]->name === "admin")
                <div class="row">
                    <div class="d-flex" style="position: absolute;top: 95px;">
                        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-primary">Add Delegations</a>
                    </div>
                </div>
                @endif
                <!-- <br /> -->
                <div class="table-responsive">
                    <table id="table1" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table1" data-flat="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',0)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th>
                                <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="vips.vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-width="450" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateFirstAndLastName">Dignitry Name</th>
                                <!-- <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th> -->
                                <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                                <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                <th data-filter-control="input" data-field="member_count" data-sortable="true" data-formatter="operateText">Number Of Person</th>
                                <th data-filter-control="input" data-field="email_address" data-sortable="true" data-formatter="operateText">Email</th>
                                <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                <th data-filter-control="input" data-field="golf_player" data-sortable="true" data-formatter="statusFormatter">Golf Player</th>
                                <th data-filter-control="input" data-field="car.car_category_a" data-sortable="true" data-formatter="operateText">Car A</th>
                                <th data-filter-control="input" data-field="car.car_category_b" data-sortable="true" data-formatter="operateText">Car B</th>
                                <th data-filter-control="input" data-field="car.car_category_c" data-sortable="true" data-formatter="operateText">Car C</th>
                                <th data-filter-control="input" data-field="hotelData.hotel_names" data-formatter="operateText">Hotel Name</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_standard" data-formatter="operateText">Standard</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_suite" data-formatter="operateText">Suite</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_superior" data-formatter="operateText">Superior</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_doubleOccupancy" data-formatter="operateText">Double Occupancy</th>
                                <!-- <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th> -->
                                <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                <th data-filter-control="input" data-field="interests" data-formatter="operateInterets">Interested Programs</th>
                                <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                <!-- <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th> -->
                                <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                <th data-field="uid" data-formatter="operateMember">Member</th>
                                <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="Regretted" class="tabcontent">
                @if(session()->get('user')->roles[0]->name === "admin")
                <div class="row">
                    <div class="d-flex" style="position: absolute;top: 95px;">
                        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-primary">Add Delegations</a>
                    </div>
                </div>
                @endif
                <!-- <br /> -->
                <div class="table-responsive">
                    <table id="table2" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table2" data-flat="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',2)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th>
                                <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="vips.vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-width="450" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateFirstAndLastName">Dignitry Name</th>
                                <!-- <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th> -->
                                <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                                <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                <th data-filter-control="input" data-field="member_count" data-sortable="true" data-formatter="operateText">Number Of Person</th>
                                <th data-filter-control="input" data-field="email_address" data-sortable="true" data-formatter="operateText">Email</th>
                                <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                <th data-filter-control="input" data-field="golf_player" data-sortable="true" data-formatter="statusFormatter">Golf Player</th>
                                <th data-filter-control="input" data-field="car.car_category_a" data-sortable="true" data-formatter="operateText">Car A</th>
                                <th data-filter-control="input" data-field="car.car_category_b" data-sortable="true" data-formatter="operateText">Car B</th>
                                <th data-filter-control="input" data-field="car.car_category_c" data-sortable="true" data-formatter="operateText">Car C</th>
                                <th data-filter-control="input" data-field="hotelData.hotel_names" data-formatter="operateText">Hotel Name</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_standard" data-formatter="operateText">Standard</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_suite" data-formatter="operateText">Suite</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_superior" data-formatter="operateText">Superior</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_doubleOccupancy" data-formatter="operateText">Double Occupancy</th>
                                <!-- <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th> -->
                                <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                <th data-filter-control="input" data-field="interests" data-formatter="operateInterets">Interested Programs</th>
                                <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                <!-- <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th> -->
                                <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                <th data-field="uid" data-formatter="operateMember">Member</th>
                                <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="Deactive" class="tabcontent">
                @if(session()->get('user')->roles[0]->name === "admin")
                <div class="row">
                    <div class="d-flex" style="position: absolute;top: 95px;">
                        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-primary">Add Delegations</a>
                    </div>
                </div>
                @endif
                <!-- <br /> -->
                <div class="table-responsive">
                    <table id="table3" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table3" data-flat="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation',3)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th>
                                <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="vips.vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-width="450" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateFirstAndLastName">Dignitry Name</th>
                                <!-- <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th> -->
                                <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                                <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                <th data-filter-control="input" data-field="member_count" data-sortable="true" data-formatter="operateText">Number Of Person</th>
                                <th data-filter-control="input" data-field="email_address" data-sortable="true" data-formatter="operateText">Email</th>
                                <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                                <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                                <th data-filter-control="input" data-field="golf_player" data-sortable="true" data-formatter="statusFormatter">Golf Player</th>
                                <th data-filter-control="input" data-field="car.car_category_a" data-sortable="true" data-formatter="operateText">Car A</th>
                                <th data-filter-control="input" data-field="car.car_category_b" data-sortable="true" data-formatter="operateText">Car B</th>
                                <th data-filter-control="input" data-field="car.car_category_c" data-sortable="true" data-formatter="operateText">Car C</th>
                                <th data-filter-control="input" data-field="hotelData.hotel_names" data-formatter="operateText">Hotel Name</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_standard" data-formatter="operateText">Standard</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_suite" data-formatter="operateText">Suite</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_superior" data-formatter="operateText">Superior</th>
                                <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_doubleOccupancy" data-formatter="operateText">Double Occupancy</th>
                                <!-- <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th> -->
                                <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                                <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                                <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                                <th data-filter-control="input" data-field="interests" data-formatter="operateInterets">Interested Programs</th>
                                <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                                <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                                <!-- <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th> -->
                                <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                                <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                                <th data-field="uid" data-formatter="operateMember">Member</th>
                                <th data-field="uid" data-formatter="operateCar">Add Car</th>
                                <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                                <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                                <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                                <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                                <th data-field="uid" data-formatter="statusChangerFormatter">Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


<!-- <div class="row">
    <div class="card w-100">
        <div class="card-body p-4"> -->
<!-- <h5 class="card-title fw-semibold mb-4">Delegations</h5> -->
<!-- if(session()->get('user')->roles[0]->name === "admin") -->
<!-- <div class="row">
                <div class="d-flex">
                    <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-primary">Add Delegations</a>
                </div>
            </div>
            <br /> -->
<!-- endif -->
<!-- <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true" data-height="800"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegation')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true">Country</th>
                            <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true">Rank</th>
                            <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true">First Name</th>
                            <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true">Last Name</th>
                            <th data-filter-control="input" data-field="designation" data-sortable="true">Designation</th>
                            <th data-filter-control="input" data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                            <th data-filter-control="input" data-field="delegation_response" data-sortable="true">Response</th>
                            <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                            <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                            <th data-filter-control="input" data-field="invitersDetail" data-formatter="invitersFormatter">Joint Inviters</th>
                            <th data-filter-control="input" data-field="member_count" data-sortable="true">Number Of Person</th>
                            <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                            <th data-filter-control="input" data-field="carA.car_quantity" data-sortable="true">Car A</th>
                            <th data-filter-control="input" data-field="carB.car_quantity" data-sortable="true">Car B</th>
                            <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                            <th data-filter-control="input" data-field="hotelData.hotel_names">Hotel Name</th>
                            <th data-filter-control="input" data-field="standard.hotel_quantity">Standard</th>
                            <th data-filter-control="input" data-field="suite.hotel_quantity">Suite</th>
                            <th data-filter-control="input" data-field="superior.hotel_quantity">Superior</th>
                            <th data-filter-control="input" data-field="dOccupancy.hotel_quantity">Double Occupancy</th>
                            <th data-filter-control="input" data-field="delegationCode">Delegation Code</th>
                            <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                            <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                            <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Active/Suspended</th>
                            <th data-field="delegationhead" data-formatter="operateInvitaion">Invitation</th>
                            <th data-field="uid" data-formatter="operateDelegation">Edit</th>
                            <th data-field="uid" data-formatter="operateMember">Member</th>
                            <th data-field="uid" data-formatter="operatePlan">Car/Accomodation</th>
                            <th data-field="uid" data-formatter="operateCar">Add Car</th>
                            <th data-field="uid" data-formatter="operateDetachCar">Remove Car</th>
                            <th data-field="officer_uid" data-formatter="operateOfficer">Assign Officer</th>
                            <th data-field="uid" data-formatter="detachOfficer">Unassign Officer</th>
                            <th data-field="uid" data-formatter="statusChangerFormatter">Active/Suspended</th> -->
<!-- <th data-filter-control="input" data-field="exhibition" data-sortable="true">Exhibition</th> -->
<!-- <th data-filter-control="input" data-field="delegates_uid" data-formatter="operateFormatter">Profile</th> -->
<!-- <th data-filter-control="input" data-field="liason_contact" data-sortable="true">Officer Contact</th> -->
<!-- <th data-filter-control="input" data-field="liason_uid" data-formatter="operateLiason">Liason</th>
                            <th data-filter-control="input" data-field="receiving_uid" data-formatter="operateReceiving">Receiving</th>
                            <th data-filter-control="input" data-field="interpreter_uid" data-formatter="operateInterpreter">Interpreter</th> -->
<!-- </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> -->
<script>
    function operateText(value, row, index) {
        return value ? value : "N/A"
    }

    function operateFirstAndLastName(value, row, index) {
        return `${row.first_Name} ${row.last_Name}`;
    }

    function memberFormatter(value, row, index) {
        return value ? value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val?.rank?.ranks_name + ' ' + val?.first_Name + ' ' + val?.last_Name + ' - ' + val?.delegation_type + '</div><br/>').join('') : '-';
    }

    function invitersFormatter(value, row, index) {
        return value ? value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val?.vips_designation + ' ' + val?.vips_name+ '</div><br/>').join('') : '-';
    }

    function statusChangerFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-danger" href="statusChanger/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        } else {
            return [
                '-',
            ].join('')
        }
    }

    function statusFormatter(value, row, index) {
        if (value != null) {
            return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
        }
    }

    function operateInvitaion(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-success" target="_blank" href="invitation/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
        //  else {
        //     return [
        //         '<div class="left">',
        //         '<a class="btn btn-warning" href="invitation/' + row.uid + '">',
        //         '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
        //         '</a>',
        //         '</div>',
        //     ].join('')
        // }
    }

    // function operateFormatter(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-success" href="delegateProfile/' + value + '">',
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
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<a class="btn btn-success" href="members/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('') : [
                '<div class="left">',
                '<a class="btn btn-success" href="members/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
        // else {
        //     return [
        //         '<div class="left">',
        //         '<a class="btn btn-warning" href="members/' + row.uid + '">',
        //         '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
        //         '</a>',
        //         '</div>',
        //     ].join('')
        // }
    }

    function operateInvitedBy(value, row, index) {
        return value ? value : "N/A";
    }

    function operateOfficerName(value, row, index) {
        if (value) {
            return value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val.officer_type + ' - ' + val.ranks_name + ' ' + val.officer_first_name + ' ' + val.officer_last_name + '-' + val.officer_contact + '</div><br/>').join('')
        } else {
            return [
                '-',
            ].join('')
        }
    }

    function operateCarsName(value, row, index) {
        return value ? value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + (val.car_category == '61346491-983a-40ed-8477-2d9ed84e6767' ? 'Cat A' : 'Cat B') + '  ' + val.car_makes + ' ' + val.car_model + ' ' + val.car_number + '  ' + ' - ' + val.driver.driver_name + ' - ' + val.driver.driver_contact + '</div><br/>').join('') : '<div>-</div>';
    }

    function operateOfficer(value, row, index) {
        if (row.delegation_response) {

            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#OfficerModal">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('') : [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#OfficerModal" disabled>',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('');
        }
    }

    function detachOfficer(value, row, index) {
        if (row.delegation_response) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<button type="button" class="btn btn-badar"  data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DetachModal">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('') : [
                '<div class="left">',
                '<button type="button" class="btn btn-badar"  data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DetachModal" disabled>',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                '</svg>',
                '</button>',
                '</div>'
            ].join('');
        }
    }

    // function operateLiason(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-success" href="liasonSpecificProfile/' + value + '">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
    //             '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
    //             '</svg>',
    //             '</a>',
    //             '</div>'
    //         ].join('')
    //     } else {
    //         return [
    //             '<div class="left">',
    //             '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#LiasonModal">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
    //             '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
    //             '</svg>',
    //             '</button>',
    //             '</div>'
    //         ].join('')
    //     }
    // }

    // function operateReceiving(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-success" href="specificReceivingData/' + value + '">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
    //             '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
    //             '</svg>',
    //             '</a>',
    //             '</div>'
    //         ].join('')
    //     } else {
    //         return [
    //             '<div class="left">',
    //             '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#ReceivingModal">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
    //             '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
    //             '</svg>',
    //             '</button>',
    //             '</div>'
    //         ].join('')
    //     }
    // }

    // function operateInterpreter(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-success" href="liasonSpecificProfile/' + value + '">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
    //             '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
    //             '</svg>',
    //             '</a>',
    //             '</div>'
    //         ].join('')
    //     } else {
    //         return [
    //             '<div class="left">',
    //             '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#InterpreterModal">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
    //             '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
    //             '</svg>',
    //             '</button>',
    //             '</div>'
    //         ].join('')
    //     }
    // }

    function operateCar(value, row, index) {
        if (value) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + value + '" data-bs-target="#AttachCar">',
                '<span>',
                '<i class="ti ti-car" style="font-size:24px;"></i>',
                '</span>',
                '</button>',
                '</div>'
            ].join('') : [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + value + '" data-bs-target="#AttachCar" disabled>',
                '<span>',
                '<i class="ti ti-car" style="font-size:24px;"></i>',
                '</span>',
                '</button>',
                '</div>'
            ].join('');
        }
    }

    function operateDetachCar(value, row, index) {
        if (row.delegation_response) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<button type="button" class="btn btn-badar" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DeattachCar">',
                '<span>',
                '<i class="ti ti-car" style="font-size:24px;"></i>',
                '</span>',
                '</button>',
                '</div>'
            ].join('') : [
                '<div class="left">',
                '<button type="button" class="btn btn-badar" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DeattachCar" disabled>',
                '<span>',
                '<i class="ti ti-car" style="font-size:24px;"></i>',
                '</span>',
                '</button>',
                '</div>'
            ].join('');
        }
    }

    function operatePlan(value, row, index) {
        if (value) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<a class="btn btn-success" href="addPlan/' + value + '">',
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
            ].join('') : [
                '<div class="left">',
                // '<a class="btn btn-success" href="#" disablded>',
                '<button type="button" class="btn btn-success" disabled>',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M4 16l6 -7l5 5l5 -6" />',
                '<path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '</svg>',
                // '</a>',
                '</button>',
                '</div>'
            ].join('');
        }
    }

    function operateDelegation(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-success" href="addDelegationPage/' + value + '">',
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
        if (value != null) {
            return !value ? 'Rep' : 'Self';
        }
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateInterets(value, row, index) {
        if (value) {
            return value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val?.program?.program_name + '</div><br/>').join('')
            // return value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val.program.program_name + ' - Day ' + val.program.program_day + ' ' + val.program.program_start_time + ' ' + val.program.program_end_time + '</div><br/>').join('')
        } else {
            return [
                '-',
            ].join('')
        }
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
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = officerDetachModal.querySelector('.modal-body #delegationUid_dis_officer')
        modalBodyInput.value = delegation
        $('#DetachModal').on('shown.bs.modal', function() {
            let targetElement = document.getElementById('officerSelect');
            let officerDeSelect = document.getElementById('delegationUid_dis_officer').value;
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

    })

    // const exampleModal = document.getElementById('LiasonModal')
    // exampleModal.addEventListener('show.bs.modal', event => {
    //     const button = event.relatedTarget
    //     const delegation = button.getAttribute('data-bs-delegation')
    //     const modalBodyInput = exampleModal.querySelector('.modal-body #delegationUid_liason')
    //     modalBodyInput.value = delegation
    // })

    // const receivingModal = document.getElementById('ReceivingModal')
    // receivingModal.addEventListener('show.bs.modal', event => {
    //     const button = event.relatedTarget
    //     const delegation = button.getAttribute('data-bs-delegation')
    //     const modalBodyInput = receivingModal.querySelector('.modal-body #delegationUid_receiving')
    //     modalBodyInput.value = delegation
    // })

    // const interpreterModal = document.getElementById('InterpreterModal')
    // interpreterModal.addEventListener('show.bs.modal', event => {
    //     const button = event.relatedTarget
    //     const delegation = button.getAttribute('data-bs-delegation')
    //     const modalBodyInput = receivingModal.querySelector('.modal-body #delegationUid_interpreter')
    //     modalBodyInput.value = delegation
    // })

    // const operateModal = document.getElementById('OperateModal')
    // operateModal.addEventListener('show.bs.modal', event => {
    //     const button = event.relatedTarget
    //     const delegation = button.getAttribute('data-bs-delegation')
    //     const modalBodyInput = operateModal.querySelector('.modal-body #delegationUid')
    //     modalBodyInput.value = delegation
    // })

    const carModal = document.getElementById('AttachCar')
    carModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        const modalBodyInput = carModal.querySelector('.modal-body #delegationUid_car')
        modalBodyInput.value = delegation
    })

    const carDetachModal = document.getElementById('DeattachCar')
    carDetachModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const delegation = button.getAttribute('data-bs-delegation')
        console.log(delegation)
        const modalBodyInput = carDetachModal.querySelector('.modal-body #delegationUid_dis_car')
        modalBodyInput.value = delegation
        $('#DeattachCar').on('shown.bs.modal', function() {
            let targetElement = document.getElementById('deattachCarSelect');
            let carDisassociate = document.getElementById('delegationUid_dis_car').value;
            targetElement.innerHTML = '';
            axios.get('/detachCarData/' + carDisassociate + '')
                .then(function(response) {
                    console.log(response)
                    let data = response.data;
                    let data2 = [];
                    data.map((val) => {
                        data2.push(`<option class="text-capitalize" value="${val.car_uid}">${val.car_makes} ${val.car_model} </option>`)
                    })
                    targetElement.innerHTML = data2;
                })
                .catch(function(error) {
                    console.log(error);
                })
        })
    })

    // const carDetachModal = document.getElementById('DeattachCar')
    // carDetachModal.addEventListener('show.bs.modal', event => {
    //     const button = event.relatedTarget
    //     const delegation = button.getAttribute('data-bs-delegation')
    //     const modalBodyInput = carDetachModal.querySelector('.modal-body #delegationUid_car_disassociate')
    //     modalBodyInput.value = delegation
    // })

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    function rowStyle(row) {
            if(row.delegation_response == 'Regretted'){
                return {classes: 'rejected'}
            }
            else if(row.delegation_response == 'Accepted'){
                return {classes: 'accepted'}
            }
            else{
                return {classes: '  '}
            }
        }
</script>
@include("layouts.tableFoot")
<script>
    ['#table', '#table1', '#table2', '#table3', '#table4', ].map((val => {
        var $table = $(val)
        var selectedRow = {}

        $(function() {
            $table.on('click-row.bs.table', function(e, row, $element) {
                selectedRow = row
                $('.active').removeClass('active')
                $($element).addClass('active')
            })
        })

        function rowStyle(row) {
            if (row.id === selectedRow.id) {
                return {
                    classes: 'active'
                }
            }
            return {}
        }

        $(val).bootstrapTable({
            exportOptions: {
                fileName: 'List Of All Delegation'
            }
        });
    }))
</script>
@endsection
@endauth