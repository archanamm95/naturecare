@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
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
.product-thumb .image img {
    height: 400px; 
    width: 300px;
}
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.nav-tabs-vertical .nav-item.show .nav-link, .nav-tabs-vertical .nav-link.active{
    background-color: #fff;

</style>

@endsection
{{-- Content --}}
@section('main')
@include('flash::message')
@include('utils.errors.list')

<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">{{trans('register.register_new_member') }}</h6>
       
    </div>
    <div class="card-body">
        @if($product->quantity < 1)
            <marquee style="color:red!important;">Product Out Of Stock !!!</marquee>
         @endif
        <form class="form-vertical steps-validation" action="{{url('admin/register')}}" method="POST" data-parsley-validate="true" name="form-wizard" id="regform" enctype="multipart/form-data">
          {!! csrf_field() !!}
            <input type="hidden" name="payable_vouchers[]" value="">
            <input type="hidden" name="payment" id="payment" value="bankwire">
            <input type="hidden" name="amount" value="{{$joiningfee}}"> 
            <input type="hidden" name="payment_method" value="card">
            <input type="hidden" name="currency" value="USD">
            <input type="hidden" name="joiningfee" id="joiningfee" amount="{{$joiningfee}}">
            <input type="hidden" name="leg" id="leg" value="{{$leg}}">
            <h6 class="width-full">{{trans('register.profile_information') }}</h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-0']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_firstname") !!}</small>
                                @if ($errors->has('firstname'))
                                <strong>{{ $errors->first('firstname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control lastname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-0']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_lastname") !!}</small>
                                @if ($errors->has('lastname'))
                                <strong>{{ $errors->first('lastname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', trans("register.email"), array('class' => 'col-form-label')) !!} {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','id' => 'email','data-parsley-required-message' => trans("all.please_enter_email"),'data-parsley-group' => 'block-0','data-parsley-email'=>"null"]) !!}
                           
                            <span class="form-text">
                                <small>{!!trans("all.type_your_email") !!}</small>
                                @if ($errors->has('email'))
                                <strong>{{ $errors->first('email') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('passport') ? ' has-error' : '' }}">
                            {!! Form::label('passport', trans("register.i_c_number"), array('class' => 'col-form-label')) !!} {!! Form::text('passport', Input::old('passport'), ['class' => 'form-control','required' => 'required','id' => 'passport','data-parsley-required-message' => trans("all.please_enter_passport"),'data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.type_your_passport_number") !!}</small>
                                @if ($errors->has('passport'))
                                <strong>{{ $errors->first('passport') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('front_ic') ? ' has-error' : '' }}">
                            {!! Form::label('front_ic', 'Front IC Upload', array('class' => 'col-form-label')) !!}
                             <input id="input" name="id_file" type="file"  multiple class="file-loading" required data-parsley-group="block-0" accept="image/jpg, image/jpeg, image/png, application/pdf">
                              <span style="font-size: 80%;font-weight: 400">jpeg,png,jpg,pdf {{trans('ticket_config.files_only')}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('back_ic') ? ' has-error' : '' }}">
                            {!! Form::label('back_ic', 'Back IC Upload', array('class' => 'col-form-label')) !!}
                            <input id="input" name="id_file_back" type="file"  multiple class="file-loading" required data-parsley-group="block-0" accept="image/jpg, image/jpeg, image/png, application/pdf">
                            <span style="font-size: 80%;font-weight: 400">jpeg,png,jpg,pdf {{trans('ticket_config.files_only')}}</span>
                            <br>
                            <a data-target="#myModal" data-toggle="modal" class="MainNavText" id="MainNavHelp" href="#myModal" style="font-weight: bold;color: red">How to upload?</a>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" style="overflow: auto !important;">
                            <center> 
                            <embed src="{{url('/uploads/documents/rule.png')}}" style="width:700px; height:auto;" frameborder="0">
                            </center>
                            </div>                 
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                  <!--   <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <img src="{{url('/uploads/documents/rule.png')}}" alt="SHEHEME" width="600" height="333">
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'col-form-label')) !!}
                            <input class="form-control" value="{{Auth::user()->username}}" required="required" data-parsley-required-message="{{trans('all.please_enter_sponsor_name')}}" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null">
                            <span class="form-text sponsordata">
                                {{Auth::user()->username}} : {{Auth::user()->name}} {{Auth::user()->lastname}}
                            </span>
                            <div class="form-control-feedback">
                                <i class="icon-person text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.type_your_sponsor_username") !!}</small>
                                @if ($errors->has('sponsor'))
                                <strong>{{ $errors->first('sponsor') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    @if($leg)
                    <div class="col-md-4">
                        <div class="required form-group{{ $errors->has('placement_user') ? ' has-error' : '' }}">
                            {!! Form::label('placement_user', trans("all.placement_username"), array('class' => 'col-form-label')) !!} {!! Form::text('placement_user', $placement_user, [ 'id' => 'key-word-placement','class' => 'form-control placementUser','required' => 'required','data-parsley-required-message' => trans("all.please_enter_placement_username") ,'data-parsley-group' => 'block-0','value' => $placement_user]) !!}
                            <span class="form-text placementdata">
                                {{$placementdata->username}} : {{$placementdata->name}} {{$placementdata->lastname}}
                            </span>
                        </div>
                    </div> 
                    @else @if($placement_user) 
                    <input type="hidden" name="placement_user" placeholder="{{trans('register.placement_username')}}" class="form-control" value="{{$placement_user}}" required > @endif @endif
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('leg') ? ' has-error' : '' }}">
                            {!! Form::label('leg', trans("register.position"), array('class' => 'col-form-label',($leg)? 'readonly' : "")) !!}
                            <select class="form-control select leg" name="leg" id="leg" required data-parsley-group="block-0">
                                <option @if($leg=='L' ) selected @endif @if($vaccant_count == 1) @if($leg=='R' ) disabled @endif @endif value="L"> Left</option>
                                <option @if($leg=='R' ) selected @endif @if($vaccant_count == 1) @if($leg=='L' ) disabled @endif @endif value="R">Right</option>
                            </select>
                            <div class="form-control-feedback">
                                <i class=" icon-drag-left-right text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.enter_position") !!}</small>
                                @if ($errors->has('leg'))
                                <strong>{{ $errors->first('leg') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" name="phone_code" id="phone_code" value="">
                        <div class="required form-group-feedback-right {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone', trans("register.phone"), array('class' => 'col-form-label')) !!} {!! Form::tel('phone', Input::old('phone'), ['class' => 'form-control','id' => 'phone','required'=>'required','data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-0']) !!}
                          
                            <span class="form-text">
                                <small>{!!trans("all.enter_your_phone_number") !!}</small>
                                @if ($errors->has('phone'))
                                <strong>{{ $errors->first('phone') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="passy required form-group-feedback-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', trans("register.password"), array('class' => 'col-form-label')) !!}
                            <div class="form-group label-indicator-absolute position-relative">
                                {!! Form::password('password', ['class' => 'form-control pwstrength','required' => 'required','id' => 'password','data-parsley-required-message' => trans("all.please_enter_password"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-0']) !!}
                                <div class="form-control-feedback form-control-feedback-lg">
                                <!-- <span class="label password-indicator-label-abs">Strong</span>     -->
                            </div>
                                                      
                            </div>
                            
                             <span class="form-text">
                                <small>{!!trans("all.a_secure_password") !!}</small>
                                @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('confirm_password', trans("register.confirm_password"), array('class' => 'col-form-label')) !!} {!! Form::password('confirm_password',['class' => 'form-control','required' => 'required','id' => 'confirm_password','data-parsley-equalto' => '#password','data-parsley-required-message' => trans("all.please_enter_password_confirmation"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-0']) !!}
                           
                            <span class="form-text">
                                <small>{!!trans("all.confirm_your_password") !!}</small>
                                @if ($errors->has('confirm_password'))
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </fieldset>
            <h6 class="width-full">  {{trans('register.product_selection') }}  </h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('package') ? ' has-error' : '' }}">
                            {!! Form::label('package', trans("register.package"), array('class' => 'col-form-label')) !!}
                            <select class="form-control select package" name="package" id="package" required="required" data-parsley-required-message="Please Select Package" data-parsley-group="block-1" data-parsley-package="null">
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
                                <h4 class="modal-title">SHEHEME</h4>
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
                                <img src="/uploads/documents/{{$product->image}}" alt="Facial Cell Revive Essence" title="Facial Cell Revive Essence" class="img-responsive">
                            </div>
                            <div>
                                <div class="caption">
                                    <h4>
                                            {{$product->name}}
                                    </h4>
                                    <p>{{$product->description}}..</p>
                                    <p class="price"> MYR <span id="price">{{$product->price}}</span></p>
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
                                <div class="alert" id ="warning-alert" role="alert">
                                </div>
                            </div>
                            @else
                               <marquee style="color:red!important;">Product Out Of Stock !!!</marquee>
                            @endif
                        </div>
                    </div>
                </div>
                @if($product->quantity > 0)
                <div class="row">
                    <div class="col-md-12" style="padding: 20px">
                        <input type="checkbox" style="width: 22px;" class="styled"  id="check" name="check" required="required" data-parsley-group="block-1">&nbsp;&nbsp;&nbsp; I Have Read And Accept The  <a aria-hidden="true" data-toggle="modal" data-target="#myModal1"  style="color: #4bb3d1;"><b>Terms & Conditions And Privacy Policy</b></a>
                    </div>
                </div>
                 <div class="modal fade" id="myModal1" role="dialog" tabindex="-1" value=" ">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                       <embed src="{{{URL::to('get-document/SHEHEME_Terms_and_Conditions.pdf') }}} " style="width: 100%;"  allowfullscreen>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                @endif
            </fieldset>
            <h6 class="width-full">  {{trans('register.billing_info/Shipping_address') }}   </h6>
            <fieldset>
                <br>
                <h4 class="width-full">  {{trans('register.billing_address') }}   </h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('billing_firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_firstname', Input::old('billing_firstname'), ['class' => 'form-control billing_firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_lastname', Input::old('billing_lastname'), ['class' => 'form-control billing_lastname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address', Input::old('address'), ['class' => 'form-control','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address2', Input::old('address2'), ['class' => 'form-control','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                            {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('city', Input::old('city'), ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-2']) !!}
                            
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
                            {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('zip', Input::old('zip'), ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-2','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
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
                                    @if($key=="MY")
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
                                @foreach($states as $key=>$state)
                                <option value="{{$key}}">{{$state}}</option>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="transaction_pass" class="form-control" placeholder="Transaction Password " value="{{$transaction_pass}}">
                        </div>
                    </div>
                </div>
                <br>
                <h4 class="width-full">  Shipping Address   </h4>
                <br>
                <input type="checkbox" id="shipping" name="shipping" value="yes" checked="true">
                <label for="shipping"> Same as billing address</label><br>
                <div class="shipping_address">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="required form-group {{ $errors->has('shipping_firstname') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_firstname', Input::old('shipping_firstname'), ['class' => 'form-control shipping_firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_lastname', Input::old('shipping_lastname'), ['class' => 'form-control shipping_lastname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('shipping_address', Input::old('shipping_address'), ['class' => 'form-control shipping_address','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('shipping_address2', Input::old('shipping_address2'), ['class' => 'form-control shipping_address2','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-2']) !!}
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
                                {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_city', Input::old('shipping_city'), ['class' => 'form-control shipping_city','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-2']) !!}
                                
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
                                {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_zip', Input::old('shipping_zip'), ['class' => 'form-control shipping_zip','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-2','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror12' ]) !!}
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
                                        @if($key=="MY")
                                        <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                        @else
                                        <option value="{{$key}}" >{{$country_item}}</option>
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
                                    @foreach($states as $key=>$state)
                                    <option value="{{$key}}">{{$state}}</option>
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
                                <a class="nav-link active" payment="{{$payment->code}}" data-toggle="tab" id="{{$payment->code}}" href="#tab{{$k}}" role="tab" >
                                <br/>{{$payment->payment_name}}</a>
                            </li>
                            @else
                            <li class="nav-item" payment="{{$payment->code}}">
                            <a class="nav-link" payment="{{$payment->code}}" data-toggle="tab" id="{{$payment->code}}" href="#tab{{$k}}">
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
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
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
                                </div> 
                                @elseif($pay->payment_name=="Register Point")
                                <div class="tab-pane register_point" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center basic">
                                        <h1> <p class="text-info">
                                            {{trans("all.sponsor")}} : <span class="sponsor-name"></span>
                                            <br>
                                            RP:<span class="register-point"></span>
                                            <br>
                                            RP Payment:<span class="register-point-used"></span>
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
                                    <div class="text-center other">
                                        <h1> <p class="text-info"> Only Basic Package Can Purchase Using Register Point
                                        </p></h1>
                                    </div>
                                </div> 
                                @elseif($pay->payment_name=="Bankwire")
                                <div class="tab-pane active bankwire" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4">
                                             </div>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    
                                                    {!! Form::label('sponsor', 'Banking slip ', array('class' => 'col-form-label', 'style' =>'text-align: unset!important;font-weight: bold;')) !!}
                                                    <span class="col-form-label" style="font-size: 80%;font-weight: 400"> ( doc,docx,pdf,jpeg,png,jpg {{trans('ticket_config.files_only')}} )</span><br>
                                                  
                                                </div>
                                                <div class="row">
                                                      <center>SHEHEME ENTERPRISE <br>
                                                            Public Bank Berhad <br>
                                                            Acc No:3221020636  <br>
                                                    </center>
                                                    <br>
                                                </div>

                                                <div class="row">
                                                    <input id="bank_file" name="bank_file" type="file"  multiple class="file-loading" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain,application/pdf,image/jpg, image/jpeg, image/png">
                                                    <br>
                                                    <div class="alert alert-danger" id="alert-danger" role="alert">Banking slip is Required</div>
                                                    <br>
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
                                                data-name="register"
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

                                    <input type="hidden" name="detail" value="Registration">
                                        
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
            $message = 'Please add '+ rem +' more product to fulfill your order.';
            $('#warning-alert').show();
            $('#warning-alert').removeClass('alert-success');   
            $('#warning-alert').addClass('alert-warning');   
            $('#warning-alert').text($message);
        }
        else{
            $message = 'You added required product.';   
            $('#warning-alert').show();
            $('#warning-alert').removeClass('alert-warning');   
            $('#warning-alert').addClass('alert-success');   
            $('#warning-alert').text($message);  
            $.ajax({
              type:"GET",
              url:"{{url('ajax/get-package')}}?quanttity="+quantity,
              success:function(res){               
                if(res.package > 0)
                    $(".package").val(res.package);
                else
                    $(".package").val(0);
              }
           }); 
        }
        if(quantity < 25){
            $('#register_point').show();
            $('.basic').show();
            $('.other').hide();
        }
        else{
            $('#register_point').hide();
            $('.basic').hide();
            $('.other').show();
            $("#bankwire").addClass("active");
            $(".bankwire").addClass("active");
            $("#register_point").removeClass("active");
            $(".register_point").removeClass("active");
        }
    });
    $(document).ready(function() {
        $('#warning-alert').hide();
        $('#alert-danger').hide();
        $('#alert-danger-rp').hide();
        $('#alert-danger-date').hide();
        $(".shipping_address").hide();
        $('.shipping_firstname').removeAttr('required');
        $('.shipping_lastname').removeAttr('required');
        $('.shipping_address').removeAttr('required');
        $('.shipping_address2').removeAttr('required');
        $('.shipping_city').removeAttr('required');
        $('.shipping_zip').removeAttr('required');
        $('.shipping_country').removeAttr('required');
        $('.shipping_state').removeAttr('required');
        $('#shipping').change(function() {
            $('.shipping_address').show();
            $('.shipping_firstname').attr('required',true);
            $('.shipping_lastname').attr('required',true);
            $('.shipping_address').attr('required',true);
            $('.shipping_address2').attr('required',true);
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
<script type="text/javascript">
</script>
<script type="text/javascript">
$(document).ready(function () {
    var placementcheck = {{$placementcheck}};
    console.log(placementcheck);
    if(placementcheck == 0){
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/register/placement_data',
            type: "post",
            async: false,
            dataType: "json",
            data: {
                sponsor: $("#sponsor").val()
            },
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                $(".leg option:contains('Left')").attr("disabled",false);
                $(".leg option:contains('Right')").attr("disabled",false);
                $(".placementUser").val(data.placement_user);
                $(".sponsordata").text(data.value);
                $(".placementdata").text(data.placementvalue);
                $(".leg").val(data.leg);
                if(data.vaccant_count == 1){
                    if(data.leg == 'L') 
                        var variable = "Right"
                    else
                        var variable = "Left"

                    $(".leg option:contains('" + variable + "')").attr("disabled","disabled");
                }
                else{
                    $(".leg option:contains('Left')").attr("disabled",false);
                    $(".leg option:contains('Right')").attr("disabled",false);
                }
            }
        });
    }

});
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
    $('.firstname').change(function(){
        $(".billing_firstname").val($(this).val());
        $(".shipping_firstname").val($(this).val());
    });
    $('.lastname').change(function(){
        $(".billing_lastname").val($(this).val());
        $(".shipping_lastname").val($(this).val());
    });
    $('#package').change(function(){
      $('#quantity').val(1)
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
        var description = 'You need to purchase minimum '+ count +' product ('+ pv +' BV)';
        $('.modal-title').html(name);
        $('.modal-body').html(description);
        $('#test').modal('show');
      }
      var quantity    = document.getElementById('quantity').value;
      var rem = count - quantity;
        if(rem > 0) {
            $message = 'Please add '+ rem +' more product to fulfill your order.';
            $('#warning-alert').show();
            $('#warning-alert').removeClass('alert-success');   
            $('#warning-alert').addClass('alert-warning');   
            $('#warning-alert').text($message);
        }
        else{
            $message = 'You added required product.';   
            $('#warning-alert').show();
            $('#warning-alert').removeClass('alert-warning');   
            $('#warning-alert').addClass('alert-success');   
            $('#warning-alert').text($message);   
        }
        if(quantity < 25){
            $('#register_point').show();
            $('.basic').show();
            $('.other').hide();
        }
        else{
            $('#register_point').hide();
            $('.basic').hide();
            $('.other').show();
            $("#bankwire").addClass("active");
            $(".bankwire").addClass("active");
            $("#register_point").removeClass("active");
            $(".register_point").removeClass("active");
        }
    });
</script>
    <script>

        $(document).ready(function() {

           

            $(".datetimepicker").datepicker()          

        });

  
             



    </script>
@endsection