@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


<div class="col-sm-12">
	<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Update ticket priority : {{$ticket_priority->title}}</h5><div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">

 {!! Form::model($ticket_priority,['url' => '/admin/helpdesk/tickets/priority/'.$ticket_priority->id , 'method' => 'PATCH','class'=>'form-vertical ticketpriorityform ','data-parsley-validate'=>'true','role'=>'form'] )!!}

{{ csrf_field() }}
    <input type="hidden" name="priority_id" value="{{$ticket_priority->id}}">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">{{trans('ticket.edit')}}</h2>
        </div>
        <div class="box-body">
           
            <!-- Name text form Required -->
            <div class="box-body table-responsive no-padding"style="overflow:hidden;">
            <!-- <table class="table table-hover" style="overflow:hidden;"> -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                            {!! Form::label('priority',trans('ticket.priority')) !!}<span class="text-red"> *</span>
                            <input type="text" class="form-control" name="priority" value="{{ ($ticket_priority->priority) }}" >
                        </div>
                    </div>
                    <!-- Grace Period text form Required -->
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('priority_desc') ? 'has-error' : '' }}">
                            {!! Form::label('priority_desc',trans('ticket.priority_desc')) !!} <span class="text-red"> *</span>
                            <input type="text" class="form-control" name="priority_desc" value="{{ ($ticket_priority->priority_desc) }}">
                        </div>
                    </div></div>
                <!-- Priority Color -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('priority_color') ? 'has-error' : '' }}">
                            {!! Form::label('priority_color',trans('ticket.priority_color')) !!}<span class="text-red"> *</span>
                            <input class="form-control my-colorpicker1 colorpicker-element colorpicker-priority" id="colorpicker" value="{{ ($ticket_priority->priority_color) }}" type="text" name="priority_color">
                           
                        </div>
                    </div> 
                    <!-- status form-check: required: Active|Dissable -->
                   <div class="col-md-3">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status',trans('ticket.status')) !!}&nbsp;<span class="text-red"> *</span><br>
                        <input class="form-check-input-styled" type="radio"  name="status" value="1" checked>&nbsp;{{trans('ticket.active')}}
                        <input class="form-check-input-styled" type="radio"  name="status" value="0" >&nbsp;{{trans('ticket.inactive')}}
                    </div>       
                </div>
                    <!-- Show form-check: required: public|private -->
                       <div class="col-md-3">
                    <div class="form-group {{ $errors->has('ispublic') ? 'has-error' : '' }}">
                        {!! Form::label('ispublic',trans('ticket.visibility')) !!}&nbsp;<span class="text-red"> *</span><br>
                        <input class="form-check-input-styled" type="radio"  name="ispublic" value="1" checked>&nbsp;public
                        <input class="form-check-input-styled" type="radio"  name="ispublic" value="0" >&nbsp;private
                    </div>       
                </div>
                </div>  
                <!-- Admin Note : Textarea : -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('admin_note',trans('ticket.admin_notes')) !!}
                            {!! Form::textarea('admin_note',null,['class' => 'form-control','size' => '30x5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <!-- <div class="form-group">
                <input type="form-check" name="default_priority" @if($ticket_priority->is_default == $ticket_priority->priority_id) checked disabled @endif> {{ trans('ticket.make-default-priority')}}
            </div> -->
            <div class="form-group">
            </div>
            {!! Form::submit(trans('ticket.update'),['class'=>'btn btn-primary'])!!}
        </div>
    </div>
    <!-- close form -->
    {!! Form::close() !!}

    </div>
</div>
</div>




@endsection @section('scripts') @endsection