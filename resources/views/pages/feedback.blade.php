@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true" data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]" data-url="{{route('request.feedbackWithDelegation')}}">
                    <thead>
                        <tr>
                            <th data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                            <th data-filter-control="input" data-field="feedback" data-formatter="operateText">Feedback</th>
                            <th data-filter-control="input" data-field="last_Name" data-formatter="operateName">Name</th>
                            <th data-filter-control="input" data-field="delegationCode" data-sortable="true" data-formatter="operateText">Delegation Code</th>
                            <th data-filter-control="input" data-field="vips_designation" data-sortable="true" data-formatter="operateText">Invited By</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateText(value, row, index) {
        return value ? value : "-"
    }

    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateName(value, row, index) {
        return `${row.first_Name} ${row.last_Name}`
    }
</script>
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