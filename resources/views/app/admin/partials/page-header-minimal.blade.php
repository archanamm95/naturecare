<div class="page-header  page-header-minimal page-header-light">
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
            <div class="d-flex justify-content-center page-header-elements-box d-lg-none d-none">
                 @if(Auth::user()->id==1)
                <a href="{{url('admin/control-panel')}}" class="btn btn-link btn-float text-default">
                
                    <i class="icon-gear text-primary"></i>
                <span>{{trans('all.control_panel')}}</span></a>
                    @endif
                <a href="{{url('admin/helpdesk/tickets-dashboard')}}" class="btn btn-link btn-float text-default">
                    <i class="icon-mailbox text-primary"></i> 
                <span> {{trans('all.support')}}</span></a>
			</div>
            <div class="time-frame text-xs d-flex">
                <div class="time-parts" id="icon">
                <svg class="feather d-inline-block text-muted mr-1" style="height: 18px;"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#clock"></use></svg>
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
</div> 


