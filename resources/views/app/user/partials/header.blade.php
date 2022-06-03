   

   <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-light fixed-top navbar-xs-dark">
        
        <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
            <div class="navbar-brand navbar-brand-md">
                   <a href="{{ URL::to('/home') }}" class="d-inline-block">
                    <img src="{{ url('img/cache/original/'.$logo_light)}}"  style="height: auto;width: 25px;margin-left: 65px;" alt="{{ config('app.name', 'Cloud MLM Software') }}">
                </a>
            </div>
            
            <div class="navbar-brand navbar-brand-xs">
                <a href="{{ URL::to('/home') }}" class="d-inline-block">
                    <img src="{{ url('img/cache/original/'.$logo_light)}}" alt="{{ config('app.name', 'Cloud MLM Software') }}">
                </a>
            </div>
        </div>     
        
        <div class="d-md-none d-flex w-100">
            <div class="col-3 text-left">
             <button class="navbar-toggler sidebar-mobile-main-toggle text-white" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
            </div>
            <div class="col-6 mt-2 text-center">
                  <a href="{{ URL::to('/home') }}" class="d-inline-block">
                    <img src="{{ url('img/cache/original/'.$logo_light)}}"  style="height: auto;width: 65px;" alt="{{ config('app.name', 'Cloud MLM Software') }}">
                </a>
            </div>
            <div class="col-3 d-flex text-right">
                 <a href="#" class="dropdown-toggle caret-0 text-white xs-head-bell" data-toggle="dropdown" >
                       <!--  <svg class="feather d-inline-block" style="height: 18px;"> --> <i class="icon-comment"></i>
                        <!-- <span class="d-md-none ml-2">{{trans('all.messages')}}</span> -->
                        <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"> @if($unread_count > 0){!!$unread_count!!} @else 0 @endif </span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                        <div class="dropdown-content-header">
                            <!--  <span class="badge bg-warning-400">   
                                @if($unread_count > 0){!!$unread_count!!} @else 0 @endif
                             </span> -->
                             <span class="font-weight-semibold">{{trans('all.messages')}}</span>
                           
                           <!--  <a href="{{url('admin/inbox#/u/mail/compose')}}" class="text-default"><i class="icon-compose"></i></a> -->
                        </div>

                        <div class="dropdown-content-body dropdown-scrollable">
                            <ul class="media-list">

                                <div class="dropdown-content-heading text-center">
                                    @if($unread_count == 0) {{trans('all.no_unread_messages')}} @else({!!$unread_count!!}) {{trans('all.unread_messages')}} @endif                                    
                                </div>

                                @if(isset($unread_mail))
                                 @foreach($unread_mail as $mail)
                                 
                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="{{url('img/cache/profile/')}}/{{$image}}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="{{url('user/inbox')}}">
                                                <span class="font-weight-semibold">{!!$mail->username!!}</span>
                                                <span class="text-muted float-right font-size-sm">{!! Date('h:i A',strtotime($mail->created_at))!!}</span>
                                            </a>
                                        </div>
                                        <span class="text-muted">{!!$mail->message_subject!!}...</span>
                                    </div>



                                </li>
                                 @endforeach
                                 @endif

                            
                            </ul>
                        </div>

                        <div class="dropdown-content-footer justify-content-center p-0">
                             <a href="{{url('user/inbox')}}" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Go to inbox"><i class="icon-menu7 d-block top-0"></i></a>
                        </div>
                    </div>
            <button class="navbar-toggler text-white xs-nav-ml" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-cog"></i>
            </button>
           
            <!--  <button class="navbar-toggler text-white" type="button" type="button" data-toggle="collapse" data-target="#messages-xs">
                <i class="icon-bell2"></i>
                <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"> @if($unread_count > 0){!!$unread_count!!} @else 0 @endif </span>
            </button> -->
          
        </div>
        </div>         
      
        

 @if(Auth::check())

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

     

            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item dropdown language-switch">

                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                         <span class="lang-xs lang-lbl" lang="{{App::getLocale()}}"></span>                     
                        <span class="caret"></span>
                    </a>



                     <ul class="dropdown-menu dropdown-menu-right">      
                     @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        @endif
                        <a class="dropdown-item deutsch {{ $lang == App::getLocale() ? 'active' : '' }}" href="{{ route('lang.switch', $lang) }}"> <span class="lang-xs lang-lbl" lang="{{$language}}"></span></a>
                    @endforeach
                    </ul>

                </li>


                <li class="nav-item dropdown nav-message-hiden">
                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown" >
                        <svg class="feather d-inline-block" style="height: 18px;"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#message-square"></use></svg>
                        <span class="d-md-none ml-2">{{trans('all.messages')}}</span>
                        <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0"> @if($unread_count > 0){!!$unread_count!!} @else 0 @endif </span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                        <div class="dropdown-content-header">
                            <!--  <span class="badge bg-warning-400">   
                                @if($unread_count > 0){!!$unread_count!!} @else 0 @endif
                             </span> -->
                             <span class="font-weight-semibold">{{trans('all.messages')}}</span>
                           
                           <!--  <a href="{{url('admin/inbox#/u/mail/compose')}}" class="text-default"><i class="icon-compose"></i></a> -->
                        </div>

                        <div class="dropdown-content-body dropdown-scrollable">
                            <ul class="media-list">

                                <div class="dropdown-content-heading text-center">
                                    @if($unread_count == 0) {{trans('all.no_unread_messages')}} @else({!!$unread_count!!}) {{trans('all.unread_messages')}} @endif                                    
                                </div>

                                @if(isset($unread_mail))
                                 @foreach($unread_mail as $mail)
                                 
                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="{{url('img/cache/profile/')}}/{{$image}}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="{{url('user/inbox')}}">
                                                <span class="font-weight-semibold">{!!$mail->username!!}</span>
                                                <span class="text-muted float-right font-size-sm">{!! Date('h:i A',strtotime($mail->created_at))!!}</span>
                                            </a>
                                        </div>
                                        <span class="text-muted">{!!$mail->message_subject!!}...</span>
                                    </div>



                                </li>
                                 @endforeach
                                 @endif

                            
                            </ul>
                        </div>

                        <div class="dropdown-content-footer justify-content-center p-0">
                             <a href="{{url('user/inbox')}}" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Go to inbox"><i class="icon-menu7 d-block top-0"></i></a>
                        </div>
                    </div>
                </li>



                

                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">                       
                        {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $image]), 'Admin', array('class' => 'rounded-circle','style'=>'')) }}

                        <span>{{ ucfirst(Auth::user()->name) }}@if(Session::get('impersonate') == "yes")[impersonating]@endif</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">

                                   @if(Auth::user()->id==1)
                        <a class="dropdown-item" href="{{ URL::to('admin/userprofile') }}"><svg class="feather mr-2" style=" width: 18px; "> <use xlink:href="/backend/icons/feather/feather-sprite.svg#user"></use> </svg>{{trans('all.my_profile')}}</a>
                        <a class="dropdown-item" href="{{ URL::to('admin/dashboard') }}"><<svg class="feather mr-2" style="width: 18px;"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#home"></use> </svg> {{trans('all.dashboard')}} </a>
                    @else 
                       <a class="dropdown-item" href="{{ URL::to('user/profile') }}"><svg class="feather mr-2" style=" width: 18px; "> <use xlink:href="/backend/icons/feather/feather-sprite.svg#user"></use> </svg>{{trans('all.my_profile')}}</a>
                        <a class="dropdown-item" href="{{ URL::to('user/dashboard') }}"><svg class="feather mr-2" style="width: 18px;"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#home"></use> </svg> {{trans('all.dashboard')}} </a>
                    @endif
                       @if(Session::get('impersonate') == "yes")
                       <a class="dropdown-item" href="{{ URL::to('user/impersonate') }}"><svg class="feather mr-2" style=" width: 18px; "> <use xlink:href="/backend/icons/feather/feather-sprite.svg#corner-down-left"></use> </svg>{{trans('all.back_to_impersonator')}}</a>
                    @endif
                    <a class="dropdown-item" href="{{ config('app.site_url')}}" target="_blank"><svg class="feather mr-2" style=" width: 18px; "> <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-cart"></use> </svg>{{trans('Shop')}}</a>
                    <a class="dropdown-item" href="{{ url('/logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><svg class="feather mr-2" style=" width: 18px; "> <use xlink:href="/backend/icons/feather/feather-sprite.svg#log-out"></use> </svg>{{trans('all.logout')}}</a></li>

                    
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    
                    


                    </div>
                </li>
            </ul>
        </div>

        @endif 

    </div>
    <!-- /main navbar --> <!-- Main navbar -->

