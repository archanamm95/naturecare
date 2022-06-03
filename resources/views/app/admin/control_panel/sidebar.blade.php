<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">
    <div class="sidebar-content">
        <div class="card">
            <div class="card-header bg-light border-top-0 border-ddd header-elements-inline">
                <span class="font-weight-bold">
                     {{trans('controlpanel.disk_space')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <div class="progress" style="height: 2rem;">
                    <div class="progress-bar {{ $disk_used_percentage_bg_class }}" style="width: {{ $disk_used_percentage }}%">
                        <span>
                            {{ round($disk_used_percentage,2) }}%  {{trans('controlpanel.in_use')}}
                        </span>
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.free_disk')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ convertToReadableSize($hardware_informations['disk']['free']) }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.total_disk')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ convertToReadableSize($hardware_informations['disk']['total']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-light border-top-1 border-ddd header-elements-inline">
                <span class="font-weight-bold">
                     {{trans('controlpanel.memory')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <div class="progress" style="height: 2rem;">
                    <div class="progress-bar {{ $ram_used_percentage_bg_class }}" style="width: {{ $ram_used_percentage }}%">
                        <span>
                            {{ round($ram_used_percentage,2) }}%  {{trans('controlpanel.in_use')}}
                        </span>
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.free_memory')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ convertToReadableSize($hardware_informations['ram']['free']) }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.total_memory')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ convertToReadableSize($hardware_informations['ram']['total']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-light border-top-1 border-ddd header-elements-inline">
                <span class="font-weight-bold">
                     {{trans('controlpanel.up_time')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <div class="media">
                    <div class="mr-3">
                       <!--  <a href="#"> -->
                            <i class="icon-switch2 text-success-400 icon-2x mt-1">
                            </i>
                        <!-- </a> -->
                    </div>
                    <div class="media-body">
                        <h6 class="media-title font-weight-semibold">
                            <a class="text-default" href="#">
                                 {{trans('controlpanel.system_is_up_for')}} :
                            </a>
                        </h6>
                        {{ $uptime_informations['uptime'] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-collapsed">
            <div class="card-header bg-light header-elements-inline">
                <span class="font-weight-bold">
                     {{trans('controlpanel.server_information')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body server-information">
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.o')}} {{trans('controlpanel.s')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $software_informations['os'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.distro')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $software_informations['distro'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.kernel')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $software_informations['kernel'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.kernel')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $software_informations['arc'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.webserver')}}:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $software_informations['webserver'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2">
                    <div class="font-weight-semibold">
                        php:
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ substr($software_informations['php'], 0, 5) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-collapsed">
            <div class="card-header bg-light border-top-1 border-ddd header-elements-inline">
                <span class="font-weight-bold">
                     {{trans('controlpanel.hardware_information')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                        cpu :
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $hardware_informations['cpu'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                        cpu {{trans('controlpanel.count')}} :
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $hardware_informations['cpu_count'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.model')}} :
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $hardware_informations['model'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.virtualization')}} :
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $hardware_informations['virtualization'] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-collapsed">
            <div class="card-header bg-light border-top-1 border-ddd header-elements-inline">
                <span class="font-weight-bold">
                     {{trans('controlpanel.database_details')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.driver')}} :
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $database_informations['driver'] }}
                    </div>
                </div>
                <div class="d-sm-flex flex-sm-wrap pb-2 pt-2 border-bottom-1 border-ddd">
                    <div class="font-weight-semibold">
                         {{trans('controlpanel.version')}} :
                    </div>
                    <div class="ml-sm-auto mt-2 mt-sm-0">
                        {{ $database_informations['version'] }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /sub navigation -->
    </div>
</div>