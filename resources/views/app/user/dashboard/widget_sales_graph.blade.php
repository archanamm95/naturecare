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