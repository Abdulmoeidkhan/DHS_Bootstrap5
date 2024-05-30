@auth
@extends('layouts.layout')
@section("content")

@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addProgramPages')}}" class="btn btn-outline-success">Add Program</a>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Add Programs</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.programsData')}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100]">
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
            // return [
            return `<div class="left"><form name="deleteProgram" action="{{route('request.deleteProgram')}}" method="POST"><input type="hidden" name="programId" value="${value}"/><button class="btn btn-badar" type="submit"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button></form></div>`;
            // ].join(``)
        }
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth