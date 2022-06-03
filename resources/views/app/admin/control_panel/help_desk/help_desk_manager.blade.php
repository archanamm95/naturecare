@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection



        {{-- Content --}}
        @section('main')
<!-- Basic datatable -->
<div class="row">
<div class="col-sm-8">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('settings.departments')}} </h5>
        <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        
    
    
        
    
    <table class="table datatable-basic table-striped table-hover" id="ticket-departments-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('ticket_departments.name')}}
                    </th>           
                    <th>
                        {{trans('ticket_departments.description')}}
                    </th>                                    
                    <th>
                        {{trans('ticket_departments.actions')}}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

       

        </div>

    </div>
</div>
<div class="col-sm-4">
    <div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('settings.create_department')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsDepartmentsController@store' , 'method' => 'post','class'=>'form-vertical departmentsform ','data-parsley-validate'=>'true','role'=>'form') )!!}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          {!! Form::label('name', trans("ticket.department_name"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.department_name")]) !!}                                           
                    </div>                    

                    <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          {!! Form::label('description', trans("ticket.department_description"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('description', Input::old('description'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.department_description")]) !!}                                           
                    </div>           

                                     
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-department"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_department')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>
</div>
<!-- Basic datatable -->
<div class="row">
<div class="col-sm-8">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('settings.categories')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        
    
    
        
    
    <table class="table datatable-basic table-striped table-hover" id="ticket-categories-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('ticket.category')}}
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
<div class="col-sm-4">
    <div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('settings.create_category')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form class="form-vertical categoryform" role="form" method="POST" action="{{ URL::to('admin/helpdesk/tickets/category') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label class="col-form-label">{{trans('ticket_details.category_name')}}</label>
                        <input type="text" class="form-control" name="category" required>                        
                    </div>                    
                    <div class="form-group">
                        <label class="col-form-label">{{trans('ticket_details.description')}}</label>
                        <input type="text" class="form-control" name="description" required>                 
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-category"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_category')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>
</div>

@stop

@section('styles')@parent

@endsection


