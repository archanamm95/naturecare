

@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endsection @section('main')
<!-- Basic datatable -->
 
<div class="card card-flat timeline-content">
                    <div class="card-header header-elements-inline">
                        <h4 class="card-title">{{trans('report.income_report')}}</h4>
                    </div>
    <br> 
     <div class="card-body" > 

     <form action="{{URL::to('user/incomereport')}}" method="post" >

     	<input type="hidden" name="_token"  value="{{csrf_token()}}">

     	<div class="row" >
        
            <div class="form-group col-sm-6">
                <label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>
                <div class="col-sm-6">
                    <div class="input-group">  
                        <input type="text" autocomplete="off" class="form-control daterange-single" name="start" id="start" value="{{ date('m/01/Y') }}"  required="true">
                        <label for="start" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>
                                  <!--   <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span> -->
                    </div>
                </div>
            </div>


            <div class="form-group col-sm-6">
                <label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>
                <div class="col-sm-6">
                    <div class="input-group"> 
                        <input type="text" autocomplete="off" class="form-control daterange-single" name="end" id="end" value="{{ date('m/t/Y') }}"   required="true">
                        <label for="end" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>
                   <!--        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span>
                 -->
                    </div>
                </div>
            </div>
       
            <div class="form-group col-sm-4"  >
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>
                </div>
            </div>
     	</div>
        <br>
    </form>  

	</div>

    	 

 <div class="card card-flat timeline-content">
         <div class="card-header header-elements-inline">
      <h3 class="text-center"><b><p class="text-center">{{trans('report.report_on_start')}} : {{$start}}  {{trans('report.to_end')}} : {{$end}}</p></b></h3>
     </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-invoice" id = "ewalletreport">
                <thead class="headerfooter">
                    <tr>
                        <th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>
                        <th>{{trans('report.fullname')}}</th> 
                        <th>{{trans('report.fromuser')}}</th>  
                 <!--        <th>{{trans('report.placement')}}</th>   -->                     
                        <th>{{trans('report.amount_type')}}</th>
                        <th>{{trans('report.debit')}}  </th>
                        <th>{{trans('report.credit')}}  </th>
                        <th>{{trans('report.created')}}</th>                        
                    </tr>
                </thead>
                <tbody>
                     @php $credit = $debit= 0 @endphp
                    @foreach($reportdata as $key=> $report)
                    <tr>
                        <td>{{$key +1 }}</td>                      
                        <td>{{$report->username}}</td>
                        <td>{{$report->name}} {{$report->lastname}}</td>     
                        <td>{{$report->fromuser}}</td>
                  <!--       <td>{{$report->placement}}</td>     -->              
                        <td>@if($report->payment_type != 'released')  {{  str_replace('_', ' ', $report->payment_type)}} @else  Payout Released  @endif</td>                        
                        <td>@if($report->payment_type == 'released')  {{currency(round($report->payable_amount,2))}}   @else 0 @endif</td>
                        <td> @if($report->payment_type != 'released') {{currency(round($report->payable_amount,2))}} @else 0 @endif</td>
                        <td>{{  date('d M Y H:i:s',strtotime($report->created_at)) }}</td>


                        @if($report->payment_type != 'released')

                               @php $credit += $report->payable_amount @endphp

                        @else
                             @php $debit += $report->payable_amount @endphp

                        @endif

                    </tr>
                    @endforeach   
                </tbody>
                 <tfoot align = "left" class="headerfooter">
          <th></th><th></th><th></th><th></th><th>{{trans('report.total')}}  
                    </th> <th></th> <th>{{currency(round($debit,2))}}</th><th>{{currency(round($credit,2))}}</th><th></th>
         </tfoot>
            </table>
        </div>
        <!--    <div class="invoice-price">                       
                <div class="invoice-price-right">
                    {{trans('report.total_debit')}}   {{  number_format( $debit,2)}} 
                   , {{trans('report.total_credit')}}   {{  number_format( $credit,2)}} 
                </div>
            </div> -->
    </div>

</div> 

                        
  </div>


                  
@stop
@section('scripts') @parent
    <script>
        $(document).ready(function() {
            App.init();                 
        });        
    </script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

  
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
         
        ] 
    } );
} );




 
 </script>
    @endsection
 
 