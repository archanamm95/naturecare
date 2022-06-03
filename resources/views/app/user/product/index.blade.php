@extends('app.user.layouts.default')  {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
<script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset ('assets/css/style.css') }}" />
<script src="{{ asset ('assets/css/script.js') }}"></script>
<link rel="stylesheet" href="{{ asset ('assets/css/intl-tel-input/build/css/intlTelInput.css') }}"/>
<script src="{{ asset ('assets/css/intl-tel-input/build/js/intlTelInput.min.js') }}"></script>
<style type="text/css">
.iti__flag {background-image: url("{{ asset('assets/css/intl-tel-input/build/img/flags.png') }}");}
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .iti__flag {background-image: url("{{ asset('assets/css/intl-tel-input/build/img/flags@2x.png') }}");}
}
.inttl{
    padding-left: 100px!important;
}    
.wizard>.actions>ul>li>a[href="#finish"] {
    display: none
}
ul.nav.nav-tabs.nav-tabs-vertical {
    background: #eaeaea;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.nav-tabs-vertical .nav-item.show .nav-link, .nav-tabs-vertical .nav-link.active{
    background-color: #fff;
}
.product-thumb .image img {
    height: 400px;
    width: 300px;
}
</style>
@endsection {{-- Content --}} @section('main') @include('utils.errors.list') @include('flash::message')
<!-- Wizard with validation -->
<div class="card card-white">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">{{$title}}</h6>
<div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    @if(count($package) > 0)
    <div class="card-body">
          @if($product->quantity < 1)
            <marquee style="color:red!important;">Product Out Of Stock !!!</marquee>
         @endif
        <form class="form-vertical steps-validation" action="{{url('user/purchase-plan')}}" method="POST" data-parsley-validate="true" name="form-wizard" id="regform" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="payable_vouchers[]" value="">
            <input type="hidden" name="payment" id="payment" value="bankwire">
            <input type="hidden" name="amount" value="{{$joiningfee}}"> 
            <input type="hidden" name="payment_method" value="card">
            <input type="hidden" name="currency" value="USD">
            <input type="hidden" name="joiningfee" id="joiningfee" amount="{{$joiningfee}}">
            <h6 class="width-full">  {{trans('register.product_selection') }} </h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('package') ? ' has-error' : '' }}">
                            {!! Form::label('package', trans("register.package"), array('class' => 'col-form-label')) !!}
                            <select class="form-control select2" name="package" id="package" required="required" data-parsley-required-message="Please Select Package" data-parsley-group="block-0" data-parsley-package="null">
                                <option value="" >{{trans('register.select_package')}}</option>
                                @foreach($package as $data)
                                <option value="{{$data->id}}" amount="{{$data->amount}}" rs="{{$data->rs}}" name="{{$data->package}}" pv="{{$data->pv}}" product_count="{{$data->product_count}}">{{$data->package}} ({{$data->pv}} BV) </option>
                                @endforeach
                            </select>
                            <div class="form-control-feedback">
                                <i class="icon-crown text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.select_package") !!}</small>
                                @if ($errors->has('package'))
                                <strong>{{ $errors->first('package') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="modal fade" id="test" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <p>Packages</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                              </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <div class="row">
                    <div class="product-layout product-list col-xs-4">
                        <div class="product-thumb">
                            <div class="image">
                                <!-- <a href="http://shop-sheheme.cloudmlm.online/index.php?route=product/product&amp;path=59&amp;product_id=50"> -->
                                     <img src="/uploads/documents/{{$product->image}}" alt="Facial Cell Revive Essence" title="Facial Cell Revive Essence" class="img-responsive">
                                <!-- </a> -->
                            </div>
                            <div>
                                <div class="caption">
                                    <h4>
                                        <!-- <a href="http://shop-sheheme.cloudmlm.online/index.php?route=product/product&amp;path=59&amp;product_id=50"> -->
                                            {{$product->name}}
                                        <!-- </a> -->
                                    </h4>
                                    <p>{{$product->description}}..</p>
                                    <p class="price">MYR <span id="price">{{$product->price}}</span></p>
                                    <p class="bv"><span id="bv">{{$product->bv}}</span> BV</p>
                                </div>
                              @if($product->quantity > 0)
                
                                <input type="hidden" value="1" name="product">
                                <label class="control-label" for="input-quantity">Qty</label>
                                <br>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" id="quantity" name="quantity" value="1" class="input-text qty text" size="4" >
                                    <input type="button" value="+" class="plus">
                                </div>
                                <br>
                                <br>
                                <div class="alert alert-warning" id ="warning-alert" role="alert">
                                </div>
                             @else
                               <marquee style="color:red!important;">Product Out Of Stock !!!</marquee>
                              @endif
                               <!--  <div class="button-group">
                                    <button type="button" onclick="addTocart('1')" class="btn btn-info"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <h6 class="width-full">  {{trans('register.billing_info/Shipping_address') }}   </h6>
            <fieldset>
                <br>
                <h4 class="width-full"> {{trans('register.billing_address') }}  </h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('billing_firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_firstname', $BillingAddress->fname, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_firstname") !!}</small>
                                @if ($errors->has('billing_firstname'))
                                <strong>{{ $errors->first('billing_firstname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('billing_lastname') ? ' has-error' : '' }}">
                            {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_lastname', $BillingAddress->lname, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_lastname") !!}</small>
                                @if ($errors->has('billing_lastname'))
                                <strong>{{ $errors->first('billing_lastname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address', $BillingAddress->address, ['class' => 'form-control','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_address") !!}</small>
                                @if ($errors->has('address'))
                                <strong>{{ $errors->first('address') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                            {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address2', $BillingAddress->address2, ['class' => 'form-control','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_address") !!}</small>
                                @if ($errors->has('address2'))
                                <strong>{{ $errors->first('address2') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('city') ? ' has-error' : '' }}">
                            {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('city',$BillingAddress->city, ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-1']) !!}
                            
                            <span class="form-text">
                                <small>{!!trans("all.your_city") !!}</small>
                                @if ($errors->has('city'))
                                <strong>{{ $errors->first('city') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('zip', $BillingAddress->pincode, ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-1','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
                            <span class="form-text">
                                <span id="ziplocation"><span></span></span>
                            <span id="ziperror"></span>
                            <small>{!!trans("all.your_zip") !!}</small> @if ($errors->has('zip'))
                            <strong>{{ $errors->first('zip') }}</strong> @endif
                            </span>
                        </div>
                    </div>
                </div>
                 <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('country') ? ' has-error' : '' }}">
                        {!! Form::label('country', trans("register.country"), array('class' => 'col-form-label')) !!} 
                            <select name="country" class="form-control" data-parsley-group="wizard-step-2" id="country" required>
                                @foreach($countries as $key => $country_item)
                                    @if($key==$BillingAddress->country)
                                    <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                    @else
                                    <option value="{{$key}}" >{{$country_item}}</option>
                                    @endif
                                @endforeach
                            </select>
                           
                            <span class="form-text">
                                <small>{!!trans("all.select_country") !!}</small>
                                @if ($errors->has('country'))
                                <strong>{{ $errors->first('country') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                        {!! Form::label('state', trans("register.state"), array('class' => 'col-form-label')) !!} 
                            <select name="state" class="form-control" data-parsley-group="wizard-step-2" id="state" required >
                                @foreach($states as $key=>$state)
                                @if($key === $BillingAddress->state)
                                    <option value="{{$key}}"selected>{{ $state }}</option>
                                @else
                                    <option value="{{$key}}" >{{$state}}</option>
                                @endif
                                @endforeach
                            </select>
                            <span class="form-text">
                                <small>{!!trans("all.select_your_state") !!}</small>
                                @if ($errors->has('state'))
                                <strong>{{ $errors->first('state') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <br>
                <h4 class="width-full">  Shipping Address   </h4>
                <br>
                <input type="checkbox" id="shipping" name="shipping" value="yes" >
                <label for="shipping"> Same as billing address</label><br> 
                <div class="shipping_address">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="required form-group {{ $errors->has('shipping_firstname') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_firstname', isset($Shippingaddress->fname)?$Shippingaddress->fname:'', ['class' => 'form-control shipping_firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-1']) !!}
                                <span class="form-text">
                                    <small>{!!trans("all.your_firstname") !!}</small>
                                    @if ($errors->has('shipping_firstname'))
                                    <strong>{{ $errors->first('shipping_firstname') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="required form-group{{ $errors->has('shipping_lastname') ? ' has-error' : '' }}">
                                {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_lastname',isset($Shippingaddress->lname)? $Shippingaddress->lname:'', ['class' => 'form-control shipping_lastname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-1']) !!}
                                <span class="form-text">
                                    <small>{!!trans("all.your_lastname") !!}</small>
                                    @if ($errors->has('shipping_lastname'))
                                    <strong>{{ $errors->first('shipping_lastname') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <!-- begin col-6 -->
                        <div class="col-md-6">
                            <div class="required form-group{{ $errors->has('shipping_address') ? ' has-error' : '' }}">
                                {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('shipping_address', isset($Shippingaddress->address)? $Shippingaddress->address:'', ['class' => 'form-control shipping_address','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-1']) !!}
                                <span class="form-text">
                                    <small>{!!trans("all.your_address") !!}</small>
                                    @if ($errors->has('shipping_address'))
                                    <strong>{{ $errors->first('shipping_address') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="required form-group{{ $errors->has('shipping_address2') ? ' has-error' : '' }}">
                                {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('shipping_address2', isset($Shippingaddress->address2)? $Shippingaddress->address2 : '', ['class' => 'form-control shipping_address2','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-1']) !!}
                                <span class="form-text">
                                    <small>{!!trans("all.your_address") !!}</small>
                                    @if ($errors->has('shipping_address2'))
                                    <strong>{{ $errors->first('shipping_address2') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- begin col-6 -->
                        <div class="col-md-6">
                            <div class="required form-group-feedback-right {{ $errors->has('shipping_city') ? ' has-error' : '' }}">
                                {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_city', isset($Shippingaddress->city)? $Shippingaddress->city : '', ['class' => 'form-control shipping_city','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-1']) !!}
                                
                                <span class="form-text">
                                    <small>{!!trans("all.your_city") !!}</small>
                                    @if ($errors->has('shipping_city'))
                                    <strong>{{ $errors->first('shipping_city') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="required form-group{{ $errors->has('shipping_zip') ? ' has-error' : '' }}">
                                {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_zip', isset($Shippingaddress->pincode)? $Shippingaddress->pincode : '', ['class' => 'form-control shipping_zip','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-1','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror12' ]) !!}
                                <span class="form-text">
                                    <span id="ziplocation"><span></span></span>
                                <span id="ziperror12"></span>
                                <small>{!!trans("all.your_zip") !!}</small> @if ($errors->has('shipping_zip'))
                                <strong>{{ $errors->first('shipping_zip') }}</strong> @endif
                                </span>
                            </div>
                        </div>
                    </div>
                     <!-- end row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="required form-group-feedback-right {{ $errors->has('shipping_country') ? ' has-error' : '' }}">
                            {!! Form::label('country', trans("register.country"), array('class' => 'col-form-label')) !!} 
                                <select name="shipping_country" class="form-control shipping_country" data-parsley-group="wizard-step-1" id="shipping_country" required>
                                    @foreach($countries as $key => $country_item)
                                        @if(isset($Shippingaddress->country))
                                            @if($key==$Shippingaddress->country)
                                            <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                            @else
                                            <option value="{{$key}}" >{{$country_item}}</option>
                                            @endif
                                        @else
                                            @if($key=='MY')
                                            <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                            @else
                                            <option value="{{$key}}" >{{$country_item}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                               
                                <span class="form-text">
                                    <small>{!!trans("all.select_country") !!}</small>
                                    @if ($errors->has('shipping_country'))
                                    <strong>{{ $errors->first('shipping_country') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="required form-group{{ $errors->has('shipping_state') ? ' has-error' : '' }}">
                            {!! Form::label('state', trans("register.state"), array('class' => 'col-form-label')) !!} 
                                <select name="shipping_state" class="form-control state" data-parsley-group="wizard-step-1" id="shipping_state" required >
                                    @foreach($states as $key=>$state)
                                        @if(isset($Shippingaddress->state))
                                            @if($key==$Shippingaddress->state)
                                                <option value="{{ $key }}" selected>{{ $state }}</option>
                                            @else
                                                <option value="{{$key}}" >{{$state}}</option>
                                            @endif
                                        @else
                                            <option value="{{$key}}" >{{$state}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="form-text">
                                    <small>{!!trans("all.select_your_state") !!}</small>
                                    @if ($errors->has('shipping_state'))
                                    <strong>{{ $errors->first('shipping_state') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <h6 class="width-full">  {{trans('register.payment') }}   </h6>
            <fieldset>
                <div class="card-body bordered">
                    <div class="d-md-flex">
                        <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0"  id="myTab">
                                
                            @foreach($payment_type as $k => $payment)
                            @if($payment->id==5)
                            <li class="nav-item" payment="{{$payment->code}}">
                                <a class="nav-link active" payment="{{$payment->code}}" data-toggle="tab" href="#tab{{$k}}" role="tab" >
                                <br/>{{$payment->payment_name}}</a>
                            </li>
                            @else
                            <li class="nav-item" payment="{{$payment->code}}">
                            <a class="nav-link" payment="{{$payment->code}}" data-toggle="tab" href="#tab{{$k}}">
                                <br/>{{$payment->payment_name}}</a>
                            </li>
                            @endif @endforeach
                        </ul>
                         
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <div class="tab-content" >
                                @foreach($payment_type as $ke => $pay) @if($pay->payment_name=="Cheque")
                                <div class="tab-pane fade show" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                     @if($payment_gateway->bank_details == "")
                                      <h4>
                                      {{trans("register.please_save_merchants_bank_details_in_payment_gateway_manager")}}</h4>
                                      @else
                                        <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                        <span name="fee" id="joiningfee"> ${{$joiningfee}} </span>   
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @elseif($pay->payment_name=="Ewallet") 
                                <div class="tab-pane ewallet" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center basic">
                                        <h1> <p class="text-info">
                                            Ewallet Balance:<span>{{$balance}}</span>
                                            <br>
                                            {{config('currency.default')}}
                                            <span class="total-amount"></span>
                                        </p></h1>
                                        <!-- <h3>{{trans('register.confirm_registration') }}</h3> -->
                                        <div class="alert alert-danger" id="alert-danger-rp" role="alert">Insufficient Amount</div>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button" id="ewalletbutton">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                    </div>
                                </div> 
                               <!--  <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                        <div class="row">
                                        <div class="col-sm-3">
                                          </div>
                                          <label class="col-sm-2 control-label" for="username">
                                              {{trans('register.username')}}:
                                              <span class="symbol ">
                                                  </span>
                                          </label>
                                          <div class="col-sm-4">
                                              <input class="form-control" id="ewalletusername" name="ewalletusername" type="text">
                                             
                                          </div>
                                          </div>
                                            <br/>
                                            <div class="row">
                                               <div class="col-sm-3">
                                                   
                                                   
                                                </div>
                                                <label class="col-sm-2 control-label" for="amount">
                                                        {{trans('register.transaction_password')}}  : <span class="symbol "></span>
                                                </label>
                                                <div class="col-sm-4">
                                                        <input type="password" id="ewallet_password" name="ewallet_password" class="form-control">
                                                </div>
                                            </div>
                                        <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button" id="ewalletbutton">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                    </div>
                                </div>  -->
                                @elseif($pay->payment_name=="Register Point")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                        <h1> <p class="text-info">
                                            {{trans("all.sponsor")}} : <span class="sponsor-name"></span>
                                            <br>
                                            RP:<span class="register-point"></span>
                                            <br>
                                            {{config('currency.default')}}
                                            <span class="total-amount"></span>
                                        </p></h1>
                                        <!-- <h3>{{trans('register.confirm_registration') }}</h3> -->
                                        <div class="alert alert-danger" id="alert-danger-rp" role="alert">Insufficient Register Point</div>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button" id="rpbutton">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                    </div>
                                </div> 
                                @elseif($pay->payment_name=="Bankwire")
                                <div class="tab-pane active" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4">
                                             </div>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    {!! Form::label('sponsor', 'Banking slip ', array('class' => 'col-form-label', 'style' =>'text-align: unset!important;font-weight: bold;')) !!}
                                                    <span class="col-form-label" style="font-size: 80%;font-weight: 400"> ( doc,docx,pdf,jpeg,png,jpg {{trans('ticket_config.files_only')}} )</span>
                                                </div>
                                                 <div class="row">
                                                      <center>SHEHEME ENTERPRISE <br>
                                                            Public Bank Berhad <br>
                                                            Acc No:3221020636  <br>
                                                    </center>
                                                </div>
                                                <div class="row">
                                                    <input id="bank_file" name="bank_file" type="file"  multiple class="file-loading" accept="image/jpg, image/jpeg, image/png ,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain,application/pdf">                
                                                    <br>
                                                    <div class="alert alert-danger" id="alert-danger" role="alert">Banking slip is Required</div>
                                                </div>
                                                <div class="row">
                                                    <label for="date" class="control-label">Pick Payment Date:</label>
                                                    <input type="date" class="form-control" value="" id="date" name="date" style="width: 78%">
                                                    <div class="alert alert-danger" id="alert-danger-date" role="alert">Payment Date Required</div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <h1> <p class="text-info">
                                            {{config('currency.default')}}
                                            <span class="total-amount"></span>
                                        </p></h1>
                                        <!-- <h3>{{trans('register.confirm_registration') }}</h3> -->
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button" id="bankwirebutton">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                    </div>
                                </div>
                                @elseif($pay->payment_name=="Bitaps")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                     @if($payment_gateway->btc_address == "")
                                      <h4> {{trans("register.please_save_merchants_bitaps_address_in_payment_gateway_manager")}}</h4>
                                      @else
                                        <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @elseif($pay->payment_name=="Paypal")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                     @if($payment_gateway->paypal_username == "" && $payment_gateway->paypal_password == "")
                                      <h4> {{trans("register.please_save_merchants_paypal_details_in_payment_gateway_manager")}}</h4>
                                      @else
                                        <input type="hidden" name="PAYMENTREQUEST_0_ITEMAMT" value="100">
                                        <input type="hidden" name="PAYMENTREQUEST_0_AMT" value="100" readonly>
                                         <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                        
                                        <div id="myContainer" style="margin-top:100px">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @elseif($pay->payment_name == "Stripe") 
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                     @if($payment_gateway->stripe_secret_key == "" && $payment_gateway->stripe_public_key == "")
                                      <h4> {{trans("register.please_save_merchants_stripe_details_in_payment_gateway_manager")}}</h4>
                                      @else
                                        <h1> <p class="text-info">
                                            {{config('currency.default')}}
                                            <span class="total-amount"></span>
                                        </p></h1>
                                        <!-- <h3>{{trans('register.confirm_registration') }}</h3> -->
                                        
                                        <p>
                                            <input 
                                                type="button"
                                                id="stripe_btn"
                                                class="btn btn-info"
                                                value="Stripe Payment Confirmation"
                                                data-key="{{$payment_gateway->stripe_public_key}}"
                                                data-amount=""
                                                data-currency="rm"
                                                data-bitcoin="false"
                                                data-name="Plan Upgrade"
                                                data-description="{{trans('register.stripe_payment')}}"
                                                data-locale="auto"
                                            >
                    
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @elseif($pay->payment_name=="Rave")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                    @if($payment_gateway->rave_public_key == "" && $payment_gateway->rave_secret_key == "")
                                      <h4> {{trans("register.please_save_merchants_rave_details_in_payment_gateway_manager")}}</h4>
                                      @else
                                        <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                        @endif
                                    </div>
                                </div>   

                                @elseif($pay->payment_name=="Authorize")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">

                                            @if($payment_gateway->auth_transaction_key == "" && $payment_gateway->auth_merchant_name == "")
                                              <h4> {{trans("register.please_save_merchants_authorize.net_details_in_payment_gateway_manager")}}</h4>
                                              @else
                                                                                     
                                                    <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="required form-group {{ $errors->has('card_number') ? ' has-error' : '' }}">
                                                            {!! Form::label('card_number', trans("register.card_number"), array('class' => 'control-label')) !!} {!! Form::text('card_number', Input::old('card_number'), ['class' => 'form-control','data-parsley-required-message' => trans("register.please_enter_card_number"),'data-parsley-group' => 'block-2']) !!}
                                                            <span class="help-block">
                                                                <small>{!!trans("register.your_card_number") !!}</small>
                                                                @if ($errors->has('card_number'))
                                                                <strong>{{ $errors->first('card_number') }}</strong>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>

                                                      <div class="col-md-6">
                                                        <div class="required form-group {{ $errors->has('cvv') ? ' has-error' : '' }}">
                                                            {!! Form::label('cvv', trans("register.cvv"), array('class' => 'control-label')) !!} {!! Form::text('cvv', Input::old('cvv'), ['class' => 'form-control','data-parsley-required-message' => trans("register.please_enter_card_number"),'data-parsley-group' => 'block-2']) !!}
                                                            <span class="help-block">
                                                                <small>{!!trans("register.cvv") !!}</small>
                                                                @if ($errors->has('cvv'))
                                                                <strong>{{ $errors->first('cvv') }}</strong>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                         
                                                        <div class="required form-group {{ $errors->has('card_last_four') ? ' has-error' : '' }}">
                                                            {!! Form::label('year', trans("register.expiration_date"), array('class' => 'control-label')) !!} 
                                                            {!!  Form::selectRange('year', date('Y'), 2040,Input::old('year'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("register.please_enter_expiration_date"),'data-parsley-group' => 'block-2']);  !!}
                                                            
                                                            <span class="help-block">
                                                                <small>{!!trans("register.your_expirationdate") !!}</small>
                                                                @if ($errors->has('expiration_date'))
                                                                <strong>{{ $errors->first('expiration_date') }}</strong>
                                                                @endif
                                                            </span>
                                                        </div>
                                                     
                                                        
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="required form-group {{ $errors->has('card_last_four') ? ' has-error' : '' }}">
                                                         
                                                         {!! Form::label('year', trans("register.expiration_date"), array('class' => 'control-label')) !!} 

                                                        {!!  Form::selectMonth('month',Input::old('month'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("register.please_enter_expiration_date"),'data-parsley-group' => 'block-2']);  !!}
                                                         <span class="help-block">
                                                                <small>{!!trans("register.your_expirationdate") !!}</small>
                                                                @if ($errors->has('year'))
                                                                <strong>{{ $errors->first('year') }}</strong>
                                                                @endif
                                                            </span>
                                                        
                                                    </div>
                                                    </div>
                                                    
                                                </div>
                                          
                                            <p>
                                                 <button class="btn btn-info btn-lg" role="button">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                            </p>
                                            @endif
                                       
                                    </div> 
                                </div>        

                                @elseif($pay->payment_name=="Ipaygh")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                          @if($payment_gateway->ipaygh_merchant_key == "")
                                              <h4> {{trans("register.please_save_merchants_ipaygh_details_in_payment_gateway_manager")}}</h4>
                                              @else
                                        <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                            <button class="btn btn-info btn-lg" role="button">{{$pay->payment_name}} {{trans('register.payment_confirmation')}}</button>
                                        </p>
                                        @endif
                                    </div>
                                </div>   

                                @elseif($pay->payment_name=="Skrill")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                       @if($payment_gateway->skrill_mer_email == "")
                                          <h4> {{trans("register.please_save_merchants_skrill_details_in_payment_gateway_manager")}}</h4>
                                          @else
                                     <h1> <p class="text-info">
                                            {{trans('register.joining_fee') }}:
                                            <span name="fee" class="ewallet_joining"> ${{$joiningfee}} </span>
                                        </p></h1>
                                        <h3>{{trans('register.confirm_registration') }}</h3>
                                        <p>
                                           <button class="btn btn-info btn-lg" role="button">
                                            {{$pay->payment_name}} {{trans('register.payment_confirmation')}}
                                        </button>
                                       </p>
                                       @endif
                                    </div>
                                </div>      
                                @elseif($pay->payment_name=="senangPay")
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">

                                    <input type="hidden" name="detail" value="Plan Upgrade">
                                    <input type="hidden" name="firstname" value="{{$userData->name}}">
                                    <input type="hidden" name="email" value="{{$userData->email}}">
                                    <input type="hidden" name="phone" value="{{$userData->mobile}}">
                                   
                                    <h3>{{trans('register.confirm_registration') }}</h3>
                                        <br>
                                            {{config('currency.default')}}
                                            <span class="total-amount"></span>
                                        <p>
                                           <button class="btn btn-info btn-lg" role="button">
                                            {{$pay->payment_name}} {{trans('register.payment_confirmation')}}
                                        </button>
                                       </p>
                                    </div>
                                </div>     

                                @else
                                <div class="tab-pane fade in" id="tab{{$ke}}" role="tabpanel">
                                     <div class="table-responsive div-vouher-payment">                      
                                       <table class="table table-dark bg-slate-600 table-vouher-regpayment">
                                         <thead>
                                           <tr>
                                             <th>#</th>
                                             <th>{{trans('register.voucher_code')}}</th>
                                             <th>{{trans('register.amount_used')}}</th>
                                             <th>{{trans('register.voucher_balance')}}</th>
                                             <th>{{trans('register.remaining')}}</th>
                                             <th>{{trans('register.validate_voucher')}}</th>
                                           </tr>
                                         </thead>
                                         <tbody>
                                           <tr>
                                             <td>1</td>
                                             <td><input type="text" name="voucher[]" class="form-control"></td>
                                             <td><span class="amount"></span></td>
                                             <td><span class="balance"></span></td>                             
                                             <td><span class="remaining"></span></td>                             
                                             <td class="td-validate-voucher"><button class="btn btn-info validatevoucher" onclick="return false;">{{trans('register.validate')}}</button></td>
                                           </tr>
                                           </tbody>
                                         </table>
                                          <br>
                                         <p><button id="resulttable" class="btn btn-primary" payment="{{$pay->code}}" role="button" style="border-color:#00bcd4; background-color: #00bcd4" >{{{ trans('all.confirm') }}}</button></p>
                                     </div>    
                                </div>
                            @endif @endforeach
                            </div>
                        </div>
                    </div>
                </div>           
            </fieldset>
        </form>
    </div>
    @else
    <h4 style="margin-left: 20px">{{ trans('admin.You_Have_Already_Purchased_Maximum_Amount_Of_Packages') }}.</h4>
    @endif
</div>

@endsection @section('scripts') @parent
<script src="//www.paypalobjects.com/api/checkout.js" async></script>
<script type="text/javascript">
    $("#quantity").change(function(){
        var quantity    = document.getElementById('quantity').value;
        var product     = document.getElementById("package");
        var name        = product.options[product.selectedIndex].getAttribute('name');
        var pv          = product.options[product.selectedIndex].getAttribute('pv');
        var bv          = document.getElementById('bv').innerHTML;
        var countvalue  = pv/bv;
        if(countvalue % 1 === 0){
           var count     = countvalue;
        }
        else{
            var count     = Math.floor(countvalue)+1;
        }

        var rem = count - quantity;
        if(rem > 0) {
            $message = 'please add '+ rem +' more product to fulfill your order.';
            $('#warning-alert').show();
            $('#warning-alert').removeClass('alert-success');   
            $('#warning-alert').addClass('alert-warning');   
            $('#warning-alert').text($message);
          }
          else{
            $message = 'you added required product.';   
            $('#warning-alert').show();
            $('#warning-alert').removeClass('alert-warning');   
            $('#warning-alert').addClass('alert-success');   
            $('#warning-alert').text($message);   
          }
    });
    $(document).ready(function() {
        $('#warning-alert').hide();
        $('#alert-danger').hide();
        $('#alert-danger-rp').hide();
        $('#alert-danger-date').hide();
        // $(".shipping_address").hide();
        // $('.shipping_firstname').removeAttr('required');
        // $('.shipping_lastname').removeAttr('required');
        // $('.shipping_address').removeAttr('required');
        // $('.shipping_address2').removeAttr('required');
        // $('.shipping_city').removeAttr('required');
        // $('.shipping_zip').removeAttr('required');
        // $('.shipping_country').removeAttr('required');
        // $('.shipping_state').removeAttr('required');
        $('#shipping').change(function() {
            $('.shipping_address').show();
            $('.shipping_firstname').attr('required',true);
            $('.shipping_lastname').attr('required',true);
            $('.shipping_address').attr('required',true);
            // $('.shipping_address2').attr('required',true);
            $('.shipping_city').attr('required',true);
            $('.shipping_zip').attr('required',true);
            $('.shipping_country').attr('required',true);
            $('.shipping_state').attr('required',true);
            
            if(this.checked){
                $('.shipping_address').hide();
                $('.shipping_firstname').removeAttr('required');
                $('.shipping_lastname').removeAttr('required');
                $('.shipping_address').removeAttr('required');
                $('.shipping_address2').removeAttr('required');
                $('.shipping_city').removeAttr('required');
                $('.shipping_zip').removeAttr('required');
                $('.shipping_country').removeAttr('required');
                $('.shipping_state').removeAttr('required');
            }
        });
    });  
</script>
<script type="text/javascript">
    var country_id = $('#country :selected').attr('value');
   if(country_id){
       $.ajax({

          type:"GET",
          url:"{{url('api/get-state-list')}}?country_id="+country_id,
          success:function(res){               
           if(res){
               $("#state").empty();
               $.each(res,function(key,value){
                   $("#state").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#state").empty();
           }
          }
       });
   }else{
       $("#state").empty();
       $("#city").empty();
   }

   $('#country').change(function(){
   var countryID = $(this).val(); 
    if (countryID != 'MY') {
        $(this).val('MY');
        alert('Sorry! Your country is temporary not available for registration at the moment.');
        return false;
    }
   if(countryID){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-state-list')}}?country_id="+countryID,
          success:function(res){               
           if(res){
               $("#state").empty();
               $.each(res,function(key,value){
                   $("#state").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#state").empty();
           }
          }
       });
   }else{
       $("#state").empty();
       $("#city").empty();
   }      
  });
</script>
<script type="text/javascript">
    var country_id = $('#shipping_country :selected').attr('value');
   if(country_id){
       $.ajax({

          type:"GET",
          url:"{{url('api/get-state-list')}}?country_id="+country_id,
          success:function(res){               
           if(res){
               $("#shipping_state").empty();
               $.each(res,function(key,value){
                   $("#shipping_state").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#shipping_state").empty();
           }
          }
       });
   }else{
       $("#shipping_state").empty();
       $("#city").empty();
   }

   $('#shipping_country').change(function(){
   var countryID = $(this).val(); 
   if (countryID != 'MY') {
        $(this).val('MY');
        alert('Sorry! Your country is temporary not available for registration at the moment.');
        return false;
    }
   if(countryID){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-state-list')}}?country_id="+countryID,
          success:function(res){               
           if(res){
               $("#shipping_state").empty();
               $.each(res,function(key,value){
                   $("#shipping_state").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#shipping_state").empty();
           }
          }
       });
   }else{
       $("#shipping_state").empty();
       $("#city").empty();
   }      
  });
</script>
<script type="text/javascript">

  $(document).ready(function() {
       $("#myTab li").click(function(e) {
          $('#payment').val($(this).attr('payment'));
   });
  });
</script> 

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
        $(document).ready(function() {

            $('#stripe_btn').on('click', function(event) {
                event.preventDefault();
                var $button = $(this),
                    $form = $button.parents('form');
                var opts = $.extend({}, $button.data(), {
                    token: function(result) {
                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });
                StripeCheckout.open(opts);
            });
            
            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                $('#payment').val($(this).attr('payment'));
           });
        });
</script>

<script type="text/javascript">
    
$('#ewalletbutton').click(function(event) {
    var balance     = {!! json_encode($balance) !!};
    var quantity    = document.getElementById('quantity').value;
    var price       = document.getElementById('price').innerHTML;
    var total_amount= quantity * price ; 

    if(balance < total_amount) {
        $('#alert-danger-rp').show();   
        return false;           
    }   
    else{
        $('#alert-danger-rp').hide();              
        $("#regform").submit();
    }                       
});
$('#rpbutton').click(function(event) {
    var quantity = document.getElementById('quantity').value;
    var bv       = document.getElementById('bv').innerHTML;
    var total_bv = quantity * bv ; 
    var value    = document.getElementById('sponsor').value;
    var register_point = 0;
    var user_id = 0;
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/getRegisterPoint/?sponsor=' + value,
        type: "GET",
        async: false,
        success: function (e) {
            register_point = e.point ; 
        }
    });       
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/getSponsorId/?sponsor=' + value,
        type: "GET",
        async: false,
        success: function (e) {
            user_id = e.id ; 
        }
    });      
    if(register_point < total_bv && user_id > 1) {
        $('#alert-danger-rp').show();   
        return false;           
    }   
    else{
        $('#alert-danger-rp').hide();              
        $("#regform").submit();
    }                       
});
$('#bankwirebutton').click(function(event) {
    var bank_file = $("#bank_file").val();  
    var date      = $("#date").val();
    if(bank_file.length == 0){
        $('#alert-danger').show();
        return false;           
    }
    if(date.length == 0){
        $('#alert-danger-date').show();
        return false;           
    }
    if(bank_file.length > 0){
        $('#alert-danger').hide();
        $("#regform").submit();
    }
});
$('#ewalletbutton').click(function(event) {

    event.preventDefault();
    
    var username = $("#ewalletusername").val();
    var password = $("#ewallet_password").val();

    var amount = {{ $joiningfee }};
    console.log(amount);

       var name=$('#ewalletusername').val();
        if(name.length == 0){
            $('#ewalletusername').next(".red").remove();
            $('#ewalletusername').after('<div class="red">Username is Required</div>');
        }

         if(password.length == 0){
                
            $('#ewallet_password').next(".red").remove();
            $('#ewallet_password').after('<div class="red">Password is Required</div>');
        }

       if(name.length > 0 && password.length > 0){
            $('#ewalletusername').next(".red").remove();
            $('#ewallet_password').next(".red").remove(); 
               $.ajax({

                url:'/ajax/validateewalletpassword',
                type: "POST",
                dataType: 'json',
                data:{username:username,password:password,amount:amount},
                    
                info:function(e){
                   
                    if (e.valid === true) {
                        $("#regform").submit();
                    } else {
                        alert(e.message);
                        return false;
                    }
                }                          

            });
           
        }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    function addTocart($product_id) {
    var quantity = document.getElementById('quantity').value;
    $.ajax({
          url: CLOUDMLMSOFTWARE.siteUrl + '/admin/register/addTocart',
          type: 'post',
          data: {product_id: $product_id , quantity:quantity},
          dataType: 'json',
          info: function(json) {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            if (json['status']){
                Toast.fire({
                  icon: 'info',
                  title: json['message']
                })
            }
            else{
                Toast.fire({
                  icon: 'error',
                  title: json['message']
                })
            }
          }
      });
    }
</script>
<script src="{{ asset('assets/css/intl-tel-input/build/js/intlTelInput.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        var input = document.querySelector("#phone");
        var iti =window.intlTelInput(input, {
            separateDialCode: true,
            utilsScript :"{{asset('assets/css/intl-tel-input/build/js/utils.js')}}",
        });
        var countryData = iti.getSelectedCountryData(); 
        $('#phone_code').val(countryData.dialCode);
        input.addEventListener('countrychange', function(e) {
            var countryData = iti.getSelectedCountryData();
            $('#phone_code').val(countryData.dialCode);
        });
    });
</script>
<script type="text/javascript">
    $('#package').change(function(){

      var package     = $(this).val();
      var product     = document.getElementById("package");
      var name        = product.options[product.selectedIndex].getAttribute('name');
      var pv          = product.options[product.selectedIndex].getAttribute('pv');
      var bv          = document.getElementById('bv').innerHTML;
      var countvalue  = pv/bv;
      if(countvalue % 1 === 0){
        var count     = countvalue;
      }
      else{
            var count     = Math.floor(countvalue)+1;
      }
      if(package >0){
        var description = 'you need to purchase minimum '+ count +' product ('+ pv +' BV)';
        $('.modal-title').html(name);
        $('.modal-body').html(description);
        $('#test').modal('show');
      }
      var quantity    = document.getElementById('quantity').value;
      var rem = count - quantity;
      if(rem > 0) {
        $message = 'please add '+ rem +' more product to fulfill your order.';
        $('#warning-alert').show();
        $('#warning-alert').removeClass('alert-success');   
        $('#warning-alert').addClass('alert-warning');   
        $('#warning-alert').text($message);
      }
      else{
        $message = 'you added required product.';   
        $('#warning-alert').show();
        $('#warning-alert').removeClass('alert-warning');   
        $('#warning-alert').addClass('alert-success');   
        $('#warning-alert').text($message);   
      }
    });
</script>
@endsection

