@auth
@extends('layouts.layout')
@section("content")
<style>
    .active {
        color: green;
        font-weight: bold;
    }

    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 0px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>

<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="table-responsive">
            <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100]" data-url="{{route('request.delegationArrivalStatusData')}}">
                    <thead>
                        <tr>
                            <th data-width="50" data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="country" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Country</th>
                            @foreach($flights as $key=>$flight)
                            <th data-filter-control="input" data-field="arrivals.{{$key}}" data-sortable="true" data-fixed-columns="true" data-formatter="operateRank">{{$flight->arrival_date}}</th>
                            @endforeach
                            <th data-filter-control="input" data-field="totalCount" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">TotalCount</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function operateSerial(value, row, index) {
        return index + 1;
    }

    function operateText(value, row, index) {
        return value;
    }

    function operateNumber(value, row, index) {
        return value ? value : 0
    }

    function operateRank(value, row, index) {
        return value ? value : 0
        // console.log(value);
    }
</script>
@include("layouts.tableFoot")
<script>
    ['#table'].map((val => {
        var $table = $(val)
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

        $(val).bootstrapTable({
            exportOptions: {
                fileName: 'List Of All Delegation'
            }
        });
    }))
</script>

@endsection
@endauth