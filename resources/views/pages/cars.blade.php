@auth
@extends('layouts.layout')
@section("content")
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center gap-2">
        <a type="button" href="{{route('pages.addCarCategories')}}" class="btn btn-outline-warning">Add Car Category</a>
        <a type="button" href="{{route('pages.addDriver')}}" class="btn btn-outline-danger">Add Driver</a>
        <a type="button" href="{{route('pages.addCar')}}" class="btn btn-outline-success">Add Car</a>
        <!-- <a type="button" href="{{route('pages.addJourney')}}" class="btn btn-outline-primary">Add Journey</a> -->
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Cars Categories</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getCarCategories')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="car_category" data-sortable="true">Car Category</th>
                            <th data-field="car_category_uid" data-formatter="operateCar">Actions</th>
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
            <h5 class="card-title fw-semibold mb-4">Cars</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getCars')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="car_number" data-sortable="true">Car Number</th>
                            <th data-field="car_makes" data-sortable="true">Car Makes</th>
                            <th data-field="car_model" data-sortable="true">Car Model</th>
                            <th data-field="car_remarks">Car Remarks</th>
                            <th data-field="car_delegation" data-formatter="operateCarRemarks">Car Status</th>
                            <th data-field="car_uid" data-formatter="operateCar">Actions</th>
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
            <h5 class="card-title fw-semibold mb-4">Driver</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getDrivers')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="driver_name" data-sortable="true">Driver Name</th>
                            <th data-field="driver_cnic">Driver CNIC</th>
                            <th data-field="driver_contact">Driver Contact</th>
                            <th data-field="driver_remarks">Driver Remarks</th>
                            <th data-field="driver_status" data-formatter="operateDriverStatus">Driver Status</th>
                            <th data-field="driver_uid" data-formatter="operateDrivers">Action</th>
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
            <h5 class="card-title fw-semibold mb-4">Journey</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getJourney')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="car_uid.car_number">Car Number</th>
                            <th data-field="driver_uid.driver_name" data-sortable="true">Driver Name</th>
                            <th data-field="journey_pickup" data-sortable="true">Car Pickup</th>
                            <th data-field="journey_dropoff" data-sortable="true">Car Dropoff</th>
                            <th data-field="journey_logged_by.name" data-sortable="true">Journey Logged By</th>
                            <th data-field="journey_assign_to" data-formatter="operateAssignedTo">Assigned To</th>
                            <th data-field="journey_uid" data-formatter="operateJourney">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> -->
<script>
    function operateDriverStatus(value, row, index) {
        if (value) {
            return [
                value != 0 ? "Avaiable" : "Booked"
            ];
        } else {
            return [
                "Booked"
            ];
        }
    }

    function operateCarRemarks(value, row, index) {
        if (value) {
            return [
                "Booked"
            ];
        } else {
            return [
                "Avaiable"
            ];
        }
    }

    function operateDrivers(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addDriverPage/' + value + '">',
                '<span><i class="ti ti-user-off" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }

    function operateCar(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addCarPage/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
            ].join('');
        }
    }

    function operateJourney(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addJourneyPage/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
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
</script>
@include("layouts.tableFoot")
@endsection
@endauth