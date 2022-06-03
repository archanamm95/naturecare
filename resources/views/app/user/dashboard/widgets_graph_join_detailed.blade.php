 

<div class="col-md-6">
         <div class="card card-flat">
             <div class="card-header header-elements-inline">
                 <h6 class="card-title">
                   Users joined over the time
                 </h6>
                 <div class="header-elements">
                 </div>
             </div>
             <div class="card-body py-0">

                <!--  <div class="row">
                     <div class="col-6">
                         <div class="d-flex align-items-center justify-content-center mb-2">
                             <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3 po"
                                 href="#" >
                                 <i class="icon-people">
                                 </i>
                             </a>
                             <div>

                                 <div class="font-weight-semibold fz-xs-12">Total members
                                 </div>
                                 <div class="text-muted">{{$total_users}}
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
                                    Total sales
                                 </div>
                                 <div class="text-muted">
                                   {{currency($total_sale)}}
                                 </div>
                             </div>
                         </div>
                     </div>



                 </div> -->
                 <hr/>
                 <div class="chart position-relative">
                     <div class="chart has-fixed-height" id="users_join_over_time" style="height:350px">
                     </div>
                 </div>


             </div>
         </div>

     </div>

      <div class="col-md-6">
 <div class="card fillheight">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">
            Sales Graph                </h6>
                <div class="header-elements">
                </div>
            </div>


<!--             <div class="card-body py-0">
                <div class="row text-center">
                    @foreach($packages_data as $package)
                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin">
                                <i class="icon-cash3 position-left text-slate">
                                </i>
                                {{$package->purchase_history_r_count}}
                                
                                @if($package->special == 'yes')
                                <span class="label label-flat border-green-400 label-icon text-green-400" style="display: inline-block;">
                                    <i class="icon-stars">
                                    </i>
                                   {{trans('dashboard.special')}}
                                </span>
                                @endif
                            </h5>
                            <span class="text-muted text-size-small">
                                {{$package->package}}  {{trans('dashboard.purchases')}}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> -->
            <div class="content-group-sm" id="users_sales_graph" style="height:350px">
            </div>
    
        </div>
    </div>