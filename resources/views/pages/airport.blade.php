@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Itineraries</h5>
            <div class="table-responsive">
                <table id="table" data-auto-refresh-interval="60" data-filter-control="true" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegationFlight',0)}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                            <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                            <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                            <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                            <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th>
                            <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                            <th data-filter-control="input" data-field="arrival_date" data-formatter="operateText">Arrival Date</th>
                            <th data-filter-control="input" data-field="arrival_time" data-formatter="operateText">Arrival Time</th>
                            <th data-filter-control="input" data-field="arrival_flight" data-formatter="operateText">Arrival Flight</th>
                            <th data-filter-control="input" data-field="arrived" data-formatter="operateStatus">Arrival Status</th>
                            <th data-filter-control="input" data-field="departure_date" data-formatter="operateText">Departure Date</th>
                            <th data-filter-control="input" data-field="departure_time" data-formatter="operateText">Departure Time</th>
                            <th data-filter-control="input" data-field="departure_flight" data-formatter="operateText">Departure Flight</th>
                            <th data-filter-control="input" data-field="departed" data-formatter="operateStatus">Departure Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateText(value, row, index) {
        return value ? value : "(blank)"
    }

    function operateStatus(value, row, index) {
        return value == 1 ? 'Yes' : 'No'
    }

    // function operateStatus(value, row, index) {
    //     if (value) {
    //         return [
    //             `${value == 1?"Valid":"Cancelled"}`
    //         ];
    //     }
    // }

    // function operateSegments(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-outline-success" href="viewItinerary/' + value + '">',
    //             '<span><i class="ti ti-plane" style="font-size:22px"></i></span>',
    //             '</a>',
    //             '</div>',
    //         ].join('');
    //     }
    // }

    // function operatePassenger(value, row, index) {
    //     if (value) {
    //         return [
    //             '<div class="left">',
    //             '<a class="btn btn-outline-success" href="viewPassenger/' + value + '">',
    //             '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
    //             '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
    //             '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
    //             '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
    //             '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
    //             '</svg>',
    //             '</a>',
    //             '</div>',
    //         ].join('');
    //     }
    // }
</script>
@include("layouts.tableFoot")
@endsection
@endauth