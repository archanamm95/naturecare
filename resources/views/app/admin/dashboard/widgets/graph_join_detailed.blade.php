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