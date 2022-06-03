@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
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
        <!-- <table class="table table-condensed" id="all_request"> -->
        <table class="table table-condensed" id="view_all_request">
            <thead class="">
                <tr>
                    <th>{{trans('payout.sl_no')}}</th>

                    <th>{{trans('payout.amount')}} (MYR)</th>

                    <th>{{trans('payout.status')}}</th>

                    <th>{{trans('Payout Generate Date')}}</th>
                    <th>{{trans('payout.payout_release_date')}}</th>

                    <th>{{trans('payout.commissions')}}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $key=> $item)
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->amount}}</td>
                <td>{{ucfirst($item->status)}}</td>
                <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
                <td>
                    @if($item->status=='pending')
                    Not yet Released
                    @elseif($item->status=='rejected')
                    Rejected
                    @else
                    {{date('Y-m-d',strtotime($item->released_date))}}
                    @endif
                </td>
                <td>

                    @foreach(array_unique(explode(',',$item->commission_id)) as $array)
                    {{ucfirst(str_replace('_',' ',$array))}}<br>
                    @endforeach
                </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>        
  </div>           
@stop
@section('scripts') @parent
<!-- <script>
if ($('#all_request').length) {
        $(document).ready(function () {
            oTable = $('#all_request').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/allpayoutrequest/data",
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
                        "data": "amount"
                    },
                
                    {
                        "data": "status"
                    },
                
                    {
                        "data": "released_date"
                    },
                    {
                        "data": "commissions"
                    }
                   
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    } 
    </script> -->
 
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

  
<script>
    $(document).ready(function() {
        $('#view_all_request').DataTable( {
            dom: "<'row'<'col-sm-6'l><'col-sm-6'fr>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row'<'col-sm-2'i><'col-sm-5'<'pull-left'p>><'col-sm-5'<'pull-right'B>> >" ,
        language: {
            paginate: {
                next: '<i class="glyphicon glyphicon-chevron-right">',
                previous: '<i class="glyphicon glyphicon-chevron-left">', 
            }
        },
        buttons: [        
        { "extend": 'csv', 
           "text":'<span class="fa fa-file-excel-o"> CSV</span>',
           "className": 'btn  btn-xs  btn-primary paginate_button  '
        },
         { "extend": 'excel', 
          "text":'<span class="fa fa-file-excel-o"> EXCEL</span>',
          "className": 'btn  btn-xs  btn-primary paginate_button ' },
         
        ] 
    } );
} );




 
 </script>
 
@endsection