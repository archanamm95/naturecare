@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

<!-- Basic datatable -->
<div class="col-sm-12">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Helpdesk | Ticket category - <b>{{$TicketCategory->name}}</b></h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
   
        <table class="table datatable-basic table-striped table-hover" id="department-ticket-table" data-department="All" data-category="{{$TicketCategory->name}}" data-priority="All" data-status="All" data-tags="All" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('ticket.name')}}
                    </th>           
                    <th>
                        {{trans('ticket.description')}}
                    </th>                                    
                    <th>
                        {{trans('ticket.actions')}}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

       
    </div>
</div>

</div>
@endsection @section('scripts') @endsection