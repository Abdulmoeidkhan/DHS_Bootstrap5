@auth
@extends('layouts.layout')
@section("content")
<style>
    .active {
        color: green;
        font-weight: bold;
    }
</style>
<style>
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
</style>

<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table" data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegation')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                            <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">First Name</th>
                            <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th>
                            <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                            <th data-filter-control="input" data-field="vips" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                            <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                            <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                            <th data-filter-control="input" data-field="member_count" data-sortable="true" data-formatter="operateText">Number Of Person</th>
                            <th data-filter-control="input" data-field="car.car_category_a" data-sortable="true" data-formatter="operateText">Car A</th>
                            <th data-filter-control="input" data-field="car.car_category_b" data-sortable="true" data-formatter="operateText">Car B</th>
                            <th data-filter-control="input" data-field="hotelData.hotel_names" data-formatter="operateText">Hotel Name</th>
                            <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_standard" data-formatter="operateText">Standard</th>
                            <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_suite" data-formatter="operateText">Suite</th>
                            <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_superior" data-formatter="operateText">Superior</th>
                            <th data-filter-control="input" data-field="hotelPlan.hotel_roomtype_doubleOccupancy" data-formatter="operateText">Double Occupancy</th>
                            <th data-filter-control="input" data-field="delegationCode" data-formatter="operateText">Delegation Code</th>
                            <th data-filter-control="input" data-field="cars" data-formatter="operateCarsName" data-sortable="true">Cars & Details</th>
                            <th data-filter-control="input" data-field="members" data-formatter="memberFormatter">Members Rank - First/Last Name</th>
                            <th data-filter-control="input" data-field="officers" data-formatter="operateOfficerName" data-sortable="true">Officer Name & Contact Details</th>
                            <th data-filter-control="input" data-field="delegation_status" data-formatter="statusFormatter" data-sortable="true">Delegation Active</th>
                            <th data-filter-control="input" data-field="created_at" data-sortable="true">Created At</th>
                            <th data-filter-control="input" data-field="updated_at" data-sortable="true">Last Updated</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateSelf(value, row, index) {
        if (value != null) {
            return !value ? 'Rep' : 'Self';
        }
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateText(value, row, index) {
        return value ? value : "-"
    }

    function memberFormatter(value, row, index) {
        return value ? value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val?.rank?.ranks_name + ' ' + val?.first_Name + ' ' + val?.last_Name + ' - ' + val?.delegation_type + '</div><br/>').join('') : '-';
    }

    function operateInvitedBy(value, row, index) {
        if (value) {
            return [
                value.vips_designation,
            ].join('')
        } else {
            return [
                '-',
            ].join('')
        }
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

    function statusFormatter(value, row, index) {
        if (value != null) {
            return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
        }
    }
</script>
<script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
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

    $('#table').bootstrapTable({
        exportOptions: {
            fileName: 'List Of All Delegation'
        }
    });
</script>

@endsection
@endauth