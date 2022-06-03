@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

<!-- Basic datatable -->
<div class="row">
<div class="col-sm-8">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Departments</h5>
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
        <h5 class="card-title">Create department</h5>
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
@endsection @section('scripts') @endsection