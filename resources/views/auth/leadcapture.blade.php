@extends('layouts.auth')

@section('content')

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{url('img/cache/original/'.$app->logo)}}" alt="IMG">
                    <br><b>{{$app->company_name}}</b>
                    <br>{{$app->company_address}}
                    <br>{{$app->email_address}}

                    <div class="sponse-img">
        <div class="rounded-circle" style="width:213px;height:214px;margin:0px auto;background-image:url({{url('img/cache/profile/'.$profile_photo)}}) ;background-repeat: no-repeat;
    background-size: contain;">
                    </div>
    </div>
                </div>
                <form class="login100-form" method="POST" action="{{url('lead')}}">
                        {{ csrf_field() }}
                     <input type="hidden" name="username" id="username" value="{{$username}}">
                    <span class="login100-form-title">
                      <h2><b>{{trans("users.lead_capture")}}</b></h2><br>
                        {{$username}}
                    </span>

                  <div class="wrap-input100 form-group{{ $errors->has('name') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                        <input id="name" type="text" class="input100 form-control" name="name" value="{{ old('name') }}" required placeholder="{{trans("users.your_name")}}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                        <input id="email" type="email" class=" input100 form-control" name="email" value="{{ old('email') }}" required placeholder="{{trans("users.your_email")}}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>


                   <div class="wrap-input100 form-group{{ $errors->has('phone') ? ' has-error' : '' }} form-group form-group-feedback form-group-feedback-right">
                         <input id="phone" type="text" class="form-control input100" name="phone" value="" required placeholder="{{trans("users.phone")}}" pattern="[0-9]{10}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </span>
                    </div>
                    


                               
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{trans("users.submit")}}
                        </button>
                    </div>

                
           <div class="text-right p-t-136">
                        <a class="txt2" href="{{url('login')}}">
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"> {{trans("users.login")}}</i>
                        </a>
                    </div>
                  
                </form>
                
            </div>
        </div>
    </div>
    

@endsection

