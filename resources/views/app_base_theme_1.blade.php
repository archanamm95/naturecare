<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]>   <![endif]-->
<html class="no-js" lang="{{ app()->getLocale() }}" itemscope itemtype="http://schema.org/website" style="--cloudmlm-primary: 115,103,240;--cloudmlm-success:40,199,111;--cloudmlm-danger:234,84,85;--cloudmlm-warning:255,159,67;--cloudmlm-dark:30,30,30;"> <!--<![endif]-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="">    
    <!-- Favicon /-->
    <link rel="shortcut icon" sizes="57x57" href="../favicon/apple-icon-57x57.png"> <link rel="shortcut icon" sizes="60x60" href="../favicon/apple-icon-60x60.png"> <link rel="shortcut icon" sizes="72x72" href="../favicon/apple-icon-72x72.png"> <link rel="shortcut icon" sizes="76x76" href="../favicon/apple-icon-76x76.png"> <link rel="shortcut icon" sizes="114x114" href="../favicon/apple-icon-114x114.png"> <link rel="shortcut icon" sizes="120x120" href="../favicon/apple-icon-120x120.png"> <link rel="shortcut icon" sizes="144x144" href="../favicon/apple-icon-144x144.png"> <link rel="shortcut icon" sizes="152x152" href="../favicon/apple-icon-152x152.png"> <link rel="shortcut icon" sizes="180x180" href="../favicon/apple-icon-180x180.png"> <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png"> <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png"> <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png"> <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png"> <link rel="manifest" href="../favicon/manifest.json"> <meta name="msapplication-TileColor" content="#ffffff"> <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"> <meta name="theme-color" content="#ffffff">
    <!-- Favicon /-->
    <!-- Facebook Metadata /-->
    <meta property="fb:page_id" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content=""/>
    <meta property="og:title" content=""/>
    <!-- Google+ Metadata /-->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="">
    <link rel="shortcut icon" href="{{ url('img/cache/logo/'.$logo_icon_dark)}}" /> 

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title>{{ config('app.name', 'Cloud MLM Software') }}</title>
    @section('meta_keywords')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="keywords" content="MLM Software, Multilevel Marketing software"/>
    @show @section('meta_author')
    @show @section('meta_description')
    <meta name="description" content="The best MLM Software in the market"/>
    @show
    <!-- Styles -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700|Nunito:300,400,600,700,800&display=swap" rel="stylesheet">     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">    
    <link href="{{ mix('/backend/backend.css') }}" rel="stylesheet"/>    
    <link href="/extra.css?v={{str_random(15)}}" rel="stylesheet"/>

     <link href="/sheheme.css" rel="stylesheet"/> 
    
    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('headerscripts')
</head>
<body class="font-sans @yield('page_class') {{$theme_skin_class}} navbar-top">
    @yield('content_top')
    @yield('content')
    @yield('content_bottom')
    @yield('overscripts')
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




<!-- //STYLE JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
  <script type="text/javascript">
  $(function() {
    $('.box').matchHeight();
});
</script>

</body>
</html>