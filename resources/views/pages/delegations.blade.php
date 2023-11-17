@auth
@extends('layouts.layout')
@section("content")
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addDelegationPage')}}" class="btn btn-outline-success">Add Delegations</a>
    </div>
</div>
<br />
@endif
<div class="modal fade" id="LiasonModal" tabindex="-1" aria-labelledby="LiasonModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Liason Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action='{{route("request.attachLiason")}}'>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="liasonSelect" class="col-form-label">Liason :</label>
                        <select class="form-select" aria-label="Liason To Be Associate" id="liasonSelect" name="liasonSelect">
                            <option value="" selected disabled hidden> Select Liason To Be Associate </option>
                            @foreach($liasons as $key=>$liason)
                            <option value="{{$liason->liason_uid}}"> {{$liason->liason_first_name.' '.$liason->liason_last_name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="delegationUid" value="" id="delegationUid" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Delegations</h5>
            <div class="table-responsive">
                <table id="table" data-toggle="table" data-flat="true" data-search="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.getDelegates')}}">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="country" data-sortable="true">Country</th>
                            <th data-field="delegation_response" data-sortable="true">Delegation Response</th>
                            <th data-field="address">Address</th>
                            <th data-field="exhibition" data-sortable="true">Exhibition</th>
                            <th data-field="delegationCode">Delegation Code</th>
                            <th data-field="self" data-formatter="operateSelf">Self</th>
                            <th data-field="first_Name" data-sortable="true">First Name</th>
                            <th data-field="last_Name" data-sortable="true">Last Name</th>
                            <th data-field="name" data-sortable="true">Invited By</th>
                            <th data-field="member_count" data-sortable="true">Number Of Person</th>
                            <th data-field="delegates_uid" data-formatter="operateFormatter">Profile</th>
                            <th data-field="delegates" data-formatter="operateMember">Member</th>
                            <th data-field="liasons" data-formatter="operateLiason">Liason</th>
                            <th data-field="delegates" data-formatter="operatePlan">Car/Accomodation</th>
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

    function operateSelf(value, row, index) {
        return !value ? 'Rep' : 'Self';
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth