@auth
@extends('layouts.layout')
@section("content")

@if(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addLiason')}}" class="btn btn-outline-success">Add Liason</a>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Liason</h5>
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter=","      data-virtual-scroll="true" data-url="{{route('request.specificLiasonData',$officer?$officer->officer_delegation:'')}}"   data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]">
                    <thead>
                        <tr>
                            <th data-field="Serial Number" data-filter-control="input" data-formatter="operateSerial">S.No</th>
                            <th data-field="rank.ranks_name" data-sortable="true">Rank</th>
                            <th data-field="officer_designation" data-sortable="true">Designation</th>
                            <th data-field="officer_contact" data-sortable="true">Contact</th>
                            <th data-field="officer_identity" data-sortable="true">Identity</th>
                            <th data-field="officer_first_name" data-sortable="true">Liason First Name</th>
                            <th data-field="officer_last_name" data-sortable="true">Liason Last Name</th>
                            <th data-field="officer_type">Officer Type</th>
                            <th data-field="officer_uid" data-formatter="operateFormatter">Actions</th>
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
                '<a class="btn btn-outline-success" href="liasonSpecificProfile/' + value + '">',
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

    function operateSerial(value, row, index) {
        return index + 1;
    }

</script>
@include("layouts.tableFoot")
@endsection
@endauth