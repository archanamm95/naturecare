         
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
    <div class="col-sm-4">
        <div class="d-flex align-items-center justify-content-center mb-2">
            <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                <i class="icon-people">
                </i>
            </a>
                <div>
                    <div class="font-weight-semibold">
                       {{trans('dashboard.weekly_joining')}}
                    </div>
                    <div class="text-muted">
                        {{$weekly_users_count}}
                    </div>
                </div>
        </div>
    </div>
        <div class="col-sm-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                                <i class="icon-people">
                                    </i>
                            </a>
                            <div>
                                <div class="font-weight-semibold">
                                   {{trans('dashboard.monthly_joining')}}
                                </div>
                                <div class="text-muted">
                                   {{$monthly_users_count}}
                                </div>
                            </div>
                        </div>
                    </div>



                     <div class="col-sm-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                                <i class="icon-people">
                                    </i>
                            </a>
                            <div>
                                <div class="font-weight-semibold">
                                    {{trans('dashboard.yearly_joining')}}
                                </div>
                                <div class="text-muted">
                                  {{$yearly_users_count}}
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
                <hr/>
                <div class="chart position-relative">
                    <div class="chart has-fixed-height" id="users_join" style="height:350px">
                    </div>
                </div>

                  
            </div>
        </div>