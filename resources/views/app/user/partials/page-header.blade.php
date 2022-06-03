<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <i class="icon-arrow-left52 mr-2">
                </i>
                <span class="font-weight-semibold">
                    {{$title}}
                </span>
                - {{$sub_title}}
            </h4>
            <a class="header-elements-toggle text-default d-md-none" href="#">
                <i class="icon-more">
                </i>
            </a>
        </div>
        <div class="header-elements d-none">
            <!-- <div class="d-flex justify-content-center">
				<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
				<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
				<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
			</div> -->
            <div class="time-frame">
                <div class="time-parts" id="icon">
                    <i class="icon-watch">
                    </i>
                </div>
                <div class="time-parts" id="year-part">
                </div>
                <div class="time-parts" id="month-part">
                </div>
                <div class="time-parts" id="date-part">
                </div>
                <div class="time-parts" id="day-part">
                </div>
                <div class="time-parts" id="time-part">
                </div>
                <div class="time-parts" id="ampm-part">
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb justify-content-center">
                <a class="breadcrumb-item" href="{{url('admin/dashboard')}}">
                    <i class="icon-home2 mr-2">
                    </i>
                    Home
                </a>
                <span class="breadcrumb-item active">
                    {{$method}}
                </span>
            </div>
            <a class="header-elements-toggle text-default d-md-none" href="#">
                <i class="icon-more">
                </i>
            </a>
        </div>
        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a class="breadcrumb-elements-item" href="{{url('admin/helpdesk/tickets-dashboard')}}">
                    <i class="icon-comment-discussion position-left">
                    </i>
                    Support
                </a>
                <div class="breadcrumb-elements-item dropdown p-0">
                    <a class="breadcrumb-elements-item" href="{{url('admin/control-panel')}}">
                        <i class="icon-gear mr-2">
                        </i>
                        Control Panel
                    </a>

                   <!--  <a class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-gear mr-2">
                        </i>
                        Settings
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="position: absolute; transform: translate3d(-84px, 40px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-end">
                        
                         <a class="dropdown-item" href="{{url('admin/control-panel')}}">
                            <i class="icon-gear">
                            </i>
                            Control Panel
                        </a>

                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>