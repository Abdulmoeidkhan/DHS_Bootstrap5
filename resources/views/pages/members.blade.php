@auth
@extends('layouts.layout')
@section("content")

@if(session()->get('user')->roles[0]->name === "delegate" )
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addMember',session()->get('user')->uid)}}" class="btn btn-outline-success">Add Members</a>
    </div>
</div>
@elseif(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addMember',$id)}}" class="btn btn-outline-success">Add Members</a>
    </div>
</div>
@endif
<br />
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Members</h5>
            <div class="table-responsive">
                <table id="table"  data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getMembers',$id)}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="member_first_Name" data-sortable="true">First Name</th>
                            <th data-field="member_last_Name" data-sortable="true">Last Name</th>
                            <th data-field="member_designation" data-sortable="true">Designation</th>
                            <th data-field="member_organistaion" data-sortable="true">Organistaion</th>
                            <th data-field="member_passport" data-sortable="true">Passport</th>
                            <th data-field="first_Name" data-sortable="true">Delegate First Name</th>
                            <th data-field="last_Name" data-sortable="true">Delegate Last Name</th>
                            <!-- <th data-field="first_Name">Delegation Code</th> -->
                            <th data-field="member_uid" data-formatter="operateProfileFormatter" data-events="operateProfile">Profile</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    window.operateProfile = {
        'click .like': function(e, value, row) {
            alert('You click like action, row: ' + JSON.stringify(row))
        },
        'click .remove': function(e, value, row) {
            alert('You click remove action, row: ' + JSON.stringify(row))
        }
    }

    function operateProfileFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                // '<a href="https://github.com/wenzhixin/' + value + '" target="_blank">' + value + '</a>',
                '<a class="btn btn-outline-success" href="memberFullProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
                '<div class="right">',
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>',
                '</div>'
            ].join('')
        }
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth