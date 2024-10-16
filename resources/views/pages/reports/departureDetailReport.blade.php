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
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.getDelegationFlight',3)}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="Serial Number" data-formatter="operateSerial">S.No</th>
                            <th data-filter-control="input" data-field="country.country" data-sortable="true" data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="rank.ranks_name" data-sortable="true" data-formatter="operateText">Rank</th>
                            <th data-filter-control="input" data-field="delegate.designation" data-formatter="operateText">Designation</th>
                            <th data-filter-control="input" data-width="450" data-field="delegate.first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateFirstAndLastName">Delegation Name</th>
                            <!-- <th data-filter-control="input" data-field="delegate.first_Name" data-formatter="operateText">First Name</th>
                            <th data-filter-control="input" data-field="delegate.last_Name" data-formatter="operateText">Last Name</th> -->
                            <th data-filter-control="input" data-field="passport" data-formatter="operateText">Passport</th>
                            <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Departure Date</th>
                            <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Departure Time</th>
                            <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Departure Flight</th>
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

    function operateFirstAndLastName(value, row, index) {
        return `${row.delegate.first_Name} ${row.delegate.last_Name}`;
    }

    function operateText(value, row, index) {
        return value ? value : "-"
    }

    function operateStatus(value, row, index) {
        return value == 1 ? 'Yes' : 'No'
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth