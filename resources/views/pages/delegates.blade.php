@auth
@extends('layouts.layout')
@section("content")
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
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
<div class="modal fade" id="statusChangerModal" tabindex="-1" aria-labelledby="statusChangerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Status Changer Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.deattachCar")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid_dis_car" value="" id="delegationUid_dis_car" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-danger" href="statusChanger/' + row.uid + '"></a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">All Delegation</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::count()}}
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
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Awaited</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_response','Awaited')->count()}}
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
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Accepted</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegation::where('delegation_response','Accepted')->count()}}
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
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Active Delegate Count</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    {{App\Models\Delegate::where([['self',1],['status',1]])->count()}}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="tab">
                <button class="tablinks active" onclick="openTab(event, 'Active')">Active</button>
                <button class="tablinks" onclick="openTab(event, 'Inactive')">Inactive</button>
            </div>
            <div id="Active" class="tabcontent" style="display: block;">
                <p>
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegates',1)}}">
                        <thead>
                            <tr>
                                <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                                <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                                <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                                <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">First Name</th>
                                <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th>
                                <th data-filter-control="input" data-field="vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                                <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                                <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                                <th data-filter-control="input" data-field="delegation_type" data-sortable="true" data-formatter="operateText">Type</th>
                                <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                                <th data-filter-control="input" data-field="passport" data-sortable="true" data-formatter="operateText">Passport</th>
                                <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arr Date</th>
                                <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arr Time</th>
                                <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arr Flight</th>
                                <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Dep Date</th>
                                <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Dep Time</th>
                                <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Dep Flight</th>
                                <th data-filter-control="input" data-field="invitation_number" data-sortable="true" data-formatter="operateText">Invitation Number</th>
                                <th data-filter-control="input" data-field="img_blob" data-sortable="true" data-formatter="operatePictureData">Image Uploaded</th>
                                <th data-filter-control="input" data-field="img_blob" data-sortable="true" data-formatter="operatePicture">Image Upload</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </p>
            </div>
            <div id="Inactive" class="tabcontent">
                <p>
                <div class="table-responsive">
                    <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true"   data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegates',0)}}">
                        <thead>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="rankName.ranks_name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Rank</th>
                            <th data-filter-control="input" data-field="first_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">First Name</th>
                            <th data-filter-control="input" data-field="last_Name" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Last Name</th>
                            <th data-filter-control="input" data-field="vips_designation" data-sortable="true" data-formatter="operateInvitedBy">Invited By</th>
                            <th data-filter-control="input" data-field="self" data-formatter="operateSelf">Status</th>
                            <th data-filter-control="input" data-field="delegation_response" data-sortable="true" data-formatter="operateText">Response</th>
                            <th data-filter-control="input" data-field="delegation_type" data-sortable="true" data-formatter="operateText">Type</th>
                            <th data-filter-control="input" data-field="designation" data-sortable="true" data-formatter="operateText">Designation</th>
                            <th data-filter-control="input" data-field="passport" data-sortable="true" data-formatter="operateText">Passport</th>
                            <th data-filter-control="input" data-field="arrival_date" data-sortable="true" data-formatter="operateText">Arr Date</th>
                            <th data-filter-control="input" data-field="arrival_time" data-sortable="true" data-formatter="operateText">Arr Time</th>
                            <th data-filter-control="input" data-field="arrival_flight" data-sortable="true" data-formatter="operateText">Arr Flight</th>
                            <th data-filter-control="input" data-field="departure_date" data-sortable="true" data-formatter="operateText">Dep Date</th>
                            <th data-filter-control="input" data-field="departure_time" data-sortable="true" data-formatter="operateText">Dep Time</th>
                            <th data-filter-control="input" data-field="departure_flight" data-sortable="true" data-formatter="operateText">Dep Flight</th>
                            <th data-filter-control="input" data-field="invitation_number" data-sortable="true" data-formatter="operateText">Invitation Number</th>
                            <th data-filter-control="input" data-field="img_blob" data-sortable="true" data-formatter="operatePictureData">Image Uploaded</th>
                            <th data-filter-control="input" data-field="img_blob" data-sortable="true" data-formatter="operatePicture">Image Upload</th>
                        </thead>
                    </table>
                </div>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function operateText(value, row, index) {
        return value ? value : "N/A"
    }

    function memberFormatter(value, row, index) {
        return value ? value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val?.rank?.ranks_name + ' ' + val?.first_Name + ' ' + val?.last_Name + ' - ' + val?.delegation_type + '</div><br/>').join('') : 'N/A';
    }

    function statusChangerFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-danger" href="statusChanger/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        } else {
            return [
                'N/A',
            ].join('')
        }
    }

    function statusFormatter(value, row, index) {

        return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
    }

    function operateInvitaion(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-success" href="invitation/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-warning" href="invitation/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
    }

    function operateMember(value, row, index) {
        if (value) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<a class="btn btn-success" href="members/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('') : [
                '<div class="left">',
                '<ul class="list-group"><li class="list-group-item disabled" aria-disabled="true"><a class="btn btn-success" href="members/' + value + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</li></ul></div>',
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-warning" href="members/' + row.uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
    }

    function operateInvitedBy(value, row, index) {
        console.log(value)
        if (value) {
            return [
                // '<div class="left">' + value.vips_name + value.vips_designation + '</div>',
                value,
            ].join('')
        } else {
            return [
                'N/A',
            ].join('')
        }
    }

    function operateOfficerName(value, row, index) {
        if (value) {
            return value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + val.officer_type + ' - ' + val.ranks_name + ' ' + val.officer_first_name + ' ' + val.officer_last_name + '-' + val.officer_contact + '</div><br/>').join('')
        } else {
            return [
                'N/A',
            ].join('')
        }
    }

    function operateCarsName(value, row, index) {
        return value ? value.map((val, i) => '<div style="text-align:left;">' + (i + 1) + ') ' + (val.car_category == '61346491-983a-40ed-8477-2d9ed84e6767' ? 'Cat A' : 'Cat B') + '  ' + val.car_makes + ' ' + val.car_model + ' ' + val.car_number + '  ' + ' - ' + val.driver.driver_name + ' - ' + val.driver.driver_contact + '</div><br/>').join('') : '<div>N/A</div>';
    }

    function operateOfficer(value, row, index) {
        return row.delegation_response == 'Accepted' ? [
            '<div class="left">',
            '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#OfficerModal">',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
            '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
            '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
            '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
            '</svg>',
            '</button>',
            '</div>'
        ].join('') : [
            '<div class="left">',
            '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#OfficerModal" disabled>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
            '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
            '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
            '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
            '</svg>',
            '</button>',
            '</div>'
        ].join('');
    }

    function detachOfficer(value, row, index) {
        return row.delegation_response == 'Accepted' ? [
            '<div class="left">',
            '<button type="button" class="btn btn-badar"  data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DetachModal">',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
            '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
            '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
            '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
            '</svg>',
            '</button>',
            '</div>'
        ].join('') : [
            '<div class="left">',
            '<button type="button" class="btn btn-badar"  data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DetachModal" disabled>',
            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
            '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
            '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
            '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
            '</svg>',
            '</button>',
            '</div>'
        ].join('');
    }

    function operateCar(value, row, index) {
        if (value) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + value + '" data-bs-target="#AttachCar">',
                '<span>',
                '<i class="ti ti-car" style="font-size:24px;"></i>',
                '</span>',
                '</button>',
                '</div>'
            ].join('') : [
                '<div class="left">',
                '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-delegation="' + value + '" data-bs-target="#AttachCar" disabled>',
                '<span>',
                '<i class="ti ti-car" style="font-size:24px;"></i>',
                '</span>',
                '</button>',
                '</div>'
            ].join('');
        }
    }

    function operateDetachCar(value, row, index) {
        return row.delegation_response == 'Accepted' ? [
            '<div class="left">',
            '<button type="button" class="btn btn-badar" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DeattachCar">',
            '<span>',
            '<i class="ti ti-car" style="font-size:24px;"></i>',
            '</span>',
            '</button>',
            '</div>'
        ].join('') : [
            '<div class="left">',
            '<button type="button" class="btn btn-badar" data-bs-toggle="modal" data-bs-delegation="' + row.uid + '" data-bs-target="#DeattachCar" disabled>',
            '<span>',
            '<i class="ti ti-car" style="font-size:24px;"></i>',
            '</span>',
            '</button>',
            '</div>'
        ].join('');
    }

    function operatePlan(value, row, index) {
        if (value) {
            return row.delegation_response == 'Accepted' ? [
                '<div class="left">',
                '<a class="btn btn-success" href="addPlan/' + value + '">',
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
            ].join('') : [
                '<div class="left">',
                '<ul class="list-group"><li class="list-group-item disabled" aria-disabled="true"><a class="btn btn-success" href="" disablded>',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                '<path d="M4 16l6 -7l5 5l5 -6" />',
                '<path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '<path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />',
                '</svg>',
                '</a>',
                '</li></ul></div>'
            ].join('');
        }
    }

    function operateDelegation(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-success" href="addDelegationPage/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateSelf(value, row, index) {
        return !value ? 'Rep' : 'Self';
    }

    function operateSerial(value, row, index) {
        return index + 1;
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

    function operatePicture(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<img src="' + value + '" width="80px" height="80px"/>',
                '</div>'
            ].join('')
        }
    }

    function operatePictureData(value, row, index) {
        if (value) {
            return "Yes";
        } else {
            return "No";
        }
    }
</script>
@endsection
@endauth