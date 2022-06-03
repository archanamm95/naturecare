


@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$title}}</h4>
       <!--  <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div>
    <div class="card-body">
        @include('utils.errors.list')
         {!! Form::open(array('url' => '/user/vouch-request','enctype'=>'multipart/form-data'),$rules) !!}   

        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
             <p class="card-text"> {{trans('voucher.balance_amount')}} :  &nbsp;&nbsp;<b>{!!$user_balance!!}</b></p>
           </div>
       </div>
          <!-- <div class="form-group">
                <p class="text-primary">
                    {{trans('voucher.balance_amt')}} :$ {!!$user_balance!!}
                </p>
            </div> -->
            <div class="row">
              <div class="col-sm-4">
                {!! Form::label('req_amount', trans('voucher.request_voucher_amount'),array('class'=>'control-label')) !!} {!! Form::number('req_amount',$user_balance, array('class'=>'form-control','required'=>'true','min'=>'1' )) !!}
              </div>
              <div class="col-sm-4">
                {!! Form::label('req_count', trans('voucher.count'),array('class'=>'control-label')) !!} {!! Form::number('req_count',1, array('class'=>'form-control','required'=>'true','min'=>'1' )) !!}
              </div>
              <div class="col-sm-4">
           {!! Form::submit(trans('voucher.confirm'),array('class'=>'btn btn-success','name'=>'myButton','style'=>'MARGIN: 28PX ;')) !!}
              </div>
            </div>
            
        {!! Form::close() !!}
</div>
</div>

<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{trans('voucher.voucher_requests')}}</h4>
       <!--  <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div>
 <div class="table-responsive">


              <table class="table table-condensed">
                <thead class="">
                  <tr>
                  <th>{{trans('voucher.sl_no')}}</th>
                  <th>{{trans('voucher.amount')}}</th>
                  <th>{{trans('voucher.count')}}</th>
                  <th>{{trans('voucher.total_amount')}}</th>
                  <th>{{trans('voucher.status')}}</th>
                  <th>{{trans('voucher.date')}}</th>
                  </tr>
                </thead>
                <tbody>           
                  
                  @foreach ($all_vouchers as $key=>$voucher)
                  <tr >
                  <td>{{$key +1 }}</td>
                  <td>{{$voucher->amount}}</td>
                  <td>{{$voucher->count}}</td>
                  <td>{{$voucher->total_amount}}</td>
                  <td>{{$voucher->status}}</td>
                  <td>{{$voucher->created_at}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
 
  {!! $all_vouchers->render() !!}
              </div>  

          

  </div>
@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
$(document).on('submit', 'form', function() {
  $(this).find('button:submit, input:submit').attr('disabled','disabled');
});
</script>

 @stop