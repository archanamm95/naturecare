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
                {{trans('controlpanel.payout_management')}} : {{trans('controlpanel.options')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">
                    {{trans('controlpanel.payout_manager')}} :  {{trans('controlpanel.basic')}}
                </legend>

                  <form  action="{{url('admin/control-panel/mipayamount')}}" data-parsley-validate="true" method="post" >
                                        {{csrf_field()}}

                        <div class="form-group row">
                  
                    <label class="col-sm-3">
                    {{trans('controlpanel.payout_type')}}
                    </label>

                    <div class="col-sm-3">
                          <select class="form-control select2" name="payout_type" id="payout_type" required="required" >
                              
                                <option value="1"> {{trans('controlpanel.payout_by_admin')}}</option>
                                  <option value="2"> {{trans('controlpanel.payout_by_user_request')}}</option>

                                
                            </select>
                       
                            
                           
                        
                    </div>


                
                 
                </div>
                   <div class="form-group row">
                  
                    <label class="col-sm-3">
Monthly Maintenance                    </label>

                    <div class="col-sm-3">
                           <input type="number" class="form-control" id="monthly_maintenance" placeholder="monthly maintenance" name="monthly_maintenance" value="{{$binary_commission->monthly_maintenance}}">
                       
                            
                           
                        
                    </div>


                
                 
                </div>
            
                
                   <div class="form-group row">
                      <label class="col-sm-3">
                    {{trans('controlpanel.minimum_payout_amount')}}
                    </label>
                       <div class="col-sm-3">
                        <input type="number" class="form-control" name="min_payout_amount" value="{{$payout_gateway_details->min_payout_amount}}" >
                         </div>
                         
                              <div class="col-sm-1">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                     </div>
                                    
                     </div>
                 </form>


                <div class="form-group row">
                    @foreach($payment_type as $payment)
                    <label class="col-form-label col-lg-2">
                      {{$payment->payment_mode}}
                    </label>

                    <div class="col-lg-10">
                        <div class="d-inline-block mr-3">
                            
                            <label class="form-check-label d-flex align-items-center">

                               <input name="{{$payment->payment_mode}}" {{($payment->status == 1 ? 'checked' : '' )}} class="form-check-input form-check-input-switch" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text=" {{trans('controlpanel.off')}}" data-on-color="success" data-on-text=" {{trans('controlpanel.on')}}" data-size="small" id="{{$payment->payment_mode}}" type="checkbox"/>
                            </label>
                        </div> 
                    </div>
                    @endforeach  
                </div>

               
            </fieldset>
        </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> {{trans('controlpanel.hyperwallet')}}</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> {{trans('controlpanel.paypal')}}</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"> {{trans('controlpanel.bitaps')}}</a>
                                 <a class="nav-item nav-link" id="nav-senag-tab" data-toggle="tab" href="#nav-senag" role="tab" aria-controls="nav-senag" aria-selected="false"> {{trans('controlpanel.senangpay')}}</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                 <form id="update-system-settings" data-parsley-validate="true" method="post" action="{{url('admin/control-panel/hyperwallet_input')}}">
                                        {{csrf_field()}}
                                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.username')}} </label>
                                        <div class="col-lg-6">
                                                <input type="text" class="form-control" name="username" value="{{$payout_gateway_details->username}}" >
                                            
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.program_token')}}</label>
                                        <div class="col-lg-6">

                                            <input type="text" class="form-control" name="programtoken" value="{{$payout_gateway_details->program_token}}" >
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.password')}}</label>
                                        <div class="col-lg-6">

                                            <input type="text" class="form-control" name="password" value="{{$payout_gateway_details->password}}" >
                                                    
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                     
                                    </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                               <form id="update-system-settings" data-parsley-validate="true" method="post" action="{{url('admin/control-panel/paypal_input')}}">
                                        {{csrf_field()}}
                                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.paypal_client_id')}}</label>
                                        <div class="col-lg-6">
                                                <input type="text" class="form-control" name="paypal_client_id" value="{{$payout_gateway_details->paypal_clientId}}" >     
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.paypal_secret')}}</label>
                                        <div class="col-lg-6">

                                            <input type="text" class="form-control" name="paypal_secret" value="{{$payout_gateway_details->paypal_secret}}" >     
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <form id="update-system-settings" data-parsley-validate="true" method="post" action="{{url('admin/control-panel/btc_input')}}">
                                        {{csrf_field()}}
                                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.wallet_id')}}</label>
                                        <div class="col-lg-6">
                                                <input type="text" class="form-control" name="wallet_id" value="{{$payout_gateway_details->wallet_id}}" >   
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.wallet_id_hash')}} </label>
                                        <div class="col-lg-6">

                                            <input type="text" class="form-control" name="wallet_id_hash" value="{{$payout_gateway_details->wallet_hashId}}" >
                                            
                                            
                                        </div>
                                    </div>
                                   

                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                     
                                    </form>
                            </div>
                            <div class="tab-pane fade" id="nav-senag" role="tabpanel" aria-labelledby="nav-senag-tab">
                                <form id="update-system-settings" data-parsley-validate="true" method="post" action="{{url('admin/control-panel/senangpay')}}">
                                        {{csrf_field()}}
                                  <input name="_token" type="hidden" value="{{csrf_token()}}">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.merchant_id')}}</label>
                                        <div class="col-lg-6">
                                                <input type="text" class="form-control" name="merchant_id" value="{{$payout_gateway_details->merchant_id}}" >   
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"> {{trans('controlpanel.secret_key')}} </label>
                                        <div class="col-lg-6">

                                            <input type="text" class="form-control" name="secret_key" value="{{$payout_gateway_details->secret_key}}" >
                                            
                                            
                                        </div>
                                    </div>
                                   

                                     <div class="form-group row">
                                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                                    </div>
                                     
                                    </form>
                            </div>
                        </div>
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
     $('.form-check-input-switch').each(function(e) {
               var switch_elem = $(this);
               key = switch_elem.attr('name');
               val_boolean = switch_elem.bootstrapSwitch('state'); 
                  switch_elem.bootstrapSwitch('state', val_boolean);
    });
 });


 

$('.form-check-input-switch').on('switchChange.bootstrapSwitch', function(e) {

    var switch_elem = $(this);
    switch_key = switch_elem.attr('name');
    switch_val_boolean = switch_elem.bootstrapSwitch('state'); 
    if(switch_val_boolean == true){
        switch_val = 1;
    }else{
        switch_val = 0;
    }
    $.ajax({
        method: 'POST',
        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/payout_options',
        data: {
            'key': switch_key,
            'value': switch_val
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
          
            changeCookiePrefix();
        }
    });


});

 


 

</script>
@stop
