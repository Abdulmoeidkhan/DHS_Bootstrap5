@auth
@extends('layouts.layout')
@section("content")
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
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<div class="row">
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Activation Code</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{config('localvariables.airportCode')}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
    </div>

</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="tab">
                <button class="tablinks active" onclick="openTab(event, 'All')">All</button>
                <button class="tablinks" onclick="openTab(event, 'Unused')">Not Arrived</button>
                <button class="tablinks" onclick="openTab(event, 'PartialUsed')">Arrived</button>
                <button class="tablinks" onclick="openTab(event, 'Used')">Departed</button>
            </div>
            <div id="Unused" class="tabcontent">
                <p>
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegationFlight',0)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                                <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                                <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th>
                                <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                                <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arrival Date</th>
                                <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arrival Time</th>
                                <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arrival Flight</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateStatus">Arrival Status</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateArrivalStatusChanger">Arrival Status Changer</th>
                                <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Departure Date</th>
                                <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Departure Time</th>
                                <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Departure Flight</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateStatus">Departure Status</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateDepartureStatusChanger">Departure Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </p>
            </div>
            <div id="PartialUsed" class="tabcontent">
                <p>
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegationFlight',1)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                                <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                                <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th>
                                <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                                <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arrival Date</th>
                                <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arrival Time</th>
                                <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arrival Flight</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateStatus">Arrival Status</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateArrivalStatusChanger">Arrival Status Changer</th>
                                <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Departure Date</th>
                                <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Departure Time</th>
                                <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Departure Flight</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateStatus">Departure Status</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateDepartureStatusChanger">Departure Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </p>
            </div>
            <div id="Used" class="tabcontent">
                <p>
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegationFlight',2)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                                <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                                <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th>
                                <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                                <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arrival Date</th>
                                <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arrival Time</th>
                                <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arrival Flight</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateStatus">Arrival Status</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateArrivalStatusChanger">Arrival Status Changer</th>
                                <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Departure Date</th>
                                <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Departure Time</th>
                                <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Departure Flight</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateStatus">Departure Status</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateDepartureStatusChanger">Departure Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </p>
            </div>
            <div id="All" class="tabcontent" style="display: block;">
                <p>
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegationFlight',3)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                                <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                                <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th>
                                <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                                <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arrival Date</th>
                                <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arrival Time</th>
                                <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arrival Flight</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateStatus">Arrival Status</th>
                                <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateArrivalStatusChanger">Arrival Status Changer</th>
                                <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Departure Date</th>
                                <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Departure Time</th>
                                <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Departure Flight</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateStatus">Departure Status</th>
                                <th data-filter-control="input" data-field="departed" data-formatter="operateDepartureStatusChanger">Departure Status Changer</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </p>
            </div>
        </div>
        <!-- <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Itineraries</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegationFlight',0)}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                            <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                            <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                            <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                            <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th>
                            <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                            <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arrival Date</th>
                            <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arrival Time</th>
                            <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arrival Flight</th>
                            <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateStatus">Arrival Status</th>
                            <th data-filter-control="input" data-field="arrived" data-sortable="true" data-formatter="operateArrivalStatusChanger">Arrival Status Changer</th>
                            <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Departure Date</th>
                            <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Departure Time</th>
                            <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Departure Flight</th>
                            <th data-filter-control="input" data-field="departed" data-formatter="operateStatus">Departure Status</th>
                            <th data-filter-control="input" data-field="departed" data-formatter="operateDepartureStatusChanger">Departure Status Changer</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> -->
    </div>
</div>
<script>
    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateText(value, row, index) {
        return value ? value : "-"
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

    function operateArrivalStatusChanger(value, row, index) {
        if (value == 1) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-badar" href="arrivalStatusChanger/' + row.delegate_uid + '/0">',
                '<span><i class="ti ti-plane" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="arrivalStatusChanger/' + row.delegate_uid + '/1">',
                '<span><i class="ti ti-plane" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }


    function operateDepartureStatusChanger(value, row, index) {
        if (value == 1) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-badar" href="departureStatusChanger/' + row.delegate_uid + '/0">',
                '<span><i class="ti ti-plane" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="departureStatusChanger/' + row.delegate_uid + '/1">',
                '<span><i class="ti ti-plane" style="font-size:22px"></i></span>',
                '</a>',
                '</div>',
            ].join('');
        }
    }

    function openTab(evt, cityName) {
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
</script>
@include("layouts.tableFoot")
<script>
    var $table = $('#table')
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
</script>
@endsection
@endauth