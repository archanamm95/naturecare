  <div class="card card-flat">
            <div class="card-header inline">
                <h6 class="card-title">{{trans('dashboard.package_purchase')}}</h6>
                <div class="heading-elements">
                </div>
            </div>
            <div class="container-fluid">
                <div class="row text-center">
                    @foreach($packages_data as $package)
                    <div class="col-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> &nbsp;&nbsp;{{$package->purchase_history_r_count}}
                            <!-- @if($package->special == 'yes')
                            <span class="label label-flat border-green-400 label-icon text-green-400" style="display: inline-block;"><i class="icon-stars"></i> {{trans('dashboard.special')}}</span>
                            @endif -->
                            </h5>
                            <span class="text-muted text-size-small">{{$package->package}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
           <div class="content-group-sm chart" id="package_sales_graph" style="height:360px"></div>
        </div>