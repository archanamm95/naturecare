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
                {{trans('controlpanel.system')}} :  {{trans('controlpanel.settings')}}
            </h5>
                <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">

                <legend class="text-uppercase font-size-sm font-weight-bold">  {{trans('controlpanel.system_settings')}}</legend>
                <form id="update-system-settings" data-parsley-validate="true" method="post">
                    {{csrf_field()}}

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">  {{trans('controlpanel.select_redirection')}} </label>
                    <div class="col-lg-3">
                            <div class="input-group">
                                <select class="form-control select2" name="system_redirect" id="system_redirect" required data-parsley-group="block-0">
                                    <option  {{ (option('app.system_redirect') == 'landing_page') ? 'selected ' : ''}}  value="landing_page">  {{trans('controlpanel.landing_page')}}</option>
                                    <option  {{ (option('app.system_redirect') == 'loginpage') ? 'selected ' : ''}}  value="loginpage">  {{trans('controlpanel.login_page')}}</option>
                                </select>
                                
                            </div>   

                        
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-form-label col-lg-2">  {{trans('controlpanel.select_redirection_after_login')}}</label>
                    <div class="col-lg-3">
                            <div class="input-group">
                                <select class="form-control select2" name="system_redirect_login" id="system_redirect_login" required data-parsley-group="block-0">
                                    <option   {{ (option('app.system_redirect_login') == 'dashboard') ? 'selected ' : ''}}  value="dashboard">  {{trans('controlpanel.dashboard')}}</option>
                                    <option   {{ (option('app.system_redirect_login') == 'landing_page') ? 'selected ' : ''}}  value="landing_page">  {{trans('controlpanel.landing_page')}}</option>
                                </select>
                                
                            </div>    
                    </div>
                </div>

                  <div class="form-group row">
                    <label class="col-form-label col-lg-2">  {{trans('controlpanel.google_tag')}} </label>
                    <div class="col-lg-3">
                            
                              <input type="text" name="gtag_value" id="gtag_value" value="{{(option('app.gtag_value'))}}" required data-parsley-group="block-0" class="form-control">
                                
                       

                        
                    </div>
                </div>


                 <div class="form-group row">
                     <button class="btn bg-dark" type="submit">  {{trans('controlpanel.save')}}</button>
                </div>

                </form>
            </fieldset>

              
                
            </div>    
        </div>
    </div> 


</div>
@stop

@section('styles')@parent
<style type="text/css">
.parsley-errors-list.filled {
    position: absolute;
    top: 40px;
}
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent 
@stop
