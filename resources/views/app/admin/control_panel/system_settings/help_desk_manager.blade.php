@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection
@section('sidebar')
@parent
<!-- Secondary sidebar -->
@include('app.admin.control_panel.sidebar')
<!-- /secondary sidebar -->
@endsection


        {{-- Content --}}
        @section('main')
<div id="settings-page">

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
               {{$title}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
          <div class="mb-3">
                <div class="row row-tile no-gutters text-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{URL::to('admin/inbox')}}" data-popup="tooltip" data-html="true" data-original-title="Mail box   " data-placement="top">
                                <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                                <span>
                                    MailBox
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{URL::to('admin/helpdesk/tickets-dashboard')}}" data-popup="tooltip" data-html="true" data-original-title="Tickets" data-placement="top">
                                <i class="fa fa-ticket fa-lg" aria-hidden="true"></i>
                                <span>
                                   Tickets
                                </span>
                            </a>
                        </div>
                    </div>
              
                 
                
                </div>
            </div>  
        </div>
    </div> 


</div>

@stop

@section('styles')@parent

@endsection


