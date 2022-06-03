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
        <h6 class="card-title">{{$sub_title}}</h6>
        <div class="header-elements">
          <div class="print" >
            <button type="button" class="btn btn-light btn-sm ml-3" onclick="printDiv('invoice-content')"><i class="icon-printer mr-2"></i>  {{trans('report.print')}}</button>
          </div>
        </div>
    </div>

    
    <div id="invoice-content">
          <div class="card-body">
             <div class="row">
              <div class="col-sm-6">
                <!--  <form action="{{URL::to('admin/maintain-members')}}" method="post">
                    <input type="hidden" name="_token"  value="{{csrf_token()}}">
                    <input type="hidden" name="month"  value="{{$month}}">
                    <label class="form-label col-sm-3">{{trans('report.choose_type')}}</label>
                    <div class="col-sm-6">
                        <div class="input-group">  
                            <select name="type" class="form-control">
                                <option selected value="1">Weekly  ( 1 to 7)</option>
                                <option value="2">Monthly ( 8 to End)</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group col-sm-3" >
                        <button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>
                    </div>
                  </form>   -->
              </div>

              <div class="col-sm-6">
                <div class="mb-4">
                  <div class="text-sm-right">
                    <ul class="list list-unstyled mb-0">
                      <li> Month: <span class="font-weight-semibold">{{$monthName}}</span></li>
                      <li> Type: <span class="font-weight-semibold">{{$type}}</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        <br>
        <div class="table-responsive">
                 <table class="table table-invoice" id = "salesreport">
                <thead class="headerfooter">
                    <tr>
                        <th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>
                        <th>{{trans('report.fullname')}}</th>   
                        <th>{{trans('report.email')}}</th>  
                        <th>Total Pv</th>  
                        <th>{{trans('dashboard.total_income')}}</th>  
                        <th>{{trans('report.date_joined')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finallist as $key=> $report) 
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{$report->username}}</td>
                        <td>{{$report->name}}{{$report->lastname}}</td>
                        <td>{{$report->email}}</td>
                        <td>{{$report->total_bv}}</td>
                        <td>{{currency(round($report->total_income,2))}}</td>
                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
                    </tr>
                    @endforeach   
                </tbody>
                  <tfoot align = "left" class="headerfooter">
          <th></th><th></th><th></th><th></th><th>Total</th><th>{{currency(round($total_income))}}</th><th></th>
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
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<!-- <script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> -->
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<script>
 $(document).ready(function() {
        $('#salesreport').DataTable( {
            dom: "<'row'<'col-sm-6'l><'col-sm-6'fr>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row'<'col-sm-2'i><'col-sm-5'<'pull-left'p>><'col-sm-5'<'pull-right'B>> >" ,
            columnDefs: [{"className": "dt-center", "targets": "_all"}],
            language: {
                paginate: {
                    next: '<i class="glyphicon glyphicon-chevron-right">',
                    previous: '<i class="glyphicon glyphicon-chevron-left">', 
                }
            },
            paging: true,
            autoWidth: true,

            buttons: [        
            {
                extend: 'pdfHtml5',
                pageSize:'A4',
                // orientation:'landscape',
                title: 'Maintain Members',
                text:'<span class="fa fa-print"> PDF</span>',
                className: 'btn  btn-xs  btn-primary paginate_button ',
                footer: true,
          },

         { "extend": 'csv', 
           "text":'<span class="fa fa-file-excel-o"> CSV</span>',
           "className": 'btn  btn-xs  btn-primary paginate_button  '
        },
         { "extend": 'excel', 
          "text":'<span class="fa fa-file-excel-o"> EXCEL</span>',
          "className": 'btn  btn-xs  btn-primary paginate_button ' },
         
        ] ,
    } );
} );
 </script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
          swal("Please add track id");
        }else{

          var url = "{{url('admin/add-track-id/')}}/"+id+"/"+tarck_id;

          $.get(url, function(data){
            if(data.valid){
              swal("Success! Track ID Added Successfully!", {
              icon: "success",
            }).then((value) => {
              location.reload();
            });
            }else{
              swal("Some error occur!");
            }
          });
        }

    });
});
</script>
 <script type="text/javascript">
  $(document).ready(function(){
  $('.Editdata').each(function () {
    var $this = $(this);
    $this.on("click", function () {
      var id = $(this).data('id');
      var tarck_id = document.getElementById("trackid"+id).value;
      if(tarck_id == ""){
        swal("Please add track id");
      }else{
        var url = "{{url('admin/add-track-id/')}}/"+id+"/"+tarck_id;
        $.get(url, function(data){
          if(data.valid){
            swal("Success! Track ID Edited Successfully!", {
              icon: "success",
            }).then((value) => {
              location.reload();
            });
          }else{
            swal("Some error occur!");
          }
        });
      }
    });
  });
  });
 </script>
 <script type="text/javascript">
  $('.addself').each(function () {
    var $this = $(this);
    $this.on("click", function () {
       var id = $(this).data('id');
       var tarck_id = 'self_pickup';
        swal({
          title: "Are you sure?",
          // text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var url = "{{url('admin/add-track-id/')}}/"+id+"/"+tarck_id;
            $.get(url, function(data){
              if (data.valid) {
                  swal("Success! Updated your delivery Method!", {
                    icon: "success",
                  }).then((value) => {
                    location.reload();
                  });
              } else {
                swal("Some error occur!");
              }
            });
          } else {
            swal("Cancelled!");
          }
        });
        });
    });
 </script>
 <script type="text/javascript">
  $('.removeself').each(function () {
    var $this = $(this);
    $this.on("click", function () {
       var id = $(this).data('id');
       var tarck_id = 'null';
        swal({
          title: "Are you sure?",
          // text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var url = "{{url('admin/add-track-id/')}}/"+id+"/"+tarck_id;
            $.get(url, function(data){
              if (data.valid) {
                  swal("Success! Updated your delivery Method!", {
                    icon: "success",
                  }).then((value) => {
                    location.reload();
                  });
              } else {
                swal("Some error occur!");
              }
            });
          } else {
            swal("Cancelled!");
          }
        });
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