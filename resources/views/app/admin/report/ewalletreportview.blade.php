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

</style>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

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
    	  <table class="table table-invoice" id = "ewalletreport">
    			<thead class="headerfooter">
    				<tr>
    					<th>{{trans('report.no')}}</th>      
                        <th>{{trans('report.username')}}</th>                       
                        <th>{{trans('report.fullname')}}</th>                       
                        <th>{{trans('report.bonus_type')}}</th>                        
                        <th>{{trans('report.from_user')}}</th>                        
                        <th>{{trans('report.credit')}} (MYR)</th>
                        <!-- <th>{{trans('report.maintain_status')}}</th> -->
                        <th>{{trans('report.date')}} </th>                     
                    </tr>
                </thead>
	            <tbody>
	            	@foreach($reportdata as $key=> $report)
	            	<tr>
	            		<td>{{$key +1 }}</td>	
                        <td>{{$report->username}}</td>
                        <td>{{$report->name}} {{$report->lastname}}</td>
                        <td>@if($report->payment_type == 'released') Payout Released @else  {{  ucfirst(str_replace('_', ' ', $report->payment_type))}} @endif</td>
                        <td>{{$report->fromname}} {{$report->fromlastname}}</td>
                        <td>{{ round($report->total_amount,2) }}</td>
                        <!-- @if($report->weekly_payout == 'yes') 
                          <td>Weekly Maintain</td>
                        @elseif($report->weekly_payout == 'no') 
                          <td>Monthly Maintain </td>
                        @else
                          <td>No Maintain</td>
                        @endif -->
                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
					</tr>
	                @endforeach   
				</tbody>
         <tfoot align = "left" class="headerfooter">
          <th></th><th></th><th></th><th></th><th>{{trans('report.total')}} </th> <th>{{ currency(round($totalamount,2)) }}</th><th></th><th></th>
         </tfoot>
        	</table>
        </div>
        	<!-- <div class="invoice-price">                       
            	<div class="invoice-price-right">
                  
                	{{trans('report.total_credit')}} {{ round($totalamount,2)}} 
                </div>
            </div> -->
    </div>
   <!--  <div class="invoice-footer text-muted">
    	<p class="text-center m-b-5">
        	{{trans('report.thank_you_for_your_business')}}
        </p>
        <p class="text-center">
        	<span class="m-r-10"><i class="fa fa-globe"></i> cloudmlmsoftware.com</span>
            <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
            <span class="m-r-10"><i class="fa fa-envelope"></i> info@cloudmlmsoftware.com</span>
        </p>
    </div> -->
</div>  
</div>           
@endsection



@section('scripts') @parent
<script type="text/javascript">
function printDiv(print) {
     var printContents = document.getElementById(print).innerHTML;
     var originalContents = document.body.innerHTML;
     
     document.body.innerHTML = printContents;

     window.print();
        
     document.body.innerHTML = originalContents;
}
    
  </script>
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
        $('#ewalletreport').DataTable( {
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