@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection


        {{-- Content --}}
        @section('main')
<div id="settings-page">
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                 {{trans('controlpanel.payment_gateway_management')}} :  {{trans('controlpanel.options')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">
                     {{trans('controlpanel.options')}} :  {{trans('controlpanel.basic')}}
                </legend>
                <div class="form-group row">
                     @foreach($paymentgateway as $payment)
                    <label class="col-form-label col-lg-2">
                        {{$payment->payment_name}}
                    </label>
                    <div class="col-lg-4">
                        <div class="d-inline-block mr-3">
                            <label class="form-check-label d-flex align-items-center">
                                <input name="{{$payment->code}}" {{ ($payment->status == "yes" ? 'checked' : '') }} class="form-check-input form-check-paymentcontrol-switch" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text=" {{trans('controlpanel.off')}}" data-on-color="success" data-on-text=" {{trans('controlpanel.on')}}" data-size="small" id="{{$payment->code}}" type="checkbox"/>  
                            </label>
                        </div> 
                    </div>

                     @endforeach  
                </div>
         
                
            </fieldset>
        </div>


         
    </div>
</div>



   <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.payment_gateway_settings')}}
            </h5>
        </div>

        <div class="card-body bordered">
            <div class="d-md-flex">
                <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#edit-cheque-pay-gateway">
                             {{trans('controlpanel.cheque')}}/ {{trans('controlpanel.bank')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-bitaps-pay-gateway">
                            Bitaps
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-authorize-pay-gateway">
                            Authorize.Net
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-rave-pay-gateway">
                           Rave
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-paypal-pay-gateway">
                           Paypal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-stripe-pay-gateway">
                            Stripe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-ipaygh-pay-gateway">
                            Ipaygh
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-skrill-pay-gateway">
                            Skrill
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="edit-cheque-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-cheque-pay-gateway" style="display: block;">
                            <legend>
                              Cheque Settings
                            </legend>
                            <form  id="update-cheque-pay-gateway" action="{{url('admin/control-panel/chequepayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.bank_details')}} </label>
                                        <div class="col-lg-12">
                                                 <textarea name="bank_details" rows="10" cols="30">{{$paymentdetails->bank_details}}</textarea>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
                        </fieldset>
                    </div>
                    <div class="tab-pane fade" id="edit-bitaps-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-bitaps-pay-gateway" style="display: block;">
                            <legend>
                               Bitaps  {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-bitaps-pay-gateway" action="{{url('admin/control-panel/bitapspayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.merchant')}} BTC  {{trans('controlpanel.address')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="btc_address" value="{{$paymentdetails->btc_address}}">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>
                  <div class="tab-pane fade" id="edit-authorize-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-authorize-pay-gateway" style="display: block;">
                            <legend>
                               Authorize.Net {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-authorize-pay-gateway" action="{{url('admin/control-panel/authorizepayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.merchant_name')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="auth_merchant_name" value="{{$paymentdetails->auth_merchant_name}}">
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.transaction_key')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="auth_transaction_key" value="{{$paymentdetails->auth_transaction_key}}">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>

                         <div class="tab-pane fade" id="edit-rave-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-rave-pay-gateway" style="display: block;">
                            <legend>
                               Rave {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-rave-pay-gateway" action="{{url('admin/control-panel/ravepayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.public_key')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="rave_public_key" value="{{$paymentdetails->rave_public_key}}">
                                        </div>
                                    </div>

                                       <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.secret_key')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="rave_secret_key" value="{{$paymentdetails->rave_secret_key}}">
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>
            
                     <div class="tab-pane fade" id="edit-paypal-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-paypal-pay-gateway" style="display: block;">
                            <legend>
                               Paypal {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-paypal-pay-gateway" action="{{url('admin/control-panel/paypalpayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.username')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="paypal_username" value="{{$paymentdetails->paypal_username}}">
                                        </div>
                                    </div>

                                        <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.password')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="paypal_password" value="{{$paymentdetails->paypal_password}}">
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.secret_key')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="paypal_secret_key" value="{{$paymentdetails->paypal_secret_key}}">
                                        </div>
                                    </div>


                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>
            
                   
                     <div class="tab-pane fade" id="edit-stripe-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-stripe-pay-gateway" style="display: block;">
                            <legend>
                               Stripe {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-stripe-pay-gateway" action="{{url('admin/control-panel/stripepayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.secret_key')}}</label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="stripe_secret_key" value="{{$paymentdetails->stripe_secret_key}}">
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-form-label col-lg-6"> {{trans('controlpanel.public_key')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="stripe_public_key" value="{{$paymentdetails->stripe_public_key}}">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>
                          
                     <div class="tab-pane fade" id="edit-ipaygh-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-ipaygh-pay-gateway" style="display: block;">
                            <legend>
                               Ipaygh {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-ipaygh-pay-gateway" action="{{url('admin/control-panel/ipayghpayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6">{{trans('controlpanel.merchant_key')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="ipaygh_merchant_key" value="{{$paymentdetails->ipaygh_merchant_key}}">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>
                        <div class="tab-pane fade" id="edit-skrill-pay-gateway">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-skrill-pay-gateway" style="display: block;">
                            <legend>
                               Skrill {{trans('controlpanel.settings')}}
                            </legend>
                               <form  id="update-skrill-pay-gateway" action="{{url('admin/control-panel/skrillpayment-manager')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-6">{{trans('controlpanel.merchant_email')}} </label>
                                        <div class="col-lg-12">
                                                <input type="text" class="form-control" name="skrill_mer_email" value="{{$paymentdetails->skrill_mer_email}}">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>
                                    </div>
                                    </form>
              
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

    </div>








@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">

$(document).ready(function () {
     $('.form-check-paymentcontrol-switch').each(function(e) {
               var switch_elem = $(this);
               key = switch_elem.attr('name');
               val_boolean = switch_elem.bootstrapSwitch('state'); 
                  switch_elem.bootstrapSwitch('state', val_boolean);
    });

    $('.form-check-paymentcontrol-switch').on('switchChange.bootstrapSwitch', function(e) {

        var switch_elem = $(this);
        switch_key = switch_elem.attr('name');
        switch_val_boolean = switch_elem.bootstrapSwitch('state'); 
        console.log(switch_val_boolean);
        if(switch_val_boolean == true){
            switch_val = 'yes';
        }else{
            switch_val = 'no';
        }
        $.ajax({
            method: 'POST',
            url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/uppaymentgateway-manager',
            data: {
                'key': switch_key,
                'value': switch_val
            },
            dataType: 'json',
            success: function(data){
                
                
            }
        });
    });
});

 

 

</script>
@stop
