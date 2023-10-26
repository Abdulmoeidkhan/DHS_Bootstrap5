@auth
@extends('layouts.layout')
@section("content")
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
<div class="container-fluid">
    @if(session()->get('user')->roles[0]->name === "admin")
    <div class="row">
        <div class="d-flex justify-content-center">
            <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-outline-success">Add Delegations</a>
        </div>
    </div>
    <br />
    @endif
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Delegations</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">S.No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Contact Number</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Activation</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Actions</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- foreach($users as $index => $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{index+1}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 text-capitalize">{user->name}</h6>
                                    <span class="fw-normal">{user->roles[0]->display_name}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{user->email}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-normal">{user->contact_number?$user->contact_number:"Not Provided"}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        if($user->activated)
                                        <span class="badge bg-success rounded-3 fw-semibold">Activated</span>
                                        else
                                        <h6 class="fw-semibold mb-1">{user->activation_code}</h6>
                                        endif
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <user-status-component :userStatus='$user->status' :user='$user' />
                                </td>
                                <td class="border-bottom-0">
                                    <user-update-component :userStatus='$user->status' :user='$user' />
                                </td>
                            </tr>
                            endforeach -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Delegations</h5>
                <div class="table-responsive">
                    <table id="table" data-flat="true" data-search="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getDelegates')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                        <thead>
                            <tr>
                                <th data-field="id">Id</th>
                                <th data-field="country">Country</th>
                                <th data-field="delegation_response">Delegation Response</th>
                                <th data-field="address">Address</th>
                                <th data-field="exhibition">Exhibition</th>
                                <th data-field="delegationCode">Delegation Code</th>
                                <th data-field="delegates">Delegates</th>
                                <th data-field="uid" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.operateEvents = {
            'click .like': function(e, value, row) {
                alert('You click like action, row: ' + JSON.stringify(row))
            },
            'click .remove': function(e, value, row) {
                alert('You click remove action, row: ' + JSON.stringify(row))
            }
        }

        function operateFormatter(value, row, index) {
            return [
                '<div class="left">',
                // '<a href="https://github.com/wenzhixin/' + value + '" target="_blank">' + value + '</a>',
                '<a class="btn btn-outline-success" href="' + value + '">',
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
    </script>
    @include("layouts.tableFoot")
    @endsection
    @endauth