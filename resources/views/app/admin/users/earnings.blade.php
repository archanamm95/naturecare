
<!-- Quick stats boxes -->
<div class="row">
    <!-- <div class="col-xl-4">
        Members online
        <div class="card bgs-teal-400">
            <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                        {{trans('users.member_current_plan')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    ddd
                </h3>
                {{trans('users.member_current_plan')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        /members online
    </div> -->

   @if(Auth::user()->admin == 1 && Auth::user()->id == 1 || Auth::user()->admin != 1)
    <div class="col-xl-6">
        <!-- Today's revenue -->
        <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.total_income')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    {{(currency(round($balance,2)))}}
                </h3>
                {{trans('users.total_income')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>

    <div class="col-xl-6">
        <!-- Today's revenue -->
        <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.total_payout')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   {{currency(round($total_payout,2))}}
                </h3>
              {{trans('users.total_payout')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>
    @endif


    <!-- <div class="col-lg-6"> -->
        <!-- Today's revenue -->
<!--         <div class="card bgs-blue-400">
                       <div class="card-body">
                <div class="header-elements">
                    <span class="heading-text badge bgs-teal-800">
                       {{trans('users.vouchers')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    {{$voucher_count}}
                </h3>
                {{trans('users.vouchers')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div> -->
        <!-- /today's revenue -->
    <!-- </div> -->
</div>
<!-- /quick stats boxes -->


                