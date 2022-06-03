<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @include('favicon')


    <title>{{ config('app.name', 'Cloud MLM Software') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/backend/backend.css') }}" rel="stylesheet">
    <!-- <link href="/extra.css" rel="stylesheet"> -->
    @yield('styles')
</head>

<body class="font-sans login-container {{$theme_skin_class}}">

<!-- Main navbar -->

    <!-- Main navbar -->
   

   <!-- Main navbar -->
   <div id="header-sticky" class="header-sticky header_sticky_on">
<div id="header-default" class="header_default header-layout">
<header>

   <div class="full-header">
    
    <div class="header-left">
    <!--     <div id="logo">
            <a href="https://www.sheheme.com.my/index.php?route=common/home"><img src="{{ url('img/cache/original/'.$logo_light)}}" title="NatucgbfreCare" alt="NatureCare" class="img-responsive"></a>
        </div> -->
        <div id="mobile-logo">
            <a href="https://www.sheheme.com.my/index.php?route=common/home"><img src="{{ url('img/cache/original/'.$logo_light)}}" title="NatureCare" alt="NatureCare" class="mobile-logo"></a>
        </div>
    </div>
    
   <!--  <div class="header-right" style="float: right;width: auto;padding: 0">
        <aside id="header-left">
            <div class="main-category-list">
                <div class="TT-panel-heading">
                    <span>menu</span>
                    <span class="icon"><i class="material-icons icon-menu">menu</i></span>
                </div>
                <div class="tt-menu horizontal-menu tt-menu-bar" id="tt-menu-6890">
                <div class="menu-close"><i class="material-icons">close</i></div>
                    <ul class="ul-top-items" style="display: block;"> -->
                    <!--     <li class="li-top-item"> -->
                         <!--    <a class="a-top-link text-uppercase" href="https://www.sheheme.com.my/index.php?route=common/home">
                                <span>Home</span> -->
                       <!--      </a>
                        </li>  -->                                 
<!--                         <li class="li-top-item mega-menu">
                            <a class="a-top-link text-uppercase" href="http://store-sheheme.cloudmlm.online/index.php?route=product/    product&product_id=50">
                                <span>Shop</span>
                            </a>
                        </li>
                        <li class="li-top-item ">
                            <a class="a-top-link text-uppercase" href="http://store-sheheme.cloudmlm.online/index.php?route=product/category/becomePartner">
                                <span>Become Partner</span>
                            </a>
                        </li>                                            
                        <li class="li-top-item ">
                            <a class="a-top-link text-uppercase" href="http://store-sheheme.cloudmlm.online/index.php?route=information/contact">
                                <span>Contact Us</span>
                            </a>
                        </li>        
                        <li class="li-top-item ">
                            <a class="a-top-link text-uppercase" href="http://store-sheheme.cloudmlm.online/index.php?route=product/category/about">
                                <span>About Us</span>
                            </a>
                        </li>        -->                                                                                
                <!--     </ul>
                </div>
            </div>
        </aside>
    </div>  -->   
</div>
</header>
</div>
</div>
    <!-- /main navbar --> <!-- Main navbar -->

    @yield('secondary_navbar')

    <!-- /main navbar -->

 <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <!-- <div class="content"> -->

                    @yield('content')

                <!-- </div> -->
                <!-- /content area -->
                <!-- Footer -->
            <div class="navbar navbar-expand-lg navbar-light d-none">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-footer">
                    <span class="navbar-text">
                        &copy; 2018 - 2019. <a href="#">{{ config('app.name', 'Cloud MLM Software') }}</a> <a href="https://cloudmlmsoftware.com" target="_blank"></a>
                    </span>

                    <ul class="navbar-nav ml-lg-auto">
                        <li class="nav-item"><a href="https://cloudmlmsoftware.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support </a></li>
                        <li class="nav-item"><a href="http://demo.cloudmlmsoftware.com/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Demo </a></li>
                    </ul>
                </div>
            </div>
            <!-- /footer -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->





@yield('overscripts')

<script>
    window.CLOUDMLMSOFTWARE = {
       "siteUrl":"{{ URL::to('/') }}"  
    };
</script>

<!-- Scripts -->
<script src="{{ mix('/backend/backend.js') }}"></script>
@yield('scripts')
@if (isset($errors) && !$errors->isEmpty())
<script type="text/javascript">
swal("","@foreach ($errors->all() as $error){{ $error }}@endforeach","error");
</script>
@endif
@if (session()->has('flash_notification.message'))
  @if (session()->has('flash_notification.overlay'))
      <script type="text/javascript">
       swal("{!! Session::get('flash_notification.title') !!}","{!! Session::get('flash_notification.message') !!}","{!! Session::get('flash_notification.level') !!}");
      </script>
  @else
      <script type="text/javascript">
       swal("{!! session('flash_notification.level') !!}"," {!! session('flash_notification.message') !!}","{!! session('flash_notification.level') !!}");
      </script>
  @endif
@endif


</body>
</html>
