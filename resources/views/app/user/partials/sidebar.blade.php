@if(Auth::check())
<!-- User menu -->

<!--- MANAGE STYLE FOR SIDEBAR MENU HERE --->

@section('styles')@parent
<style type="text/css">
    .sidebar .nav-item-header{
        display: none;
    }
</style>
@endsection


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
                               <!--                <use xlink:href="/backend/icons/feather/feather-sprite.svg#settings" /> -->
                           </svg>
                       </a>
                   </div>
               </div>
           </div>
       </div>
       <!-- /user menu -->


       <!-- Main navigation -->
       <div class="card card-sidebar-mobile">

        <ul class="nav nav-sidebar" data-nav-type="accordion">
           @if(true==false)
           @include('app.user.partials.menu')
           @endif
           <!-- Main -->


           <li class="navigation-header"><span>{{trans('menu.main')}}</span> <i class="icon-menu" title="Main pages"></i></li>


           <li class="nav-item {{set_active('user/dashboard')}}">
            <a class="nav-link" href="{{url('user/dashboard')}}" class="nav-link active">                           
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#home" />
                </svg> 
                <span class="text" >{{trans('menu.dashboard')}}</span>
            </a>

        </li>
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.profile')}}</div> 
            <i class="icon-menu" title="{{trans('menu.profile')}}"></i>
        </li>
        <li class="nav-item {{set_active('user/profile')}}">
            <a class="nav-link" href="{{url('user/profile')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#user" />
                </svg> 
                <span class="text">{{trans('menu.profile')}}</span>
            </a>
        </li>
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.network')}} </div> 
            <i class="icon-menu" title="Network"></i>
        </li>

   @if ($GLOBAL_RANK!='Influencer' && $GLOBAL_RANK!='InfluencerManager')
        <li class="nav-item nav-item-submenu {{set_active('user/genealogy')}}{{set_active('user/sponsortree')}}{{set_active('user/sponsortable')}}{{set_active('user/tree')}}">
            <a href="javascript:void(0);" class="nav-link">
                <!--<b class="caret pull-right"></b>-->
                <span class="badge pull-right"></span>
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#layers" />
                </svg> 
                <span> {{trans('menu.network')}} </span>
            </a>
            <ul class="nav nav-group-sub" style="{{set_active_display('user/genealogy')}}{{set_active_display('user/sponsortree')}}{{set_active_display('user/sponsortable')}}{{set_active_display('user/tree')}}"  data-submenu-title="Network Explorers">
               <!--  <li class="nav-item {{set_active('user/genealogy')}}"><a class="nav-link" href="{{url('user/genealogy')}}">{{trans('tree.binary_genealogy')}}</a></li> -->
                <li class="nav-item {{set_active('user/sponsortree')}}"><a class="nav-link" href="{{url('user/sponsortree')}}">{{trans('menu.sponsor-genealogy')}}</a></li>
               <!--  <li class="nav-item {{set_active('user/sponsortable')}}"><a class="nav-link"
                    href="{{url('user/sponsortable')}}">{{trans('menu.sponsor-table')}}</a></li> -->
                 <li class="nav-item {{set_active('user/tree')}}"><a class="nav-link" href="{{url('user/tree')}}">{{trans('menu.tree-genealogy')}}</a></li>

            </ul>
            </li>
    @else
            <li class="nav-item nav-item-submenu {{set_active('user/influencertree')}}">
            <a href="javascript:void(0);" class="nav-link">
                <!--<b class="caret pull-right"></b>-->
                <span class="badge pull-right"></span>
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#layers" />
                </svg> 
                <span> {{trans('menu.network')}} </span>
            </a>
            <ul class="nav nav-group-sub" style="{{set_active_display('user/influencertree')}}"  data-submenu-title="Network Explorers">

                <li class="nav-item {{set_active('user/influencertree')}}"><a class="nav-link" href="{{url('user/influencertree')}}">{{trans('menu.influencer-genealogy')}}</a></li>

                <!-- <li class="nav-item {{set_active('user/tree')}}"><a class="nav-link" href="{{url('user/tree')}}">{{trans('menu.inf_tree-genealogy')}}</a></li> -->

            </ul>
            </li>
    @endif

            <!-- @if($user_registration==2 || $user_registration==5)  -->
            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.members_management')}} </div> <i class="icon-menu" title="{{trans('menu.members_management')}}"></i>
           <!--  </li>
            <li class="nav-item nav-item-submenu {{set_active('admin/users')}}{{set_active('admin/users/*')}}">
                <a href="javascript:void(0);" class="nav-link">

                   <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#users" />
                </svg> 
                <span class="text"> {{trans('menu.members')}}  </span>
            </a>
            <ul class="nav nav-group-sub" style="{{set_active_display('user/register')}}" data-submenu-title="{{trans('menu.members_management')}}">


               <li class="nav-item {{set_active('user/register')}}"><a class="nav-link" href="{{url('user/register')}}">{{trans('menu.enroll_new_member')}} </a></li>
           </ul>
       </li> -->
<!--        <li class="nav-item-header">
        <div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.income_report')}}</div> 
        <i class="icon-menu" title="{{trans('menu.income_report')}}"></i>
    </li>
    <li class="nav-item-header">
        <div class="text-uppercase font-size-xs line-height-xs"></div> 
        <i class="icon-menu" title="{{trans('menu.plan_purchase')}}"></i>
    </li>
    <li class="nav-item nav-item-submenu {{set_active('user/incomereport*')}}">
        <a href="javascript:void(0);" class="nav-link">
            <svg class="feather">
                <use xlink:href="/backend/icons/feather/feather-sprite.svg#printer" />
            </svg> 
            <span class="text"> {{ trans('menu.income_report')}} </span>
        </a>
        <ul class="nav nav-group-sub" style="{{set_active_display('user/incomereport*')}}" data-submenu-title="{{ trans('menu.income_report')}}">
           <li class="nav-item {{set_active('user/incomereport*')}}"><a class="nav-link" href="{{url('user/incomereport')}}">{{trans('menu.income_detail_statement')}}</a></li>

       </ul>
   </li> -->
    <!--  <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Income Report</div> 
            <i class="icon-menu" title="Income Report"></i>
        </li>
        <li class="nav-item {{set_active('user/incomereport')}}">
            <a class="nav-link" href="{{url('user/incomereport')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#dollar-sign" />
                </svg> 
                <span class="text">Income Report</span>
            </a>
        </li> -->

   <!--  <li class="nav-item {{set_active('user/incomereport*')}}">
        <a class="nav-link" href="{{url('user/incomereport')}}">
            <svg class="feather">
                <use xlink:href="/backend/icons/feather/feather-sprite.svg#printer" />
            </svg> 
            <span class="text">{{trans('menu.income_report')}}</span>
        </a>
    </li> -->
    <li class="nav-item-header">
        <div class="text-uppercase font-size-xs line-height-xs"></div> 
        <i class="icon-menu" title="{{trans('menu.plan_purchase')}}"></i>
    </li>
 <!--    <li class="nav-item nav-item-submenu {{set_active('user/purchase-plan')}}{{set_active('user/purchase-history')}}">
        <a href="javascript:void(0);" class="nav-link">
            <svg class="feather">
                <use xlink:href="/backend/icons/feather/feather-sprite.svg#file-plus" />
            </svg> 
            <span class="text"> {{ trans('menu.plan_upgrade')}} </span>
        </a>
        <ul class="nav nav-group-sub" style="{{set_active_display('user/purchase-plan')}} {{set_active_display('user/purchase-history')}}" data-submenu-title="{{ trans('menu.plan_purchase')}}">

           <li class="nav-item {{set_active('user/purchase-plan')}}"><a class="nav-link" href="{{url('user/purchase-plan')}}">{{trans('menu.plan_upgrades')}}</a></li>

           <li class="nav-item {{set_active('user/purchase-history')}}"><a class="nav-link" href="{{url('user/purchase-history')}}">{{trans('menu.purchase_history')}}</a></li>
       </ul>
   </li>  -->
   <li class="nav-item-header">
    <div class="text-uppercase font-size-xs line-height-xs"></div> 
    <i class="icon-menu" title="{{trans('menu.plan_purchase')}}"></i>
</li>
<!-- <li class="nav-item nav-item-submenu {{set_active('user/shop-history')}}{{set_active('user/onlinestore')}}{{set_active('user/viewcart')}}{{set_active('user/shippingaddress')}}">
    <a href="javascript:void(0);" class="nav-link">
        <svg class="feather">
            <use xlink:href="/backend/icons/feather/feather-sprite.svg#file-plus" />
        </svg> 
        <span class="text">Order</span>
    </a>
    <ul class="nav nav-group-sub" style="{{set_active_display('user/shop-history')}}{{set_active_display('user/shop')}}{{set_active_display('user/onlinestore')}}{{set_active_display('user/viewcart')}}{{set_active_display('user/shippingaddress')}}" data-submenu-title="{{ trans('menu.plan_purchase')}}"> -->
        <!-- <li class="nav-item {{set_active('user/onlinestore')}}{{set_active('user/viewcart')}}{{set_active('user/shippingaddress')}}"><a class="nav-link" href="{{url('user/purchasefor')}}">{{trans('products.online_purchase')}}</a></li> -->
<!-- 
        <li class="nav-item {{set_active('user/shop-history')}}"><a class="nav-link" href="{{url('user/shop-history')}}">{{trans('products.order_history')}}</a></li> -->


<!--     </ul>
</li> -->

  <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Order</div> 
            <i class="icon-menu" title="{{trans('menu.profile')}}"></i>
        </li>
        <!-- <li class="nav-item {{set_active('user/shop-history')}}">
            <a class="nav-link" href="{{url('user/shop-history')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-cart
" />
                </svg> 
                <span class="text">Order</span>
            </a>
        </li> -->

          <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Sales Order History</div> 
            <i class="icon-menu" title="{{trans('menu.profile')}}"></i>
        </li>
        <li class="nav-item {{set_active('user/sale-history')}}">
            <a class="nav-link" href="{{url('user/sale-history')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-bag
" />
                </svg> 
                <span class="text">Sales Order History</span>
            </a>
        </li>

        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Customer List</div> 
            <i class="icon-menu" title="{{trans('menu.profile')}}"></i>
        </li>
        <li class="nav-item {{set_active('user/customer-list')}}">
            <a class="nav-link" href="{{url('user/customer-list')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-bag
" />
                </svg> 
                <span class="text">Customer List</span>
            </a>
        </li>
<!-- <li class="nav-item-header">
    <div class="text-uppercase font-size-xs line-height-xs"></div> 
    <i class="icon-menu" title="{{trans('menu.m_wallet')}}"></i>
</li> -->
<li class="nav-item nav-item-submenu {{set_active('user/ewallet')}}{{set_active('user/fund-transfer')}}{{set_active('user/my-transfer')}} {{set_active('user/payoutrequest')}} {{set_active('user/allpayoutrequest')}}{{set_active('user/register-point')}}">
    <a href="javascript:void(0);" class="nav-link">
        <svg class="feather">
            <use xlink:href="/backend/icons/feather/feather-sprite.svg#credit-card" />
        </svg> 
        <span class="text"> {{ trans('menu.payout')}} </span>
    </a>
    <ul class="nav nav-group-sub" style="
    /*{{set_active_display('user/ewallet')}} 
    {{set_active_display('user/fund-transfer')}}
    {{set_active_display('user/my-transfer')}}*/
    {{set_active_display('user/payoutrequest')}}
    {{set_active_display('user/allpayoutrequest')}}
    {{set_active_display('user/register-point')}}" data-submenu-title="{{ trans('menu.m_wallet')}}">

    <!-- <li class="nav-item {{set_active('user/ewallet')}}"><a class="nav-link" href="{{url('user/ewallet')}}">{{trans('menu.my_wallet')}}</a></li>
    <li class="nav-item {{set_active('user/register-point')}}"><a class="nav-link" href="{{url('user/register-point')}}">{{trans('wallet.register_point')}}</a></li>

    <li class="nav-item {{set_active('user/fund-transfer')}}"><a class="nav-link" href="{{url('user/fund-transfer')}}">{{trans('menu.fund_transfer')}}</a></li>
    <li class="nav-item {{set_active('user/my-transfer')}}"><a class="nav-link" href="{{url('user/my-transfer')}}">{{trans('menu.my_transfer')}}</a></li> -->
    <!-- <li class="nav-item {{set_active('user/payoutrequest')}}"><a class="nav-link" href="{{url('user/payoutrequest')}}">{{trans('menu.request_payout')}}</a></li> -->
    <li class="nav-item  {{set_active('user/allpayoutrequest')}} ">
        <a class="nav-link" href="{{url('user/allpayoutrequest')}}">{{trans('menu.view_my_payout')}}</a>

    </li>
      



</ul>
</li>
<li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Ewallet</div> 
            <i class="icon-wallet" title="{{trans('menu.wallet')}}"></i>
        </li>
        <li class="nav-item {{set_active('user/ewallet')}}">
            <a class="nav-link" href="{{url('user/ewallet')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#credit-card" />
                </svg> 
                <span class="text">Ewallet</span>
            </a>
        </li>
@if($SP==1)

  <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Stock</div> 
            <i class="fa fa-shopping-basket" title="{{trans('products.stock_history')}}"></i>
        </li>
        <li class="nav-item {{set_active('user/stock-history')}}">
            <a class="nav-link" href="{{url('user/stock-history')}}">
                <svg class="feather">
                <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-bag" />
                </svg> 
           
                <span class="text">Stock</span>
            </a>
        </li>  

@endif
  <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Feedback & Support</div> 
            <i class="icon-home2" title="{{trans('menu.profile')}}"></i>
        </li>
        <li class="nav-item {{set_active('user/profile')}}">
            <a class="nav-link" href="{{url('user/helpdesk/tickets-dashboard')}}">
                <svg class="feather">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#user" />
                </svg> 
                <span class="text">Feedback & Support</span>
            </a>
        </li>
<!--  <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.feedback')}} </div> <i class="icon-menu" title="Support"></i></li>
<li class="nav-item nav-item-submenu {{set_active('user/inbox')}} {{set_active('user/helpdesk/*')}} {{set_active('user/helpdesk/*/*')}} {{set_active('user/helpdesk/*/*/*')}}">
    <a href="javascript:void(0);" class="nav-link"> -->
        <!--<b class="caret pull-right"></b>
        <svg class="feather">
            <use xlink:href="/backend/icons/feather/feather-sprite.svg#mail" />
        </svg> 
        <span class="text">{{trans('menu.feedback')}} </span>
    </a> -->
 <!--    <ul class="nav nav-group-sub" style=" {{set_active_display('user/inbox')}} {{set_active_display('user/helpdesk/*')}}" data-submenu-title="Support streams"> -->
     <!-- <li class="nav-item {{set_active('user/inbox')}}">
        <a class="nav-link" href="{{url('user/inbox')}}">{{trans('menu.mailbox')}} </a>
    </li> -->
<!--     <li class="nav-item  {{set_active('user/helpdesk/*')}} {{set_active('user/helpdesk/*/*')}} {{set_active('user/helpdesk/*/*/*')}} ">
        <a class="nav-link" href="{{url('user/helpdesk/tickets-dashboard')}}">{{trans('menu.voucher')}} </a>
    </li>


</ul> -->
<!-- </li> -->
<!-- <li class="nav-item nav-item-submenu {{set_active('user/allnews')}}{{set_active('user/allvideos')}}{{set_active('user/documentdownload')}}">
    <a href="javascript:void(0);" class="nav-link"> -->
        <!--<b class="caret pull-right"></b>-->
<!--         <span class="badge pull-right"></span>
        <svg class="feather">
            <use xlink:href="/backend/icons/feather/feather-sprite.svg#image" />
        </svg> 
        <span>{{trans('menu.marketing_tools')}}   </span>
    </a> -->
<!--     <ul class="nav nav-group-sub" style="{{set_active_display('user/allnews')}}{{set_active_display('user/allvideos')}}{{set_active_display('user/documentdownload')}}"  data-submenu-title="News & Videos"> -->

     <!--    <li class="nav-item {{set_active('user/allnews')}}"><a class="nav-link" href="{{url('user/allnews')}}">{{trans('menu.news')}}</a></li> -->
     <!--    <li class="nav-item {{set_active('user/allvideos')}}"><a class="nav-link" href="{{url('user/allvideos')}}"> {{trans('menu.videos')}} </a></li> -->
        <!-- <li class="nav-item {{set_active('user/documentdownload')}}"><a class="nav-link" href="{{url('user/documentdownload')}}">{{trans('menu.product_pdf')}}</a></li> -->
<!--         <li class="nav-item nav-item-submenu"><a href="javascript:void(0);" class="nav-link">
            <span class="badge pull-right"></span> -->
            <!-- <svg class="feather">
                <use xlink:href="/backend/icons/feather/feather-sprite.svg#image" />
            </svg>  -->
    <!--         <span>{{trans('menu.product_pdf')}}   </span>
        </a>
        <ul class="nav nav-group-sub">
            <li class="nav-item"><a class="nav-link" href="#">{{trans('menu.infographic')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#"> {{trans('menu.e-leaflet')}}</a></li>
            <li class="nav-item nav-item-submenu"><a href="javascript:void(0);" class="nav-link">
            <span class="badge pull-right"></span> -->
            <!-- <svg class="feather">
                <use xlink:href="/backend/icons/feather/feather-sprite.svg#image" />
            </svg>  -->
<!--             <span>{{trans('menu.b-partner-hub')}}</span>
        </a>
         <ul class="nav nav-group-sub">
            <li class="nav-item"><a class="nav-link" href="#">{{trans('menu.plan')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#"> {{trans('menu.activity')}} </a></li>
        </ul>
    </li>
        </ul>
    </li>
</ul>
</li> -->
<li class="nav-item {{set_active('auth/logout')}}">
    <a class="nav-link" href="{{ url('/logout') }}"  onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    <svg class="feather">
        <use xlink:href="/backend/icons/feather/feather-sprite.svg#log-out" />
    </svg> 
    <span class="text"> {{trans('menu.logout')}}</span></a>
</li>


<!-- @endif -->
              <!--   <li class="nav-item {{set_active('user/shop')}}">
                                                     
                             <a class="nav-link" href="http://shop-sheheme.cloudmlm.online/"><svg class="feather">
                                <use xlink:href="/backend/icons/feather/feather-sprite.svg#home" />
                            </svg> 
                            Shop</a>
                            

                        </li> -->

                   <!--  <li class="nav-item nav-item-submenu {{set_active('user/onlinestore')}}{{set_active('user/sales')}}">
                        <a href="javascript:void(0);" class="nav-link">
                           
                            <span class="badge pull-right"></span>
                            <svg class="feather">
                                <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-bag" />
                            </svg> 
                            <span>{{trans('menu.online_store')}}   </span>
                        </a>
                         <ul class="nav nav-group-sub" style="{{set_active_display('user/onlinestore')}}"  data-submenu-title="{{trans('menu.online_store')}}">

                            <li class="nav-item {{set_active('user/onlinestore')}}"><a class="nav-link" href="{{url('user/onlinestore')}}">{{trans('menu.purchase_order')}}</a></li>
                            <li class="nav-item {{set_active('user/sales')}}"><a class="nav-link" href="{{url('user/sales')}}"> {{trans('menu.my_order')}}  </a></li>
                        </ul>
                    </li> -->



                    

                    
                    











                    



                  <!--   <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"></div> <i class="icon-menu" title="{{trans('menu.request_voucher')}}"></i></li>
                    <li class="nav-item nav-item-submenu {{set_active('user/requestvoucher')}}{{set_active('user/myvoucher')}}">
                        <a href="javascript:void(0);" class="nav-link">
                        <svg class="feather">
                                <use xlink:href="/backend/icons/feather/feather-sprite.svg#minus-square" />
                            </svg> 
                            <span class="text"> {{trans('menu.vouchers')}} </span>
                        </a>
                        <ul class="nav nav-group-sub" style="{{set_active_display('user/requestvoucher')}} {{set_active_display('user/myvoucher')}}" data-submenu-title="{{ trans('menu.request_voucher')}}">

                              @if($voucher_user_request == 'yes')   

                             <li class="nav-item {{set_active('user/requestvoucher')}}"><a class="nav-link" href="{{url('user/requestvoucher')}}">{{trans('menu.request_voucher')}}</a></li>
                           @endif

                             <li class="nav-item {{set_active('user/myvoucher')}}"><a class="nav-link" href="{{url('user/myvoucher')}}">{{trans('menu.my_voucher')}}</a></li>
                            
                            
                        </ul>
                    </li> -->
                    


                    








                     <!-- <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{trans('menu.lead')}}</div> <i class="fa fa-bullhorn" title="{{trans('menu.profile')}}"></i></li>
                     <li class="nav-item {{set_active('user/lead')}}">
                        <a class="nav-link" href="{{url('user/lead')}}">
                        <svg class="feather">
                                <use xlink:href="/backend/icons/feather/feather-sprite.svg#users" />
                            </svg> 
                            <span class="text">{{trans('menu.lead')}}</span>
                        </a>
                    </li> -->
                    
                    

                </ul>

            </div>
            <!-- /main navigation -->
        </div>
    </div>
    <!-- /main sidebar -->


    @endif


