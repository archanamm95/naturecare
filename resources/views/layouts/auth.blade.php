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
    <link href="/extra.css" rel="stylesheet">
    @yield('styles')
</head>

<body class="font-sans login-container {{$theme_skin_class}}">

<!-- Main navbar -->

    <!-- Main navbar -->
   

   <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-light">
   <!--      <div class="navbar-brand">
            <a href="{{ URL::to('/home') }}" class="d-inline-block">
               <img src="{{ url('img/cache/original/'.$logo_light)}}" alt="{{ config('app.name', 'Cloud MLM Software') }}" class="rounded-circle" style="height:100px;width:150px;margin-left:8px;margin-top: 15px;">
            </a>
        </div> -->

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>


        <div class="collapse navbar-collapse" id="navbar-mobile">
            
            <span class="navbar-text ml-md-3 mr-md-auto">
                <!-- <span class="badge bg-success">STATUS : Healthy</span> -->
            </span>

            <ul class="navbar-nav">
               <!--  
                <li class="nav-item dropdown currency-switch">
                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                         <i class="fa fa-{{strtolower(currency()->getUserCurrency())}}"></i>
                        <span class="d-md ml-2">{{currency()->getUserCurrency()}} - {{currency()->__get('name')}}</span>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-right">                        
                        @foreach (currency()->getActiveCurrencies() as $curr => $currency)
                            @if ($curr != strtolower(currency()->getUserCurrency()))
                            @endif                        
                           <li><a class="dropdown-item {{ $curr == strtolower(currency()->getUserCurrency()) ? 'active' : '' }}" href="{{url('/')}}/{{Route::getFacadeRoot()->current()->uri()}}/?currency={{$curr}}">  <span class="currency-symbol">{{$currency['symbol']}}</span> <span class="currency-code"> {{strtoupper($curr)}}</span><span class="currency-name"> {{$currency['name']}}</span></a></li>
                         @endforeach                       
                    </ul>
                </li>
 -->
                <li class="nav-item dropdown language-switch">

                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                         <span class="lang-xs lang-lbl" lang="{{ Lang::locale()}}"></span>                     
                        <span class="caret"></span>
                    </a>



                     <ul class="dropdown-menu dropdown-menu-right">      
                     @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != Lang::locale())
                        @endif
                        <a class="dropdown-item deutsch {{ $lang == Lang::locale() ? 'active' : '' }}" href="{{ route('lang.switch', $lang) }}"> <span class="lang-xs lang-lbl" lang="{{$language}}"></span></a>  
                    @endforeach
                    </ul>

                </li>



                
           
                <li class="nav-item  ">
                    <a href="{{ route('login') }}" class="navbar-nav-link">
                        <span>Login</span>
                    </a>

                </li>
               

            </ul>
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
