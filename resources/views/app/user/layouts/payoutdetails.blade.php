
<!-- Quick stats boxes -->
<div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
            <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title">{{trans('payout.balance_amount')}}</h6>               
            </div>

           
            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                     {{currency(round($user_balance,2))}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>

             

              

            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>

     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
            <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title"> {{trans('payout.total_payout_done')}}</h6>               
            </div>

           
            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                     {{currency(round($total_payout,2))}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>

             

              

            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
            <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title">  {{trans('payout.total_pending_request')}}</h6>               
            </div>

           
            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                         {{currency(round($total_pending,2))}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>

             

              

            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>
   
 
 

   


  
</div>
<!-- /quick stats boxes -->


                