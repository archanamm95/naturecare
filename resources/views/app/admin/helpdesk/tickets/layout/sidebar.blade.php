<!-- Secondary sidebar -->
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-secondary-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">{{trans('ticket.tickets')}}</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>


    <div class="sidebar-content">
        <!-- Sub navigation -->
        <div class="card">

            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">{{trans('ticket.navigation')}}</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>


            <div class="card-body no-padding">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item-header">
                       {{trans('ticket.ticket_dashboard')}}
                    </li>
                    <li class="nav-item {{set_active('admin/helpdesk/tickets-dashboard')}}">
                        <a class="nav-link" href="{{url('admin/helpdesk/tickets-dashboard')}}">
                            <i class="icon-ticket">
                            </i>
                         {{trans('ticket.tickets_dashboard')}}
                        </a>
                    </li>
                    <li class="nav-item-header">
                        {{trans('ticket.tickets')}}
                    </li>
                    <li class="nav-item {{set_active('admin/helpdesk/ticket')}}">
                        <a class="nav-link" href="{{url('admin/helpdesk/ticket')}}">
                            <i class="icon-ticket">
                            </i>
                          {{trans('ticket.all_tickets')}}
                        </a>
                    </li>
                    <li class="nav-item {{set_active('admin/helpdesk/tickets/overdue')}}">
                        <a class="nav-link" href="{{url('admin/helpdesk/tickets/overdue/?overdue=on')}}">
                            <i class="fa fa-calendar-times-o text-danger">
                            </i>
                          {{trans('ticket.overdue')}}
                        </a>
                    </li>
                    <li class="nav-item {{set_active('admin/helpdesk/tickets/open')}}">
                        <a class="nav-link" href="{{url('admin/helpdesk/tickets/open/?status=Open')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                         {{trans('ticket.open')}}
                        </a>
                    </li>  
                         
                                        
                    <li class="nav-item {{set_active('admin/helpdesk/tickets/resolved')}}">
                        <a class="nav-link" href="{{url('admin/helpdesk/tickets/resolved/?status=Resolved')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                          {{trans('ticket.resolved')}}
                        </a>
                    </li>                     
                  
                    <li class="nav-item {{set_active('admin/helpdesk/tickets/closed')}}">
                        <a class="nav-link" href="{{url('admin/helpdesk/tickets/closed/?status=Closed')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                         {{trans('ticket.closed')}}
                        </a>
                    </li>    


                    <li class="nav-item-header">
                       {{trans('ticket.management')}}
                    </li>

                       <!--  <li class="nav-item {{set_active('admin/helpdesk/tickets/add')}}">
                            <a class="nav-link" href="{{url('admin/helpdesk/tickets/add?create=true')}}">
                                <i class="icon-folder-open3 text-success">
                                </i>
                               {{trans('ticket.create_ticket')}}
                            </a>
                        </li>     -->                 
                  


                        <!--     <li class="nav-item {{set_active('admin/helpdesk/tickets/department')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/tickets/department')}}">
                                <i class="icon-tree6"></i>
                                Departments
                                </a>
                            </li>    -->                         
                           
                         <!--    <li class="nav-item {{set_active('admin/helpdesk/tickets/category')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/tickets/category')}}">
                                <i class="icon-tree6"></i>
                                Categories
                                </a>
                            </li>   -->                          
                           

                            <li class="nav-item {{set_active('admin/helpdesk/tickets/canned-response*')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/tickets/canned-response')}}">
                                <i class="icon-paste"></i>
                                   {{trans('ticket.canned_response')}}
                                </a>
                            </li>                            
                           

                    


                            <li class="nav-item {{set_active('admin/helpdesk/tickets/priority*')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/tickets/priority')}}">
                                <i class="icon-move-up2"></i>
                                   {{trans('ticket.priority')}}
                                </a>
                            </li>   
                                              


                           

                             <li class="nav-item {{set_active('admin/helpdesk/tickets/ticket-type*')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/tickets/ticket-type')}}">
                                <i class="icon-move-up2"></i>
                                  {{trans('ticket.ticket_types')}}
                                </a>
                            </li> 
                           
                        <li class="nav-item nav-item-submenu {{set_active('admin/helpdesk/tickets')}}">
                        <a class="nav-link" href="#">
                            <i class="icon-book3">
                            </i>
                          {{trans('ticket.knowledge_base')}}
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Page layouts" style="display: none;">
                                

                            <li class="nav-item {{set_active('admin/helpdesk/kb/category*')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/kb/category')}}" style="color: black !important">
                                <i class="icon-list"></i>
                                   {{trans('ticket.article_categories')}}
                                </a>
                            </li>    

                            <li class="nav-item {{set_active('admin/helpdesk/kb/article*')}}">
                                <a class="nav-link" href="{{url('admin/helpdesk/kb/article')}}" style="color: black !important">
                                <i class="icon-magazine"></i>
                                   {{trans('ticket.articles')}}
                                </a>
                            </li>                               
                                              
                            
                        </ul>
                    </li>  



                </ul>
            </div>
        </div>
        <!-- /sub navigation -->
    </div>
</div>
<!-- /secondary sidebar -->