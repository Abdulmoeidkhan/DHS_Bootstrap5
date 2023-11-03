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
                    <table id="table" data-flat="true" data-search="true" data-show-refresh="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getDelegates')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                        <thead>
                            <tr>
                                <th data-field="id">Id</th>
                                <th data-field="country">Country</th>
                                <th data-field="delegation_response">Delegation Response</th>
                                <th data-field="address">Address</th>
                                <th data-field="exhibition">Exhibition</th>
                                <th data-field="delegationCode">Delegation Code</th>
                                <th data-field="first_Name">Delegates First Name</th>
                                <th data-field="last_Name">Delegates Last Name</th>
                                <th data-field="name">Invited By</th>
                                <th data-field="delegates" data-formatter="operateFormatter">Profile</th>
                                <th data-field="liasons" data-formatter="operateLiason">Attach Liason</th>
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

        function operateLiason(value, row, index) {
            if (value) {
                return [
                    '<div class="left">',
                    '<a class="btn btn-outline-success" href="delegateProfile/' + value + '">',
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
                    '<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#LiasonModal">',
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"/>',
                    '<path d="M6 21v-2a4 4 0 0 1 4 -4h2" />',
                    '<path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />',
                    '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />',
                    '</svg>',
                    '</button>',
                    '<div class="modal fade" id="LiasonModal" tabindex="-1" aria-labelledby="LiasonModal" aria-hidden="true">',
                    '<div class="modal-dialog">',
                    '<div class="modal-content">',
                    '<div class="modal-header">',
                    '<h5 class="modal-title" id="exampleModalLabel">Attach Liason</h5>',
                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>',
                    '</div>',
                    '</div>',
                    '</div>',
                    '</div>',
                    '</div>'
                ].join('')
            }
        }
    </script>
    @include("layouts.tableFoot")
    @endsection
    @endauth