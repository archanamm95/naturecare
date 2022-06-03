
<!-- Quick stats boxes -->
<div class="row">
    <div class="col-lg-6">
        <!-- Members online -->
        <div class="card bgs-teal-400">
            <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                        {{trans('users.current_pool_balance')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    {{number_format($pool_balance,2)}}RM
                </h3>
                {{trans('users.current_pool_balance')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /members online -->
    </div>

   
    <div class="col-lg-6">
        <!-- Today's revenue -->
        <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.current_pool_percentage')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    {{$pool_percentage}}<b>%</b>
                </h3>
                {{trans('users.current_pool_percentage')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>

    <div class="col-lg-4">
        <!-- Today's revenue -->
        <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.total_share_count')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   {{$total_share}}
                </h3>
              {{trans('users.total_share_count')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div> 
     <div class="col-lg-4">
        <!-- Today's revenue -->
        <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.total_user_count')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   {{$total_users}}
                </h3>
              {{trans('users.total_user_count')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div> 
    <div class="col-lg-4">
        <!-- Today's revenue -->
        <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.one_share_amount')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   {{number_format($one_share,2)}}RM
                </h3>
              {{trans('users.one_share_amount')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>


   
</div>