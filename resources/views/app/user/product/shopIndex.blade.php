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
    <div class="card-body">
        @if($product->quantity < 1)
            <marquee style="color:red!important;">Products Out Of Stock !!!</marquee>
         @else
        <form class="form-vertical steps-validation" action="{{url('user/purchase-shop')}}" method="POST" data-parsley-validate="true" name="form-wizard" id="regform" enctype="multipart/form-data">
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
                    <div class="product-layout product-list col-xs-4">
                        <div class="product-thumb">
                            <div class="image">
                                <img src="/uploads/documents/{{$product->image}}" alt="Facial Cell Revive Essence" title="Facial Cell Revive Essence" class="img-responsive">
                            </div>
                                <div class="caption">
                                    <h4>
                                     
                                            {{$product->name}}
                                        
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
                            @else
                             <input type="hidden" name="product" required="">
                             <marquee style="color:red!important;">Product Out Of Stock !!!</marquee>
                            @endif
                        </div>
                    </div>
                </div>
            </fieldset>            
            <h6 class="width-full"> {{trans('admin.user_info') }}  </h6>
            <fieldset><br>
                    <div class="col-sm-6" id="searchtreeholder">
                <span class="input-group">
                    <input class="form-control" id="key-word-user" name="key-word-user-binary" placeholder=" {{trans('tree.search_member')}}" type="text"/>
                    <input id="key_user_hidden" name="key_user_hidden" type="hidden"/>
                </span>
                </div>
            </fieldset>
            <h6 class="width-full">  {{trans('register.billing_info/Shipping_address') }}   </h6>
            <fieldset>
                <br>
                <h4 class="width-full">  {{trans('register.billing_address') }}   </h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('billing_firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_firstname', $BillingAddress->fname, ['class' => 'form-control' ,'id'=>'fname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_lastname', $BillingAddress->lname, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address', $BillingAddress->address, ['class' => 'form-control','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address2', $BillingAddress->address2, ['class' => 'form-control','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('city', $BillingAddress->city, ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-2']) !!}
                            
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
                            {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('zip', $BillingAddress->pincode, ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-2','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
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
                            <select name="country" class="form-control" data-parsley-group="wizard-step-3" id="country" required>
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
                            <select name="state" class="form-control" data-parsley-group="wizard-step-3" id="state" required >
                                @foreach($states as $key => $state)
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
                                {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_firstname', isset($Shippingaddress->fname)?$Shippingaddress->fname:'', ['class' => 'form-control shipping_firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_lastname', isset($Shippingaddress->lname)?$Shippingaddress->lname:'', ['class' => 'form-control shipping_lastname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('shipping_address', isset($Shippingaddress->address)?$Shippingaddress->address:'', ['class' => 'form-control shipping_address','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('shipping_address2', isset($Shippingaddress->address2)? $Shippingaddress->address2:'', ['class' => 'form-control shipping_address2','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_city', isset($Shippingaddress->city)? $Shippingaddress->city:'', ['class' => 'form-control shipping_city','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-2']) !!}
                                
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
                                {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_zip', isset($Shippingaddress->pincode)? $Shippingaddress->pincode:'', ['class' => 'form-control shipping_zip','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-2','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror12' ]) !!}
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
                                <select name="shipping_country" class="form-control shipping_country" data-parsley-group="wizard-step-2" id="shipping_country" required>
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
                                <select name="shipping_state" class="form-control state" data-parsley-group="wizard-step-2" id="shipping_state" required >
                                    @foreach($shopstates as $key=>$state)
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
                                                data-name="Shop Purchase"
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
                                                            {!! Form::label('card_number', trans("register.card_number"), array('class' => 'control-label')) !!} {!! Form::text('card_number', Input::old('card_number'), ['class' => 'form-control','data-parsley-required-message' => trans("register.please_enter_card_number"),'data-parsley-group' => 'block-3']) !!}
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
                                                            {!! Form::label('cvv', trans("register.cvv"), array('class' => 'control-label')) !!} {!! Form::text('cvv', Input::old('cvv'), ['class' => 'form-control','data-parsley-required-message' => trans("register.please_enter_card_number"),'data-parsley-group' => 'block-3']) !!}
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
                                                            {!!  Form::selectRange('year', date('Y'), 2040,Input::old('year'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("register.please_enter_expiration_date"),'data-parsley-group' => 'block-3']);  !!}
                                                            
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

                                                        {!!  Form::selectMonth('month',Input::old('month'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("register.please_enter_expiration_date"),'data-parsley-group' => 'block-3']);  !!}
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
        @endif
    </div>
</div>

@endsection @section('scripts') @parent
<script src="//www.paypalobjects.com/api/checkout.js" async></script>
<script type="text/javascript">

    $(document).ready(function() {
        totalamount();


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
    
</script>
<script type="text/javascript">
   // var country_id = $('#country :selected').attr('value');
   // if(country_id){
   //     $.ajax({
   //        type:"GET",
   //        url:"{{url('api/get-state-list')}}?country_id="+country_id,
   //        success:function(res){               
   //         if(res){
   //             $("#state").empty();
   //             $.each(res,function(key,value){
   //                 $("#state").append('<option value="'+key+'">'+value+'</option>');
   //             });
   //         }else{
   //            $("#state").empty();
   //         }
   //        }
   //     });
   // }else{
   //     $("#state").empty();
   //     $("#city").empty();
   // }

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
    // var country_id = $('#shipping_country :selected').attr('value');
    // if(country_id){
    //    $.ajax({
    //       type:"GET",
    //       url:"{{url('api/get-state-list')}}?country_id="+country_id,
    //       success:function(res){               
    //        if(res){
    //            $("#shipping_state").empty();
    //            $.each(res,function(key,value){
    //                $("#shipping_state").append('<option value="'+key+'">'+value+'</option>');
    //            });
    //        }else{
    //           $("#shipping_state").empty();
    //        }
    //       }
    //    });
    // }else{
    //    $("#shipping_state").empty();
    //    $("#city").empty();
    // }

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
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
    $("#quantity").change(function(){
        totalamount();
    
});
function totalamount(){
    var quantity = document.getElementById('quantity').value;
    var amount   = document.getElementById('price').innerHTML;
    var total_amount = quantity * amount ;
    document.cookie = "total_amount = " + total_amount ;
    $('span.total-amount').text(total_amount);
}
$('.steps-validation').click(function(e){
        var currentindex = $('.steps-validation .current');
        if(currentindex[2].id== 'regform-p-2'){
            console.log("current");
            console.log(currentindex[2].id);
            var user = $('#key_user_hidden').val();
            console.log(user);
            if(user!=''){
               $.ajax({
               type:"GET",
               url:"{{url('get-user-value')}}",
               data:{user:user},
               success:function(result){               
                console.log(result[0].BillingAddress);
                // $('#fname').val(result[0].BillingAddress.fname);
                document.getElementById("fname").innerHTML = result[0].BillingAddress.fname;

                // $('#fname').html(result[0].BillingAddress.fname);

               }
           });
        }
    }
});
</script>
@endsection

