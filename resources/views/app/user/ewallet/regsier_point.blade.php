@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
    /*th {*/
        /*background-color: #34bcd4;*/
    /*}*/
</style>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endsection @section('main')
<!-- Basic datatable -->


<div class="row">
     <div class="col-lg-3 col-6">
        <div class="card border-info box">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{$balance}} RP</h3>
                <div class="text-muted text-size-small"> {{trans('wallet.balance')}}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card border-info box">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{$total_earned}} RP</h3>
                <div class="text-muted text-size-small"> {{trans('wallet.total_earned')}}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card border-info box">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{$used}} RP</h3>
                <div class="text-muted text-size-small"> {{trans('voucher.used')}}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card border-info box">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{$count}}</h3>
                <div class="text-muted text-size-small"> {{trans('ewallet.available_product_count')}}</div>
            </div>
        </div>
    </div>
</div>

<div class="card card-flat border-top-success box">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
            {{trans('wallet.register_point_history')}} 
        </h4>
    </div>
    <div class="card card-body">
        <div class="table-responsive">
        <table class="table table-condensed" id="wallet_reacharge">

            <thead class="headerfooter">

                <tr>
                    <th>Sl.No</th>
                    <th>{{trans('products.product_count')}}</th>
                    <th>{{trans('products.register_point')}} (RP)</th>                               
                    <th>{{trans('report.credit')}} / {{trans('report.debit')}}</th>
                    <th>{{trans('ewallet.date')}}</th>
                </tr>

            </thead>

            <tbody>
                <?php $total_credit=0; ?>
                @foreach ($data as $key=>$request)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$request->count}}</td>
                        <td>{{$request->bv}}</td>
                        <!-- <td></td>  -->
                        <td>@if($request->type =='credit')<span style="color:green">{{ucwords($request->type)}}</span>
                            <?php $bv=$request->bv; ?>
                            @else<span style="color:red">{{ucwords($request->type)}}</span> 
                            <?php $bv=-$request->bv; ?>
                            @endif
                        </td>                        
                        <td>{{date('d-m-Y',strtotime($request->created_at))}}</td>
                    </tr>
                    <?php $total_credit=$total_credit+$bv; ?>
                @endforeach

            </tbody>

            <tfoot class="headerfooter">

                <th></th><th>Balance</th><th><span class="text text-bold"></span>{{(number_format($total_credit,2))}}</th><th></th><th></th>
                
            </tfoot>

        </table>
    </div>
    </div>
</div>
    </div>        
  </div>

               





                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">
   function checkForm(form)
 {
  
   form.add_amount.disabled = true;
   form.debit_amount.disabled = true;
   return true;
 }

</script>
<script type="text/javascript">
$(function(){
    $("#bank").hide();
    $('#payment').on('change',function(){
        if($(this).val() != 'barion'){
            $("#bank").show();
        }else{
            $("#bank").hide();
        }
    });
 });
  $(document).ready(function() {
        $("bank").hide();
        $('#wallet_reacharge').DataTable( {
            dom: "<'row'<'col-sm-6'l><'col-sm-6'fr>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row'<'col-sm-2'i><'col-sm-5'<'pull-left'p>><'col-sm-5'<'pull-right'B>> >" ,
        language: {
            paginate: {
                next: '<i class="glyphicon glyphicon-chevron-right">',
                previous: '<i class="glyphicon glyphicon-chevron-left">', 
            }
        },

    } );
} );

</script>


<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
@stop



 