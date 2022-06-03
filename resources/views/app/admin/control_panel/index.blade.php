@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection



        {{-- Content --}}
        @section('main')
<div id="settings-page">

    <div class="card card-white">
        <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        <div class="card-header pb-1 pt-1 bg-light" style="">
            <h3 class="mb-0 font-weight-light">
               {{trans('controlpanel.system')}}
            </h3>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <div class="row row-tile no-gutters text-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/branding')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.branding_settings')}} <br/> - {{trans('controlpanel.logo')}}  <br/> - {{trans('controlpanel.favicon')}}  <br/>   " data-placement="top">
                                <i class="icon-office">
                                </i>
                                <span>
                                   {{trans('controlpanel.branding')}}
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/design')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.design_settings')}}" data-placement="top">
                                <i class="icon-design">
                                </i>
                                <span>
                                     {{trans('controlpanel.design_settings')}}
                                </span>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/menu-manager')}}" data-popup="tooltip" data-html="true" data-original-title="Menu Manager" data-placement="top">
                                <i class="icon-design">
                                </i>
                                <span>
                                    Menu manager
                                </span>
                            </a>
                        </div>
                    </div> -->
                  <!--   <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/performance')}}" data-popup="tooltip" data-html="true" data-original-title=" {{trans('controlpanel.performance_settings')}}" data-placement="top">
                                <i class="icon-meter-fast">
                                </i>
                                <span>
                                    {{trans('controlpanel.performance_settings')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                <!--     <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/idle-timeout')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.idle_timeout_settings')}}" data-placement="top">
                                <i class="icon-user-lock">
                                </i>
                                <span>
                                    {{trans('controlpanel.idle_timeout_settings')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                 <!--    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/control-home-edit')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.system_settings')}}" data-placement="top">
                                <i class="icon-home5">
                                </i>
                                <span>
                                    {{trans('controlpanel.system_settings')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
<!--                     <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/backupmanager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.backup_manager')}}" data-placement="top">
                                <i class="icon-database" aria-hidden="true"></i>

                                <span>
                                    {{trans('controlpanel.backup_manager')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        
        
    </div>    
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-light" style="">
            <h3 class="mb-0 font-weight-light">
                 {{trans('controlpanel.network')}}
            </h3>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <div class="row row-tile no-gutters text-center">

    
                    

                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/account-settings')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.account_settings')}}" data-placement="top">
                                <i class="icon-add-to-list">
                                </i>
                                <span>
                                     {{trans('controlpanel.account_settings')}}
                                </span>
                            </a>
                        </div>
                    </div>                    


                <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/organization-tree-settings')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.tree_settings')}} " data-placement="top">
                                <i class="icon-tree7">
                                </i>
                                <span>
                                    {{trans('controlpanel.organization_tree_settings')}}
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/commission-settings')}}" data-popup="tooltip" data-html="true" data-original-title=" {{trans('controlpanel.commission_settings')}}" data-placement="top">
                                <i class="icon-users2">
                                </i>
                                <span>
                                     {{trans('controlpanel.commission_settings')}}
                                </span>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/package-manager')}}" data-popup="tooltip" data-html="true" data-original-title=" {{trans('controlpanel.package_manager')}}" data-placement="top">
                                <i class="icon-calculator3">
                                </i>
                                <span>
                                     {{trans('controlpanel.package_manager')}}
                                </span>
                            </a>
                        </div>
                    </div> 
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/product-manager')}}" data-popup="tooltip" data-html="true" data-original-title=" {{trans('controlpanel.product_manager')}}" data-placement="top">
                                <i class="icon-calculator3">
                                </i>
                                <span>
                                     {{trans('controlpanel.product_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>  -->
                <!--     <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/bonus-settings')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.bonus_settings')}}" data-placement="top">
                                <i class="icon-coins">
                                </i>
                                <span>
                                    {{trans('controlpanel.bonus_settings')}}
                                </span>
                            </a>
                        </div>
                    </div>     -->                  
          <!--           <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/rank-settings')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.rank_settings')}}" data-placement="top">
                                <i class="icon-coins">
                                </i>
                                <span>
                                    {{trans('controlpanel.rank_settings')}}
                                </span>
                            </a>
                        </div>
                    </div>     -->

                     <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/sharepartner-settings')}}" data-popup="tooltip" data-html="true" data-original-title=" Share Partner Package" data-placement="top">
                                <i class="icon-users2">
                                </i>
                                <span>
                                   Share Partner Package
                                </span>
                            </a>
                        </div>
                    </div>                   
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/payout-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.payout_manager')}}" data-placement="top">
                                <i class="icon-coins">
                                </i>
                                <span>
                                    {{trans('controlpanel.payout_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>
                 <!--    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/blacklist-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.blacklist_manager')}}" data-placement="top">
                                <i class="icon-shield-notice">
                                </i>
                                <span>
                                    {{trans('controlpanel.blacklist_manager')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                  <!--   <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/ban-ip')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.ban_i')}}{{trans('controlpanel.p')}}" data-placement="top">
                                <i class="icon-eye-blocked">
                                </i>
                                <span>
                                     {{trans('controlpanel.ban_i')}}{{trans('controlpanel.p')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                  <!--        <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/paymentgateway-manager')}}" data-popup="tooltip" data-html="true" data-original-title=" {{trans('controlpanel.payment_gateway_manager')}}" data-placement="top">
                                <i class="icon-cash3">
                                </i>
                                <span>
                                    {{trans('controlpanel.payment_gateway_manager')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        
        
    </div>    
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-light" style="">
            <h3 class="mb-0 font-weight-light">
                 {{trans('controlpanel.addons')}}
            </h3>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <div class="row row-tile no-gutters text-center">
                    <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/currency-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.currency_manager')}}" data-placement="top">
                                <i class="icon-cash3">
                                </i>
                                <span>
                                     {{trans('controlpanel.currency_manager')}}
                                </span>
                            </a>
                        </div>
                    </div> -->
                    <!-- <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/language-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.language_manager')}}" data-placement="top">
                                <i class="icon-earth">
                                </i>
                                <span>
                                    {{trans('controlpanel.language_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/ecommerce-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.e_commerce_manager')}}" data-placement="top">
                                <i class="icon-cart">
                                </i>
                                <span>
                                   {{trans('controlpanel.e_commerce_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>  -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/cms_manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.c')}}{{trans('controlpanel.m')}}{{trans('controlpanel.s')}}  {{trans('controlpanel.manager')}}" data-placement="top">
                                <i class="icon-blog">
                                </i>
                                <span>
                                    {{trans('controlpanel.c')}}{{trans('controlpanel.m')}}{{trans('controlpanel.s')}}  {{trans('controlpanel.manager')}}
                                </span>
                            </a>
                        </div>
                    </div>
              <!--       <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/lead-capture-manager')}}" data-popup="tooltip" data-html="true" data-original-title="Lead capture Manager" data-placement="top">
                                <i class="icon-list3">
                                </i>
                                <span>
                                    Lead capture Manager
                                </span>
                            </a>
                        </div>
                    </div>  -->
                   <!--  <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/control-email_manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.email_manager')}}" data-placement="top">
                                <i class="icon-envelop4">
                                </i>
                                <span>
                                     {{trans('controlpanel.email_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>  -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/helpdesk-manager')}}" data-popup="tooltip" data-html="true" data-original-title=" {{trans('controlpanel.helpdesk_manager')}}" data-placement="top">
                                <i class="icon-ticket">
                                </i>
                                <span>
                                    {{trans('controlpanel.helpdesk_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/campaign-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.campaign_manager')}}" data-placement="top">
                                <i class="icon-collaboration">
                                </i>
                                <span>
                                    {{trans('controlpanel.campaign_manager')}}
                                </span>
                            </a>
                        </div>
                    </div>
                   <!--  <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/email-templates')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.email_manager')}}" data-placement="top">
                                <i class="icon-envelop4">
                                </i>
                                <span>
                                     {{trans('settings.email_template')}}
                                </span>
                            </a>
                        </div>
                    </div>  -->
                  <!--   <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/contact-manager')}}" data-popup="tooltip" data-html="true" data-original-title="Contact manager" data-placement="top">
                                <i class="icon-vcard">
                                </i>
                                <span>
                                    Contact manager
                                </span>
                            </a>
                        </div>
                    </div> -->
         <!--            <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/autoresponder-manager')}}" data-popup="tooltip" data-html="true" data-original-title="Autoresponder manager" data-placement="top">
                                <i class="icon-ticket">
                                </i>
                                <span>
                                    Autoresponder manager
                                </span>
                            </a>
                        </div>
                    </div>
 -->
         <!--            <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/control-panel/voucher-manager')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.voucher_manager')}}" data-placement="top">
                                <i class="icon-file-presentation2">
                                </i>
                                <span>
                                    {{trans('controlpanel.voucher_manager')}}
                                </span>
                            </a>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
        
        
    </div>    
<!--     <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-light" style="">
            <h3 class="mb-0 font-weight-light">
                {{trans('controlpanel.reports')}}
            </h3>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <div class="row row-tile no-gutters text-center">
             
                    
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4  ">
                        <div class="quickLink">
                            <a href="#" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.report_preferences')}}" data-placement="top">
                                <i class="icon-table2">
                                </i>
                                <span>
                                     {{trans('controlpanel.report_preferences')}}
                                </span>
                            </a>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        
        
    </div>     -->

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
    $('document').ready(function(){
        
    });
</script>
@stop
