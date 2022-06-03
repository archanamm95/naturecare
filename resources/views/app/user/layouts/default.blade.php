@extends('app.user.layouts.sidenav')

{{-- Web site Title --}}
@section('title')
    Administration :: @parent
@endsection

{{-- Styles --}}
@section('styles')
    @parent
    <style type="text/css">
        @if($theme_font_size)
            html,body{
                font-size: {{$theme_font_size}}px;

            }
        @endif
    </style>
@endsection

{{-- Header --}}
@section('header')
    @include('app.user.partials.header')
@endsection

{{-- Sidebar --}}
@section('sidebar')
    @include('app.user.partials.sidebar')
@endsection

{{-- Page Header --}}
@section('page-header')

    @include('app.user.partials.page-header-minimal')


@endsection

{{-- Footer --}}
@section('footer')
    @include('app.user.partials.footer')
@endsection



{{-- Scripts --}}
@section('scripts')
@parent
@endsection

@section('overscripts')
@parent
<script type="text/javascript">window.CLOUDMLMSOFTWARE = {"signedIn":@if(Auth::User()) true @else false @endif,"csrfToken":"{{ csrf_token() }}","admin":true,"username":@if(Auth::User()) "{{$user->username}}" @else false @endif,"siteUrl":"{{ URL::to('/') }}","previousUrl":"{{ URL::previous() }}","currentUrl":"{{ URL::current() }}","usernamehash":"{{Crypt::encrypt($user->username)}}","LockUrl":"{!!url('lock/?loggedOut=').Crypt::encrypt($user->username).'&redirect='.URL::current()!!}","presence":{{$presence}},"idleTimeout":@if(isset($idle_timeout)) '{{$idle_timeout}}' @else 'false' @endif,"idleTimeoutTime":@if(isset($idle_timeout_delay)) '{{$idle_timeout_delay}}' @else '0' @endif,"cookie_prefix" :@if(isset($cookie_prefix)) '{{$cookie_prefix}}' @else 'cookie_' @endif }; /*15 minute is 900000 - 1 minute 60000*/ 

</script>

@endsection




@section('scripts')
@parent
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CLOUDMLMSOFTWARE.csrfToken
        }
    });
</script>


@if (Request::getHttpHost() != 'dev.cloudmlmsoftware.com')

@elseif (Request::getHttpHost() != 'dev.cloudmlmsoftware.local')

@else

@php 
$warning_count = 0;
$warning_text = '';
@endphp

@if (env('APP_ENV')!='production')
@php 
$warning_count = $warning_count+1;
$warning_text = $warning_text.'APP_ENV is set to production! \<br>\<br>';
@endphp
@endif

@if (env('APP_DEBUG')!='false')
@php 
$warning_count = $warning_count+1;
$warning_text = $warning_text.'APP_DEBUG is set to true!<br>\<br>';
@endphp
@endif

@if (env('DEBUGBAR_ENABLED')!='true')
@php 
$warning_count = $warning_count+1;
$warning_text = $warning_text.'DEBUGBAR_ENABLED is set to true!\<br>\<br>';
@endphp
@endif

@if (env('MAIL_FROM_NAME')=='Cloud MLM Software Demo')
@php 
$warning_count = $warning_count+1;
$warning_text = $warning_text.'CHECK MAIL_FROM_NAME!\<br>\<br>';
@endphp
@endif


@if (env('MAIL_FROM_ADDRESS')=='demo@cloudmlmsoftware.com')
@php 
$warning_count = $warning_count+1;
$warning_text = $warning_text.'Check MAIL_FROM_ADDRESS!\<br>\<br>';
@endphp
@endif


@if ($warning_count>=1)
<script type="text/javascript">
    // var warning_text = "{!!$warning_text!!}";
    new PNotify({
        title: 'Warning notice!',
        text: "{!!$warning_text!!} \<br>Still see warnings after configuration changes? \<br/> try \<code>php artisan config:clear\</code>",
        addclass: 'bg-danger border-danger'
    });
</script>
@endif

@endif

@endsection
