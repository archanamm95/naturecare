<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ config('app.name', 'Cloud MLM Software') }}</title>
    @show @section('meta_description')
    <meta name="description" content="@lang('site.site_description_value')"/>@show 
    @show @section('og_title')
    <meta property="og:title" content="">@show 
    @show @section('og_type')
    <meta property="og:type" content="website">@show 
    @show @section('og_url')
    <meta property="og:url" content="">@show 
    @show @section('og_sitename')
    <meta property="og:site_name" content="">@show 
    @show @section('og_description')
    <meta property="og:description" content="">@show 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->


    <link id="favicon" rel="shortcut icon" href="{{ url('img/cache/logo/'.$logo_icon_light)}}" type="image/png" />
   <link href="{{ mix('/frontend/frontend.css') }}" rel="stylesheet"/>
      @yield('styles')
</head>
 <body class="font-sans" data-smooth-scroll-offset="77">

  
@include('site-demo-v2.partials.header')
@yield('content')
@include('site-demo-v2.partials.footer')
@yield('topscripts')
@yield('overscripts')
  <script src="{{ mix('/frontend/frontend.js') }}"></script>
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

<script type="text/javascript">
  /*IntroJs().start()  */


</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70977094-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-70977094-2');
</script>

</body>
</html>
