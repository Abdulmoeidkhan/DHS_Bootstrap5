@auth
@extends('layouts.layout')
@section("content")

@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addProgram')}}" class="btn btn-outline-success">Add Program</a>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Add Programs</h5>
            <div class="table-responsive">
                <table id="table" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.programsData')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <!-- <th data-field="liason_rank" data-sortable="true">Rank</th> -->
                            <th data-field="program_name" data-sortable="true">Program Name</th>
                            <th data-field="program_day" data-sortable="true">Program Day</th>
                            <th data-field="program_start_time" data-sortable="true">Program Start Time</th>
                            <th data-field="program_end_time" data-sortable="true">Program End Time</th>
                            <th data-field="program_uid" data-sortable="true" data-formatter="operatePlans">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operatePlans(value, row, index) {
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