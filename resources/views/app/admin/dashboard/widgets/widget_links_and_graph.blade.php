<div class="row">   
        <!--LINKS-->
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
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}index.php?route=account/register&sponsor={{$secret}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy input-group-text" data-clipboard-target="#referrallink" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>

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
                    <!-- {{trans('Purchase Link')}} -->
                     {{trans('dashboard.Purchase Link')}}
                </h6>
            </div>
       

         <!-- <div class="card-body"> -->
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink2" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}index.php?route=product/all_product&purchase={{$secret}}"/>
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
        <!--LINKS END-->
</div>



<div class="row display-flex">
    <div class="col-xl-7">
        <!--JOIN_GRAPH WIDGET START-->
                 <style type="text/css">
             .po{
                pointer-events: none!important;
             }
         </style>

         <div class="card card-flat">
             <div class="card-header header-elements-inline">
                 <h6 class="card-title">
                     {{trans('dashboard.users_joined_over_the_time')}}
                 </h6>
                 <div class="header-elements">
                 </div>
             </div>
             <div class="card-body py-0">

                 <div class="row">
                     <div class="col-6">
                         <div class="d-flex align-items-center justify-content-center mb-2">
                             <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3 po"
                                 href="#" >
                                 <i class="icon-people">
                                 </i>
                             </a>
                             <div>
                                 <div class="font-weight-semibold fz-xs-12"> {{trans('wallet.total_members')}}
                                 </div>
                                 <div class="text-muted">
                                     {{$total_users}}
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-6">
                         <div class="d-flex align-items-center justify-content-center mb-2">
                             <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3 po"
                                 href="#">
                                 <i class="icon-people">
                                 </i>
                             </a>
                             <div>
                                 <div class="font-weight-semibold fz-xs-12">
                                     {{trans('report.total_sales')}}
                                 </div>
                                 <div class="text-muted">
                                   {{  currency($total_sales)}}
                                 </div>
                             </div>
                         </div>
                     </div>



                 </div>
                 <hr />
                 <div class="chart position-relative">
                     <div class="chart has-fixed-height" id="users_join_vs_sales" style="height:350px">
                     </div>
                 </div>


             </div>
         </div>
        <!--JOIN_GRAPH WIDGET END-->
    </div>
    <div class="col-xl-5">
        <!--JOIN_MAP WIDGET START-->
        <div class="card map-card fillheight">
    
    <div class="card-header header-elements-inline">
        <h6 class="card-title">
            {{trans('dashboard.global_view')}}
        </h6>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="fullscreen"></a>
            </div>
        </div>
    </div>
    <div class="card-body py-0">
        <div class="has-fixed-height map-choropleth">
        </div>
    </div>
</div>
        <!--JOIN_MAP WIDGET END-->

    </div>
</div>