
    @if($user_type == 'Influencer' || $user_type == 'InfluencerManager') 
    <div class="row">
    <div class="col-lg-4 col-12">


       
        <!-- /area chart in colored card -->
        <div class="card  box">
            <div class="card-body">
                <div class="heading-elements">

                </div>

                <h3 class="no-margin text-semibold">{{$GLOBAL_RANK}}</h3>
                <!-- {{trans('dashboard.member_current_position')}} -->
                <div class="text-muted text-size-small"> Current Position</div>
               
              
            </div> 

            <div id="chart_area_color"></div>
        </div>
         
    </div>                        

        <div class="col-lg-4 col-12">
            <div class="card box">
                <!-- <div class="card-body metric_user"> -->
                    <div class="heading-elements">

                    </div>
           <div class="card-header bg-white border-0 header-elements-inline pb-0">  
                    <!-- <h3 class="no-margin text-semibold">{{currency(round($total_sale,2))}}<span id="total_users_bar_total" class="total"> <i
                            class="icon-spinner fa-spin"></i></span> </h3> -->
                    <h3 class="no-margin text-semibold"><span id="total_users_bar_total" class="total"
                        >{{currency(round($total_sale,2))}} </span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
                      <p class="text-semibold"><a href="{{url('user/sale-history')}}" target="_blank" class="text-grey"> Monthly sales : RM <span id="total_users_bar_count" class="count"
                        > {{$total_sales_count}}<i class="icon-spinners fa-spin"></i></span></a></p>

                    <!-- <div class="text-muted text-size-small">{{trans('dashboard.current_income')}}</div> -->
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
         




        <div class="col-lg-4 col-12">
            <!-- Bar chart in colored card -->
         <div class="card box">
            <div class="card-body metric_user_pur">
              <div class="card-header bg-white border-0 header-elements-inline pb-0">  
                    <!-- <h3 class="no-margin text-semibold">{{currency(round($total_sale,2))}}<span id="total_users_bar_total" class="total"> <i
                            class="icon-spinner fa-spin"></i></span> </h3> -->
                    <h3 class="no-margin text-semibold"><span id="total_users_pur_total" class="total_pur"
                        >{{currency(round($total_credit,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                      <p class="text-semibold">
                        <!-- <a href="{{url('user/shop-history')}}" target="_blank" class="text-grey">  -->
                            Monthly Purchase : RM <span id="total_users_pur_count" class="count_pur"
                        > {{$total_purchase_count}}</span>
                    <!-- </a> -->
                </p>
              


                <!-- <div class="heading-elements">
                     <h3 class="no-margin text-semibold "> {{currency(round($total_credit,2))}}</h3>
                     <p class="text-semibold"><a href="{{url('user/shop-history')}}" target="_blank" class="text-grey">Total Purchase: {{$total_purchase_count}}</a></p>
                </div> -->
               <!--  <div id="purchaserange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div> -->
            </div>
            <!-- /bar chart in colored card -->
        </div>
     </div>

     
</div>


<div class="row">
    <div class="col-lg-4 col-12">
        <div class="card totalincome box">
            <div class="card-body  metric_user_income">
                <div class="col-md-9">
                    <div class="heading-elements">

                    </div>
                        <!-- <h3 class="no-margin text-semibold incomedatavalue"> {{currency(round($incom,2))}}</h3>
                        <div class="header-elements">
                            <div class="d-flex justify-content-between">
                                <div class="list-icons ml-3">
                                </div>
                            </div>
                        </div> -->

                         <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_income_total" class="income"
                        >{{currency(round($incom,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                    
                    Monthly Earnings
                   
                </div>
               <!--  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div> -->
            </div>
        </div>
    </div>
         <div class="col-lg-4 col-12">
            <div class="card box">
                <div class="card-body metric_payout">
                    <div class="heading-elements">

                    </div>
           <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_payout_total" class="payout"
                        >{{currency(round($payout_amount,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                     
                Monthly Payout
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
        </div>  
   

   
        <div class="col-lg-4 col-12">
            <div class="card box">
                <div class="card-body metric_grp_sale">
                    <div class="heading-elements">

                    </div>
           <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_grp_sale_total" class="grp_sale"
                        >RM {{$montly_groupsale}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                     
                Monthly Groupsale
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
        </div>  




        <!--  <div class="col-lg-3 col-12">
            <div class="card box">
                <div class="card-body">
                    <div class="heading-elements">

                    </div>

                    
                    
                </div>

                <div id="sparklines_color"></div>
            </div>
            
        </div>  -->
    </div>

<div class="row">   
 <div class="col-md-6">
     <!-- Sparklines in colored card -->
    <div class="card box">
      <div class="card-body">           
       <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('dashboard.referral_link')}}
                </h6>
            </div>
            <!-- <div class="card-body"> -->
           <!--  @if($GLOBAL_RANK == 'Member' || $GLOBAL_RANK == 'Customer')
            <span class="text-semibold text-info">You Need To Upgrade as Dealer to get Referal Link</span>
                
            @else -->

                <div class="input-group">
                    <input class="selectall form-control" id="referrallink" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}/index.php?route=account/register&sponsor={{$secret}}&type={{$influencer}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy input-group-text" data-clipboard-target="#referrallink" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            <!-- @endif -->
            <!-- </div> -->

        <!--  <div class="card-body">
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink2" readonly="true" spellcheck="false" type="text" value="{{url('/',$secret)}}-test"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy1 input-group-text" data-clipboard-target="#referrallink2" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            </div> -->

        </div>
    </div>
</div>
</div>     
<div class="col-md-6">
     <!-- Sparklines in colored card -->
    <div class="card box">
      <div class="card-body">           
       <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('Purchase Link')}}
                </h6>
            </div>
       

         <!-- <div class="card-body"> -->
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink2" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}/index.php?route=product/all_product&purchase={{$secret}}&type={{$influencer}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy1 input-group-text" data-clipboard-target="#referrallink2" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            <!-- </div> -->

        </div>
    </div>
</div>
</div>    
</div>
    
    @else 
    <div class="row">
    <div class="col-lg-3 col-12">


        <!-- Area chart in colored card -->
        @if($user_type == 'Customer' || $user_type == 'Member')

        <div class="card card-body border-top-primary">
                <div class="text-center">
                     <h6 class="no-margin text-semibold">Current Position : <b>{{$GLOBAL_RANK}}</b></h6>
                <!-- <div class="text-muted text-size-small"> Current Position</div> -->
                
                     <h6 class="font-weight-semibold">Target to be Dealer :<b> <br>RM {{$settings_data->ProductCountDealer}}</b></h6>
                       @if($tobeDealer_saleCount < $settings_data->ProductCountDealer)
                    
                           <h6>Remaining days: <b>{{$remaining_days}} days</b> ({{$settings_data->memberSale_validity}}days)</h6>
                    @endif
                </div>

                <div class="progress rounded-pill" style="height: 0.625rem;" >
                     <div class="progress-bar bg-primary" style="width:{{($tobeDealer_saleCount/$settings_data->ProductCountDealer)*100}}%;" >
                            <span>{{$tobeDealer_saleCount}}/{{$settings_data->ProductCountDealer}} products</span>
                     </div>
                </div>
              
          </div>

        
        @else
        <!-- /area chart in colored card -->
        <div class="card  box">
            <div class="card-body">
                <div class="heading-elements">

                </div>

                <h3 class="no-margin text-semibold">{{$GLOBAL_RANK}}</h3>
                <!-- {{trans('dashboard.member_current_position')}} -->
                <div class="text-muted text-size-small"> Current Position</div>
               
              
            </div> 

            <div id="chart_area_color"></div>
        </div>
          @endif

    </div>                        

        







  <div class="col-lg-3 col-12">
            <!-- Bar chart in colored card -->
         <div class="card box">
            <div class="card-body metric_user">
              <div class="card-header bg-white border-0 header-elements-inline pb-0">  
                    <!-- <h3 class="no-margin text-semibold">{{currency(round($total_sale,2))}}<span id="total_users_bar_total" class="total"> <i
                            class="icon-spinner fa-spin"></i></span> </h3> -->
                    <h3 class="no-margin text-semibold"><span id="total_users_bar_total" class="total"
                        >{{currency(round($total_sale,2))}} </span></h3>

                        
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                     
    <p class="text-semibold"><a href="{{url('user/sale-history')}}" target="_blank" class="text-grey"> Monthly sales : RM <span id="total_users_bar_count" class="count"> {{$total_sales_count}}<i class="icon-spinners fa-spin"></i></span></a></p>

              


                <!-- <div class="heading-elements">
                     <h3 class="no-margin text-semibold "> {{currency(round($total_credit,2))}}</h3>
                     <p class="text-semibold"><a href="{{url('user/shop-history')}}" target="_blank" class="text-grey">Total Purchase: {{$total_purchase_count}}</a></p>
                </div> -->
               <!--  <div id="purchaserange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div> -->
            </div>
            <!-- /bar chart in colored card -->
        </div>
     </div>





  

        <div class="col-lg-3 col-12">
            <!-- Bar chart in colored card -->
         <div class="card box">
            <div class="card-body metric_user_pur">
              <div class="card-header bg-white border-0 header-elements-inline pb-0">  
                    <!-- <h3 class="no-margin text-semibold">{{currency(round($total_sale,2))}}<span id="total_users_bar_total" class="total"> <i
                            class="icon-spinner fa-spin"></i></span> </h3> -->
                    <h3 class="no-margin text-semibold"><span id="total_users_pur_total" class="total_pur"
                        >{{currency(round($total_credit,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                      <p class="text-semibold">
                        <!-- <a href="{{url('user/shop-history')}}" target="_blank" class="text-grey">  -->
                            Monthly Purchase : RM <span id="total_users_pur_count" class="count_pur"
                        > {{$total_purchase_count}}</span>
                    <!-- </a> -->
                </p>
              


                <!-- <div class="heading-elements">
                     <h3 class="no-margin text-semibold "> {{currency(round($total_credit,2))}}</h3>
                     <p class="text-semibold"><a href="{{url('user/shop-history')}}" target="_blank" class="text-grey">Total Purchase: {{$total_purchase_count}}</a></p>
                </div> -->
               <!--  <div id="purchaserange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div> -->
            </div>
            <!-- /bar chart in colored card -->
        </div>
     </div>

     <div class="col-lg-3 col-12">
            <div class="card box">
                <div class="card-body metric_cashback">
                    <div class="heading-elements">

                    </div>
           <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_cashback_total" class="cashback"
                        >{{currency(round($cashback,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                   <!--  <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                     
                Monthly cashback
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
        </div>  
</div>


<div class="row">
    <div class="col-lg-3 col-12">
        <div class="card totalincome box">
            <div class="card-body  metric_user_income">
                <div class="col-md-9">
                    <div class="heading-elements">

                    </div>
                        <!-- <h3 class="no-margin text-semibold incomedatavalue"> {{currency(round($incom,2))}}</h3>
                        <div class="header-elements">
                            <div class="d-flex justify-content-between">
                                <div class="list-icons ml-3">
                                </div>
                            </div>
                        </div> -->

                         <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_income_total" class="income"
                        >{{currency(round($incom,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                   <!--  <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                    
                    Monthly Earnings
                   
                </div>
               <!--  <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div> -->
            </div>
        </div>
    </div>
         <div class="col-lg-3 col-12">
            <div class="card box">
                <div class="card-body metric_payout">
                    <div class="heading-elements">

                    </div>
           <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_payout_total" class="payout"
                        >{{currency(round($payout_amount,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                     
                Monthly Payout
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
        </div>  
   <!--  <div class="col-lg-3 col-12">

      
        <div class="card box" >
            <div class="card-body"  data-toggle="tooltip" >
                <div class="heading-elements">

                </div>

                <h3 class="no-margin text-semibold">{{currency(round($payout_amount,2))}}</h3>
                Total Payout
                <div class="text-muted text-size-small"> </div>

                   
            </div>
            <div id="chart_area_color"></div>
        </div>
     

    </div> -->
      <!--   <div class="col-lg-3 col-6"> -->
            <!-- Sparklines in colored card -->
          <!--   <div class="card box">
                <div class="card-body">
                    <div class="heading-elements">

                    </div>

                   
                </div>

                <div id="sparklines_color"></div>
            </div> -->
            <!-- /sparklines in colored card -->
      <!--   </div> -->
        <!-- <div class="col-lg-3 col-6"> -->
            <!-- Sparklines in colored card -->
          <!--   <div class="card box">
                <div class="card-body">
                    <div class="heading-elements">

                    </div>

                    
                </div>

                <div id="sparklines_color"></div>
            </div> -->
            <!-- /sparklines in colored card -->
        


    <div class="col-lg-3 col-12">
            <div class="card box">
                <div class="card-body">
                    <div class="heading-elements">

                    </div>

                    <h3 class="no-margin text-semibold">{{currency(round($pending_cmsn,2))}}</h3>
                      <p class="text-semibold">Pending Commission</p>
                    <!-- <div class="text-muted text-size-small">{{trans('dashboard.current_income')}}</div> -->
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
        </div> 
        <div class="col-lg-3 col-12">
            <div class="card box">
                <div class="card-body metric_grp_sale">
                    <div class="heading-elements">

                    </div>
           <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_grp_sale_total" class="grp_sale"
                        >RM {{$montly_groupsale}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <!-- <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button> 
                            <button data-range="1"
                                class="dropdown-item btn range"></button>
                            <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
                     
                Monthly Groupsale
                </div>

                <div id="sparklines_color"></div>
            </div>
            <!-- /sparklines in colored card -->
        </div>  




        <!--  <div class="col-lg-3 col-12">
            <div class="card box">
                <div class="card-body">
                    <div class="heading-elements">

                    </div>

                    
                    
                </div>

                <div id="sparklines_color"></div>
            </div>
            
        </div>  -->
    </div>

     
<div class="row">   
 <div class="col-md-6">
     <!-- Sparklines in colored card -->
    <div class="card box">
      <div class="card-body">           
       <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('dashboard.referral_link')}}
                </h6>
            </div>
            <!-- <div class="card-body"> -->
            @if($GLOBAL_RANK == 'Member' || $GLOBAL_RANK == 'Customer')
            <span class="text-semibold text-info">You Need To Upgrade as Dealer to get Referal Link</span>
                
            @else

                <div class="input-group">
                    <input class="selectall form-control" id="referrallink" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}/index.php?route=account/register&sponsor={{$secret}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy input-group-text" data-clipboard-target="#referrallink" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            @endif
            <!-- </div> -->

        <!--  <div class="card-body">
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink2" readonly="true" spellcheck="false" type="text" value="{{url('/',$secret)}}-test"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy1 input-group-text" data-clipboard-target="#referrallink2" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            </div> -->

        </div>
    </div>
</div>
</div>     
<div class="col-md-6">
     <!-- Sparklines in colored card -->
    <div class="card box">
      <div class="card-body">           
       <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('Purchase Link')}}
                </h6>
            </div>
       
            @if($GLOBAL_RANK == 'Customer')
                <span class="text-semibold text-info">You Need To Upgrade as Member to get Purchase Link</span>
            @else
         <!-- <div class="card-body"> -->
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink2" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}/index.php?route=product/all_product&purchase={{$secret}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy1 input-group-text" data-clipboard-target="#referrallink2" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            <!-- </div> -->
            @endif
        </div>
    </div>
</div>
</div>    
</div>
 
    <!-- /sparklines in colored card -->
 <div class="row">
<div class="col-md-6 col-sm-6"> 
    
     <div class="card card-body border-top border-top-primary">
        <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('Level Bonus Criteria')}}
                </h6>
            </div>
                               
        <div class="text-center">
        <p   class="text-semibold" >Level 1 Bonus {{$total_sales_count}}/{{$level_settings_criteria->criteria_l1}} RM </p>
        <div class="progress mb-3" style="height: 0.625rem;" >
        <div class="progress-bar bg-primary" style="width:{{($total_sales_count/$level_settings_criteria->criteria_l1)*100}}%;" >
        <!-- <span>{{$total_sales_count}}/{{$level_settings_criteria->criteria_l1}} set</span> -->
        </div>
        </div>
        </div>
        <div class="text-center">
        <p   class="text-semibold" >Level 2 Bonus {{$total_sales_count}}/{{$level_settings_criteria->criteria_l2}} RM </p>
        <div class="progress mb-3" style="height: 0.625rem;" >
        <div class="progress-bar bg-primary" style="width:{{($total_sales_count/$level_settings_criteria->criteria_l2)*100}}%;" >
        <!-- <span>{{$total_sales_count}}/{{$level_settings_criteria->criteria_l2}} set</span> -->
        </div>
        </div>
        </div>
        <div class="text-center">
        <p   class="text-semibold" >Level 3 Bonus  </p>
        </div>
        <div class="row">
        <div class="col-md-6 col-sm-6"> 
        <div class="progress mb-3" style="height: 0.625rem;">
        <div class="progress-bar bg-primary " style="width: {{($total_sales_count/$level_settings_criteria->criteria_l3)*100}}%">
        <!-- <span>sales {{$total_sales_count}}/{{$level_settings_criteria->criteria_l3}} set</span> -->
        </div>
        </div>
        <div class="text-center"> <p class="text-semibold" >sales {{$total_sales_count}}/{{$level_settings_criteria->criteria_l3}} RM</p></div>
        </div>
        <div class="col-md-6 col-sm-6"> 
        <div class="progress mb-3" style="height: 0.625rem;">
        <div class="progress-bar bg-primary" style="width: {{($ref_grpsale/$level_settings_criteria->criteria2_l3)*100}}%">
        <!-- <span>refferals seles {{$ref_grpsale}}/{{$level_settings_criteria->criteria2_l3}} set</span>     -->
        </div>
        </div>
        <div class="text-center"> <p class="text-semibold" > refferals sales {{$ref_grpsale}}/{{$level_settings_criteria->criteria2_l3}} RM</p></div>
        </div>
        </div>
     </div>
</div>  

     <div class="col-md-6 col-sm-6">   
        <div class="card card-body border-top-primary">
         <div class="text-center">
          <h2 class="mb-0 font-weight-semibold">Monthly Target</h2>
              @if($total_sales_count >= 4)
                Achieved your target! You are eligible for commission.
              @else 
              <!--   {{$monthly_remaining_days}} days -->
              <div style="font-size: 20px;">
                <span>Remaining days:</span>
                <span id="days"></span>
                <!-- <span id="hours"></span>
                <span id="minutes"></span>
                <span id="seconds"></span> -->
                <span id="expiry"></span>
                </div>
              @endif
        </div>   
         <div class="progress rounded-pill">
         <div class="progress-bar @if($total_sales_count >= 4)  bg-suc  @else bg-primary @endif "style="width:{{($total_sales_count/$settings_data->monthly_count)*100}}%;" >
                <span>{{$total_sales_count}}/{{$settings_data->monthly_count}} products</span>
         </div>
        </div>
    </div>
  </div>  
</div>    
@endif
<div class="row card-body">
    
        <!--JOIN_GRAPH WIDGET START and JOIN_GRAPH WIDGET START-->
        @include('app.user.dashboard.widgets_graph_join_detailed')
        <!--JOIN_GRAPH WIDGET END and JOIN_GRAPH WIDGET END-->
    

    
</div>


<input type="hidden" id="datetime" value="{{$monthly_remaining_days}}">









    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    @section('scripts')
    @parent
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript">
        $(function() {

         var start = moment().subtract(29, 'days');
         var end = moment();
         function cb(start, end) {
             $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
             var started = start.format('DD,MM,YYYY');
             var ended = end.format('DD,MM,YYYY');
             $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/totalincome-datas.json/' + started+'/'+ended, function (data) {
                console.log(data);
                $('.incomedatavalue').html(data);
            });
         }

         $('#reportrange').daterangepicker({
             startDate: start,
             endDate: end,
             ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
      }, cb,
      );

         cb(start, end);


     });
 </script>
 <script type="text/javascript">
        $(function() {

         var start = moment().subtract(29, 'days');
         var end = moment();
         function cb(start, end) {
             $('#purchaserange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
             var started = start.format('DD,MM,YYYY');
             var ended = end.format('DD,MM,YYYY');
             $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/totalpurchase-datas.json/' + started+'/'+ended, function (data) {
                console.log(data);
                $('.purchasedatavalue').html(data);
            });
         }

         $('#purchaserange').daterangepicker({
             startDate: start,
             endDate: end,
             ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
      }, cb,
      );

         cb(start, end);


     });
 </script>

 <script>
    function makeTimer() {
        var endTime = "{{$monthly_remaining_days}}";  
        endTime = (Date.parse(endTime) / 1000);
        var now = new Date();
        now = (Date.parse(now) / 1000);

        var timeLeft = endTime - now;
        var days = Math.floor(timeLeft / 86400) + 1; 
        // var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        // var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
        // var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

        // if (hours < "10") { hours = "0" + hours; }
        // if (minutes < "10") { minutes = "0" + minutes; }
        // if (seconds < "10") { seconds = "0" + seconds; }

        if(days < 0)
        {
            $("#expiry").html("<span> Expired</span>");
        }
        else
        {
            $("#days").html(days + "<span> Days</span>");
            // $("#hours").html(hours + "<span> Hours</span>");
            // $("#minutes").html(minutes + "<span> Minutes</span>");
            // $("#seconds").html(seconds + "<span> Seconds</span>");   
        }
    }

    setInterval(function() { makeTimer(); }, 1000);

</script>
 @endsection
