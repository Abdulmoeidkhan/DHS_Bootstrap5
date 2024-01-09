@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Badges</h5>
            <div class="table-responsive">
                <table id="table" data-auto-refresh-interval="60" data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getDelegates',1)}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-formatter="operateSerial" data-filter-control="input">S.No.</th>
                            <th data-field="country" data-filter-control="input" data-sortable="true">Country</th>
                            <th data-field="delegationCode" data-filter-control="input" data-sortable="true">Delegation Code</th>
                            <th data-field="rankName.ranks_name" data-filter-control="input" data-sortable="true">Rank</th>
                            <th data-field="first_Name" data-filter-control="input" data-sortable="true">First Name</th>
                            <th data-field="last_Name" data-filter-control="input" data-sortable="true">Last Name</th>
                            <th data-field="vips_designation" data-filter-control="input" data-sortable="true">Invited By</th>
                            <th data-field="self" data-filter-control="input" data-formatter="operateSelf" data-sortable="true">Self/Rep</th>
                            <th data-field="delegation_status" data-filter-control="input" data-sortable="true" data-formatter="statusFormatter">Delegation Active</th>
                            <th data-field="isHead" data-filter-control="input" data-sortable="true">Delegation Head</th>
                            <th data-field="delegates_uid" data-filter-control="input" data-sortable="true" data-formatter="operatePlans">Actions</th>
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
                '<a class="btn btn-outline-primary" href="liasonSpecificProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h3v4h-3z" /><path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" /><path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 16h2" /><path d="M14 12h4" /></svg>',
                '</a>',
                '&nbsp;&nbsp;&nbsp;',
                '<a class="btn btn-outline-success" href="liasonSpecificProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l9 6l9 -6l-9 -6l-9 6" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><path d="M3 19l6 -6" /><path d="M15 13l6 6" /></svg>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateSelf(value, row, index) {
        return !value ? 'Rep' : 'Self';
    }

    function statusFormatter(value, row, index) {

        return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
    }
</script>
@include("layouts.tableFoot")
@endsection
@endauth