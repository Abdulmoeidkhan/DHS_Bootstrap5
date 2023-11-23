@auth
@extends('layouts.layout')
@section("content")
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center gap-2">
        <a type="button" href="{{route('pages.addflights')}}" class="btn btn-outline-success">Add itinerary</a>
        <a type="button" href="{{route('pages.addticketspage')}}" class="btn btn-outline-primary">Add Tickets</a>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Itineraries</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getItinerary')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="itinerary_name" data-sortable="true">Itinerary Name</th>
                            <th data-field="itinerary_remarks" data-sortable="true">Itinerary Remarks</th>
                            <th data-field="itinerary_status" data-formatter="operateStatus">Status</th>
                            <th data-field="itinerary_uid" data-formatter="operateSegments">View Itinerary</th>
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
            <h5 class="card-title fw-semibold mb-4">Tickets</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getTickets')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="ticket_remarks" data-sortable="true">Ticket Remarks</th>
                            <th data-field="ticket_number" data-sortable="true">Ticket Numer</th>
                            <th data-field="coupon_status" data-sortable="true">Coupon Status</th>
                            <th data-field="ticket_status" data-formatter="operateStatus">Ticket Status</th>
                            <th data-field="passenger_uid" data-formatter="operatePassenger">Passenger</th>
                            <th data-field="itinerary_uid" data-formatter="operateSegments">View Itinerary</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateStatus(value, row, index) {
        if (value) {
            return [
                `${value == 1?"Valid":"Cancelled"}`
            ];
        }
    }

    function operateSegments(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="viewItinerary/' + value + '">',
                '<span><i class="ti ti-plane" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }

    function operatePassenger(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="viewPassenger/' + value + '">',
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
</script>
@include("layouts.tableFoot")
@endsection
@endauth