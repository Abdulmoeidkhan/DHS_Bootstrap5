@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.officerData',['params'=>1,'type'=>'Interpreter','force' => 'all','id'=>null])}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="officer_rank.ranks_name" data-sortable="true">Rank</th>
                            <th data-field="officer_first_name" data-sortable="true">First Name</th>
                            <th data-field="officer_last_name" data-sortable="true">Last Name</th>
                            <th data-field="officer_designation" data-sortable="true">Designation</th>
                            <th data-field="officer_contact" data-sortable="true">Contact</th>
                            <th data-field="officer_identity" data-sortable="true">Identity</th>
                            <th data-field="officer_type" data-sortable="true">Type</th>
                            <th data-field="officerCode" data-sortable="true">Code</th>
                            <th data-field="officer_address" data-sortable="true">Address</th>
                            <th data-field="officer_picture.img_blob" data-formatter="operatePicture">Picture</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateProfile(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addOfficerPage/' + value + '">',
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

    function operatePicture(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<img src="' + value + '" width="80px" height="80px"/>',
                '</div>'
            ].join('')
        }
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth