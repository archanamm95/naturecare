<div class="row">
   
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
            <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title">{{trans('products.orders')}}</h6>               
            </div>

           
            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                     {{$oders_count}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>

            <div class="chart position-relative">
                <div class="chart" style="height:60px">

                     <div class="d-flex">
                        <div class="text-muted font-size-sm">
                             {{trans('products.orders')}}
                        </div>
                    </div>
                    <div class="text-right">
                                             
                <a href="{{url('admin/control-panel/ecommerce-manager')}}" class="btn btn-info"><i class="icon-cart5" aria-hidden="true"></i></a>
            </div>
                </div>
            </div>

             

               

            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
            <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title">{{trans('products.total_sale')}}</h6>               
            </div>

           
            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                     {{$total_sale}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>
                
            <div class="chart position-relative">
                <div class="chart" style="height:60px">

                     <div class="d-flex">
                        <div class="text-muted font-size-sm">
                            {{trans('products.total_sale')}}
                        </div>
                    </div>

                </div>
            </div>

             

               

            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>


  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
             <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title">{{trans('products.pending_orders')}}</h6>               
            </div>

            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                  {{$pending_orders}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>


            <div class="chart position-relative">
                <div class="chart" style="height:60px">

                     <div class="d-flex">
                        <div class="text-muted font-size-sm">
                             {{trans('products.pending_orders')}}
                        </div>
                    </div>

                </div>
            </div>
            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>


  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <!-- Area chart in colored card -->
        <div class="card ">
             <div class="card-header bg-white border-0 header-elements-inline pb-2">
                <h6 class="card-title">{{trans('products.total_products')}}</h6>               
            </div>

            <div class="card-body pt-0 pb-0">
                <div class="d-flex">
                <h3 class="no-margin font-weight-semibold mb-0">
                  {{$count_product}}
                </h3>
                <div class="list-icons ml-auto">
                    
                </div>
                </div>


            <div class="chart position-relative">
                <div class="chart" style="height:60px">

                     <div class="d-flex">
                        <div class="text-muted font-size-sm">
                           {{trans('products.total_products')}}
                        </div>
                    </div>

                </div>
            </div>
            </div>

        </div>
        <!-- /area chart in colored card -->
    </div>



  


   
</div>
