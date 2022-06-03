<div class="header-wrapper">
<header>
  <div class="container">
    <div class="row">
      <div class="col-xs-4">
        <a href="{{ url('/') }}">{{ Html::image(route('imagecache', ['template' => 'original', 'filename' => 'logo.png']), 'Logo', array('class' => '','style'=>'height: 23px;margin-top: 18px;')) }}</a>
      </div>    
      <div class="col-xs-8 signin text-right navbar-nav">
      
      @include('site.partials.language')
  
      
      @if (Auth::guest())
        <a href="{{ url('/login') }}">@lang('site.sign_in') </a>&nbsp; &nbsp;
        <!-- <a href="{{ url('/register') }}">@lang('site.register') </a> -->
      @else
      <ul id="user-right" class="list-inline">
       <li>
       {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => Auth::user()->profile_info->image]), 'a picture', array('class' => 'thumb','style'=>'width:16px;display: inline-block;')) }}
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
         {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu pull-right" role="menu">
            @if(Auth::check() && Auth::user()->admin == "1")
            <li><a href="{{ url('admin/profile')}}"><i class="fa fa-btn fa-sign-out"></i>My profile</a></li>
            <li><a href="{{ url('/admin/dashboard') }}">@lang('site.dashboard') </a></li>    
            @endif        
            @if(Auth::check() && Auth::user()->admin == "0")
            <li><a href="{{ url('/user/profile')}}"><i class="fa fa-btn fa-sign-out"></i>My profile</a></li>
            <li><a href="{{ url('/user/dashboard') }}">@lang('site.dashboard') </a></li>
            @endif
      
            <!-- <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li> -->
             <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

        </ul>
        </li>
       </ul>
       @endif
      </div>
    </div>     
  </div>
</header>

</div>
