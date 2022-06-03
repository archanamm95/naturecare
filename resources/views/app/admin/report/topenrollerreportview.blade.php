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
    <div class="invoice-content">
            <div class="card-body">
        @include('app.admin.report.reportheader')

    	<div class="table-responsive">
    		<table class="table table-invoice" id = "topenroller">
    			<thead>
    				<tr>
    					<th>{{trans('report.no')}}</th>
    					<th>{{trans('report.username')}}</th>
						<th>{{trans('report.name')}}</th>
                        <th>{{trans('report.email')}}</th>
                        <th>{{trans('report.referrals')}}</th>
                       
                    </tr>
                </thead>
	            <tbody>
	            	@foreach($reportdata as $key=>$report)
	            	<tr>
	            		<td>{{ $key +1 }}</td>
	                    <td>{{$report->username}}</td>
	                    <td>{{$report->name}} {{$report->lastname}}</td>
                        <td>{{$report->email}}</td>
                        <td>{{$report->referals}}</td>
	                    
					</tr>
	                @endforeach   
				</tbody>
          <tfoot align = "left" class="headerfooter">
          <th></th><th></th><th></th><th></th><th> </th> <th></th>
         </tfoot>
          </table>
        </div>
        </div>
    </div>
</div>             
@endsection



@section('scripts') @parent
 <script  src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        App.init();                 
    });
</script>
<script>
    $(document).ready(function() {
        $('#topenroller').DataTable( {
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
        
          { "extend": 'pdf', 
          "pageSize":'A3',
          "orientation":'landscape',
          "text":'<span class="fa fa-print"> PDF</span>',
          "className": 'btn  btn-xs  btn-primary paginate_button ' },

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
 