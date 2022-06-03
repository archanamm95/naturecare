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
                {{trans('controlpanel.performance')}} : {{trans('controlpanel.clear_all_cache')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="row mb-3">
                    <button type="button" data-initial-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.clear_cache')}}" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> {{trans('controlpanel.clearing_all_cache')}}..." data-loaded-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.all_cache_cleared')}}!" data-error-text="{{trans('controlpanel.could_not_cleared_cache')}}! {{trans('controlpanel.please_contact_administrator')}}!" data-load-url="/admin/control-panel/performance/clear-cache-all" class="btn btn-light btn-loading mr-3 mb-3"><i class="icon-spinner4 mr-2"></i> {{trans('controlpanel.clear_all_cache')}} </button>
            </div>    
        </div>
    </div>           


    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.performance')}} : {{trans('controlpanel.clear_individual_cache_items')}}
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="row mb-3">
                    <button type="button" data-initial-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.clear_cache')}}" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> {{trans('controlpanel.clearing_application_cache')}}..." data-loaded-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.application_cache_cleared')}}!" data-error-text="{{trans('controlpanel.could_not_cleared_application_cache')}}! {{trans('controlpanel.please_contact_administrator')}}!" data-load-url="/admin/control-panel/performance/clear-cache-application" class="btn btn-light btn-loading mr-3 mb-3"><i class="icon-spinner4 mr-2"></i> {{trans('controlpanel.clear_application_cache')}} </button>

                    <button type="button" data-initial-text="<i class='icon-spinner4 mr-2'></i> Clear cache" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i>{{trans('controlpanel.clearing_config_cache')}}..." data-loaded-text="<i class='icon-spinner4 mr-2'></i>{{trans('controlpanel.config_cache_cleared')}}!" data-error-text="{{trans('controlpanel.could_not_cleared_config_cache')}}! {{trans('controlpanel.please_contact_administrator')}}!" data-load-url="/admin/control-panel/performance/clear-cache-config" class="btn btn-light btn-loading mr-3 mb-3"><i class="icon-spinner4 mr-2"></i> {{trans('controlpanel.clear_config_cache')}}</button>

                    <button type="button" data-initial-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.clear_cache')}}" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> {{trans('controlpanel.clearing_views_cache')}}..." data-loaded-text="<i class='icon-spinner4 mr-2'></i>{{trans('controlpanel.view_cache_cleared')}}!" data-error-text="{{trans('controlpanel.could_not_cleared_view_cache')}}! {{trans('controlpanel.please_contact_administrator')}}!" data-load-url="/admin/control-panel/performance/clear-cache-views" class="btn btn-light btn-loading mr-3 mb-3"><i class="icon-spinner4 mr-2"></i> {{trans('controlpanel.clear_view_cache')}}</button>

                    <button type="button" data-initial-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.clear_cache')}}" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> {{trans('controlpanel.clearing_routes_cache')}}..." data-loaded-text="<i class='icon-spinner4 mr-2'></i>{{trans('controlpanel.routes_cache_cleared')}}!" data-error-text="{{trans('controlpanel.could_not_cleared_route_cache')}}! {{trans('controlpanel.please_contact_administrator')}}!" data-load-url="/admin/control-panel/performance/clear-cache-routes" class="btn btn-light btn-loading mr-3 mb-3"><i class="icon-spinner4 mr-2"></i> {{trans('controlpanel.clear_route_cache')}} </button>
            </div>    
        </div>
    </div>   


    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.performance')}} : {{trans('controlpanel.cache_manually')}}
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="row mb-3">

                    <button type="button" data-initial-text="<i class='icon-spinner4 mr-2'></i> {{trans('controlpanel.cache_config')}}" data-loading-text="<i class='icon-spinner4 spinner mr-2'></i> {{trans('controlpanel.caching_configurations')}}..." data-loaded-text="<i class='icon-spinner4 mr-2'></i>{{trans('controlpanel.cached_config')}}!" data-error-text="{{trans('controlpanel.could_cache_config')}}! {{trans('controlpanel.please_contact_administrator')}}!" data-load-url="/admin/control-panel/performance/cache-config" class="btn btn-light btn-loading mr-3 mb-3"><i class="icon-spinner4 mr-2"></i> {{trans('controlpanel.cache_configurations')}} </button>
                
            </div>    
        </div>
    </div> 


</div>
@stop

@section('styles')@parent
<style type="text/css">

</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">


    // Loading button
    var _componentClearCacheButton = function() {
        $('.btn-loading').on('click', function () {
            var btn = $(this),
                initialText = btn.data('initial-text'),
                loadingText = btn.data('loading-text');
                loadedText = btn.data('loaded-text');
                errorText = btn.data('error-text');
                loadUrl = btn.data('load-url');
           
            if(btn.hasClass('disabled')){
                
            }else{
                 btn.html(loadingText).addClass('disabled');
                $.ajax({
                    url: CLOUDMLMSOFTWARE.siteUrl+loadUrl,
                    dataType: "json",
                    type: "POST",
                    success: function(data){
                        new PNotify({
                            text: loadedText,
                            delay: 1000,
                            styling: 'brighttheme',
                            icon: 'fa fa-file-image-o',
                            nonblock: {
                                nonblock: false
                            }
                        });
                        // console.log(data);
                        // btn.html(initialText).removeClass('disabled');
                        btn.html(loadedText).addClass('disabled');

                    },
                    error: function() {
                        swal(errorText);
                    } 
                });
            }

        });
    };

            

    _componentClearCacheButton();

</script>
@stop
