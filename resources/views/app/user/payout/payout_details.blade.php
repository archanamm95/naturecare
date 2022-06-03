@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent

 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css"/>
<style type="text/css">
</style>
@endsection @section('main')
@include('app.user.layouts.payoutdetails')
<!-- Basic datatable -->
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$title}}</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-condensed" payout_id="{{$payout_id}}" id="payout_details1">
            <thead class="">
                <tr>
                    <th>{{trans('payout.sl_no')}}</th>

                    <th>{{trans('payout.from_user')}}</th>

                    <th>{{trans('payout.payment_type')}}</th>

                    <th>{{trans('payout.amount')}}</th>

                    <th>{{trans('payout.payout_request_date')}}</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>        
  </div>
  <input type="hidden" id="payout_id" value="{{$payout_id}}">           
@stop
@section('scripts') @parent
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script>
if ($('#payout_details1').length) {

    var payout_id=$('#payout_details1').attr('payout_id');

        // var payout_id=$('#payout_id').val();
        $(document).ready(function () {
            oTable = $('#payout_details1').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],   
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/payout-details/data/"+payout_id,
                "columns": [{
                "data": 'rownum',
                "searchable": false
                }],
                "columnDefs": [{
                    "targets": 4,
                    "defaultContent": "-",
                    "targets": "_all",
                    "createdCell": function (td, cellData, rowData, row, col) {
                    }
                }],
                "columns": [{
                        "data": "rownum"
                    },
                    {
                        "data": "from_user"
                    },
                    {
                        "data": "payment_type"
                    },
                    {
                        "data": "total_amount"
                    },
                     {
                        "data": "request_date"
                    },  
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    } 
    </script>
@endsection