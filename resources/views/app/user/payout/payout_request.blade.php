@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
@include('app.user.layouts.payoutdetails')
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$title}}</h5>
     <!--    <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div> 
        
<div class="card-body">
  @include('utils.errors.list') 
    {!! Form::open(array('url' => 'user/request','enctype'=>'multipart/form-data'),$rules) !!}
    <div class="row">
      <div class="col-sm-4 ">
        {!!  Form::label('req_amount', trans("payout.request_amount") ,array('class'=>'control-label'))  !!}  
        {!!  Form::number('req_amount',$user_balance, array('class'=>'form-control','required'=>'true','min'=> '1' ))  !!}
      </div>
      <div class="col-sm-4">
        {!!  Form::label('payment_mode', trans("payout.payment_mode") ,array('class'=>'control-label'))  !!}  
          <select class="form-control " name="payment_mode" id="payment_mode" required="required" data-parsley-required-message="Please Select Package" data-parsley-group="block-0">
          @foreach($payment_type as $data)
            <option value="{{$data->id}}">{{$data->payment_mode}} </option>
          @endforeach
          </select>
      </div>
    <div class="col-sm-4">
      {!! Form::submit(trans('payout.request'),array('class'=>'btn btn-success','style'=>'MARGIN: 30PX ;')) !!}
    </div>
    </div>
    {!! Form::close() !!}
</div>            
</div>
                  
@stop
