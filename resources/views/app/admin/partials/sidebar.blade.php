@if(Auth::check())


@section('styles')@parent
<style type="text/css">
    .sidebar .nav-item-header {
        display: none;
    }
    .numberCircle {
        border-radius: 50%;
        width: 22px;
        height: 22px;
        border: 2px solid #666;
        color: #f8f8f9;
        text-align: center;
        margin-left: 6px !important;
        border-color: white;
        padding: 1px;
        font-size: 11px;
    }    
</style>
@endsection

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        {{trans('menu.navigation')}}
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div> 


    <div class="sidebar-content">


        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">

                        {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $image]), 'Admin', array('class' => 'rounded-circle','width' => '38','height' => '38')) }}


                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50 d-flex align-items-center">
                            <svg class="feather d-inline-block" style="width: 1px">
                                <!-- <use xlink:href="/backend/icons/feather/feather-sprite.svg#user" /> -->
                            </svg>
                         {{ Auth::user()->username }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white">
                            <svg class="feather d-inline-block" style="width: 18px">
                                <!-- <use xlink:href="/backend/icons/feather/feather-sprite.svg#settings" /> -->
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>


         @if(Auth::user()->id >1)
          <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <div class="category-content no-padding">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li> 

                   <!--       <li class="nav-item {{set_active('admin/dashboard')}}">
                    <a class="nav-link" href="{{url('admin/dashboard')}}" class="nav-link active">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#home" />
                        </svg>
                        <span class="text">{{trans('menu.dashboard')}}</span>
                    </a>
                </li>                              
                    -->
                @foreach($role_names as $item)
                 @if($item->submenu_count == 1 && $item->is_root == 'yes')
                        <li class="nav-item {{set_active($item->link)}}"><a  class="nav-link"  href="{{ url($item->link) }}"> <i class="{{$item->icon}}"></i>  <span class="text">{{trans($item->role_name)}}</span> </a></li> 
                 @else
                     @if($item->is_root == 'yes') 
                         @if($item->main_role == 1)  
                            <li class="nav-item nav-item-submenu @foreach($role_names as $sub_key=>$item_sub)
                                 @if(isset($item_sub->link))
                                     @if( $item_sub->parent_id == $item->id)
                                        {{set_active($item_sub->link)}}
                                     @endif
                                 @endif
                                @endforeach" >
                                        
                         @else
                            <li class="nav-item  {{set_active($item->link)}}" >
                         @endif
                            <a  class="nav-link" href="{{ url($item->link) }}" >
                            <i class="{{$item->icon}}"></i> 
                            <span class="text">{{trans($item->role_name)}}</span>
                     @endif

                              
                     </a> 
                     @if($item->is_root == 'yes')
                        @if($item->submenu_count != 1)
                           <ul class="nav nav-group-sub">
                                @foreach($role_names as $sub_key=>$item_sub)
                                    @if($item_sub->parent_id == $item->id)                     
                                        <li class="nav-item {{set_active($item_sub->link)}}"><a  class="nav-link"  href="{{ url($item_sub->link) }}"> {{trans($item_sub->role_name)}} </a></li> 
                                       <?php  unset($role_names[$sub_key]) ; ?>
                                    @endif
                                @endforeach

                           </ul>            
                        @endif
                     @endif
                     </li>
                @endif
            @endforeach
            <li class=" nav-item {{set_active('auth/logout')}}">
                <a  class="nav-link"  href="{{url('auth/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="icon-switch2"></i>
                    <span class="text"> {{trans('menu.logout')}}</span>
                </a>
                </li>
            </ul>
          </li>
         </ul>
        </div>
        </div>
        @else





        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">

            <ul class="nav nav-sidebar" data-nav-type="accordion">
                @if(true==false)
                @include('app.admin.partials.menu')
                @endif
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.main')}}</div> 
                </li>



                <li class="nav-item {{set_active('admin/dashboard')}}">
                    <a class="nav-link" href="{{url('admin/dashboard')}}" class="nav-link active">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#home" />
                        </svg>
                        <span class="text">{{trans('menu.dashboard')}}</span>
                    </a>
                </li>





                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.network')}} </div> 
                </li>


                <li
                    class="nav-item nav-item-submenu {{set_active('admin/genealogy')}}{{set_active('admin/sponsortree')}}{{set_active('admin/sponsortable')}}{{set_active('admin/tree')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <span class="badge pull-right"></span>
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#layers" />
                        </svg>
                        <span> {{trans('menu.genealogy')}} </span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style="{{set_active_display('admin/genealogy')}}{{set_active_display('admin/sponsortree')}}{{set_active_display('admin/sponsortable')}}{{set_active_display('admin/tree')}}"
                        data-submenu-title="Network Explorers">
                      <!--   <li class="nav-item {{set_active('admin/genealogy')}}"><a class="nav-link"
                                href="{{url('admin/genealogy')}}">{{trans('tree.binary_genealogy')}}</a></li> -->
                        <li class="nav-item {{set_active('admin/sponsortree')}}"><a class="nav-link"
                                href="{{url('admin/sponsortree')}}">{{trans('menu.sponsor-genealogy')}}</a></li>
                        <!-- <li class="nav-item {{set_active('admin/sponsortable')}}"><a class="nav-link"
                                href="{{url('admin/sponsortable')}}">{{trans('menu.sponsor-table')}}</a></li> -->
                        <li class="nav-item {{set_active('admin/tree')}}"><a class="nav-link"
                                href="{{url('admin/tree')}}">{{trans('menu.tree-genealogy')}}</a></li>
                         <li class="nav-item {{set_active('admin/influencertree')}}"><a class="nav-link"
                                href="{{url('admin/influencertree')}}">{{trans('menu.influencer-genealogy')}}</a></li>

                    </ul>
                </li>

              <!--       <li class="nav-item nav-item-submenu {{set_active('admin/adminregister')}}{{set_active('admin/viewalladmin')}}{{set_active('admin/work_assign')}}{{set_active('admin/assign-role/*')}}">
                    <a href="javascript:;" class="nav-link">
                       <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#users" />
                        </svg>
                        <span class="text">Admin</span>
                    </a>
                    <ul class="nav nav-group-sub" style="{{set_active_display('admin/adminregister')}}{{set_active_display('admin/viewalladmin')}}{{set_active_display('admin/work_assign')}}{{set_active_display('admin/assign-role')}}" data-submenu-title="Subadmin Management">
                         <li class="nav-item {{set_active('admin/adminregister')}}"><a class="nav-link" href="{{url('admin/adminregister')}}">{{trans('menu.admin_register')}}</a></li>
                         <li class="nav-item {{set_active('admin/viewalladmin')}}{{set_active('admin/assign-role/*')}}"><a class="nav-link" href="{{url('admin/viewalladmin')}}">{{trans('menu.view_all')}}</a></li>
                    </ul>
                </li>
 -->



                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.members_management')}}</div>
                   
                </li>
                <li
                    class="nav-item nav-item-submenu {{set_active('admin/users')}}{{set_active('admin/users/*')}}{{set_active('admin/useraccounts')}}{{set_active('admin/register')}}{{set_active('admin/dummy_register')}}{{set_active('admin/lead')}}{{set_active('admin/send-mail')}}{{set_active('admin/maintain-members')}}{{set_active('admin/non-maintain-members')}}{{set_active('admin/approve_payments')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#users" />
                        </svg>
                        <span class="text"> {{trans('menu.members')}} </span>@if($PendingTransactions > 0 ) <span class="numberCircle">{{$PendingTransactions}}</span> @endif
                    </a>
                    <ul class="nav nav-group-sub "
                        style="{{set_active_display('admin/send-mail')}}{{set_active_display('admin/users')}}{{set_active_display('admin/useraccounts')}}{{set_active_display('admin/lead')}}{{set_active_display('admin/register')}}{{set_active_display('admin/dummy_register')}}{{set_active_display('admin/approve_payments')}}{{set_active_display('admin/maintain-members')}}{{set_active_display('admin/non-maintain-members')}}{{set_active_display('admin/users/*')}}"
                        data-submenu-title="Member Management">

                        <li class="nav-item {{set_active('admin/users')}}"><a class="nav-link"
                                href="{{url('admin/users')}}">{{trans('menu.list_all_members')}}</a></li>


                        <!--  <li class="nav-item {{set_active('admin/approve_users')}}"><a class="nav-link"
                                href="{{url('admin/approve_users')}}">Approve Users</a></li> -->

                        <li class="nav-item {{set_active('admin/useraccounts')}}"><a class="nav-link"
                                href="{{url('admin/useraccounts')}}">{{trans('menu.user_accounts')}}</a></li>

                       <!--  @if($user_registration==1 || $user_registration==2 || $user_registration==4 ||
                        $user_registration==5) -->

                        <li class="nav-item {{set_active('admin/register')}}"><a class="nav-link"
                                href="{{url('admin/register')}}">Register Influence Manager</a></li> 
                       <!--  <li class="nav-item {{set_active('admin/dummy_register')}}"><a class="nav-link"
                                href="{{url('admin/dummy_register')}}">{{trans('menu.enroll_demmy_member')}}</a></li> -->

                        <!-- @endif -->

                       <!--  <li class="nav-item {{set_active('admin/approve_payments')}}"><a class="nav-link"
                                href="{{url('admin/approve_payments')}}">{{trans('menu.approve_payments')}}@if($PendingTransactions > 0 ) <span class="numberCircle">{{$PendingTransactions}}</span> @endif </a> </li> -->
                      <!--   <li class="nav-item {{set_active('admin/maintain-members')}}"><a class="nav-link"
                                href="{{url('admin/maintain-members')}}">{{trans('menu.maintain_members')}}</a></li>
                        <li class="nav-item {{set_active('admin/non-maintain-members')}}"><a class="nav-link"
                                href="{{url('admin/non-maintain-members')}}">{{trans('menu.non_maintain_members')}}</a></li> -->
                       <!--  <li class="nav-item {{set_active('admin/users/password')}}"><a class="nav-link"
                                href="{{url('admin/users/password')}}">{{trans('menu.change-password')}}</a></li> -->

                      <!--   <li class="nav-item {{set_active('admin/users/changeusername')}}"><a class="nav-link"
                                href="{{url('admin/users/changeusername')}}">{{trans('menu.Change_Username')}}</a></li> -->
                       <!--  <li class="nav-item {{set_active('admin/users/pool-bonus')}}"><a class="nav-link"
                                href="{{url('admin/users/pool-bonus')}}">{{trans('users.pool_bonus')}}</a></li> -->
                       <!--  <li class="nav-item {{set_active('admin/send-mail')}}"><a href="{{url('admin/send-mail')}}"  class="nav-link">{{trans('mail.send_mail')}}</a></li> -->
                        <!-- <li class="nav-item {{set_active('admin/lead')}}"><a class="nav-link"
                                href="{{url('admin/lead')}}">{{trans('menu.lead_capture')}}</a></li> -->
                    </ul>
                </li>
             <!--    <li class="nav-item {{set_active('admin/shop')}}">
                                                     
                             <a class="nav-link" href="http://shop-sheheme.cloudmlm.online/"><svg class="feather ">
                                <use xlink:href="/backend/icons/feather/feather-sprite.svg#home" />
                            </svg> <span class="text">
                            Shop</span></a>
                            

                </li> -->




                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.wallets')}}</div> 
                </li>
                <li
                    class="nav-item nav-item-submenu {{set_active('admin/wallet')}} {{set_active('admin/rs-wallet')}}  {{set_active('admin/fund-credits')}} {{set_active('admin/payoutrequest')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#credit-card" />
                        </svg>
                        <span class="text">{{trans('menu.wallets')}} </span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style="{{set_active_display('admin/wallet')}}{{set_active_display('admin/rs-wallet')}}   {{set_active_display('admin/fund-credits')}} {{set_active_display('admin/payoutrequest')}} "
                        data-submenu-title="Wallets">

                        <li class="nav-item {{set_active('admin/wallet')}}"><a class="nav-link"
                                href="{{url('admin/wallet')}}">E-{{trans('menu.wallet')}}</a></li>
                        <!-- <li class="nav-item {{set_active('admin/rs-wallet')}}"><a class="nav-link"
                                href="{{url('admin/rs-wallet')}}">RS-{{trans('menu.wallet')}}</a></li> -->
                        <!-- <li class="nav-item {{set_active('admin/fund-credits')}}"><a class="nav-link"
                                href="{{url('admin/fund-credits')}}">{{trans('menu.transfer_credit')}} </a></li> -->
                        <li class="nav-item  {{set_active('admin/payoutrequest')}}"><a class="nav-link"
                                href="{{url('admin/payoutrequest')}}">{{trans('menu.payout_requests')}}</a>
                        </li>

                    </ul>
                </li>
             <!--    <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.store')}} </div>
                </li>
                <li
                    class="nav-item nav-item-submenu {{set_active('admin/online-store/dashboard')}}{{set_active('admin/sales')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <span class="badge pull-right"></span>
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-bag" />
                        </svg>
                        <span> {{trans('menu.store')}} </span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style="{{set_active_display('admin/viewmore*')}}{{set_active_display('admin/online-store/dashboard')}}{{set_active_display('admin/sales')}}"
                        data-submenu-title="Store">
                        <li class="nav-item {{set_active('admin/online-store/dashboard')}}"><a class="nav-link"
                                href="{{url('admin/online-store/dashboard')}}">{{trans('menu.dashboard')}}</a></li>
                        <li class="nav-item {{set_active('admin/sales')}}"><a class="nav-link"
                                href="{{url('admin/sales')}}">{{trans('menu.sales')}}</a></li>
                    </ul>
                </li> -->





            <!--     <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.voucher_management')}}</div>
                    
                </li>
                <li
                    class="nav-item nav-item-submenu {{set_active('admin/voucherlist')}} {{set_active('admin/voucherrequest')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#minus-square" />
                        </svg>
                        <span class="text">{{trans('menu.vouchers')}}</span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style=" {{set_active_display('admin/voucherlist')}} {{set_active_display('admin/voucherrequest')}}"
                        data-submenu-title="Voucher Management">
                        <li class="nav-item {{set_active('admin/voucherlist')}}"><a class="nav-link"
                                href="{{url('admin/voucherlist')}}">{{trans('menu.Voucher_List')}}</a></li>
                        @if($voucher_admin_approval == 'yes')
                        <li class="nav-item {{set_active('admin/voucherrequest')}}"><a class="nav-link"
                                href="{{url('admin/voucherrequest')}}">{{trans('menu.Voucher_Request')}}</a></li>
                        @endif


                    </ul>
                </li>
 -->


                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.support')}}</div> 
                </li>
                <li
                    class="nav-item nav-item-submenu {{set_active('admin/inbox')}} {{set_active('admin/helpdesk/*')}} {{set_active('admin/helpdesk/*/*')}} {{set_active('admin/helpdesk/*/*/*')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#mail" />
                        </svg>
                        <span class="text">{{trans('menu.support')}}</span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style=" {{set_active_display('admin/inbox')}} {{set_active_display('admin/helpdesk/*')}}"
                        data-submenu-title="Support streams">
                        <li class="nav-item {{set_active('admin/inbox')}}"><a class="nav-link"
                                href="{{url('admin/inbox')}}">{{trans('menu.mailbox')}}</a></li>
                        <li
                            class="nav-item  {{set_active('admin/helpdesk/*')}} {{set_active('admin/helpdesk/*/*')}} {{set_active('admin/helpdesk/*/*/*')}} ">
                            <a class="nav-link"
                                href="{{url('admin/helpdesk/tickets-dashboard')}}">{{trans('menu.tickets')}}</a>
                        </li>


                    </ul>
                </li>



                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.resources_manager')}}</div> 
                </li>

                <li
                    class="nav-item nav-item-submenu {{set_active('admin/autoresponse')}} {{set_active('admin/documentupload')}} {{set_active('admin/addvideos')}}
                     {{set_active('admin/optionsettings')}}{{set_active('admin/getnews')}}{{set_active('admin/uploadusers')}}">

                    <a href="javascript:void(0);" class="nav-link">

                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#download" />
                        </svg>
                        <span class="text">{{trans('menu.resources')}}</span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style="{{set_active_display('admin/documentupload')}}{{set_active_display('admin/getnews')}}{{set_active_display('admin/addvideos')}}{{set_active_display('admin/uploadusers')}}"
                        data-submenu-title="Resource manager">
                        <li class="nav-item {{set_active('admin/documentupload')}}"><a class="nav-link"
                                href="{{url('admin/documentupload')}}">{{trans('menu.Documents')}}</a></li>
                        <li class="nav-item {{set_active('admin/getnews')}}"><a class="nav-link"
                                href="{{url('admin/getnews')}}">{{trans('menu.news')}}</a></li>
                        <li class="nav-item {{set_active('admin/addvideos')}}"><a class="nav-link"
                                href="{{url('admin/addvideos')}}">{{trans('menu.videos')}}</a></li>
                        <!-- <li class="nav-item {{set_active('admin/uploadusers')}}"><a class="nav-link"
                                href="{{url('admin/uploadusers')}}">{{trans('menu.upload_users')}}</a></li> -->



                    </ul>
                </li>


                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.configuration')}}</div> 
                </li>

                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.settings')}}</div> 
                </li>

                <li class="nav-item nav-item-submenu {{set_active('admin/control-panel')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#settings" />
                        </svg>
                        <span class="text">{{trans('menu.settings')}}</span>
                    </a>
                    <ul class="nav nav-group-sub" style="{{set_active_display('admin/control-panel')}}"
                        data-submenu-title="Control Panel">
                        <li class="nav-item {{set_active('admin/control-panel')}}">
                            <a class="nav-link"
                                href="{{url('admin/control-panel')}}">{{trans('menu.control_panel')}}</a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.profile_management')}}</div>
                    
                </li>
                <li class="nav-item {{set_active('admin/userprofiles/*')}}{{set_active('admin/userprofile')}}">
                    <a class="nav-link" href="{{url('admin/userprofile')}}">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#user" />
                        </svg>
                        <span class="text">{{trans('menu.profile')}} </span>
                    </a>
                </li>

                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.wallets')}}</div>
                </li>





                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.reports')}}</div> 
                </li>
                <li
                    class="nav-item nav-item-submenu {{set_active('admin/salesreport')}}{{set_active('admin/customer_report')}}{{set_active('admin/dealer_report')}}{{set_active('admin/rpreport')}}{{set_active('admin/members_register_point')}}{{set_active('admin/topearners')}}{{set_active('admin/joiningreport')}}{{set_active('admin/incomereport')}}
                    {{set_active('admin/payoutreport')}}{{set_active('admin/joiningreportbysponsor')}}{{set_active('admin/joiningreportbycountry')}}{{set_active('admin/fundcredit')}}{{set_active('admin/payoutreport')}}{{set_active('admin/summaryreport')}}{{set_active('admin/inactive_users')}}{{set_active('admin/pool-bonus')}}{{set_active('admin/users-details')}}{{set_active('admin/edit-rp')}}{{set_active('admin/topenrollerreport')}}{{set_active('admin/sharepartnerstockreport')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#printer" />
                        </svg>
                        <span class="text"> {{trans('menu.reports')}}</span>
                    </a>
                    <ul class="nav nav-group-sub"
                        style=" {{set_active_display('admin/salesreport')}}{{set_active_display('admin/customer_report')}}{{set_active_display('admin/rpreport')}}{{set_active_display('admin/members_register_point')}}{{set_active_display('admin/topearners')}}{{set_active_display('admin/joiningreport')}}{{set_active_display('admin/incomereport')}}{{set_active_display('admin/payoutreport')}}{{set_active_display('admin/joiningreportbysponsor')}}{{set_active_display('admin/joiningreportbycountry')}}{{set_active_display('admin/fundcredit')}}{{set_active_display('admin/summaryreport')}}{{set_active_display('admin/inactive_users')}}{{set_active_display('admin/pool-bonus')}}{{set_active_display('admin/users-details')}}{{set_active_display('admin/edit-rp')}}{{set_active_display('admin/topenrollerreport')}}{{set_active_display('admin/sharepartnerstockreport')}}"
                        data-submenu-title="REPORTS">
                        <li class="nav-item {{set_active('admin/joiningreport')}}"><a class="nav-link"
                                href="{{url('admin/joiningreport')}}">{{trans('menu.joining-report')}}</a></li>
                     <!--    <li class="nav-item {{set_active('admin/fundcredit')}}"><a class="nav-link"
                                href="{{url('admin/fundcredit')}}"> {{trans('menu.fund-credit-report')}}</a></li> -->
                        <li class="nav-item {{set_active('admin/incomereport')}}"><a class="nav-link"
                                href="{{url('admin/incomereport')}}">{{trans('menu.member-income-report')}}</a></li>

                         <li class="nav-item {{set_active('admin/pendingreport')}}"><a class="nav-link"
                                href="{{url('admin/pendingreport')}}">{{trans('report.pending-commission-report')}}</a></li>        

                        <!-- <li class="nav-item {{set_active('admin/pool-bonus')}}"><a class="nav-link"
                                href="{{url('admin/pool-bonus')}}">{{trans('report.leadership_pool_bonus')}}</a></li> -->
                        <li class="nav-item {{set_active('admin/topearners')}}"><a class="nav-link"
                                href="{{url('admin/topearners')}}"> {{trans('menu.top-user-report')}} </a></li>
                        <li class="nav-item {{set_active('admin/payoutreport')}}"><a class="nav-link"
                                href="{{url('admin/payoutreport')}}">{{trans('menu.payout-report')}}</a></li>
                        <li class="nav-item {{set_active('admin/salesreport')}}"><a class="nav-link"
                                href="{{url('admin/salesreport')}}">{{trans('menu.sales_report')}}</a></li>
                        <li class="nav-item {{set_active('admin/customer_report')}}"><a class="nav-link"
                                href="{{url('admin/customer_report')}}">{{trans('Customer Report')}}</a></li>
                        <li class="nav-item {{set_active('admin/dealer_report')}}"><a class="nav-link"
                                href="{{url('admin/dealer_report')}}">{{trans('Dealer Report')}}</a></li>
                        <!-- <li class="nav-item {{set_active('admin/rpreport')}}"><a class="nav-link"
                                href="{{url('admin/rpreport')}}">{{trans('report.register_point_report')}}</a></li> -->
                      <!--   <li class="nav-item {{set_active('admin/members_register_point')}}"><a class="nav-link"
                                href="{{url('admin/members_register_point')}}">{{trans('report.members_register_point')}}</a></li> -->
                        <li class="nav-item {{set_active('admin/summaryreport')}}"><a class="nav-link"
                                href="{{url('admin/summaryreport')}}">{{trans('menu.summaryreport')}}</a></li>
                        <li class="nav-item {{set_active('admin/inactive_users')}}"><a class="nav-link"
                                href="{{url('admin/inactive_users')}}">{{trans('report.inactive_user_report')}}</a></li>
                        <li class="nav-item {{set_active('admin/sharepartnerstockreport')}}"><a class="nav-link"
                                href="{{url('admin/sharepartnerstockreport')}}">{{trans('report.share_partner_stock')}}</a></li>
                       <!--  <li class="nav-item {{set_active('admin/users-details')}}"><a class="nav-link"
                                href="{{url('admin/users-details')}}">{{trans('report.user_details')}}</a></li> -->
                       <!--  <li class="nav-item {{set_active('admin/topenrollerreport')}}"><a class="nav-link"
                                href="{{url('admin/topenrollerreport')}}">{{trans('report.top_enroller_report')}}</a></li> -->
                    </ul>
                </li>


                @if(true==true)
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.email_marketing')}} </div>
                    <svg class="feather">
                        <use xlink:href="/backend/icons/feather/feather-sprite.svg#send" />
                    </svg>
                </li>

                <li class="nav-item nav-item-submenu {{set_active('admin/campaign')}}">
                    <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#send" />
                        </svg>
                        <span class="text">{{trans('menu.campaigns')}}</span>
                    </a>
                    <ul class="nav nav-group-sub" style="{{set_active_display('admin/campaign')}}"
                        data-submenu-title="CAMPAIGN MANAGEMENT">

                        <li class="nav-item {{set_active('admin/campaign/create')}}">
                            <a class="nav-link" href="{{url('admin/campaign/create')}}">
                                {{trans('menu.create_new_campaign')}}
                            </a>
                        </li>

                        <li class="nav-item {{set_active('admin/campaign/lists')}}">
                            <a class="nav-link" href="{{url('admin/campaign/lists')}}">
                                {{trans('menu.manage_campaigns')}}
                            </a>
                        </li>
                        <li class="nav-item {{set_active('admin/campaign/contacts')}}">
                            <a class="nav-link" href="{{url('admin/campaign/contacts')}}">
                                {{trans('menu.contacts_lists')}}
                            </a>
                        </li>
                        <li class="nav-item {{set_active('admin/campaign/autoresponders')}}">
                            <a class="nav-link" href="{{url('admin/campaign/autoresponders')}}">
                                {{trans('menu.autoresponders_list')}}
                            </a>
                        </li>
                        <li class="nav-item {{set_active('admin/campaign/autoresponders/create')}}">
                            <a class="nav-link" href="{{url('admin/campaign/autoresponders/create')}}">
                                {{trans('menu.create_autoresponder')}}
                            </a>
                        </li>

                    </ul>
                </li>
                @endif






                <li class="nav-item {{set_active('auth/logout')}}">
                    <a class="nav-link" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <svg class="feather">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#log-out" />
                        </svg>
                        <span class="text"> {{trans('menu.logout')}}</span></a>
                </li>

            </ul>

        </div>
            @endif
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->


@endif