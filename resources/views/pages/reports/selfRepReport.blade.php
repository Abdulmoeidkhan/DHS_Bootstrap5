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
                <table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-virtual-scroll="true" data-filter-control="true" data-toggle="table" data-flat="true" table id="table" data-filter-control-multiple-search="true"  data-filter-control-multiple-search-delimiter="," data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100,200]" data-url="{{route('request.selfRepData')}}">
                    <thead>
                        <tr>
                            <th data-width="50" data-filter-control="input" data-field="SNO" data-formatter="operateSerial">S.No.</th>
                            <th data-filter-control="input" data-field="name.vips_designation" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Invited By</th>
                            <th data-filter-control="input" data-field="count" data-sortable="true" data-fixed-columns="true" data-formatter="operateText">Invitation</th>
                            <th data-filter-control="input" data-field="selfSum" data-sortable="true" data-fixed-columns="true" data-formatter="operateNumber">Accepted Self</th>
                            <th data-filter-control="input" data-field="repSum" data-sortable="true" data-fixed-columns="true" data-formatter="operateNumber">Accepted Rep</th>
                            <th data-filter-control="input" data-field="regretted" data-sortable="true" data-fixed-columns="true" data-formatter="operateNumber">Regretted</th>
                            {{-- <th data-filter-control="input" data-field="awaited" data-sortable="true" data-fixed-columns="true" data-formatter="operateNumber">Awaited</th> --}}
                            <th data-filter-control="input" data-field="totalCountOfDelegatesSum" data-sortable="true" data-fixed-columns="true" data-formatter="operateNumber">Number Of Delegates</th>
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
        return value ? value : 0
    }

    function operateNumber(value, row, index) {
        return value ? value : 0
    }
</script>
@include("layouts.tableFoot")
<script>
    ['#table' ].map((val => {
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
        $(val).bootstrapTable({
      printPageBuilder: function (val) {
        return `
<html>
  <head>
  <style type="text/css" media="print">
  @page {
    size: auto;
    margin: 25px 0 25px 0;
  }
  </style>
  <style type="text/css" media="all">
  table {
    border-collapse: collapse;
    font-size: 12px;
  }
  table, th, td {
    border: 1px solid grey;
  }
  th, td {
    text-align: center;
    vertical-align: middle;
  }
  p {
    font-weight: bold;
    margin-left:20px;
  }
  table {
    width:94%;
    margin-left:3%;
    margin-right:3%;
  }
  div.bs-table-print {
    text-align:center;
  }
  </style>
  </head>
  <title>Print Table</title>
  <body>
  <div class="bs-table-print">${val}</div>
  </body>
</html>`
      }
    })
    }))
</script>

@endsection
@endauth