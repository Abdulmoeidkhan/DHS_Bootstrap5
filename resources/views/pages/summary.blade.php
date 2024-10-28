@auth
@extends('layouts.layout')
@section("content")

<br />
<h2>Delegation</h2>
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
<br />
<h2>Liaison/Receiving Officer</h2>
<div class="row">
    @php
    $components=[
    // ['firstCol'=>2,'secondCol'=>12,'heading'=>'All Invitation','dataFunc'=>'allDelegation'],
    // ['firstCol'=>2,'secondCol'=>12,'heading'=>'Confirm Delegates','dataFunc'=>'memberCountAccepted'],
    ['firstCol'=>4,'secondCol'=>12,'heading'=>'Army','dataFunc'=>'officersArmy','childComp'=>[['heading'=>'LO'],['heading'=>'IO'],['heading'=>'RO']]],
    ['firstCol'=>4,'secondCol'=>12,'heading'=>'Navy','dataFunc'=>'officersNavy','childComp'=>[['heading'=>'LO'],['heading'=>'IO'],['heading'=>'RO']]],
    ['firstCol'=>4,'secondCol'=>12,'heading'=>'AirForce','dataFunc'=>'officersAirForce','childComp'=>[['heading'=>'LO'],['heading'=>'IO'],['heading'=>'RO']]],
    ];
    @endphp
    @foreach ($components as $key=>$comp)
    <livewire:summary-card-component :$comp :$key />
    @endforeach
</div>
<br />
<h2>Flights</h2>
<div class="row">
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Confirm Members</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Updated Flight</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\DelegateFlight::whereNotNull('arrival_date')->count()}}
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
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Balance Flight</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Http\Controllers\DelegationsPageController::memberCountAccepted() -
                                    App\Models\DelegateFlight::whereNotNull('arrival_date')->count()}}
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
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Flight Today</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\DelegateFlight::where('arrival_date',''.date('Y-m-d').'')->orwhere('departure_date',''.date('Y-m-d').'')->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center">Arrival : {{App\Models\DelegateFlight::where('arrival_date',''.date('Y-m-d').'')->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">Departure : {{App\Models\DelegateFlight::where('departure_date',''.date('Y-m-d').'')->count()}}</span>
                                </div>
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
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Flight Tomorrow</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\DelegateFlight::where('arrival_date',''.date("Y-m-d", strtotime("tomorrow")).'')->orwhere('departure_date',''.date("Y-m-d", strtotime("tomorrow")).'')->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center"> Arrival : {{App\Models\DelegateFlight::where('arrival_date',''.date("Y-m-d", strtotime("tomorrow")).'')->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center"> Departure : {{App\Models\DelegateFlight::where('departure_date',''.date("Y-m-d", strtotime("tomorrow")).'')->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<h2>Golf</h2>
<div class="row">
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Confirm Members</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Golf Players</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('golf_player',1)->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<h2>Hotels Data</h2>
<div class="row">
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Confirm Members</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-8">
        <div class="row">
            @foreach(App\Models\Hotel::all() as $key => $hotel)
            <div class="col-lg-2">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">{{$hotel->hotel_names}}</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Room::where('hotel_uid',$hotel->hotel_uid)->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center">Check-In : {{App\Models\Room::where('hotel_uid',$hotel->hotel_uid)->whereNotNull('room_checkin')->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">Check-Out : {{App\Models\Room::where('hotel_uid',$hotel->hotel_uid)->whereNotNull('room_checkout')->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<br />
<h2>Card Printing</h2>
<div class="row">
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Confirm Members</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-4">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Total Avail for Print</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegate::where([['self',1],['status',1]])->count() + App\Models\Officer::where('officer_status',1)->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center">Officers : {{App\Models\Officer::where('officer_status',1)->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">Delegates : {{App\Models\Delegate::where([['self',1],['status',1]])->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Total Printed</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegate::where([['self',1],['status',1],['isPrinted',1]])->count() + App\Models\Officer::where([['officer_status',1],['isPrinted',1]])->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center">Officers : {{App\Models\Officer::where([['officer_status',1],['isPrinted',1]])->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">Delegates : {{App\Models\Delegate::where([['self',1],['status',1],['isPrinted',1]])->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Balance to be Print</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegate::where([['self',1],['status',1],['isPrinted',0]])->count() + App\Models\Officer::where([['officer_status',1],['isPrinted',0]])->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center">Officers : {{App\Models\Officer::where([['officer_status',1],['isPrinted',0]])->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">Delegates : {{App\Models\Delegate::where([['self',1],['status',1],['isPrinted',0]])->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br />
<h2>VIP's Data</h2>
<div class="row">
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Confirm Members</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
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
    <div class="col-lg-12">
        <div class="row">
            @foreach(App\Models\Vips::all() as $key => $vip)
            <div class="col-lg-2">
                <div class="card overflow-hidden text-center">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">{{$vip->vips_designation}}</h5>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where([['invited_by',$vip->vips_uid],['delegation_status',1]])->count()}}
                                </h4>
                                <div class="me-2">
                                    <span
                                        class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">Accepted : {{App\Models\Delegation::where([['delegation_response','Accepted'],['invited_by',$vip->vips_uid],['delegation_status',1]])->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-warning rounded-3 fw-semibold text-center">Awaited : {{App\Models\Delegation::where([['delegation_response','Awaited'],['invited_by',$vip->vips_uid],['delegation_status',1]])->count()}}</span>
                                    <span
                                        class="badge mx-auto my-1 bg-badar rounded-3 fw-semibold text-center">Regretted : {{App\Models\Delegation::where([['delegation_response','Regretted'],['invited_by',$vip->vips_uid],['delegation_status',1]])->count()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
@endauth