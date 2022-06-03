@extends('layouts.auth')
<style type="text/css">
.form-check {
    padding-left: 0rem!important;
}
</style>
@section('content')

@php
$lockedflag = false;
$redirectFlag = false;
@endphp

@if(Input::get('loggedOut'))
@if(App\User::where('username', '=', Crypt::decrypt(Input::get('loggedOut')))->exists())
@php
$lastusername = Crypt::decrypt(Input::get('loggedOut'));
$lastuserid = App\User::where('username', '=', $lastusername )->value('id');
$lastuserObj = App\User::with('profile_info')->find($lastuserid);
$lastUserNiceName = $lastuserObj->name;
$lockedflag = true;
@endphp
@endif
@endif

@if(Input::get('redirect'))
@php
    $redirectPath = array_get(parse_url(Request::get('redirect')),'path');
    $redirectFlag = true;
@endphp
@endif

<div class="content d-flex justify-content-center align-items-center-no mt-5">


<!-- Simple login form -->
<form class="login-form" method="POST" action="{{ route('login') }}">

    
                        

    {{ csrf_field() }}
    <div class="card mb-0 ">

    <div class="card-body p-4">
        @if($redirectFlag==true) 
        <input id="redirectPath" type="hidden" name="redirectPath" value="{{$redirectPath}}">
        @endif

        @if($lockedflag==true)         
            <input id="username" type="hidden" name="username" value="{{$lastusername}}" >
            <div class="text-center">
            <div class="card-img-actions d-inline-block mb-3">

                {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $lastuserObj->profile_info->image]), $lastUserNiceName , array('class'=>'rounded-circle','width'=>'160','height'=>'160')) }}

                <div class="card-img-actions-overlay card-img rounded-circle">
                    <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                        <i class="icon-question7"></i>
                    </a>
                </div>
            </div>
            </div>

            <div class="text-center mb-3">
                <h6 class="font-weight-semibold mb-0">{{$lastUserNiceName}} </h6>
                <span class="d-block text-muted">{{trans('all.unlock_your_account')}}</span>
            </div>
        @endif
        
        @if($lockedflag==false)    

            <div class="text-center mb-3">
                <!-- <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i> -->
                <!-- <h2 class="mb-0">{{trans('all.login_to_your_account')}}</h2> -->
                <!-- <h2 class="mb-3">Welcome Back!</h2> -->
                 <div >
                 <!-- <div class="navbar-brand navbar-brand-xs"> -->
                  <img src="{{ url('img/cache/original/'.$logo_light)}}" alt="{{ config('app.name', 'Cloud MLM Software') }}" class="rounded-circle" style="height:100px;width:150px;margin-left:8px;margin-top: 15px;">

                </div>
                <!-- <span class="d-block text-muted">{{trans('all.enter_your_credentials_below')}}</span> -->
            </div>

          <!--   <svg class="d-block mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" width="100" height="2" viewBox="0 0 100 2"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="08-login" fill="#D8E3EC" transform="translate(-650 -371)"><path id="Rectangle-15" d="M650 371h100v2H650z"></path></g></g></svg> -->


         

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} form-group-feedback form-group-feedback-right" >
                <label class="block text-extra-bold mb-2" for="username">{{trans('dashboard.username')}}</label>
                <input id="username" type="text" class="form-control" name="username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" required autofocus  autofocus="true">
                @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
                <div class="form-control-feedback">
                    <!-- <i class="icon-user text-muted"></i> -->
                </div>
            </div>
        @endif

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-group-feedback form-group-feedback-right">
            <label class="block text-extra-bold mb-2" for="password">{{trans('register.password')}}</label>
            <div class="input-group mb-3">
                <input id="password" type="password"  class="form-control" name="password" aria-describedby="basic-addon2" required  @if($lockedflag == true) autofocus @endif value="<?php if(isset($_COOKIE["member_pass"])) { echo $_COOKIE["member_pass"]; } ?>">
              <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2" onclick="myFunction()" ><i id="icon" class="icon-eye"></i></span>
                </div>
            </div>
            <!-- <input id="password" type="password"  class="form-control" name="password" required  @if($lockedflag == true) autofocus @endif value="<?php if(isset($_COOKIE["member_pass"])) { echo $_COOKIE["member_pass"]; } ?>"> -->
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <div class="form-control-feedback">
                <!-- <i class="icon-lock2 text-muted"></i> -->
            </div>
        </div>

        <!--  <div class="form-group d-flex align-items-center">
            <div class="form-check mb-0">
                <label class="form-check-label text-extra-bold">
                     <div class="checkbox">
               
                    <input type="checkbox"  class="styled" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> > {{trans('register.remember_me')}}
                
            </div>
                    
                </label>
            </div>

            <a href="{{ route('password.request') }}" class="ml-auto text-extra-bold">{{trans('all.forgot_password')}} ?</a>
        </div> -->

        @if($lockedflag==true)    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block text-extra-bold">{{trans('all.unlock_account')}}<i class="icon-circle-right2 position-right"></i></button>
        </div>
        @endif

        @if($lockedflag==false)    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block text-extra-bold" name="login_submit">{{trans('all.sign_in')}}<i class="icon-circle-right2 ml-2"></i></button>
        </div>
        @endif

       <!--  <span class="form-text text-center text-muted">
            {{trans('all.by_continuing_you_are_confirming_that_you_have_read_our')}}
            
            

             <a href="{{url('/terms_and_conditions') }}"target="_blank">{{trans('all.terms')}} &amp; {{trans('all.conditions')}}</a>
              {{trans('all.and')}} 

             
            <a href="{{url('/cookie') }}" target="_blank">{{trans('all.cookie_policy')}}</a>

        </span> -->

        
        
    </div>
    </div>
</form>
<!-- /simple login form -->
</div>

@endsection @section('scripts') @parent
<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("password");
  document.getElementById("icon").classList.toggle("icon-eye-blocked");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
@endsection