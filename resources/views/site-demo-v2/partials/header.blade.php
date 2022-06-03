 <div class="nav-container">
            <div>
                <div class="bar bar--sm visible-xs">
                    <div class="container">
                        <div class="row">
                            <div class="col-3 col-md-2">
                                

                                <a href="/"> 
<!-- {{ Html::image(route('imagecache', ['template' => 'original', 'filename' => 'logo.png']), 'a picture', array('class' => 'logo logo-dark','style'=>'width:16px;display: inline-block;')) }}
{{ Html::image(route('imagecache', ['template' => 'original', 'filename' => 'logo.png']), 'a picture', array('class' => 'logo logo-light','style'=>'width:16px;display: inline-block;')) }}
 -->
                            <img class="logo logo-light" alt="Image" src="{{ asset('site-demo-v2/img/all/logo.png')}}" class="logo"/>
                            <img class="logo logo-dark" alt="Image" src="{{ asset('site-demo-v2/img/all/logo.png')}}" class="logo"/>

                            </div>

                            <div class="col-9 col-md-10 text-right">
                                <a href="#" class="hamburger-toggle" data-toggle-class="#menu2;hidden-xs hidden-sm"> <i class="icon icon--sm stack-interface stack-menu"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <nav id="menu2" class="bar bar-2 hidden-xs bar--transparent bar--absolute" data-scroll-class='100vh:pos-fixed' data-step="2" data-intro="Lets see how you can log in into the system">
                    <div class="container">
                        <div class="row">


                            <div class="col-lg-2 text-center text-left-sm hidden-xs order-lg-2" >
                                <div class="bar__module">
                                    <a href="/"> 
<!-- 
{{ Html::image(route('imagecache', ['template' => 'original', 'filename' => 'logo.png']), 'a picture', array('class' => 'logo logo-dark','style'=>'max-height: 128px;')) }}
{{ Html::image(route('imagecache', ['template' => 'original', 'filename' => 'logo.png']), 'a picture', array('class' => 'logo logo-light','style'=>'width: 108px;max-height: 128px;')) }}

 -->
                            <img class="logo logo-light" style="max-height: 128px;"  alt="Image" src="{{ asset('site-demo-v2/img/all/logo.png')}}" class="logo"/>
                            <img class="logo logo-dark hidden" style="max-height: 128px;" alt="Image" src="{{ asset('site-demo-v2/img/all/logo.png')}}" class="logo"/>
                             
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 order-lg-1">
                                <div class="bar__module">
        <div class="modal-instance pull-right-no blockviewinsmscreen centerinsmallscreen">
            <a class="modal-trigger menu-toggle" href="#"> <i class="stack-interface stack-menu"></i> </a>
            <div class="modal-container menu-fullscreen">
                <div class="modal-content" data-width="100%" data-height="100%">
                    <div class="pos-vertical-center pos-asbolute text-center">
                        <div class="heading-block"> <img alt="Image" src="{{ asset('site-demo-v2/img/all/logo.png')}}" class="logo">
                            <p class="lead"> This is the demo website/landing page your users will be able to access first. Can be customized/redesized 
<br class="hidden-xs hidden-sm">  to suit your business. </p>
                        </div>
                        <ul class="menu-vertical" >
                            <li class="h4"> <a href="{{ url('/login') }}" id="xxx" style="display: block;position: relative;" data-step="3" data-intro="Click on this link to login. You can ask for login details at skype:cloudmlmsofwtare"  data-position='right' >login</a> </li>
                            <li class="h4"> <a href="{{ url('/register') }}">Sign Up</a> </li>
                        </ul>
                    </div>
                    <div class="pos-absolute pos-bottom text-center">
                        <ul class="social-list list-inline list--hover">
                            <li><a href="#"><i class="socicon socicon-google icon icon--xs"></i></a></li>
                            <li><a href="#"><i class="socicon socicon-twitter icon icon--xs"></i></a></li>
                            <li><a href="#"><i class="socicon socicon-facebook icon icon--xs"></i></a></li>
                            <li><a href="#"><i class="socicon socicon-instagram icon icon--xs"></i></a></li>
                        </ul>
                        <p class="type--fine-print type--fade">© Your Company 2018. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            </div>

                           @if (Auth::guest())


                            <div class="col-lg-5 text-right text-left-xs text-left-sm order-lg-3">
                                <div class="bar__module">
                                    <ul class="menu-horizontal text-left">
                                        <li class="centerinsmallscreen"> <a href="{{ url('/login') }}" class="type--uppercase btn__text">
                                        Login
                                    </a> </li>
                                    </ul>
                                </div>

                                <div class="bar__module">

                                    <a class="btn btn--sm type--uppercase yellowbtn" href="{{ url('/register') }}"> <span class="btn__text">
                                    Sign Up
                                </span> </a>
                                </div>
                            </div>

                            @endif     

                            

                            @if(Auth::check() && Auth::user()->admin == "1")

                            <div class="col-lg-5 text-right text-left-xs text-left-sm order-lg-3">
                                <div class="bar__module">
                                    <ul class="menu-horizontal text-left">
                                        <li class="centerinsmallscreen"> <a href="{{ url('admin/userprofile')}}" class="type--uppercase btn__text">
                                        My Profile
                                    </a> </li>
                                    </ul>
                                </div>

                                <div class="bar__module">
                                    <a class="btn btn--sm type--uppercase yellowbtn" href="{{ url('admin/dashboard') }}"> <span class="btn__text">
                                    Dashboard
                                </span> </a>
                                </div>

                                <div class="bar__module">
                                    <a class="btn btn--sm type--uppercase yellowbtn" href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> <span class="btn__text">
                                    Logout
                                </span> </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                </form>

                                </div>


                            </div>

                            @endif

                            @if(Auth::check() && Auth::user()->admin == "0")

                            <div class="col-lg-5 text-right text-left-xs text-left-sm order-lg-3">
                                <div class="bar__module">
                                    <ul class="menu-horizontal text-left">
                                        <li> <a href="{{ url('user/profile')}}" class="type--uppercase btn__text">
                                        My Profile
                                    </a> </li>
                                    </ul>
                                </div>

                                <div class="bar__module">
                                    <a class="btn btn--sm type--uppercase yellowbtn" href="{{ url('user/dashboard') }}"> <span class="btn__text">
                                    Dashboard
                                </span> </a>
                                </div>

                                <div class="bar__module">
                                    <a class="btn btn--sm type--uppercase yellowbtn" href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> <span class="btn__text">
                                    Logout
                                </span> </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                </form>

                                </div>


                            </div>

                            @endif



                        </div>
                    </div>
                </nav>
            </div>
        </div>
