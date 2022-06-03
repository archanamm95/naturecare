@extends('site.base')

@section('content')
<!-- Page container -->
  <div class="page-container">

    <!-- Page content -->
    <div class="page-content">

   <div class="header-info">
      <div class="col-sm-10 col-sm-offset-1 text-center">
        <h1 data-scroll-reveal="enter left and move 50px over 1.33s" class="wow fadeIn">{{trans('site.your_networks')}}<br/> @lang('site.landing_page_sample')</h1>
        <br />
        <p class="lead white wow fadeIn" data-wow-delay="0.5s">@lang('site.this_is_a_sample_page_for_demonstrating_cloud_mlm_softwares_feature')<br>
       @lang('site.we_can_design_integrate_your_choice')</p>
        <div class="text-center wow fadeIn" data-wow-delay="0.10s"> <img src="{{url('assets/site/img/services.png')}}"/></div>
        <br />
          
        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            <div class="row">
              <div class="col-xs-6 text-right wow fadeInUp" data-wow-delay="1s">
                <a href="#be-the-first" class="btn btn-secondary btn-lg scroll">@lang('site.learn_more')</a>
              </div>
              <div class="col-xs-6 text-left wow fadeInUp" data-wow-delay="1.4s">
                <a href="#invite" class="btn btn-primary btn-lg scroll">@lang('site.request_full_demo')</a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>



    <div class="mouse-icon hidden-xs">
        <div class="scroll"></div>
    </div>

    <section id="be-the-first" class="pad-xl">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text-center margin-30 wow fadeIn" data-wow-delay="0.6s">
            <h2>@lang('site.number_1_mlm_software_with_unleashed_features_scalability_security')</h2>
            <p class="lead white">@lang('site.we_are_version_2_1_0_future_upgrades_are_free')</p>
          </div>
        </div>
        
        <div class="iphone wow fadeInUp" data-wow-delay="1s">
            <img src="{{url('assets/site/img/iphone.png')}}"/>
        </div>
      </div>
    </section>

    <section id="main-info" class="pad-xl">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 wow fadeIn" data-wow-delay="0.4s">
                    <hr class="line purple">
                    <h3>@lang('site.any_design')</h3>
                    <p>@lang('site.this_is_just_sample_we_can_build_and_integrate_any_theme_of_your_choice_no_limitations')</p>
                </div>
                <div class="col-sm-4 wow fadeIn" data-wow-delay="0.8s">
                    <hr  class="line blue">
                    <h3>@lang('site.multilingual_on_request')</h3>
                    <p>@lang('site.make_your_landing_page_multilingual_dynamic_backend_translation_with_language_switcher')</p>
                </div>
                <div class="col-sm-4 wow fadeIn" data-wow-delay="1.2s">
                    <hr class="line yellow">
                    <h3>@lang('site.dynamic')</h3>
                    <p>@lang('site.need_a_dynamic_website_for_your_mlm_business_choose_from_variety_ofcms_frameworks_we_are_experts_at')</p>
                </div>
            </div>
        </div>
    </section>
    <section id="helprun" class="wow fadeIn" data-wow-delay="1.3s">
      <div class="container">
      <div class="row">
    
              <div class="">
                <h3 class="text-center">Steps to install &amp; run this software</h3>
                <pre>
                <b>Configure environment</b>
                Install dependencies ( composer install)
                Install npm dependencies ( npm install)
                Rename .env.example to .env ( cp .env.example .env)
                Select database connection type (you can select sqlite if you wish)
                <b>Database migration &amp; seeding</b>
                Touch databse ( touch database/database.sqlite)
                Run database migration and basic seed ( php artisan migrate:refresh --seed )
                Run  (php artisan serve)
                Access project at http://127.0.0.1:8000
                </pre>
              </div>
        
          </div>
        </div>
    </section>
    <section id="invite" class="pad-lg light-gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text-center">
            <i class="fa fa-envelope-o margin-40"></i>
            <h2 class="black">@lang('site.try_now')</h2>
            <br />
            <p class="black">@lang('site.try_our_full_featured_demo')</p>
            <br />
            
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                {{ Form::open(array('url' => '/subscribe','method'=>'post')) }}
                {!! csrf_field() !!}

                <div class="form-group">
                    {{Form::email('email',Input::old('email'),['class'=>'form-control','required'=>'true','type' => 'email','placeholder'=> 'Enter email'])}}
                </div>
                <button type="submit" class="btn btn-primary btn-lg">@lang('site.give_me_a_full_demo')</button>
                {{ Form::close() }}
              </div>
            </div><!--End Form row-->

          </div>
        </div>
      </div>
    </section>

    </div>
    </div>
    
@endsection


