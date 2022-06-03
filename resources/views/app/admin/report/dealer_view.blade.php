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
                 <table class="table table-invoice" id = "dealerreport">
                <thead class="headerfooter">
                    <tr>
                        <th>{{trans('report.no')}}</th>
                        <th>{{trans('Dealer Name')}}</th>
                        <th>{{trans('Dealer Type')}}</th>
                        <th>{{trans('Dealer email')}}</th>
                        <th>{{trans('Date Of Purchase')}}</th>
                        <!-- <th>{{trans('Date Of Joining')}}</th> -->

                    </tr>
                </thead>
                <tbody>
                    @foreach($reportdata as $key=> $report) 
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{$report->name}} {{$report->lastname}}</td>
                        <td>{{$report->user_type}}</td>
                        <td>{{$report->email}}</td>
                        <td>{{ date('d M Y',strtotime($report->purchased_at))}}</td>
                        <!-- <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td> -->
                    </tr>
                    @endforeach   
                </tbody>
                
            </table>
             
        </div>
    </div>
   <!--  <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
            {{trans('report.thank_you_for_your_business')}}
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
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>    
    var start_date = {!! json_encode($start_date) !!};
    var end_date = {!! json_encode($end_date) !!};
</script>
<script>
    $(document).ready(function() {
        $('#dealerreport').DataTable( {
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
            //in
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                 pageTotal+"<br>"+total 
            );
          
            //out
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                pageTotal+"<br>"+total 
            );
            $( api.column( 1 ).footer() ).html(
                "Total <br> Grand Total" 
            );
           
            
        }
    } );
} );
 </script>

 <script type="text/javascript">
   
  //  document.getElementById("Add").onclick = function () { 

  //   alert('hello!'); 


  // };
  $('.addEdt').each(function () {
    var $this = $(this);
    $this.on("click", function () {
        var id = $(this).data('id');
        var tarck_id = document.getElementById("track"+id).value;

        if(tarck_id == ""){
          alert("Please add track id");
        }else{

          var url = "{{url('admin/add-track-id/')}}/"+id+"/"+tarck_id;

          $.get(url, function(data){
            if(data.valid){
              alert("Track Id Added");
              location.reload();
            }else{
              alert("Some error occur");
            }
          });
        }

    });
});
 </script>
<script src="//www.tracking.my/track-button.js"></script>
<script>
  function linkTrack(num) {
    TrackButton.track({
      tracking_no: num
    });
  }
</script>


 @endsection