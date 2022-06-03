         
        <div class="card fillheight">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">
                {{trans('products.orders')}} 
                </h6>
                <div class="header-elements">
                </div>
            </div>
            <div class="card-body py-0">
                
  <div class="row">
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                                 <i class=" icon-cart 2x" aria-hidden="true"></i>
                            </a>
                            <div>
                                <div class="font-weight-semibold">
                                    {{trans('products.weekly_orders')}}
                                </div>
                                <div class="text-muted">
                                    {{$weekly_sale_count}}
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-sm-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                             <i class="icon-cart" aria-hidden="true"></i>
                            </a>
                            <div>
                                <div class="font-weight-semibold">
                                   {{trans('products.monthly_orders')}}
                                </div>
                                <div class="text-muted">
                                  {{$monthly_sale_count}}
                                </div>
                            </div>
                        </div>
                    </div>



                     <div class="col-sm-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <a class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                                <i class="icon-cart" aria-hidden="true"></i>
                            </a>
                            <div>
                                <div class="font-weight-semibold">
                                    {{trans('products.yearly_orders')}}
                                </div>
                                <div class="text-muted">
                                  {{$yearly_sale_count}}
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
                <hr/>
                <div class="chart position-relative">
                    <div class="chart has-fixed-height" id="area_basic" style="height:350px">
                    </div>
                </div>

                  
            </div>
        </div>