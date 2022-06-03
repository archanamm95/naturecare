@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
@section('styles') @parent
<link  href="http://fonts.googleapis.com/css?
family=Reenie+Beanie:regular" 
rel="stylesheet"
type="text/css">
<link rel="stylesheet" href="{{ asset ('assets/css/intl-tel-input/build/css/intlTelInput.css') }}"/>
<script src="{{ asset ('assets/css/intl-tel-input/build/js/intlTelInput.min.js') }}"></script>
<style type="text/css">
.iti__flag {background-image: url("{{ asset('assets/css/intl-tel-input/build/img/flags.png') }}");}
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
.iti__flag {background-image: url("{{ asset('assets/css/intl-tel-input/build/img/flags@2x.png') }}");}
}
.inttl{
    padding-left: 80px!important;
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
</style>
@endsection
{{-- Content --}}
@section('main')
@include('flash::message')
                <!-- Cover area -->
<div class="profile-cover">
    <div class="profile-cover-img" style="background-image: url({{url('img/cache/original/'.$cover_photo)}}">
    </div>
    <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
        <div class="mr-md-3 mb-2 mb-md-0 avatarin ajxloaderouter">
            <div class="rounded-circle" id="profilephotopreview" style="width:100px;height:100px;margin:0px auto;background-image:url({{url('img/cache/profile/'.$profile_photo)}}">
            </div>
           <div class="profileuploadwrapper">
                        <form id="profilepicform" method="post" name="profilepicform">
                            {!! Form::file('file', ['class' => 'inputfile profilepic','id'=>'profile']) !!}
                {!! Form::hidden('type', 'profile') !!}
                {!! Form::hidden('user_id', $selecteduser->id) !!}
                {!! csrf_field() !!}
                            <label for="profile">
                                <i class="icon-file-plus position-left">
                                </i>
                                <span>
                                </span>
                            </label>
                        </form>
            </div>
        </div>
     
            <div class="media-body text-white">
                <h1 class="mb-0">{{ $selecteduser->name }} {{ $selecteduser->lastname }}</h1>
                    <span class="d-block">{{ $selecteduser->username }}</span>
            </div>
            <div class="ml-md-3 mt-2 mt-md-0">
                <ul class="list-inline list-inline-condensed mb-0">
                     <li class="list-inline-item">
                        <form id="coverpicform" method="post" name="coverpicform">
                            {!! Form::file('file', ['class' => 'inputfile coverpic','style'=>'display:none;','id'=>'cover']) !!}
                            {!! Form::hidden('type', 'cover') !!}
                            {!! Form::hidden('user_id', $selecteduser->id) !!}
                            {!! csrf_field() !!}
                            <label for="cover">
                                <span class="btn btn-light border-transparent" href="#">
                                    <i class="icon-file-picture position-left"></i>
                                        {{trans('profile.cover_image')}}
                                </span>
                            </label>
                        </form>
                    </li>
                </ul>
            </div>
    </div>
</div>
<!-- /cover area -->
<div id="profile_tabs_wrapper">
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
          <!--   <div class="text-center d-lg-none w-100">
                <ul class="nav navbar-nav visible-xs-block">
                    <li class="full-width text-center">
                        <a data-target="#navbar-second" data-toggle="collapse">
                            <i class="icon-menu7">
                            </i>
                        </a>
                    </li>
                </ul>
            </div> -->
     
    <!-- <div class="navbar-collapse collapse" id="navbar-second">  navbar-nav nav-tabs-->
        <!-- <ul class="nav border-0 nav-xs mb-0">
            <li class="nav-item">
                <a data-toggle="tab" href="#overview" class="navbar-nav-link a-tab active scroll">
                  <i class="icon-calendar3 position-left"></i>
                  <span class="text-hided">{{trans('profile.overview')}}</span>
                </a>
            </li>
              <li class="nav-item">
                <a data-toggle="tab" href="#activity"  class="navbar-nav-link a-tab scroll">
                  <i class="icon-menu7 position-left"></i>
                  <span class="text-hided">{{trans('profile.activity')}} </span> 
                </a>
            </li>
            <li class="nav-item">
                <a href="#update" class="navbar-nav-link a-tab scroll" data-toggle="tab">
                    <i class="icon-pencil"></i>
                    <span class="text-hided">{{trans('profile.edit_info')}} </span>
                </a>
            </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#settings"  class="navbar-nav-link a-tab scroll">
                        <i class="icon-cog3 position-left ">
                        </i>
                       <span class="text-hided">{{trans('profile.account_settings')}} </span>
                    </a>
                </li>
                <li class="nav-item">
                     <a data-toggle="tab" href="#shipping_address"  class="navbar-nav-link a-tab scroll ">
                        <i class="icon-ship "></i>
                        <span class="text-hided">{{trans('profile.shipping_address')}}</span>
                    </a>                    
                </li>
                <li class="nav-item">
                     <a data-toggle="tab" href="#payout_info"  class="navbar-nav-link a-tab scroll">
                        <i class="icon-credit-card "></i>
                        <span class="text-hided">{{trans('profile.payout_info')}}</span>
                    </a>                    
                </li> -->
         
      <!--   </ul>
        <div class="navbar-right navbar-collapse collapse">
            <ul class="nav navbar-nav"> -->
                 <!-- <li class="nav-item">
                                <a href="{{ url('user/notes') }}" class="navbar-nav-link">
                                    <i class="icon-stack-text"></i>
                                   <span class="text-hided">{{trans('profile.notes')}} </span>
                                </a>
                            </li>
                  <li class="nav-item">
                     <a data-toggle="tab" href="#referrals"  class="navbar-nav-link a-tab scroll">
                        <i class="icon-collaboration position-left "></i>
                       <span class="text-hided">{{trans('profile.referrals')}} </span>
                    </a>

                     
                </li>               
                
            </ul> -->
            <ul class="nav nav-pills nav-justified nav-xs mb-0">
            <li class="active">
            <a href="#overview" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.overview')}}">
              <i class="icon-calendar3 position-left"></i>
              <span class="text-hided">{{trans('profile.overview')}}</span>
            </a>
        </li>
        
       
        <li>
            <a href="#activity" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.activity')}}">
            <i class="icon-menu7 position-left"></i>
            <span class="text-hided">{{trans('profile.activity')}} </span> 
            </a>
        </li>
    <!--     <li>
            <a href="#update" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.edit_info')}}">
            <i class="icon-pencil"></i>
            <span class="text-hided">{{trans('profile.edit_info')}} </span>
            </a>
        </li> -->
        <li>
            <a href="#settings" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.account_settings')}}">
            <i class="icon-cog3 position-left "></i>
            <span class="text-hided">Account settings</span>
            </a>
        </li>

    <!--      <li>
            <a href="#shipping_address" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.shipping_address')}}">
            <i class="icon-ship"></i>
            <span class="text-hided">{{trans('profile.shipping_address')}}</span>
           </a>
        </li> -->
        <li>
            <a href="#payout_info" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.payout_info')}}">
            <i class="icon-cog3 position-left "></i>
            <span class="text-hided">{{trans('profile.payout_info')}}</span>
            </a>
        </li>
        <li>
            <a href="{{ url('user/notes') }}" class="navbar-nav-link" data-popup="tooltip" data-container="body" title="{{trans('profile.notes')}}">
            <i class="icon-stack-text"></i>
            <span class="text-hided">{{trans('profile.notes')}} </span>
            </a>
        </li>
        <li>
            <a href="#referrals" data-toggle="tab" class="navbar-nav-link a-tab scroll" data-popup="tooltip" data-container="body" title="{{trans('profile.referrals')}}">
             <i class="icon-collaboration position-left"></i>
            <span class="text-hided">{{trans('profile.referrals')}} </span>
            </a>
        </li>
    </ul>
        <!-- </div> -->

<!-- <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab" aria-expanded="false">First Panel</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#tabs-2" role="tab" aria-expanded="true">Second Panel</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-expanded="false">Third Panel</a>
    </li>
</ul> -->
    </div>
   
<!-- </div> -->
    <!-- /profile navigation -->

            <!-- Content area -->
            <div class="content">

                <!-- Inner container -->
                <div class="d-flex align-items-start flex-column flex-lg-row">
                    <div class="col-md-6 d-sm-none">
                          <div class="card card-body">
            <div class="row text-center">
         <!--    <div class="col">
                <p>
                    <i class="icon-medal-star icon-2x display-inline-block text-warning">
                    </i>
                </p>
                <h5 class="text-semibold no-margin">
                    {{ $user_rank_name }}
                </h5>
                <span class="text-muted text-size-small">
                    {{trans('profile.rank')}}  
                </span>
            </div> -->
            <div class="col">
                <p>
                    <i class="icon-users2 icon-2x display-inline-block text-info">
                    </i>
                </p>
                <h5 class="text-semibold no-margin">
                    {{ $referrals_count }}
                </h5>
                <span class="text-muted text-size-small">
                    {{ trans('all.referrals') }}
                </span>
            </div>
            <div class="col">
                <p>
                    <i class="icon-cash3 icon-2x display-inline-block text-success">
                    </i>
                </p>
                <h5 class="text-semibold no-margin">
                    {{ currency(round($balance,2)) }}
                </h5>
                <span class="text-muted text-size-small">
                    {{ trans('all.balance') }}
                </span>
            </div>
        </div>
    </div>
                    </div>

                    <!-- Left content -->
                    <div class="tab-content w-100">
                        <div class="tab-pane active" id="overview">
                        @include('app.admin.users.earnings')

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="content-group user-details-profile">
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.username') }} :
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->username }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.email') }} :
                                                </label>
                                                <span class="float-right">
                                                    <a href="emailto: {{ $selecteduser->email }}">
                                                        {{ $selecteduser->email }}
                                                    </a>
                                                </span>
                                            </div>
                                           @if(isset($sponsor))
                                          
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.sponsor') }}:
                                                </label>
                                                <span class="float-right">
                                                     {{$sponsor->name}}  {{$sponsor->lastname}}
                                                </span>
                                            </div>
                                            @endif
                                            <!-- <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.package') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{$selecteduser->profile_info->package_detail->package}}
                                                </span>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.first_name') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->name }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.last_name') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->lastname }}
                                                </span>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.gender') }}:
                                                </label>
                                                <span class="float-right">
                                                @if($selecteduser->profile_info->gender == 'm')  {{ trans('register.male') }}
                                                @elseif($selecteduser->profile_info->gender == 'f') {{ trans('register.female') }}  @endif
                                                </span>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.phone') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->profile_info->mobile }}
                                                </span>
                                            </div>
                                             <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans("register.i_c_number") }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->profile_info->passport }}
                                                </span>
                                            </div> 
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans("profile.front_ic_doc") }}:
                                                </label>
                                                <span class="float-right">
                                                    @if($selecteduser->profile_info->id_file != 0)
                                                    <button type="button"  class="btn btn-default" data-toggle="modal" data-target="#myModal"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#eye" /></svg></button>
                                                    <!-- <a href="{{'/admin/download_id/'.$selecteduser->profile_info->id_file}}" class="btn btn-success btn-md" target="_blank"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#download" /></svg> </a> -->
                                                    <!-- Modal -->
                                                    <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body" style="overflow: auto !important;">
                                                    <center> 
                                                    <embed src="{{'/uploads/documents/'.$selecteduser->profile_info->id_file}}" style="width:400px; height:auto;" frameborder="0">
                                                    </center>
                                                    </div>                 
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    @else
                                                    Uploaded
                                                    @endif
                                                </span>
                                            </div> 
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans("profile.back_ic_doc") }}:
                                                </label>
                                                <span class="float-right">
                                                    @if($selecteduser->profile_info->id_file_back != 0)
                                                    <button type="button"  class="btn btn-default" data-toggle="modal" data-target="#myModal2"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#eye" /></svg></button>
                                                    <!-- <a href="{{'/admin/download_id/'.$selecteduser->profile_info->id_file_back}}" class="btn btn-success btn-md" target="_blank"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#download" /></svg> </a> -->
                                                    <!-- Modal -->
                                                    <div id="myModal2" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body" style="overflow: auto !important;">
                                                    <center> 
                                                    <embed src="{{'/uploads/documents/'.$selecteduser->profile_info->id_file_back}}" style="width:400px; height:auto;" frameborder="0">
                                                    </center>
                                                    </div>                 
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                     @else
                                                    Uploaded
                                                    @endif
                                                </span>
                                            </div> 
                                            
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="content-group user-details-profile">
                                             

                                            <div class="form-group">
                                                <span class="">
                                                    <div class="flag-icon flag-icon-{{ strtolower($selecteduser->profile_info->country) }}" style="width: 100%;height: 188px;">
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.country') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $country }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.state') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $state }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.zipcode') }}:
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->profile_info->zip }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.address') }} :
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->profile_info->address1 }}
                                                </span>
                                                <span class="float-right">
                                                    {{ $selecteduser->profile_info->address2 }}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{ trans('register.city') }} :
                                                </label>
                                                <span class="float-right">
                                                    {{ $selecteduser->profile_info->city }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </div>
                        



                        </div>  

                   <div class="tab-pane" id="activity">
                        <!-- Timeline -->
                      
                        <div class="timeline timeline-left content-group">
                            <div class="timeline-container">
                                @foreach($activities as $activity)
                                
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <a href="#" >
                                            {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $activity->user->profile_info->profile]), $activity->user->username, array('class' => '','style'=>'')) }}
                                        </a>
                                    </div>
                                  <div class="card card-flat timeline-content">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">
                                                {{$activity->title}}
                                            </h6>
                                            <div class="heading-elements">
                                                <span class="label label-success heading-text">
                                                    <i class="icon-history position-left text-success">
                                                    </i>
                                                    {{$activity->created_at->diffForHumans()}}
                                                </span>
                                                <ul class="icons-list">
                                                    <li>
                                                        <a data-action="reload">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{$activity->description}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /timeline -->
                    </div>
<!-- 
                    <div class="tab-pane" id="update">                             
                        <div class="card card-flat">

                           {!!  Form::model($selecteduser, array('route' => array('user.saveprofile', $selecteduser->id))) !!} 


                            <form action="{{ url('user/profile/edit/'.$selecteduser->id) }}" method="post" data-parsley-validate="parsley">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title">
                                        {{ trans('profile.update_profile') }}
                                    </h6>
                                    <div class="header-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                               
                                <div class="card-body"> -->
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="required form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                            {!! Form::label('name', trans("register.first_name"), array('class' => 'col-form-label')) !!} {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-1','readonly']) !!}
                                            <span class="form-text">
                                                <small>{!! trans("all.your_first_name") !!}</small>
                                                @if ($errors->has('name'))
                                                <strong>{{ $errors->first('name') }}</strong>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                            {!! Form::label('lastname', trans("register.last_name"), array('class' => 'col-form-label')) !!} {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-1']) !!}
                                            <span class="form-text">
                                                <small>{!! trans("all.your_last_name") !!}</small>
                                                @if ($errors->has('lastname'))
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    begin col-6

                                    <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('gender') ? ' has-error' : '' }}">
                                        {!! Form::label('gender', trans("register.gender"), array('class' => 'col-form-label')) !!} {!! Form::select('gender', array('m' => trans("all.male"), 'f' => trans("all.female") ,'other' =>trans("all.trans")),null !==(Input::old('gender')) ? Input::old('gender') : $selecteduser->profile_info->gender,['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_select_gender"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="fa fa-neuter text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("all.select_your_gender_from_list") !!}</small>
                                            @if ($errors->has('gender'))
                                            <strong>{{ $errors->first('gender') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </div> -->
                               <!--  <div class="row">
                                    <div class="col-md-6">
                                    <div class="required form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                        {!! Form::label('address1', trans("register.address1"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address1', null !==(Input::old('address1')) ? Input::old('address1') : $selecteduser->profile_info->address1, ['class' => 'form-control','required' => 'required','id' => 'address1','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address1"),'data-parsley-group' => 'block-1']) !!}
                                        <span class="form-text">
                                            <small>{!! trans("all.your_address1") !!}</small>
                                            @if ($errors->has('address1'))
                                            <strong>{{ $errors->first('address1') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="required form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                        {!! Form::label('address2', trans("register.address2"), array('class' => 'col-form-label')) !!} {!! Form::textarea('address2', null !==(Input::old('address2')) ? Input::old('address2') : $selecteduser->profile_info->address2, ['class' => 'form-control','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address2"),'data-parsley-group' => 'block-1']) !!}
                                        <span class="form-text">
                                            <small>{!! trans("all.your_address2") !!}</small>
                                            @if ($errors->has('address2'))
                                            <strong>{{ $errors->first('address2') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </div>
                                <div class="row"> -->
                                        <!-- begin col-6 -->
                       <!--              <div class="col-md-4">
                                    <div class="required form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                        {!! Form::label('zip', trans("register.zip_code"), array('class' => 'col-form-label')) !!} {!! Form::number('zip', null !==(Input::old('zip')) ? Input::old('zip') : $selecteduser->profile_info->zip, ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'pattern'=>'[0-9]{1}[0-9]{3,7}','data-parsley-group' => 'block-1','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
                                        <span class="form-text">
                                            <span id="ziplocation"><span></span></span>
                                        <span id="ziperror"></span>
                                        <small>{!! trans("all.your_zip") !!}</small> @if ($errors->has('zip'))
                                        <strong>{{ $errors->first('zip') }}</strong> @endif
                                        </span>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('city') ? ' has-error' : '' }}">
                                        {!! Form::label('city', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('city', null !==(Input::old('city')) ? Input::old('city') : $selecteduser->profile_info->city, ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-city text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("all.your_city") !!}</small>
                                            @if ($errors->has('city'))
                                            <strong>{{ $errors->first('city') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        {!! Form::label('mobile', trans("register.city"), array('class' => 'col-form-label')) !!} {!! Form::text('mobile', null !==(Input::old('mobile')) ? Input::old('mobile') : $selecteduser->profile_info->mobile, ['class' => 'form-control','required' => 'required','id' => 'mobile','data-parsley-required-message' => trans("please enter phone number"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-city text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("please enter phone number") !!}</small>
                                            @if ($errors->has('mobile'))
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                        {!! Form::label('facebook', trans("Facebook"), array('class' => 'col-form-label')) !!} {!! Form::text('facebook', null !==(Input::old('facebook')) ? Input::old('facebook') : $selecteduser->profile_info->facebook, ['class' => 'form-control','required' => 'required','id' => 'facebook','data-parsley-required-message' => trans("enter facebook url"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your fb url") !!}</small>
                                            @if ($errors->has('facebook'))
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('wechat') ? ' has-error' : '' }}">
                                        {!! Form::label('wechat', trans("Wechat Id"), array('class' => 'col-form-label')) !!} {!! Form::text('wechat', null !==(Input::old('wechat')) ? Input::old('wechat') : $selecteduser->profile_info->wechat, ['class' => 'form-control','required' => 'required','id' => 'wechat','data-parsley-required-message' => trans("enter wechat id"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your wechat id") !!}</small>
                                            @if ($errors->has('wechat'))
                                            <strong>{{ $errors->first('wechat') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                 <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('instagram') ? ' has-error' : '' }}">
                                        {!! Form::label('instagram', trans("Instagram"), array('class' => 'col-form-label')) !!} {!! Form::text('instagram', null !==(Input::old('instagram')) ? Input::old('instagram') : $selecteduser->profile_info->instagram, ['class' => 'form-control','required' => 'required','id' => 'instagram','data-parsley-required-message' => trans("enter instagram id"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your instagram id") !!}</small>
                                            @if ($errors->has('instagram'))
                                            <strong>{{ $errors->first('instagram') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </div>
                              
                                <div class="row">
                                    

                                <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                        {!! Form::label('twitter', trans("Twitter"), array('class' => 'col-form-label')) !!} {!! Form::text('twitter', null !==(Input::old('twitter')) ? Input::old('twitter') : $selecteduser->profile_info->twitter, ['class' => 'form-control','required' => 'required','id' => 'twitter','data-parsley-required-message' => trans("enter twitter username"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your twitter username") !!}</small>
                                            @if ($errors->has('twitter'))
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                           <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('tiktok') ? ' has-error' : '' }}">
                                        {!! Form::label('tiktok', trans("Tiktok"), array('class' => 'col-form-label')) !!} {!! Form::text('tiktok', null !==(Input::old('tiktok')) ? Input::old('tiktok') : $selecteduser->profile_info->tiktok, ['class' => 'form-control','required' => 'required','id' => 'tiktok','data-parsley-required-message' => trans("enter tiktok username"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your tiktok username") !!}</small>
                                            @if ($errors->has('tiktok'))
                                            <strong>{{ $errors->first('tiktok') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                     <div class="col-md-4">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('youtube') ? ' has-error' : '' }}">
                                        {!! Form::label('youtube', trans("Youtube"), array('class' => 'col-form-label')) !!} {!! Form::text('youtube', null !==(Input::old('youtube')) ? Input::old('youtube') : $selecteduser->profile_info->youtube, ['class' => 'form-control','required' => 'required','id' => 'youtube','data-parsley-required-message' => trans("enter youtube url"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your youtube url") !!}</small>
                                            @if ($errors->has('youtube'))
                                            <strong>{{ $errors->first('youtube') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </div>
                                <div class="row"> 


                              <div class="col-md-6">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('Lazada_Shop_name') ? ' has-error' : '' }}">
                                        {!! Form::label('Lazada_Shop_name', trans("Lazada Shop name"), array('class' => 'col-form-label')) !!} {!! Form::text('Lazada_Shop_name', null !==(Input::old('Lazada_Shop_name')) ? Input::old('Lazada_Shop_name') : $selecteduser->profile_info->Lazada_Shop_name, ['class' => 'form-control','required' => 'required','id' => 'Lazada_Shop_name','data-parsley-required-message' => trans("enter Lazada shop name"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your Lazada shop name") !!}</small>
                                            @if ($errors->has('Lazada_Shop_name'))
                                            <strong>{{ $errors->first('Lazada_Shop_name') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                     <div class="col-md-6">
                                    <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('Shopee_Shop_Name') ? ' has-error' : '' }}">
                                        {!! Form::label('Shopee_Shop_Name', trans("Shopee Shop Name"), array('class' => 'col-form-label')) !!} {!! Form::text('Shopee_Shop_Name', null !==(Input::old('Shopee_Shop_Name')) ? Input::old('Shopee_Shop_Name') : $selecteduser->profile_info->Shopee_Shop_Name, ['class' => 'form-control','required' => 'required','id' => 'Shopee_Shop_Name','data-parsley-required-message' => trans("enter youtube url"),'data-parsley-group' => 'block-1']) !!}
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check text-muted"></i>
                                        </div>
                                        <span class="form-text">
                                            <small>{!! trans("enter your youtube url") !!}</small>
                                            @if ($errors->has('Shopee_Shop_Name'))
                                            <strong>{{ $errors->first('Shopee_Shop_Name') }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </div> -->



<!-- end row -->
<!-- <div class="row">
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('country') ? ' has-error' : '' }}">
    {!! Form::label('country', trans("register.country"), array('class' => 'col-form-label')) !!} {!! Form::select('country', $countries ,null !==(Input::old('country')) ? Input::old('country') : $selecteduser->profile_info->country,['class' => 'form-control','id' => 'country','required' => 'required','data-parsley-required-message' => trans("all.please_select_country"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class="fa fa-flag-o text-muted"></i>
    </div>
    <span class="form-text">
        <small>{!! trans("all.select_country") !!}</small>
        @if ($errors->has('country'))
        <strong>{{ $errors->first('country') }}</strong>
        @endif
    </span>
</div>
</div>

<div class="col-md-6">
<div class="required form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    {!! Form::label('state', trans("register.state"), array('class' => 'col-form-label')) !!} {!! Form::select('state', $states ,null !==(Input::old('state')) ? Input::old('state') : $selecteduser->profile_info->state,['class' => 'form-control','id' => 'state']) !!}
    <span class="form-text">
        <small>{!! trans("all.select_your_state") !!}</small>
        @if ($errors->has('state'))
        <strong>{{ $errors->first('state') }}</strong>
        @endif
    </span>
</div>
</div>

</div> -->





<!-- end row -->



<!-- <div class="row">
begin col-6
<div class="col-md-6">
<input type="hidden" name="phone_code" id="phone_code" value="">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('phone') ? ' has-error' : '' }}">
     {!! Form::label('phone', trans("register.phone"), array('class' => 'col-form-label')) !!} {!! Form::tel('phone', null !==(Input::old('phone')) ? Input::old('phone') : $selecteduser->profile_info->mobile, ['class' => 'form-control inttl','pattern'=>'[1-9]{1}[0-9]{9}','id' => 'phone', 'required' ,'data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class=" icon-mobile3 text-muted"></i>
    </div>
    <span class="form-text">
        <small>{!! trans("all.enter_your_phone_number") !!}</small>
        @if ($errors->has('phone'))
        <strong>{{ $errors->first('phone') }}</strong>
        @endif
    </span>
</div>
</div>
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('email') ? ' has-error' : '' }}">
   {!! Form::label('email', trans("register.email"), array('class' => 'col-form-label')) !!} {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','id' => 'email','data-parsley-required-message' => trans("all.please_enter_email"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class="icon-mail5 text-muted"></i>
    </div>
    <span class="form-text">
        <small>{!! trans("all.type_your_email") !!}</small>
        @if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
        @endif
    </span>
</div>
</div>
</div> -->
<!--  <div class="text-right">
    <button class="btn btn-primary" type="submit">
         {{trans('profile.save')}} 
        <i class="icon-arrow-right14 position-right">
        </i>
    </button>
</div>

</div>

</form>
</div>
</div> -->

<div class="tab-pane" id="referrals">
<!-- Timeline -->
    <div class="card card-flat timeline-content">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">
                {{trans('users.referrals')}}
                <a class="heading-elements-toggle"></a>
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            @include('app.admin.users.referrals')
        </div>
    </div>
<!-- /timeline -->
</div>
     








<div class="tab-pane fade in" id="payout_info">
    <div class="card card-flat timeline-content">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">
                {{ trans('profile.payout_info') }}
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse">
                        </a>
                    </li>
                    <li>
                        <a data-action="reload">
                        </a>
                    </li>
                    <li>
                        <a data-action="close">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('user/payout_info/edit/'.$selecteduser->id) }}" method="post" data-parsley-validate="parsley">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if($Manual_Bank==1)
                    Bank
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.account_number') }}
                                    </label>
                                    @if(empty($selecteduser->profile_info->account_number))
                                    <input class="form-control" name="account_number" type="text" value="{{ $selecteduser->profile_info->account_number }}" required= "required" >
                                    @else
                                    <input class="form-control" name="account_number" type="text" value="{{ $selecteduser->profile_info->account_number }}" readonly>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.account_holder_name') }}
                                    </label>
                                    @if(empty($selecteduser->profile_info->account_holder_name))
                                    <input class="form-control" name="account_holder_name" type="text" value="{{ $selecteduser->profile_info->account_holder_name }}" required= "required">
                                    @else
                                    <input class="form-control" name="account_holder_name" type="text" value="{{ $selecteduser->profile_info->account_holder_name }}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.bank_swift') }}
                                    </label>
                                    @if(empty($selecteduser->profile_info->swift))
                                    <input class="form-control" name="swift" type="text" value="{{ $selecteduser->profile_info->swift }}" required= "required">
                                    @else
                                    <input class="form-control" name="swift" type="text" value="{{ $selecteduser->profile_info->swift }}" readonly>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.bank_code') }}
                                    </label>
                                    @if(empty($selecteduser->profile_info->bank_code))
                                    <input class="form-control" name="bank_code" type="text" value="{{ $selecteduser->profile_info->bank_code }}" required= "required">
                                    @else
                                    <input class="form-control" name="bank_code" type="text" value="{{ $selecteduser->profile_info->bank_code }}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.branch_address') }}
                                    </label>
                                    @if(empty($selecteduser->profile_info->branch_address))
                                    <input class="form-control" name="branch_address" type="text" value="{{ $selecteduser->profile_info->branch_address }}" required= "required">
                                    @else
                                    <input class="form-control" name="branch_address" type="text" value="{{ $selecteduser->profile_info->branch_address }}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($paypal==1)
                     <hr>
                    Paypal
                          <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.paypal_email') }}
                                    </label>
                                    <input class="form-control" name="paypal_email" type="text" value="{{ $selecteduser->profile_info->paypal }}">
                                </div>
                             
                            </div>
                        </div>


                    @endif
                    @if($Bitaps==1)
                    <hr>
                    Bitaps
                        <div class="form-group">
                            <div class="row">
                            <!-- <div class="col-md-6">
                                <label>
                                    {{ trans('register.paypal') }}
                                </label>
                                <input class="form-control" name="paypal" type="text" value="{{ $selecteduser->profile_info->paypal }}">
                                 
                            </div> -->
                                <div class="col-md-6">
                                    <label>
                                    {{ trans('register.btc_wallet_address') }}
                                    </label>
                                    <input class="form-control" name="btc_wallet" type="text" value="{{ $selecteduser->profile_info->btc_wallet }}">
                                </div>
                            </div>
                        </div>
                    @endif
                   <!--  <div>


          
                                @if($Hyperwallet==1) 
                                 <hr>
                                Hyperwallet 
                    @if(!$selecteduser->hypperwalletid == 0)
                        <div class="form-group">
                            <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                         {{trans('profile.hypper_wallet ')}} Id
                                        </label>
                                        <input class="form-control" name="hypperwalletid"  type="text" value="{{ $selecteduser->hypperwalletid }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                             {{trans('profile.hyper_wallet_token')}} 
                                        </label>
                                        <input class="form-control" name="hyperwallet_token" type="text" value="{{ $selecteduser->hypperwallet_token }}">
                                    </div>
                            </div>
                        </div>
                    @else
                        {{trans('profile.please_create_hypperwallet')}} ID 
                        <br>
                        <div>
                            <a href="{{ url('user/createhypperwalletid/'.$selecteduser->id) }}" type="button" class="btn btn-primary"> {{trans('profile. create')}} ID</a>
                         </div>
                                @endif
                    @endif
                    </div> -->
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">
                         {{trans('profile.save')}} 
                        <i class="icon-arrow-right14 position-right">
                        </i>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="settings">
<!-- Account settings -->
    <div class="card card-flat timeline-content">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">
                {{trans('profile.account_settings')}}  
            </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse">
                        </a>
                    </li>
                    <li>
                        <a data-action="reload">
                        </a>
                    </li>
                    <li>
                        <a data-action="close">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="card card-flat timeline-content">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">
                   {{ trans('register.login_password') }}
                    </h6>
                    <div class="heading-elements">
                    <ul class="icons-list">
                        <li>
                        <a data-action="collapse">
                        </a>
                        </li>
                        <li>
                        <a data-action="reload">
                        </a>
                        </li>
                        <li>
                        <a data-action="close">
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('user/loginPassword_settings') }}" method="post" >
                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label>
                                    {{ trans('register.new_login_password') }}
                                    </label>
                                    <input class="form-control" name="new_loginPassword" type="password" value="">
                 
                                    </div>
                                    <div class="col-md-6">
                                    <label>
                                    {{ trans('register.confirm_password') }}
                                    </label>
                                    <input class="form-control" name="confirm__loginPassword" type="password" value="">
                                    </div>   
                                </div>
                            </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">
                                      {{ trans('register.update') }}
                                        <i class="icon-arrow-right14 position-right">
                                        </i>
                                    </button>
                                </div>
                                <input class="form-control" name="id" type="hidden" value="{{$selecteduser->id}}">
                    </form>
                </div>
            </div>
          <!--   <div class="card card-flat timeline-content">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">
                  {{trans('profile.update_transaction_password')}} 
                    </h6>
                    <div class="heading-elements">
                    <ul class="icons-list">
                        <li>
                        <a data-action="collapse">
                        </a>
                        </li>
                        <li>
                        <a data-action="reload">
                        </a>
                        </li>
                        <li>
                        <a data-action="close">
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('user/transactionPassword_settings') }}" method="post" >
                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label>
                                    {{trans('profile.new_transaction_password')}} 
                                    </label>
                                    <input class="form-control" name="new_transactionPassword" type="password" value="">
                 
                                    </div>
                                    <div class="col-md-6">
                                    <label>
                                   {{trans('profile.confirm_transaction_password')}}  
                                    </label>
                                    <input class="form-control" name="confirm_transactionPassword" type="password" value="">
                                    </div>   
                                </div>
                            </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">
                                      {{trans('profile.update')}} 
                                        <i class="icon-arrow-right14 position-right">
                                        </i>
                                    </button>
                                </div>
                                <input class="form-control" name="id" type="hidden" value="{{$selecteduser->id}}">
                    </form>
                </div>   
            </div> -->

        <!--     <div class="card card-flat timeline-content">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">
                  {{ trans('register.2_f_a_authentication') }}
                    </h6>
                    <div class="heading-elements">
                     <ul class="icons-list">
                        <li>
                        <a data-action="collapse">
                        </a>
                        </li>
                        <li>
                        <a data-action="reload">
                        </a>
                        </li>
                        <li>
                        <a data-action="close">
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-body">
                <form action="{{ url('user/2fa_authentication/'.$selecteduser->id) }}" method="post" >
                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                            <div class="form-group">
                              <label class="col-md-12"> 2FA {{trans('profile.authentication')}}  :</label>
                                <div class="col-md-6">
                                    <input type=radio name="enable_2fa" value="1" {{ $selecteduser->enable_2fa == '1' ? 'checked' : ''}}> {{trans('profile.enabled')}} </option>
                                    &nbsp;
                                    <input type=radio name="enable_2fa" value="0" {{ $selecteduser->enable_2fa == '0' ? 'checked' : ''}}> {{trans('profile.disabled')}} </option>            
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">
                                      {{ trans('register.update') }}
                                    <i class="icon-arrow-right14 position-right">
                                    </i>
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>   
            </div> -->
        </div>
    </div>
<!-- /account settings -->
</div>

</div>
<!-- /left content -->


<!-- Right sidebar component -->
    <div class="sidebar-component-right wmin-300 border-0  sidebar-expand-md">

    <!-- Sidebar content -->
    <div class="sidebar-content">
        <div class="card card-body d-xsmall-none">
        <div class="row text-center">
            <div class="col">
                <p>
                    <i class="icon-medal-star icon-2x display-inline-block text-warning">
                    </i>
                </p>
                <h5 class="text-semibold no-margin">
                    {{ $GLOBAL_RANK }}
                </h5>
                <span class="text-muted text-size-small">
                    {{trans('User Type')}}  
                </span>
            </div>
            <div class="col">
                <p>
                    <i class="icon-users2 icon-2x display-inline-block text-info">
                    </i>
                </p>
                <h5 class="text-semibold no-margin">
                    {{ $referrals_count }}
                </h5>
                <span class="text-muted text-size-small">
                    {{ trans('all.referrals') }}
                </span>
            </div>
            <div class="col">
                <p>
                    <i class="icon-cash3 icon-2x display-inline-block text-success">
                    </i>
                </p>
                <h5 class="text-semibold no-margin">
                    {{ currency(round($balance,2)) }}
                </h5>
                <span class="text-muted text-size-small">
                    {{ trans('all.balance') }}
                </span>
            </div>
        </div>
    </div>
              <div class="content-group">
        @if(isset($sponsor->username))
        @if($sponsor->id > 7)
        <div background-size:="" class="card-body bg-blue border-radius-top text-center" contain;"="">
            <div class="content-group-sm">
                <h5 class="text-semibold no-margin-bottom">
                     {{trans('profile.sponsor_information')}} 
                </h5>
            </div>
        </div>
        <div class="card card-body no-border-top no-border-radius-top">
            <div class="form-group mt-1">
                <label class="text-semibold">
                     {{trans('profile.sponsor_name')}}:
                </label>
                <span class="float-right">
                    {{ $sponsor->name }}
                </span>
            </div>
            <div class="form-group mt-1">
                <label class="text-semibold">
                    {{trans('profile.sponsor_username')}}:
                </label>
                <span class="float-right">
                    {{ $sponsor->username }}
                </span>
            </div>
            <div class="form-group mt-1">
                <label class="text-semibold">
                    {{trans('profile.sponsor_country')}}:
                </label>
                <span class="float-right">
                    {{ $sponsor->profile_info->country }}
                </span>
            </div>
            <div class="form-group mt-1">
                <label class="text-semibold">
                   {{trans('profile.date_joined')}}:
                </label>
                <span class="float-right">
                    {{ $sponsor->profile_info->created_at->toFormattedDateString() }}
                </span>
            </div>
        </div>
        @endif
        @endif
    </div>
            <!-- Share your thoughts -->
            <div class="card card-flat">
        <div class="card-header header-elements-inline">
                <h6 class="card-title">
                  {{trans('profile.create_a_note')}}    
                   
                </h6>
                <div class="heading-elements">
                </div>
            </div>
            <div class="card-body">
                <form action="#" class="usernotesform" data-parsley-validate="">
                    <div class="form-group">
                        <input class="form-control mb-13" cols="1" id="title" name="title" placeholder="Note title" required="" type="text"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-13" cols="1" id="description" name="description" placeholder="Note content" required="" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        
                        <div class=" " id="note-color" data-toggle="buttons">
                        <label class="btn btn-primary btn-xs">
                          <input type="radio" name="color" value="bg-primary" >  {{trans('profile.primary')}}  </label>
                        <label class="btn btn-success btn-xs">
                          <input type="radio" name="color" value="bg-success"> {{trans('profile.success')}} </label>
                          <br>
                        <label class="btn btn-info btn-xs">
                          <input type="radio" name="color" value="bg-info"> {{trans('profile.info')}} </label>
                        <label class="btn btn-warning btn-xs">
                          <input type="radio" name="color" value="bg-warning"> {{trans('profile.warning')}} </label>
                          <br>
                        <label class="btn btn-danger btn-xs">
                          <input type="radio" name="color" value="bg-danger"> {{trans('profile.danger')}} </label>
                        </div>
                    </div>
                    <div class="row"> 
                         <div class="col-6">
                        <a class="btn btn-link" href="{{ url('user/notes') }}">
                            {{trans('profile.view_all_notes')}}  
                            <i class="icon-arrow-right14 position-right">
                            </i>
                           
                        </a>
                    </div>

                        <div class="col-6 text-right">
                            <button class="submit-user-note btn btn-primary btn-labeled btn-labeled-right" type="button">
                                {{trans('profile.save')}}  
                                <b>
                                <i class="icon-circle-right2">
                                </i>
                            </b>
                            </button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
 
                        </div>
                        <!-- /sidebar content -->

                    </div>
                    <!-- /right sidebar component -->




                </div>
                <!-- /inner container -->

            </div>
            <!-- /content area -->





@endsection 
{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
     $('.submit-user-note').click(function () {
        $('.usernotesform').submit();
    });
    $(".usernotesform").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $('.usernotesform').parsley().validate();
    if ($('.usernotesform').parsley().isValid()) {
        var block = $(this).parent().parent().parent().parent();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/user/postusernote',
            data: new FormData($('.usernotesform')[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function beforeSend() {
                $(block).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function success(response) {
                $(block).unblock();
                $('.usernotesform').find("input[type=text], textarea").val("");
                new PNotify({
                    text: 'Note Added',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
                if ($('#notes').length) {
                    $newNote = '<div class="each-note col-sm-4"><div class="panel ' + response.color + '"><div class="panel-body"><div class="media"><div class="media-left"><i class=" icon-file-text3 text-warning-400 no-edge-top mt-5"></i></div><div class="media-body"><h6 class="media-heading text-semibold">' + response.title + ' - <i class="text-xs">' + response.date + '</i></h6>' + response.description + '</div></div></div><div class="panel-footer ' + response.color + ' panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a><div class="heading-elements"><button class="btn  btn-link btn-xs heading-text text-default btn-delete-note" data-id="' + response.id + ' " type="button"><i class="icon-trash text-size-small position-right"></i></button></div></div></div></div>';
                    $('#notes>.row:first-child').append($newNote);
                }
            }
        });
    } else {
        console.log('not valid');
    }
});

//     $(document).ready(function () {
//     if ($(".btn-delete-note").length) {
//         $('#notes').on('click', '.btn-delete-note', function (e) {
//             var id = $(this).data('id');
//             var this_context = $(this);
//             // confirm('Are you sure you want to delete the note?','confirmation','yes','no');
//             swal({
//                 title: "Are you sure?",
//                 text: "Your will not be able to recover this note!",
//                 type: "warning",
//                 showCancelButton: true,
//                 confirmButtonClass: "btn-danger",
//                 confirmButtonText: "Yes, delete it!",
//                 closeOnConfirm: false
//             }, function () {
//                 //console.log(id);
//                 $.ajax({
//                     url: CLOUDMLMSOFTWARE.siteUrl + '/user/notes/'+id,
//                     data: {
//                         'note_id': id
//                     },
//                     dataType: 'json',
//                     async: true,
//                     type: 'delete',
//                     beforeSend: function beforeSend() {
//                         this_context.closest('.each-note');
//                     },
//                     success: function success(response) {
//                         this_context.closest('.each-note').remove();
//                         swal('Deleted!');
//                         setTimeout(function () {}, 2000);
//                     },
//                     error: function error(response) {
//                         swal('Something went wrong!');
//                     }
//                 });
//             });
//         });
//     }
// });
</script>

<script>
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
</script><script>
   $('#shipp_country').change(function(){
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
    jQuery(document).ready(function ($) {

  $('.nav .a-tab').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})  
    
    $('a.scroll').on('click', function (e) {
        var href = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $("#profile_tabs_wrapper").offset().top
        }, 'slow');
        e.preventDefault();
    });
    
});
</script>
<script type="text/javascript">
     $('[data-popup="tooltip"]').tooltip({
        display: 'none'
    });
</script>
<script type="text/javascript">
    $("#myModal").on("hidden.bs.modal", function () {
        oTable.ajax.reload();
    })
</script>
@endsection

@section('styles')
@parent
<style type="text/css">
    div#profilephotopreview {
    background-size: cover;
}
</style>

@endsection
