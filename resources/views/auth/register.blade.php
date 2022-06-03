@extends('layouts.auth_store')
@section('styles') @parent
<style type="text/css">
li.parsley-required {
    color: red;
}
.wizard > .steps > ul > li.current > a {
    color: #4ebcd8;
    cursor: default;
}
ul#parsley-id-9 {
    color: red;
}
ul#parsley-id-27 {
    color: red;
}
.iti__flag-box, .iti__country-name {
    color: black;
}
.iti--separate-dial-code .iti__selected-dial-code {
    color: white;
}
.product-thumb .image img {
    height: 400px;
    width: 300px;
}
.form-group-feedback-right .form-control {
    padding-right: 0px;
}
select.form-control:not([size]):not([multiple]) {
     height: 41px; 
}
</style>
<script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset ('assets/css/script.js') }}"></script>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">

<link href="{{ asset ('assets/css/stylesheet.css') }}" rel="stylesheet">
<link href="{{ asset ('assets/css/TemplateTrip/menu.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset ('assets/css/TemplateTrip/ttheader-footer-setting.css') }}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ asset ('assets/css/TemplateTrip/TemplateTrip/bootstrap.min.css') }}" rel="stylesheet" media="screen" /> -->

<link rel="stylesheet" href="{{ asset ('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset ('assets/css/intl-tel-input/build/css/intlTelInput.css') }}"/>
<script src="{{ asset ('assets/css/intl-tel-input/build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset ('assets/css/intl-tel-input/build/js/intlTelInput.min.js') }}"></script>
<style type="text/css">
.iti__flag {background-image: url("../assets/css/intl-tel-input/build/img/flags.png");}
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .iti__flag {background-image: url("../assets/css/intl-tel-input/build/img/flags@2x.png");}
}
.inttl{
    padding-left: 100px!important;
}    
.wizard>.actions>ul>li>a[href="#finish"] {
    display: none
}

</style>
@endsection
@section('content')
@include('flash::message')
@include('utils.errors.list')

<div class="content">

<div class="row" style="    margin-top: 10px;">

    <div class="col-lg-8 offset-lg-2">
        <div class="card mb-0">
       
                <div class="text-center mb-3">
                 <img src="{{ url('img/cache/original/'.$logo_light)}}" alt="{{ config('app.name', 'Cloud MLM Software') }}" class="rounded-circle" style="height:100px;width:150px;margin-left:8px;margin-top: 15px;">
                <h2 class="mb-0 font-weight-bold">ENROL PARTNER</h2>
                                <!-- <span class="d-block text-muted">All fields are required</span> -->
                </div>
                  <form class="form-vertical steps-validation" action="{{url('register')}}" method="POST" data-parsley-validate="true" name="form-wizard" id="regform" enctype="multipart/form-data">
            {!! csrf_field() !!}
           <input type="hidden" name="payable_vouchers[]" value="">
            <input type="hidden" name="payment" id="payment" value="bankwire">
             <input type="hidden" name="amount" value="{{$joiningfee}}"> 
            <input type="hidden" name="payment_method" value="card">
            <input type="hidden" name="package" value="1">
            <input type="hidden" name="currency" value="USD">
            <input type="hidden" name="leg" value="{{$leg}}">
             <input type="hidden" name="joiningfee" id="joiningfee" amount="{{$joiningfee}}">
              <h6 class="width-full">Profile Information</h6>
            <fieldset>
                <div class="row">
                <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'col-form-label')) !!}
                            {!! Form::text('sponsor', Input::old('sponsor'), ['class' => 'form-control sponsor','required' => 'required','data-parsley-required-message' => trans("please enter sponsor name"),'data-parsley-group' => 'block-0']) !!}

                            <span class="form-text sponsordata">
                            </span>
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_sponsor_username") !!}</small> -->
                                @if ($errors->has('sponsor'))
                                <strong>{{ $errors->first('sponsor') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('name','Username', array('class' => 'col-form-label')) !!} {!! Form::text('username', Input::old('username'), ['class' => 'form-control username','required' => 'required','data-parsley-required-message' => trans("please enter user username"),'data-parsley-group' => 'block-0']) !!}
                            <span class="form-text">
                                <!-- <small>{!!trans("all.your_firstname") !!}</small> -->
                                @if ($errors->has('username'))
                                <strong>{{ $errors->first('username') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div> 

                 </div>
             
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-0']) !!}
                            <span class="form-text">
                                <!-- <small>{!!trans("all.your_firstname") !!}</small> -->
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
                                <!-- <small>{!!trans("all.your_lastname") !!}</small> -->
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
                                <!-- <small>{!!trans("all.type_your_email") !!}</small> -->
                                @if ($errors->has('email'))
                                <strong>{{ $errors->first('email') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                

          
                <div class="row">
                      <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('dateofbirth') ? ' has-error' : '' }}">
                          {!! Form::label('name', trans("Date of Birth"), array('class' => 'col-form-label')) !!} {!! Form::date('dateofbirth', Input::old('dateofbirth'), ['class' => 'form-control bg-transparent date-slashes','id' => 'dateofbirth','placeholder' =>'MM/DD/YYYY','required' => 'required','data-parsley-required-message' => trans("Please Enter Your Date of Birth"),'data-parsley-group' => 'block-0']) !!}
                            <span class="form-text">
                                <!-- <small>{!!trans("Enter Your Date of birth") !!}</small> -->
                                @if ($errors->has('dateofbirth'))
                                <strong>{{ $errors->first('dateofbirth') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>

                        <div class="col-md-6">
                        <input type="hidden" name="phone_code" id="phone_code" value="">
                        <div class="required form-group-feedback-right {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone', trans("register.phone"), array('class' => 'col-form-label')) !!} {!! Form::tel('phone', Input::old('phone'), ['class' => 'form-control','id' => 'phone','required'=>'required','data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-0']) !!}
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.enter_your_phone_number") !!}</small> -->
                                @if ($errors->has('phone'))
                                <strong>{{ $errors->first('phone') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('facebook_username') ? ' has-error' : '' }}">
                            {!! Form::label('facebook_username', 'Facebook URL', array('class' => 'col-form-label')) !!} {!! Form::text('facebook_username', Input::old('facebook_username'), ['class' => 'form-control','id' => 'facebook_username','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_passport_number") !!}</small> -->
                                @if ($errors->has('facebook_username'))
                                <strong>{{ $errors->first('facebook_username') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
                    <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('WeChat_id') ? ' has-error' : '' }}">
                            {!! Form::label('WeChat_id ', 'We-chat id', array('class' => 'col-form-label')) !!} {!! Form::text('WeChat_id', Input::old('WeChat_id'), ['class' => 'form-control','id' => 'WeChat_id','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_passport_number") !!}</small> -->
                                @if ($errors->has('We-chat id'))
                                <strong>{{ $errors->first('We-chat id') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
                   <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('Instagram_Id') ? ' has-error' : '' }}">
                            {!! Form::label('Instagram_Id ', 'Instagram Id', array('class' => 'col-form-label')) !!} {!! Form::text('Instagram_Id', Input::old('Instagram_Id'), ['class' => 'form-control','id' => 'Instagram_Id','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_pasInstagram Idsport_number") !!}</small> -->
                                @if ($errors->has('Instagram_Id'))
                                <strong>{{ $errors->first('Instagram_Id') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
                   <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('tiktok_id') ? ' has-error' : '' }}">
                            {!! Form::label('tiktok_id', 'TikTok', array('class' => 'col-form-label')) !!} {!! Form::text('tiktok_id', Input::old('tiktok_id'), ['class' => 'form-control','id' => 'tiktok_id','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_passport_number") !!}</small> -->
                                @if ($errors->has('tiktok_id'))
                                <strong>{{ $errors->first('tiktok_id') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
            </div>
                 <div class="row">
                    <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('Shopee_Shop_Name') ? ' has-error' : '' }}">
                            {!! Form::label('Shopee_Shop_Name', 'Shopee Shop Name', array('class' => 'col-form-label')) !!} {!! Form::text('Shopee_Shop_Name', Input::old('Shopee_Shop_Name'), ['class' => 'form-control','id' => 'Shopee_Shop_Name','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_passport_number") !!}</small> -->
                                @if ($errors->has('Shopee_Shop_Name'))
                                <strong>{{ $errors->first('Shopee_Shop_Name') }}</strong>
                                @endif
                         </span>
                    </div>
                </div>
                    <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('Lazada_Shop_name ') ? ' has-error' : '' }}">
                            {!! Form::label('Lazada_Shop_name', 'Lazada Shop name', array('class' => 'col-form-label')) !!} {!! Form::text('Lazada_Shop_name', Input::old('Lazada_Shop_name'), ['class' => 'form-control','id' => 'Lazada_Shop_name','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_passport_number") !!}</small> -->
                                @if ($errors->has('Lazada_Shop_name'))
                                <strong>{{ $errors->first('Lazada_Shop_name') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
                   <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('twitter_username') ? ' has-error' : '' }}">
                            {!! Form::label('twitter_username ', 'Twitter', array('class' => 'col-form-label')) !!} {!! Form::text('twitter_username', Input::old('twitter_username'), ['class' => 'form-control','id' => 'twitter_username','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_pasInstagram Idsport_number") !!}</small> -->
                                @if ($errors->has('twitter_username'))
                                <strong>{{ $errors->first('twitter_username') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
                 <div class="col-md-3">
                     <div class="required form-group-feedback-right {{ $errors->has('twitter_username') ? ' has-error' : '' }}">
                            {!! Form::label('youtube_username ', 'Youtube', array('class' => 'col-form-label')) !!} {!! Form::text('youtube_username', Input::old('youtube_username'), ['class' => 'form-control','id' => 'youtube_username','data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-mutFacebook URLed"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_pasInstagram Idsport_number") !!}</small> -->
                                @if ($errors->has('youtube_username'))
                                <strong>{{ $errors->first('youtube_username') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>




                    </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="passy required form-group-feedback-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', trans("register.password"), array('class' => 'col-form-label')) !!}
                            <div class="form-group label-indicator-absolute position-relative">
                                {!! Form::password('password', ['class' => 'form-control pwstrength','required' => 'required','id' => 'password','data-parsley-required-message' => trans("all.please_enter_password"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-0']) !!}
                                <div class="form-control-feedback form-control-feedback-lg">
                                <!-- <span class="label password-indicator-label-abs">Strong</span>     -->
                            </div>
                                                      
                            </div>

                            
                             <span class="form-text">
                                <!-- <small>{!!trans("all.a_secure_password") !!}</small> -->
                                @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('confirm_password', trans("register.confirm_password"), array('class' => 'col-form-label')) !!} {!! Form::password('confirm_password',['class' => 'form-control','required' => 'required','id' => 'confirm_password','data-parsley-equalto' => '#password','data-parsley-required-message' => trans("all.please_enter_password_confirmation"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-0']) !!}
                           
                            <span class="form-text">
                                <!-- <small>{!!trans("all.confirm_your_password") !!}</small> -->
                                @if ($errors->has('confirm_password'))
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>

                </div>
               

                <div class="row">
                <div class="col-md-4">
                  <div class="required form-group-feedback-right {{ $errors->has('passport') ? ' has-error' : '' }}">
                            {!! Form::label('passport', trans("register.i_c_number"), array('class' => 'col-form-label')) !!} {!! Form::text('passport', Input::old('passport'), ['class' => 'form-control','required' => 'required','id' => 'passport','data-parsley-required-message' => trans("Please enter your IC Number"),'data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <!-- <i class="icon-user-check text-muted"></i> -->
                            </div>
                          
                            <span class="form-text">
                                <!-- <small>{!!trans("all.type_your_passport_number") !!}</small> -->
                                @if ($errors->has('passport'))
                                <strong>{{ $errors->first('passport') }}</strong>
                                @endif
                            </span>
                    </div>
                </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('front_ic') ? ' has-error' : '' }}">
                            {!! Form::label('front_ic', 'Front IC Upload', array('class' => 'col-form-label')) !!}


                            <input id="Ic_image_Input" name="id_file" type="file"  multiple class="file-loading" required data-parsley-group="block-0" accept="image/jpg, image/jpeg, image/png" >

                           
                            <img id="Front_Ic_image" width="200px"  />

                            <span style="font-size: 80%;font-weight: 400">jpeg,png,jpg files only</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('back_ic') ? ' has-error' : '' }}">
                            {!! Form::label('back_ic', 'Back IC Upload', array('class' => 'col-form-label')) !!}
                            <input id="Ic_backimage_Input" name="id_file_back" type="file"  multiple class="file-loading" required data-parsley-group="block-0" accept="image/jpg, image/jpeg, image/png">
                           <img id="Ic_back_image" width="200px"  />
                            <span style="font-size: 80%;font-weight: 400">jpeg,png,jpg {{trans('ticket_config.files_only')}}</span>
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
                </div>

            </fieldset>
            <h6 class="width-full">  Product Selection  </h6>
            <fieldset>
                 <div class="row pt-4 pb-4">

                    @foreach($product as $products)

                    <div class="col-md-4 text-center">
                        <div class="mb-2">
                            <img src="{{url('/uploads/documents/'.$products->image)}}" class="img-responsive" style="width: 70px;height: 70px;">
                        </div>       
                             {{$products->name}}<br>
                         <h4>PRICE:{{$products->price}}</h4><br>

                             <input type="checkbox" value="{{$products->id}}" name="product_ids[]" value="true" >

                             <input class="form-control product" type="number" name="product[{{$products->id}}]" min="0" max="2" value="0" id="product">
                            

                <!--            <input type="button" value="Add to cart" onclick="getnumber()"/>   -->
                            <!-- <div class="quantity buttons_added ">
                            <input type="button" value="-" class="minus">
                            <input type="number" step="1" min="1" id="quantity" name="quantity" value="1" class="input-text qty text text-white" size="4" max="2">
                            <input type="button" value="+" class="plus">
                            </div>  -->
                    </div>
                     @endforeach
                         <input type="hidden" name="counthidden" id="counthidden" class="form-control">
             
                     
               </div> 
            </fieldset>
            <h6 class="width-full">  Billing Info/Shipping Address   </h6>
            <fieldset>
                <br>
                <h4 class="width-full" style="color: white">  Billing Address   </h4>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('billing_firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('billing_firstname', Input::old('billing_firstname'), ['class' => 'form-control billing_firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-2']) !!}
                            <span class="form-text">
                                <!-- <small>{!!trans("all.your_firstname") !!}</small> -->
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
                                <!-- <small>{!!trans("all.your_lastname") !!}</small> -->
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
                                <!-- <small>{!!trans("all.your_address") !!}</small> -->
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
                                <!-- <small>{!!trans("all.your_address") !!}</small> -->
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
                                <!-- <small>{!!trans("all.your_city") !!}</small> -->

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
                            <!-- <small>{!!trans("all.your_zip") !!}</small> -->
                                @if ($errors->has('zip'))
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
                            <select name="country" class="form-control select" data-parsley-group="wizard-step-3" id="country" required>
                                @foreach($countries as $key => $country_item)
                                    @if($key=="MY")
                                    <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                    @else
                                    <option value="{{$key}}" >{{$country_item}}</option>
                                    @endif
                                @endforeach
                            </select>
                           
                            <span class="form-text">
                                <!-- <small>{!!trans("all.select_country") !!}</small> -->
                                @if ($errors->has('country'))
                                <strong>{{ $errors->first('country') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                        {!! Form::label('state', trans("register.state"), array('class' => 'col-form-label')) !!} 
                            <select name="state" class="form-control select" data-parsley-group="wizard-step-3" id="state" required >
                                @foreach($states as $key=>$state)
                                <option value="{{$key}}">{{$state}}</option>
                                @endforeach
                            </select>
                            <span class="form-text">
                                <!-- <small>{!!trans("all.select_your_state") !!}</small> -->
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
                <h4 class="width-full" style="color: white">  Shipping Address   </h4>
                <br>
                <input type="checkbox" id="shipping" name="shipping" value="yes" checked="true">
                <label for="shipping"> Same as billing address</label><br>
                <div class="shipping_address">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="required form-group {{ $errors->has('shipping_firstname') ? ' has-error' : '' }}">
                                {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('shipping_firstname', Input::old('shipping_firstname'), ['class' => 'form-control shipping_firstname','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-2']) !!}
                                <span class="form-text">
                                    <!-- <small>{!!trans("all.your_firstname") !!}</small> -->
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
                                    <!-- <small>{!!trans("all.your_lastname") !!}</small> -->
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
                                    <!-- <small>{!!trans("all.your_address") !!}</small> -->
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
                                    <!-- <small>{!!trans("all.your_address") !!}</small> -->
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
                                    <!-- <small>{!!trans("all.your_city") !!}</small> -->
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
                                <!-- <small>{!!trans("all.your_zip") !!}</small> -->
                                 @if ($errors->has('shipping_zip'))
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
                                <select name="shipping_country" class="form-control shipping_country select" data-parsley-group="wizard-step-2" id="shipping_country" required>
                                    @foreach($countries as $key => $country_item)
                                        @if($key=="MY")
                                        <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                        @else
                                        <option value="{{$key}}" >{{$country_item}}</option>
                                        @endif
                                    @endforeach
                                </select>
                               
                                <span class="form-text">
                                    <!-- <small>{!!trans("all.select_country") !!}</small> -->
                                    @if ($errors->has('shipping_country'))
                                    <strong>{{ $errors->first('shipping_country') }}</strong>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="required form-group{{ $errors->has('shipping_state') ? ' has-error' : '' }}">
                            {!! Form::label('state', trans("register.state"), array('class' => 'col-form-label')) !!} 
                                <select name="shipping_state" class="form-control state select" data-parsley-group="wizard-step-2" id="shipping_state" required >
                                    @foreach($states as $key=>$state)
                                    <option value="{{$key}}">{{$state}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text">
                                    <!-- <small>{!!trans("all.select_your_state") !!}</small> -->
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
                                <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
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
                                </div> 
                                @elseif($pay->payment_name=="Bankwire")
                                <div class="tab-pane active" id="tab{{$ke}}" role="tabpanel">
                                    <div class="text-center">
                                        <div class="row">
                                           <!--  <div class="col-sm-4">
                                             </div> -->
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
                                                    <input id="bank_file" name="bank_file" type="file"  multiple class="file-loading" accept="image/jpg, image/jpeg, image/png ,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain,application/pdf" required="required">              
                                                    <br>
                                                    <!-- <div class="alert alert-danger" id="alert-danger" role="alert">Banking slip is Required</div> -->
                                                </div>
                                                <div class="row">
                                                    <label for="date" class="control-label">Pick Payment Date:</label>
                                                    <input type="date" class="form-control" value="" id="date" name="date" style="width: 78%background-color: white;">
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
                                                                <!-- <small>{!!trans("register.your_card_number") !!}</small> -->
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
                                                                <!-- <small>{!!trans("register.cvv") !!}</small> -->
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
                                                                <!-- <small>{!!trans("register.your_expirationdate") !!}</small> -->
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
                                                                <!-- <small>{!!trans("register.your_expirationdate") !!}</small> -->
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
    </div>
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

<!-- <script src="https://checkout.stripe.com/checkout.js"></script>
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
    var amount   = document.getElementById('price').innerHTML;
    var total_amount = quantity * amount ; 
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
    if(register_point < total_amount && user_id > 1) {
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
</script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<!-- <script type="text/javascript">
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
</script> -->
<!-- <script src="../assets/css/intl-tel-input/build/js/intlTelInput.js"></script> -->


<!-- <script src="../assets/css/javascript/TemplateTrip/menu.js"></script> -->








<script type="text/javascript">
    $(document).ready(function () {
        var input = document.querySelector("#phone");
        var iti =window.intlTelInput(input, {
            separateDialCode: true,
            utilsScript :'../assets/css/intl-tel-input/build/js/utils.js',
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
    });
</script>

<script type="text/javascript">
document.getElementById('Ic_image_Input').onchange = function () {
  var src = URL.createObjectURL(this.files[0])
  document.getElementById('Front_Ic_image').src = src
}
</script>
<script type="text/javascript">
document.getElementById('Ic_backimage_Input').onchange = function () {
  var src = URL.createObjectURL(this.files[0])
  document.getElementById('Ic_back_image').src = src
}
</script>

<script type="text/javascript"> 
 $(".product").on("keyup change", function(e) {
    var product_count = 0;
    $("input[class *= 'product']").each(function(){

        product_count += +$(this).val();
    });

  $("#counthidden").val(product_count);

    if (product_count>2)
    alert("You can only purchase two items!");
 
})
</script>  

@endsection

