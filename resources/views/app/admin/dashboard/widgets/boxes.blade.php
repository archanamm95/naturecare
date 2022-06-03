<!-- DOWNLINE_MEMBERS_COUNT WIDGET START-->
<div class="col-lg-4 col-md-6 col-sm-6 col-6">        
<div class="card metric">
    <div class="card-header bg-white border-0 header-elements-inline pb-0">
        <h6 class="card-title">{{trans('dashboard.downline_members')}}</h6>
        <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">{{trans('Show data from :')}} </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button>
                            <button data-range="week"
                                class="dropdown-item btn range">{{trans('dashboard.this_week')}}</button>
                            <button data-range="month"
                                class="dropdown-item btn range">{{trans('dashboard.this_month')}}</button>
                            <button data-range="year"
                                class="dropdown-item btn range">{{trans('dashboard.this_year')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0 pb-0">
        <div class="d-flex flex-row align-items-center">
            <div class="col p-0">
                <h3 class="text-4xl font-weight-normal ml-1 count-text-color mt-1 mb-3"><span
                        class="hide hidden">{{$total_users}}</span> <span id="total_users_bar_count" class="count"> <i
                            class="icon-spinner2 fa-spin"></i></span> </h3>
            </div>
        </div>
    </div>

    <div class="rounded-lg mt-3 position-absolute fixed-top fixed-bottom ec-chart" id="users_join_bar"
        style="top: 60%;">
    </div>
</div>            
</div>
<!--DOWNLINE_MEMBERS_COUNT WIDGET END-->

<!--DOWNLINE_MEMBERS_COUNT WIDGET START-->
<div class="col-lg-4 col-md-6 col-sm-6 col-6">          
    <div class="card metric">
    <div class="card-header bg-white border-0 header-elements-inline pb-0">
        <h6 class="card-title">{{trans('dashboard.members_income')}}</h6>
    </div>
    <div class="card-body pt-0 pb-0 overflow-auto">
        <div class="d-flex mt-2">
            <h3 class="text-4xla no-margin text-muted font-weight-semibold mt-1 mb-0 fz-xs-20 fz-xs-15">  {{ currency(round($total_amount,2)) }} </h3>
            <!-- <div class="list-icons ml-auto">
                <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                </svg> 
            </div> -->
        </div>
        <div class="text-muted font-size-sm">
            {{round($per_payout)}}% {{trans('dashboard.payout_done')}}
        </div>
    </div>
</div>           
</div>
<!--DOWNLINE_MEMBERS_COUNT WIDGET END-->

<!--DOWNLINE_MEMBERS_COUNT WIDGET START-->
<div class="col-lg-4 col-md-6 col-sm-6 col-6">          
    <div class="card metric">
    <div class="card-header bg-white border-0 header-elements-inline pb-0">
        <h6 class="card-title">{{trans('dashboard.package_sales')}}</h6>
    </div>
    <div class="card-body pt-0 pb-0">
        <div class="d-flex mt-2 overflow-auto">
            <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{ currency(round($total_sales,2)) }} </h3>
            <!-- <div class="list-icons ml-auto">
                <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-cart"></use>
                </svg> 
            </div> -->
        </div>
        <div class="text-muted font-size-sm">
            {{round($per_payout)}}% {{trans('dashboard.payout_done')}}
        </div>
    </div>
</div>             
</div> 
<!--DOWNLINE_MEMBERS_COUNT WIDGET END-->

<!-- DOWNLINE_MEMBERS_COUNT WIDGET START -->

<!-- <div class="row">  -->
    @foreach($payment as $key=>$data)
    
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card metric">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <!-- <h6 class="card-title">{{ucfirst(str_replace("_"," ",$key))}}</h6> -->
                <!-- <h6 class="card-title">{{$key}}</h6> -->
                <h6 class="card-title">{{trans('dashboard.'.$key)}}</h6>
 
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2 overflow-auto">
                    <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{currency(round($data,2))}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>
                <div class="text-muted font-size-sm">
                    {{ucfirst(str_replace("_"," ",$key))}}
                </div>
            </div>
        </div>
    </div>
    
    
    @endforeach
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card metric">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <h6 class="card-title">{{trans('dashboard.Level Bonus')}}</h6>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2 overflow-auto">
                    <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{currency(round($level_bonus,2))}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>
                <div class="text-muted font-size-sm">
                    {{trans('dashboard.Level Bonus')}}
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
<!--DOWNLINE_MEMBERS_COUNT WIDGET END-->

<!--DOWNLINE_MEMBERS_COUNT WIDGET START-->
<!-- <div class="row">  -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card weeklyMaintainMembersIncome">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <h6 class="card-title">{{trans('dashboard.pending_bonus')}}</h6>
                <div class="header-elements">
                <div class="d-flex justify-content-between">

                    <div class="list-icons ml-3">
                        
                    </div>
                </div>
            </div>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2 overflow-auto">
                    <h3 class="weeklyMaintainMembersIncome text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{currency(round($pending_commission,2))}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>
                <div class="text-muted font-size-sm">
                   {{trans('dashboard.pending_bonus')}} 
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card metric">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <h6 class="card-title">{{trans('dashboard.non_maintain_member')}}</h6>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2 overflow-auto">
                    <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{round($nonMaintainMembers,2)}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>
               
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card metric">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <h6 class="card-title">{{trans('dashboard.maintain_members_count')}}</h6>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2">
                    <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{count($maintain_member)}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>

                

            </div>
        </div>
    </div>
<!-- </div> -->
<!--DOWNLINE_MEMBERS_COUNT WIDGET END