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