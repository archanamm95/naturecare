<!-- <div class="row">  -->
<div class="col-lg-3 col-md-6 col-sm-6 col-6">
    <div class="card metric">
        <div class="card-header bg-white border-0 header-elements-inline pb-0">
            <h6 class="card-title">Total BV</h6>
        </div>
        <div class="card-body pt-0 pb-0">
            <div class="d-flex mt-2 overflow-auto">
                <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{$userstotal_bv}} </h3>
                <div class="list-icons ml-auto">
                    <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                        <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-cart"></use>
                    </svg> 
                </div>
            </div>
            <div class="text-muted font-size-sm">
                Total BV
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-6">
    <div class="card company_pool">
        <div class="card-header bg-white border-0 header-elements-inline pb-0">
            <h6 class="card-title">{{trans('dashboard.company_pool')}}</h6>
            <div class="header-elements">
                <div class="d-flex justify-content-between">

                    <div class="list-icons ml-3">
                        <div class="dropdown">
                            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                    class="icon-cog3 "></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">Show data from : </div>
                                <button data-range="today"
                                    class="dropdown-item btn range">{{trans('dashboard.today')}}</button>
                                <button data-range="week"
                                    class="dropdown-item btn range">{{trans('dashboard.this_week')}}</button>
                                <button data-range="month"
                                    class="dropdown-item btn range">{{trans('dashboard.this_month')}}</button>
                                <button data-range="year"
                                    class="dropdown-item btn range">{{trans('dashboard.this_year')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 pb-0">
            <div class="d-flex mt-2 overflow-auto">
                <h3 class="text-4xla no-margin text-muted font-weight-semibold mt-1 mb-0"><span class="company_pool fz-xs-15 fz-xs-20">{{$company_pool}}</span> </h3>
                <!-- <div class="list-icons ml-auto">
                    <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                        <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                    </svg> 
                </div> -->
            </div>
            <br>
            <div class="text-muted font-size-sm">
                {{trans('dashboard.company_pool')}}
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-6">
    <div class="card leadership_pool">
        <div class="card-header bg-white border-0 header-elements-inline pb-0">
            <h6 class="card-title">{{trans('report.leadership_pool')}}</h6>
            <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button>
                            <button data-range="week"
                                class="dropdown-item btn range">{{trans('dashboard.this_week')}}</button>
                            <button data-range="month"
                                class="dropdown-item btn range">{{trans('dashboard.this_month')}}</button>
                            <button data-range="year"
                                class="dropdown-item btn range">{{trans('dashboard.this_year')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body pt-0 pb-0">
            <div class="d-flex mt-2 overflow-auto">
                <h3 class="text-4xla no-margin text-muted font-weight-semibold mt-1 mb-0"><span class="leadership_pool fz-xs-15 fz-xs-20">{{$leadership_pool}}</span> </h3>
                <!-- <div class="list-icons ml-auto">
                    <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                        <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                    </svg> 
                </div> -->
            </div>
            <br>
            <div class="text-muted font-size-sm">
                {{trans('report.current_leadership_pool')}}
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-6">
    <div class="card international_pool">
        <div class="card-header bg-white border-0 header-elements-inline pb-0 overflow-auto">
            <h6 class="card-title">{{trans('report.international_pool')}}</h6>
            <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button>
                            <button data-range="week"
                                class="dropdown-item btn range">{{trans('dashboard.this_week')}}</button>
                            <button data-range="month"
                                class="dropdown-item btn range">{{trans('dashboard.this_month')}}</button>
                            <button data-range="year"
                                class="dropdown-item btn range">{{trans('dashboard.this_year')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body pt-0 pb-0">
            <div class="d-flex mt-2 overflow-auto">
                <h3 class="text-4xla no-margin text-muted font-weight-semibold mt-1 mb-0"><span class="international_pool fz-xs-15 fz-xs-20">{{$international_pool}}</span> </h3>
                <!-- <div class="list-icons ml-auto">
                    <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                        <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                    </svg> 
                </div> -->
            </div>
            <br>
            <div class="text-muted font-size-sm">
                {{trans('report.international_pool')}}
            </div>
        </div>
    </div>
</div>
<!-- </div> -->


