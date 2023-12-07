@auth
@extends('layouts.layout')
@section("content")

@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#CarPlanModal">Add Car Plan</button>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#HotelPlanModal">Add Hotel Plan</button>
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
                <table id="table1" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getCarPlan',$id)}}">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="car_category" data-sortable="true">Category</th>
                            <th data-field="car_quantity" data-sortable="true">Quantity</th>
                            <th data-field="car_plan_uid" data-sortable="true">Actions</th>
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
                <table id="table2" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getHotelPlan',$id)}}">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="hotel_names" data-sortable="true">Hotel</th>
                            <th data-field="room_type" data-sortable="true">Room Type</th>
                            <th data-field="hotel_quantity" data-sortable="true">Quantity</th>
                            <th data-field="car_plan_uid" data-sortable="true">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="delegateProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
            ].join('')
        }
    }

    function operateMember(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="members/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
            ].join('')
        }
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
        const exampleModal = document.getElementById('LiasonModal')
        exampleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const delegation = button.getAttribute('data-bs-delegation')
            const modalBodyInput = exampleModal.querySelector('.modal-body #delegationUid')
            modalBodyInput.value = delegation
        })
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth