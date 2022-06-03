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

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


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
    		  <table class="table table-invoice" id = "fundcreditreport">
    			<thead class= "headerfooter">

    				<tr>

    					<th>{{trans('report.no')}}</th>



                                                                    

                        <th>{{trans('report.username')}}</th>                                               



                        <th>{{trans('report.fullname')}}</th>   



                        <th>{{trans('report.from_user')}}</th>                                             



                        <th>{{trans('report.email')}}</th>  



                         <th>{{trans('report.amount')}}</th>                                             



                        <!--<th>Amount credited</th>-->



                        <th>{{trans('report.date_joined')}}</th>



                        



                    </tr>



                </thead>



	            <tbody>



	            	@foreach($reportdata as $key=> $report)





                    <tr>

                        <td>{{ $key +1 }}</td>

                        <td>{{$report->username}}</td>

                       <td>{{$report->name}}{{$report->lastname}}</td>

                        <td>{{$report->fromuser}}</td>

                        <td>{{$report->email}}</td>

                        <td>{{currency(round($report->amount,2)) }}</td>

                        <!--<td>{{$report->amount_credited}}</td>-->



                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>

                    </tr>



	                @endforeach   



				</tbody>

              <tfoot align = "left" class="headerfooter">
          <th></th><th></th><th></th><th> {{trans('report.total')}} </th> <th></th><th>{{currency(round($payable_amount,2))}}</th><th></th>
         </tfoot>

        	</table>



        </div>
    </div>



        	<!--<div class="invoice-price">                       



            	<div class="invoice-price-right col-sm-offset-6">



                </div>



            </div>-->



    </div>

 <!-- <div class="invoice-price">                       
                <div class="invoice-price-right col-sm-offset-6">
                    {{trans('report.total_amount')}} $ {{round($payable_amount,2)}}
                </div>
            </div>

    <div class="invoice-footer text-muted">



    	<p class="text-center m-b-5">



        	{{trans('report.thank_you_for_your_business')}}



        </p>



       



      



        



    </div> -->



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

  <script  src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#fundcreditreport').DataTable( {
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