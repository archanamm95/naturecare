@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
<style type="text/css">
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
              <button type="button" class="btn btn-light btn-sm ml-3" onclick="printDiv('invoice-content')"><i class="icon-printer mr-2"></i> {{trans('report.print')}}</button>
            </div>
             </div>
          </div>

    
    <div id="invoice-content">
          <div class="card-body">
        @include('app.admin.report.reportheader')
        <br>

    	<div class="table-responsive">
    		  <table class="table table-invoice" id = "joiningreport">
    			<thead  class="headerfooter">
    				<tr>
    					<th>{{trans('report.no')}}</th>
    					<th>{{trans('report.username')}}</th>
						<th>{{trans('report.first_name')}}</th>
                        <!-- <th>{{trans('report.last_name')}}</th> -->
                        <th>{{trans('report.email')}}</th>
                        <th>IC Number</th>  
                        <!-- <th>{{trans('report.country')}}</th> -->
                        <!-- <th>{{ trans("all.customer_id") }}</th> -->
                        <th>{{trans('report.date_joined')}}</th>
                    </tr>
                </thead>
	            <tbody>
	            	@foreach($reportdata as $key=>$report)
	            	<tr>
	            		<td>{{ $key +1 }}</td>
	                    <td>{{$report->username}}</td>
	                    <td>{{$report->name}}{{$report->lastname}}</td>
	                    <!-- <td>{{$report->lastname}}</td> -->
	                    <td>{{$report->email}}</td>
                      <!-- <td>{{$report->keyid}}</td> -->

	                    <td>{{$report->passport}}</td>
	                    <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
					</tr>
	                @endforeach   
				</tbody>
        <tfoot align = "left" class="headerfooter">
          <th></th><th></th><th></th><th></th><th></th><th></th>
        </tfoot>
        
        	</table>
        </div>
        </div>
       
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
<!-- <script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> -->
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>



<script>    
    var start_date = {!! json_encode($start_date) !!};
    var end_date = {!! json_encode($end_date) !!};
</script>
  <script>
    $(document).ready(function() {
        $('#joiningreport').DataTable( {
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