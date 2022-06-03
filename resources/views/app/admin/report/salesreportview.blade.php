@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent


<style type="text/css">
.invoice>div:not(.invoice-footer) {
    margin-bottom: 43px;
}
.invoice-price .invoice-price-right {
    padding: 3px;
}
.headerfooter{
  background-color:#12c3cc!important;
}
th, td {
    white-space: nowrap;
}
table tfoot {
    display: table-row-group;
}
</style>

@endsection
{{-- Content --}}
@section('main')
<div class="card card-flat timeline-content">
        <div class="card-header bg-transparent header-elements-inline">
            <h6 class="card-title">{{$title}}</h6>
            <div class="header-elements">
             <!--  <button type="button" class="btn btn-light btn-sm" id="savepdf"><i class="icon-file-check mr-2"></i> Save</button> -->
              <div class="print" >
              <button type="button" class="btn btn-light btn-sm ml-3" onclick="printDiv('invoice-content')"><i class="icon-printer mr-2"></i>  {{trans('report.print')}}</button>
            </div>
             </div>
          </div>


    
    <div id="invoice-content">
          <div class="card-body">
        @include('app.admin.report.reportheader')
        <br>
        <div class="table-responsive">
                 <table class="table table-invoice" id = "salesreport">
                <thead class="headerfooter">
                    <tr>
                        <th>{{trans('report.no')}}</th>
                        <th>{{trans('report.seller_name')}}</th>
                        <th>{{trans('report.purchased_username')}}</th>   
                        <th>{{trans('report.email')}}</th>  
                        <th>{{trans('all.amount')}}(<i class="fa fa-btc"></i>)</th>
                        <th>{{trans('Order ID')}}</th>
                        <th> {{trans('ewallet.track_order')}}</th>
                        <th>{{trans('Purchase Date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportdata as $key=> $report) 
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{$report->sellername}}</td>
                        <td>{{$report->username}}</td>
                        <td>{{$report->email}}</td>
                        <td>{{$report->amount}}</td>
                        <td>#{{$report->invoice_id}}</td>
                        <td>
              @if($report->tracking_id == "not_found" || $report->tracking_id == NULL)
                  Progressing
              @else
                  @if($report->tracking_id == "self_pickup")
                    {{ucwords(str_replace('_',' ',($report->tracking_id)))}}
                  @else
                      <button class="btn btn-primary" onclick="linkTrack('{{$report->tracking_id}}')">TRACK</button>
                  @endif
              @endif
             </td>
                       
                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <span style="float: right;font-weight: bold;">{{trans('report.total')}} :</span>
                </div>
                <div class="col-sm-6">
                    <span style="font-weight: bold;">{{ round($total_amount,2) }}</span>
                </div>
             
                
            </div>
        </div>
    </div>
</div>   
</div>  
     

@endsection
@section('scripts') @parent

<script  src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<!-- <script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> -->
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>    
    var start_date = {!! json_encode($start_date) !!};
    var end_date = {!! json_encode($end_date) !!};
</script>
  <script>
    $(document).ready(function() {
        $('#salesreport').DataTable( {
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
         
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            //out
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                'MYR '+pageTotal+"<br>"+'MYR '+total 
            );
            $( api.column( 4 ).footer() ).html(
                "Total <br> Grand Total" 
            );
           
            
        } 
    } );
} );
 </script>
 @endsection