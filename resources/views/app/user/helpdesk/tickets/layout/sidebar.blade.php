<!-- Secondary sidebar -->
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">
    <div class="sidebar-content">
        <!-- Sub navigation -->
        <div class="sidebar-category">
              <div class="card">
 
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">{{trans('menu.navigation')}}</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <div class="card-body no-padding">
                 <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item-header">
                       {{trans('menu.tickets_dashboard')}}
                    </li>
                    <li class="nav-item {{set_active('user/helpdesk/tickets-dashboard')}}">
                        <a class="nav-link" href="{{url('user/helpdesk/tickets-dashboard')}}">
                            <i class="icon-ticket">
                            </i>
                           {{trans('menu.tickets_dashboard')}}
                        </a>
                    </li>
                    <li class="nav-item-header">
                        {{trans('menu.tickets')}}
                    </li>
                    <li class="nav-item {{set_active('user/helpdesk/ticket')}}">
                        <a class="nav-link" href="{{url('user/helpdesk/ticket')}}">
                            <i class="icon-ticket">
                            </i>
                          {{trans('menu.all_tickets')}} 
                        </a>
                    </li>
                      <li class="nav-item {{set_active('user/helpdesk/tickets/add')}}">
                            <a class="nav-link" href="{{url('user/helpdesk/tickets/add?create=true')}}">
                                <i class="icon-folder-open3 text-success">
                                </i>
                               {{trans('menu.create_a_ticket')}}
                            </a>
                        </li>                     
                  
                    <li class="nav-item {{set_active('user/helpdesk/tickets/overdue')}}">
                        <a class="nav-link" href="{{url('user/helpdesk/tickets/overdue/?overdue=on')}}">
                            <i class="fa fa-calendar-times-o text-danger">
                            </i>
                          {{trans('menu.overdue')}} 
                        </a>
                    </li>
                    <li class="nav-item {{set_active('user/helpdesk/tickets/open')}}">
                        <a class="nav-link" href="{{url('user/helpdesk/tickets/open/?status=Open')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                          {{trans('menu.open')}} 
                        </a>
                    </li>  
                         
                                        
                    <li class=" nav-item {{set_active('user/helpdesk/tickets/resolved')}}">
                        <a class="nav-link" href="{{url('user/helpdesk/tickets/resolved/?status=Resolved')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                          {{trans('menu.resolved')}} 
                        </a>
                    </li>                     
                  
                    <li class=" nav-item {{set_active('user/helpdesk/tickets/closed')}}">
                        <a class="nav-link" href="{{url('user/helpdesk/tickets/closed/?status=Closed')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                          {{trans('menu.closed')}} 
                        </a>
                    </li>    


                    <li class="nav-item-header">
                        {{trans('menu.knowledge_base')}}
                    </li>       


                           
 
                           
                        <li class="nav-item nav-item-submenu {{set_active('user/helpdesk/tickets')}}">
                        <a class="nav-link" href="#">
                            <i class="icon-book3">
                            </i>
                          {{trans('menu.knowledge_base')}}
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Page layouts" style="display: none;">

                           

                            <li class="nav-item {{set_active('user/helpdesk/kb/article*')}}">
                                <a class="nav-link" href="{{url('user/helpdesk/kb/article')}}" style="display: none;">
                                <i class="icon-magazine"></i>
                                 {{trans('menu.articles')}}   
                                </a>
                            </li>                               
                                              
                            
                        </ul>
                    </li>  



                </ul>
            </div>
        </div>
    </div>
        <!-- /sub navigation -->
    </div>
</div>
<!-- /secondary sidebar -->