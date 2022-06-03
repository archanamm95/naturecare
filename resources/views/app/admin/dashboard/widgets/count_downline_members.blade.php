<div class="card metric">

    <div class="card-header bg-white border-0 header-elements-inline pb-0">
        <h6 class="card-title">{{trans('dashboard.downline_members')}}</h6>

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
        <div class="d-flex flex-row align-items-center">
            <div class="col p-0">
                <h3 class="text-4xl font-weight-normal ml-1 count-text-color mt-1 mb-3"><span
                        class="hide hidden">{{$total_users}}</span> <span id="total_users_bar_count" class="count"> <i
                            class="icon-spinner2 fa-spin"></i></span> </h3>
            </div>
        </div>
    </div>

    <div class="rounded-lg mt-3 position-absolute fixed-top fixed-bottom ec-chart" id="users_join_bar"
        style="top: 60%;">
    </div>


</div>