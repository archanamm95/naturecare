<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Join</h5>
                    <span class="d-block text-muted">All fields are required</span>
                </div>
               <form class="form-vertical steps-validation" action="{{url('user/register')}}" method="POST" data-parsley-validate="true" name="form-wizard">
            {!! csrf_field() !!}
           <input type="hidden" name="payable_vouchers[]" value="">
            <input type="hidden" name="payment" id="payment" value="cheque">
             <input type="hidden" name="amount" value="{{$joiningfee}}"> 
            <input type="hidden" name="payment_method" value="card">
            <input type="hidden" name="currency" value="USD">
            <h6 class="width-full">{{trans('register.network_information') }}  </h6>
     
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'col-form-label')) !!}
                              <input class="form-control" value="{!!(Input::old('sponsor_name'))?Input::old('sponsor_name') :$sponsor_name !!}" required="required" data-parsley-required-message="all.please_enter_sponsor_name" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null">

                            <!--data-parsley-remote="data-parsley-remote" data-parsley-remote-validator="validate_sponsor" data-parsley-remote-options='{ "type": "POST", "dataType": "jsonp", "data": { "csrf": {{csrf_token()}} } }' data-parsley-remote-message="all.there_is_no_user_with_that_username" data-parsley-trigger-after-failure="change" data-parsley-trigger="change" 
                            -->
                            <div class="form-control-feedback">
                                <i class="icon-person text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.type_your_sponsors_username") !!}</small>
                                @if ($errors->has('sponsor'))
                                <strong>{{ $errors->first('sponsor') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                     @if($leg)
                            <div class="col-md-4">
                                <div class="required form-group form-group-feedback-right {{ $errors->has('placement_user') ? ' has-error' : '' }}">
                                    {!! Form::label('placement_user', trans("all.placement_username"), array('class' => 'control-label')) !!} {!! Form::text('placement_user', $sponsor_name, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_placement_username") ,'data-parsley-group' => 'block-0','value' => $placement_user,'readonly']) !!}
                                </div>
                            </div>
                            @else @if($placement_user)
                            <input type="hidden" name="placement_user" placeholder="{{trans('register.placement_username')}}" class="form-control" value="{{$placement_user}}" required /> @endif @endif
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('leg') ? ' has-error' : '' }}">
                            {!! Form::label('leg', trans("register.position"), array('class' => 'col-form-label',($leg)? 'readonly' : "")) !!}
                            <select class="form-control select2" name="leg" id="leg" required data-parsley-group="block-0">
                                <option @if($leg=='L' ) selected @endif value="L">{{ trans('register.left')}}</option>
                                <option @if($leg=='R' ) selected @endif value="R">{{ trans('register.right')}}</option>
                            </select>
                            <div class="form-control-feedback">
                                <i class=" icon-drag-left-right text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.type_your_sponsors_username") !!}</small>
                                @if ($errors->has('sponsor_name'))
                                <strong>{{ $errors->first('sponsor_name') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('package') ? ' has-error' : '' }}">
                            {!! Form::label('package', trans("register.package"), array('class' => 'col-form-label')) !!}
                            <select class="form-control select2" name="package" id="package" required="required" data-parsley-required-message="Please Select Package" data-parsley-group="block-0">
                                @foreach($package as $data)
                                <option value="{{$data->id}}" amount="{{$data->amount}}" rs="{{$data->rs}}" pv="{{$data->pv}}">{{$data->package}} </option>
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
                </div>
         
            <h6 class="width-full">  {{trans('register.contact_information') }}  </h6>
   
                <div class="row">
                    <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.firstname"), array('class' => 'col-form-label')) !!} {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_firstname") !!}</small>
                                @if ($errors->has('firstname'))
                                <strong>{{ $errors->first('firstname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            {!! Form::label('lastname', trans("register.lastname"), array('class' => 'col-form-label')) !!} {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_lastname") !!}</small>
                                @if ($errors->has('lastname'))
                                <strong>{{ $errors->first('lastname') }}</strong>
                                @endif
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
                                    @if($key=="US")
                                    <option value="{{ $key }}" selected>{{ $country_item }}</option>
                                    @else
                                    <option value="{{$key}}" >{{$country_item}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="form-control-feedback">
                                <i class="fa fa-flag-o text-muted"></i>
                            </div>
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
                <!-- end row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::text('zip', Input::old('zip'), ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-1','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
                            <span class="form-text">
                                <span id="ziplocation"><span></span></span>
                            <span id="ziperror"></span>
                            <small>{!!trans("all.your_zip") !!}</small> @if ($errors->has('zip'))
                            <strong>{{ $errors->first('zip') }}</strong> @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            {!! Form::label('address', trans("register.address"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address', Input::old('address'), ['class' => 'form-control','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.your_address") !!}</small>
                                @if ($errors->has('address'))
                                <strong>{{ $errors->first('address') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('city') ? ' has-error' : '' }}">
                            {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('city', Input::old('city'), ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-city text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.your_city") !!}</small>
                                @if ($errors->has('city'))
                                <strong>{{ $errors->first('city') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::label('gender', trans("register.gender"), array('class' => 'col-form-label')) !!} {!! Form::select('gender', array('m' => trans("all.male"), 'f' => trans("all.female") ,'other' =>trans("all.trans")),NULL,['class' => 'form-control select2','required' => 'required','data-parsley-required-message' => trans("all.please_select_gender"),'data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class="fa fa-neuter text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.select_your_gender_from_list") !!}</small>
                                @if ($errors->has('gender'))
                                <strong>{{ $errors->first('gender') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone', trans("register.phone"), array('class' => 'col-form-label')) !!} {!! Form::text('phone', Input::old('phone'), ['class' => 'form-control','id' => 'phone','data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class=" icon-mobile3 text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.enter_your_phone_number") !!}</small>
                                @if ($errors->has('phone'))
                                <strong>{{ $errors->first('phone') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', trans("register.email"), array('class' => 'col-form-label')) !!} {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','id' => 'email','data-parsley-required-message' => trans("all.please_enter_email"),'data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
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

                    <div class="col-md-6">
                          <div class="required form-group-feedback-right {{ $errors->has('shipping_country') ? ' has-error' : '' }}">
                        {!! Form::label('shipping_country', trans("shipping_country"), array('class' => 'col-form-label')) !!} 
                        <select name="shipping_country" id="shipping_country" class="form-control"  >
                         @foreach($shipping_countries as $shipping_countries)
                             @if($shipping_countries->country_id == 129)
                                 <option value="{{$shipping_countries->country_id}}" selected="true">{{$shipping_countries->name}}</option>
                             @else
                                 <option value="{{$shipping_countries->country_id}}">{{$shipping_countries->name}}</option>
                             @endif
                         @endforeach
                       </select>
                   </div>
                    </div>
                    <div class="col-md-6">
                         <div class="required form-group-feedback-right {{ $errors->has('shipping_state') ? ' has-error' : '' }}">
                        {!! Form::label('shipping_state', trans("shipping_state"), array('class' => 'col-form-label')) !!} 
                        <select name="shipping_state" id="shipping_state" class="form-control" >
                         @foreach($shipping_states as $shipping_states)
                         <option value="{{$shipping_states->zone_id}}">{{$shipping_states->name}}</option>
                         @endforeach
                       </select>
                    </div>
                </div>
            </div>

                <div class="row">
                    <!-- begin col-6 -->
                   <!--  <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('wechat') ? ' has-error' : '' }}">
                            {!! Form::label('wechat', trans("register.wechat"), array('class' => 'col-form-label')) !!} {!! Form::text('wechat', Input::old('wechat'), ['class' => 'form-control','id' => 'wechat','data-parsley-required-message' => trans("all.please_enter_wechat"),'data-parsley-group' => 'block-1']) !!}
                            <span class="form-text">
                                <small>{!!trans("all.type_your_wechat") !!}</small>
                                @if ($errors->has('wechat'))
                                <strong>{{ $errors->first('wechat') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div> -->
                    <!-- begin col-4 -->
                    <div class="col-md-6">
                        <div class="required form-group-feedback-right {{ $errors->has('passport') ? ' has-error' : '' }}">
                            {!! Form::label('passport', trans("register.national_identification_number"), array('class' => 'col-form-label')) !!} {!! Form::text('passport', Input::old('passport'), ['class' => 'form-control','required' => 'required','id' => 'passport','data-parsley-required-message' => trans("all.please_enter_passport"),'data-parsley-group' => 'block-1']) !!}
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
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="transaction_pass" class="form-control" placeholder="Transaction Password " value="{{$transaction_pass}}" />
                        </div>
                    </div>
                </div>
         
            <h6 class="width-full">  {{trans('register.login_information') }}   </h6>
       
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', trans("register.username"), array('class' => 'col-form-label')) !!} {!! Form::text('username', Input::old('username'), ['class' => 'form-control','required' => 'required','id' => 'username','data-parsley-required-message' => trans("all.please_enter_username"),'data-parsley-type' => 'alphanum']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.desired_username_used_to_login") !!}</small>
                                @if ($errors->has('username'))
                                <strong>{{ $errors->first('username') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4">
                        <div class="passy required form-group-feedback-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', trans("register.password"), array('class' => 'col-form-label')) !!}
                            <div class="input-group label-indicator-absolute">
                                {!! Form::password('password', ['class' => 'form-control pwstrength','required' => 'required','id' => 'password','data-parsley-required-message' => trans("all.please_enter_password"),'data-parsley-minlength'=>'6']) !!}
                                <span class="label password-indicator-label-abs"></span>
                               <!--  <span class="input-group-addon">
                                                    <a class="generate-pass" href="javascript:void(0)" data-popup="tooltip" title="{{trans('register.generate_a_password')}}" data-placement="top" ><i class="icon-googleplus5"></i></a>
                                                </span> -->
                            </div>
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.a_secure_password") !!}</small>
                                @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4">
                        <div class="required form-group-feedback-right {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('confirm_password', trans("register.confirm_password"), array('class' => 'col-form-label')) !!} {!! Form::password('confirm_password',['class' => 'form-control','required' => 'required','id' => 'confirm_password','data-parsley-equalto' => '#password','data-parsley-required-message' => trans("all.please_enter_password_confirmation"),'data-parsley-minlength'=>'6']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="form-text">
                                <small>{!!trans("all.confirm_your_password") !!}</small>
                                @if ($errors->has('confirm_password'))
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end col-6 -->
                </div>
                <div class="bhoechie-tab-content active">
                    <div class="text-center">
                        <!--  <div class="text-center">
                            <h1>{{trans('register.confirm_registration') }}</h1>
                            
                            <p><button class="btn btn-success btn-lg" role="button">{{trans('register.click_to_complete_registration') }}</button></p>
                        </div> -->
                    </div>
                </div>
                <!-- end row -->
   
            <h6 class="width-full">  {{trans('register.payment') }}   </h6>

                <div class="m-b-0 text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                                    @foreach($payment_type as $k => $payment)
                                    @if($payment->id==1)
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
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <div class="tab-content" >
                                    @foreach($payment_type as $ke => $pay) @if($pay->payment_name=="Cheque")
                                    <div class="tab-pane active" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                            <span name="fee" id="joiningfee"> 300 </span>   
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                                <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                            </p>
                                        </div>
                                    </div>
                                    @elseif($pay->payment_name=="Ewallet")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                                <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                            </p>
                                        </div>
                                    </div>

<<<<<<< HEAD
                                     @elseif($pay->payment_name=="Bitaps")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                                <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                            </p>
                                        </div>
=======
                                    <div class="form-control-feedback d-none">
                                        <i class="icon-user-check text-muted"></i>
                                    </div>
                                    <span class="help-block">
                                        <small>{!!trans("all.a_secure_password") !!}</small>
                                        @if ($errors->has('password'))
                                            <strong>{{ $errors->first('password') }}</strong>
                                        @endif
                                    </span>
                                </div>
                            </div>
                                        <!-- end col-4 -->
                                        <!-- begin col-4 -->
                            <div class="col-md-4">
                                <div class="required form-group-feedback-right  {{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::label('confirm_password', trans("register.confirm_password"), array('class' => 'control-label')) !!} {!! Form::text('confirm_password','', ['class' => 'form-control','required' => 'required','id' => 'confirm_password','data-parsley-required-message' => trans("all.please_enter_password_confirmation"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-2']) !!}
                                    <div class="form-control-feedback d-none">
                                        <i class="icon-user-check text-muted"></i>
>>>>>>> 3aba6a005e62464fed96c5cb53be4402ca5c27ce
                                    </div>
                                    @elseif($pay->payment_name=="Paypal")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <input type="hidden" name="PAYMENTREQUEST_0_ITEMAMT" value="100">
                                            <input type="hidden" name="PAYMENTREQUEST_0_AMT" value="100" readonly>
                                             <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                                <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                            </p>
                                            
                                            <div id="myContainer" style="margin-top:100px">
                                            </div>
                                        </div>
                                    </div>
                                     @elseif($pay->payment_name == "Stripe") 

                                      <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            
                                            <p>
                                                  <input 
                                                    type="button"
                                                    id="stripe_btn"
                                                    class="btn btn-primary"
                                                    value="Pay with Card"
                                                    data-key="{{$payment_gateway->stripe_public_key}}"
                                                    data-amount=""
                                                    data-currency="chf"
                                                    data-bitcoin="false"
                                                    data-name="baduchandor"
                                                    
                                                    data-description="Stripe payment"
                                                    data-locale="auto"
                                                />
                        
                                                <h3>{{trans('register.confirm_registration') }}</h3>
                                            </p>
                                        </div>
                                    </div>
                                                                    
                                          
                                    @elseif($pay->payment_name=="Rave")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                                <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                            </p>
                                        </div>
                                    </div>   

                                    @elseif($pay->payment_name=="Authorize")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                             <div class="text-center">
                                                                                         
                                                    <span name="fee" id="joiningfee"></span>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="required form-group {{ $errors->has('card_number') ? ' has-error' : '' }}">
                                                                {!! Form::label('card_number', trans("register.card_number"), array('class' => 'control-label')) !!} {!! Form::text('card_number', Input::old('card_number'), ['class' => 'form-control','data-parsley-required-message' => trans("register.please_enter_card_number")]) !!}
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
                                                                {!! Form::label('cvv', trans("register.cvv"), array('class' => 'control-label')) !!} {!! Form::text('cvv', Input::old('cvv'), ['class' => 'form-control','data-parsley-required-message' => trans("register.please_enter_card_number")]) !!}
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
                                                                {!!  Form::selectRange('year', date('Y'), 2040,Input::old('year'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("register.please_enter_expiration_date")]);  !!}
                                                                
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

                                                            {!!  Form::selectMonth('month',Input::old('month'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("register.please_enter_expiration_date")]);  !!}
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
                                                     <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                                </p>
                                           
                                    </div> 
                                    </div>        

                                     @elseif($pay->payment_name=="Ipaygh")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                                <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                            </p>
                                        </div>
                                    </div>   

                                    @elseif($pay->payment_name=="Skrill")
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                         <h1> <p class="text-success">
                                                {{trans('register.joining_fee') }}:
                                                <span name="fee" class="ewallet_joining"> 70 </span>
                                            </p></h1>
                                            <h3>{{trans('register.confirm_registration') }}</h3>
                                            <p>
                                               <button class="btn btn-success btn-lg" role="button">
                                                {{$pay->payment_name}} payment confirmation
                                               <!--  <img src="https://www.skrill.com/fileadmin/content/images/brand_centre/Skrill_Logos/skrill-150x65_en.gif" alt="Skrill banner 150x65" title="Use the Skrill Digital Wallet for all your online transactions."> -->
                                            </button>
                                           </p>
                                        </div>
                                    </div>      
    
 
                                    @else
                                    <div class="tab-pane" id="tab{{$ke}}" role="tabpanel">
                                        <div class="text-center">
                                            <h1> <p class="text-success" >
                                                <!-- {{trans('register.joining_fee') }}: -->
                                                <span name="fee" id="voucher_joining" value=""></span>    
                                            </p></h1>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <h4>{{{ trans('register.voucher') }}}</h4>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="key" id="key" placeholder="{{{ trans('register.voucher_key') }}}" class="form-control" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="" id="verify" class="btn btn-secondary">{{{ trans('register.verify') }}}</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div id="err"></div>
                                                </div>
                                            </div>
                                            <table class="table" id="resulttable">
                                                <tr>
                                                    <th>{{{ trans('register.voucher_code') }}}</th>
                                                    <th>{{{ trans('register.total_amount') }}}</th>
                                                    <th>{{{ trans('register.balance') }}}</th>
                                                </tr>
                                            </table>
                                            <br>
                                            <p>
                                                <button id="conf" class="btn btn-success" role="button">{{{ trans('register.confirm') }}}</button>
                                            </p>
                                        </div>
                                    </div>
                                @endif @endforeach
                                </div>
                            </div>
                        </div>
                    </div>           
                </div>
           
        </form>
            </div>
         </div>
    </div>
</div>
@section('scripts')
@parent
<script type="text/javascript">
var joiningfe = {{ $joiningfee }};
</script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>
<script>
 
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
 

<script>

$('.location-picker').on('show.bs.dropdown', function (e) {

   callmap();

    $('.dropdown-menu').click(function(e) {
          e.stopPropagation();
    });

});


$("#location").on('keyup',function (e){
      $('.location-picker').addClass('open');
      callmap();
});

</script>
<script type="text/javascript">
  $('select[name=shipping_country]').change(function() {
  var country_country_id = $(this).val();

  if(country_country_id){
      $.ajax({
          type:"GET",
          url:"{{url('api/get-shipping-state-list')}}?id="+country_country_id,
          success:function(res){               
              if(res){
                  $("#shipping_state").empty();
                  $("#shipping_state").append('<option>Select</option>');
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
  }
 });

</script>
<script type="text/javascript">
   $(document).ready(function() {
       $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
          e.preventDefault();
          $(this).siblings('a.active').removeClass("active");
          $(this).addClass("active");
          var index = $(this).index();
          $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
          $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
          $('#payment').val($(this).attr('payment'));
   });
  });
</script>
<script>
  $(document).ready(function() {
    if ($(".steps-validation").length) {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            $('#payment').val($(this).attr('payment'));
        });
    }
});
//
// Wizard with validation
//
// Show form
// 
if ($(".steps-validation").length) {
    var form = $(".steps-validation").show();
    form.parsley();
    // Initialize wizard
    $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onStepChanging: function(event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            // if (newIndex === 3 && Number($("#age-2").val()) < 18) {
            //     return false;
            // }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex) {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            var validateForm = form.parsley().whenValidate({
                group: 'block-' + currentIndex
            });
            validateForm.then(function() {}, function() {});
            if (validateForm.state() === "resolved") {
                return true;
            }
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            // Used to skip the "Warning" step if the user is old enough.
            // if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
            //     form.steps("next");
            // }
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            // if (currentIndex === 2 && priorIndex === 3) {
            //     form.steps("previous");
            // }
        },
        onFinishing: function(event, currentIndex) {
            // form.validate().settings.ignore = ":disabled";
            // return form.valid();
        },
        onFinished: function(event, currentIndex) {
            alert("Submitted!");
        }
    });
    Parsley.addValidator('sponsor', {
        validateString: function(value, country) {
            var ajaxStatus = $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/validatesponsor/?sponsor=' + value,
                type: "GET",
                async: false,
                success: function(e) {
                    if (e.valid === true) {
                        return true;
                    } else {
                        return false;
                    }
                },
                error: function() {
                    return false;
                }
            });
            ajaxStatusFlag = $.parseJSON(ajaxStatus.responseText);
            return ajaxStatusFlag.valid;
        },
        messages: {
            en: 'No such sponsor exists!'
        }
    });
    }


</script>
<script>
if ($("#package").length) {
    $('#package').change(function() {
        var product = document.getElementById("package");
        var amount = product.options[product.selectedIndex].getAttribute('amount');
        var pv = product.options[product.selectedIndex].getAttribute('pv');
        var rs = product.options[product.selectedIndex].getAttribute('rs');
        $('#joiningfee').html(amount);
        $('#paypal_joining').html(amount);
        $('#voucher_joining').html(amount);
        $('.ewallet_joining').html(amount);
    });
}
$(document).ready(function() {
    //console.log(446);
    if ($("#conf").length) {
        $("#conf").hide();
    }
    var voucherbalance = 0;
    var voucher = [];
    if ($("table#resulttable").length) {
        $("table#resulttable").hide();
    }
    $('body').on('click', '#verify', function(e) {
        //console.log(746);
        
        if ($("#err").length) {
            $("#err").hide();
        }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (jQuery.inArray($('#key').val(), voucher) == -1) {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/register/data',

                type: "post",
                async: false,
                dataType: "json",
                data: {
                    key: $('#key').val()
                },
                success: function(data, textStatus, jqXHR) {
                    if (data[0] == undefined) {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Invalid voucher code";
                    }
                    voucher.push(data[0].voucher_code);
                    sel = document.getElementById('package');
                    joiningfe= sel.options[sel.selectedIndex].getAttribute('amount');
                    if (data[0].total_amount >= joiningfe) {
                        //console.log(123);
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Reached maximum joining fee ";
                        $("#conf").show();
                    }
                    if (voucherbalance < joiningfe) {
                        console.log(joiningfe);
                        voucherbalance += parseInt(data[0].total_amount);
                        $("table#resulttable").show();
                        drawTable(data);
                        payable_vouchers.push(data[0]);
                    } else {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Reached maximum joining fee ";
                        $("#conf").show();
                        voucherbalance -= parseInt(data[0].total_amount);
                    }
                }
            });
        } else {
            if ($("#err").length) {
                $("#err").show();
            }
            document.getElementById("err").innerHTML = "<strong> Error!</strong> Voucher code is already used ";
        }
    });
});
function drawTable(data) {
    for (var i = 0; i < data.length; i++) {
        drawRow(data[i]);
    }
}

function drawRow(rowData) {
    var row = $("<tr />");
    if ($("#resulttable").length) {
        $("#resulttable").append(row);
    }
    row.append($("<td><input type='hidden' name='payable_vouchers[]' value='" + rowData.voucher_code + "'>" + rowData.voucher_code + "</td>"));
    row.append($("<td>" + rowData.total_amount + "</td>"));
    row.append($("<td>" + rowData.balance_amount + "</td>"));
}

</script>

@endsection
