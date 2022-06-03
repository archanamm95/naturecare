@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

<!-- Basic datatable -->
<div class="col-sm-12">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Priorities</h5>
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
    <table class="table datatable-basic table-striped table-hover" id="ticket-priority-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('tickets.priority')}}
                    </th>           
                    <th>
                        {{trans('tickets.priority_desc')}}
                    </th>                                    
                    <th>
                        {{trans('tickets.priority_color')}}
                    </th>
                    <th>
                        {{trans('tickets.status')}}
                    </th>
                    <th>
                        {{trans('tickets.action')}}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

       

        </div>

    </div>
</div>
<div class="col-sm-12">
	<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Create priority</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">

 {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsPriorityController@store' , 'method' => 'post','class'=>'form-vertical departmentsform ','data-parsley-validate'=>'true','role'=>'form','onsubmit'=>'checkForm(this)') )!!}


            <!-- <table class="table table-hover" style="overflow:hidden;"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                        {!! Form::label('priority',trans('ticket.priority')) !!} <span class="text-red"> *</span>
                        <input type="text" class="form-control" name="priority" value="" >
                    </div>
                </div>
                <!-- Grace Period text form Required -->
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('priority_desc') ? 'has-error' : '' }}">
                        {!! Form::label('priority_desc',trans('ticket.priority_desc')) !!}<span class="text-red"> *</span>
                        <input type="text" name="priority_desc" class="form-control">
                    </div>
                </div> 
            </div>
            <!-- Priority Color -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('priority_color') ? 'has-error' : '' }}">
                        {!! Form::label('priority_color',trans('ticket.priority_color')) !!}<span class="text-red"> *</span>
                        <input class="form-control my-colorpicker1 colorpicker-element colorpicker-priority" id="colorpicker" type="text" name="priority_color">
                        

                    </div>
                </div>
                <!-- status form-check: required: Active|Dissable -->
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status',trans('ticket.status')) !!}&nbsp;<span class="text-red"> *</span>
                        <input class="form-check-input-styled" type="radio"  name="status" value="1" checked>&nbsp;{{trans('ticket.active')}}
                        <input class="form-check-input-styled" type="radio"  name="status" value="0" >&nbsp;{{trans('ticket.inactive')}}
                    </div>       
                </div>

                <!-- Show form-check: required: public|private -->
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('ispublic') ? 'has-error' : '' }}">
                        {!! Form::label('ispublic',trans('ticket.visibility')) !!}&nbsp;<span class="text-red"> *</span>
                        <input class="form-check-input-styled" type="radio"  name="ispublic" value="1" checked>&nbsp;public
                        <input class="form-check-input-styled" type="radio"  name="ispublic" value="0" >&nbsp;private
                    </div>       
                </div>
            </div>  
            <!-- Admin Note  : Textarea :  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('admin_note',trans('ticket.admin_notes')) !!}
                        {!! Form::textarea('admin_note',null,['class' => 'form-control','size' => '30x5']) !!}
                    </div>
                </div>
            </div>
        
            {!! Form::submit(trans('ticket.submit'),['id '=>'add_p', 'name'=>'add_p', 'class'=>'btn btn-primary'])!!}
       

    <!-- close form -->
    {!! Form::close() !!}
    </div>
</div>
</div>
@endsection @section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_p.disabled = true;
   
   return true;
 }

</script>
@stop