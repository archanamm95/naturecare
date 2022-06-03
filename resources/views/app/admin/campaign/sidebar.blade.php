
 
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-secondary-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                <span class="font-weight-semibold">{{trans('wallet.email_marketing') }}</span>
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>

            
    <div class="sidebar-content">
        <!-- Action buttons -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span>
                    {{trans('wallet.email_marketing') }}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                


                <div class="row row-tile no-gutters">
                   <div class="col-sm-6">
                        <a href="{{url('admin/campaign/lists')}}" class="btn bg-teal-300 btn-block btn-float btn-float-lg m-0" style="height: 80px;">
                            
                        
                            <i class="icon-git-branch text-default-800 icon-2x" style="    padding-top: 6px;
">
                            </i>
                            <span>
                                {{trans('campaign.campaign') }}
                            </span>
                        
                        </a>
                        <a href="{{url('admin/campaign/contacts')}}" class="btn bg-green-300 btn-block btn-float btn-float-lg m-0" style="height: 80px;" >
                            
                            <i class="icon-people text-default-800 icon-2x" style="padding-top: 10px;">
                            </i>
                            <span>
                                {{trans('wallet.contacts') }}
                            </span>
                        </a>
                    </div>
                     <div class="col-sm-6">
                        <a href="{{url('admin/campaign/autoresponders')}}" class="btn bg-purple-300 btn-block btn-float btn-float-lg m-0" style="height: 80px;    padding-top: 6px;
">
                            <i class="icon-mail-read text-default-800 icon-2x " >
                            </i>
                            <span>
                                {{trans('wallet.responders') }}
                            </span>
                        </a>
                        <a href="{{url('admin/campaign/contactlist')}}" class="btn bg-blue-300 btn-block btn-float btn-float-lg m-0" style="height: 80px;">
                            <i class="icon-stats-bars text-default-800 icon-2x" style="    padding-top: 10px;">
                            </i>
                            <span>
                                {{trans('report.report') }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /action buttons -->
        <!-- Sub navigation -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span>
                    {{trans('menu.navigation') }}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item-header">{{trans('campaign.campaign') }}</li>

                    <li class="nav-item">
                        <a href="{{url('admin/campaign/create')}}" class="nav-link"><i class="icon-googleplus5"></i>  {{trans('campaign.create_campaign') }}</a>
                    </li>
              
                    <li class="nav-item">
                        <a  class="nav-link" href="{{url('admin/campaign/lists')}}">
                            <i class="icon-portfolio">
                            </i>
                            {{trans('wallet.view_all_campaigns') }}
                        </a>
                    </li>
                    <li class="nav-item-header">
                       
                        {{trans('autoresponder.autoresponder') }}

                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{url('admin/campaign/autoresponders/create')}}">
                            <i class="icon-files-empty">
                            </i>
                            {{trans('wallet.create_autoresponder') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{url('admin/campaign/autoresponders')}}">
                            <i class="icon-file-plus">
                            </i>
                            {{trans('wallet.view_all_autoresponders') }}
                            <!-- <span class="badge badge-default">
                                28
                            </span> -->
                        </a>
                    </li>
                    <li class="nav-item-header">
                        {{trans('wallet.contacts') }}
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{url('admin/campaign/contacts')}}">
                            <i class="icon-files-empty">
                            </i>
                           {{trans('contacts.all_contact') }}
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a  class="nav-link" href="{{url('admin/campaign/contactlist')}}">
                            <i class="icon-files-empty">
                            </i>
                           {{trans('contacts.contact_list') }}
                        </a>
                    </li>
                    
                   <!--  <li class="navigation-divider">
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="#">
                            <i class="icon-cog3">
                            </i>
                            Settings
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <!-- /sub navigation -->
    </div>
</div>