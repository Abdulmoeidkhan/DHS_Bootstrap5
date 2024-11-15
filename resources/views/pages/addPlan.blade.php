@auth
@extends('layouts.layout')
@section("content")

@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#CarPlanModal">Add/Update Car Plan</button>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#HotelPlanModal">Add/Update Hotel Plan</button>
        <div class="modal fade" id="CarPlanModal" tabindex="-1" aria-labelledby="CarPlanModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Car Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:car-plan-component delegationUid="{{$id}}" compType='1' />
                </div>
            </div>
        </div>
        <div class="modal fade" id="HotelPlanModal" tabindex="-1" aria-labelledby="HotelPlanModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel12">Hotel Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:hotel-plan-component delegationUid="{{$id}}" compType='1' />
                </div>
            </div>
        </div>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Car Plans</h5>
            <div class="table-responsive">
                <table id="table1" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"
                    data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true"
                    data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true"
                    data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getCarPlan',$id)}}">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="car_category_a" data-sortable="true">Category A</th>
                            <th data-field="car_category_a_details" data-formatter="categoryDetailController" data-sortable="true">Category A Details</th>
                            <th data-field="car_category_a_car_details" data-formatter="categoryCarDetailController" data-sortable="true">Category A Car Details</th>
                            <th data-field="car_category_b" data-sortable="true">Category B</th>
                            <th data-field="car_category_b_details" data-formatter="categoryDetailController" data-sortable="true">Category B Details</th>
                            <th data-field="car_category_b_car_details" data-formatter="categoryCarDetailController" data-sortable="true">Category B Car Details</th>
                            <th data-field="car_category_c" data-sortable="true">Category C</th>
                            <th data-field="car_category_c_details" data-formatter="categoryDetailController" data-sortable="true">Category C Details</th>
                            <th data-field="car_category_c_car_details" data-formatter="categoryCarDetailController" data-sortable="true">Category C Car Details</th>
                            <th data-field="car_plan_uid" data-formatter="deleteCarPlan" data-sortable="true">Actions</th>
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
            <h5 class="card-title fw-semibold mb-4">Hotel Plans</h5>
            <div class="table-responsive">
                <table id="table2" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"
                    data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true"
                    data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true"
                    data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getHotelPlan',$id)}}">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="hotel_names" data-sortable="true">Hotel</th>
                            <th data-field="hotel_roomtype_suite" data-sortable="true">Suite Room</th>
                            <th data-field="hotel_roomtype_suite_details" data-formatter="categoryDetailController" data-sortable="true">Suite Room Details</th>
                            <th data-field="hotel_roomtype_delux" data-sortable="true">Delux Room</th>
                            <th data-field="hotel_roomtype_delux_details" data-formatter="categoryDetailController" data-sortable="true">Delux Room Details</th>
                            <th data-field="hotel_roomtype_exec" data-sortable="true">Executive Room</th>
                            <th data-field="hotel_roomtype_exec_details" data-formatter="categoryDetailController" data-sortable="true">Executive Room Details</th>
                            <th data-field="hotel_roomtype_standard" data-sortable="true">Standard Room</th>
                            <th data-field="hotel_roomtype_standard_details" data-formatter="categoryDetailController" data-sortable="true">Standard Room Details</th>
                            <th data-field="hotel_roomtype_doubleOccupancy" data-sortable="true">Double Occupancy Room</th>
                            <th data-field="hotel_roomtype_doubleOccupancy_details" data-formatter="categoryDetailController" data-sortable="true">Double Occupancy Room Details</th>
                            <th data-field="hotel_plan_uid" data-formatter="deleteHotelPlan" data-sortable="true">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteHotelPlan(value, row, index) {
        return [
            '<div class="left">',
            '<a class="btn btn-badar" href="deleteHotelPlan/' + value + '">',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"/><path d="M22 22l-5 -5"/><path d="M17 22l5 -5"/></svg>',
            '</a>',
            '</div>',
        ].join('')
    }

    function deleteCarPlan(value, row, index) {
        return [
            '<div class="left">',
            '<a class="btn btn-badar" href="deleteCarPlan/' + value + '">',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"/><path d="M22 22l-5 -5"/><path d="M17 22l5 -5"/></svg>',
            '</a>',
            '</div>',
        ].join('')
    }

    function categoryDetailController(value, row, index) {
        if (value) {
            return value.map(
                (val, i) =>
                '<div style="text-align:left;">' + (i + 1) + ') ' +
                (val.first_Name != null ? val.first_Name : '') +
                ' - ' + (val.last_Name != null ? val.last_Name : '') +
                ' - ' + (val.designation != null ? val.designation : '') +
                ' - ' + (val.delegation_type != null ? val.delegation_type : '') +
                ' - ' + (val.delegateCode != null ? val.delegateCode : '') +
                '</div><br/>'
            ).join('')
        } else {
            return [
                '-',
            ].join('')
        }
    }

    function categoryCarDetailController(value, row, index) {
        if (value) {
            return value.map(
                (val, i) =>
                '<div style="text-align:left;">' + 
                (val.car_make_name != null ? val.car_make_name : '') +
                '</div><br/>'
            ).join('')
        } else {
            return [
                '-',
            ].join('')
        }
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth