@auth
@extends('layouts.layout')
@section("content")

<br/>
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
<br/>
<h2>Officers</h2>
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
<br/>
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
</div>



@endsection
@endauth