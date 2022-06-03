@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.helpdesk.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main')
<div class="col-sm-12">
    <div class="card card-flat">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{trans('ticket.view_ticket')}} : <b>{{$ticket->ticket_number}}</b></h5>
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
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <i class="fa  fa-check-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position: relative;margin-right: 10px;">&times;</button>
            {!!Session::get('success')!!} 
        </div>
        @endif



 {!! Form::model($ticket,['url' => '/admin/helpdesk/ticket/'.$ticket->id , 'method' => 'PATCH','class'=>'form-vertical ticketform ','data-parsley-validate'=>'true','role'=>'form'] )!!}

       

 	
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
            <div class="col-sm-8">
            <div class="required form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
               {!! Form::label('subject', trans("ticket.subject"), array('class' => 'control-label')) !!} 
               {!! Form::text('ticketsubject', null !==(Input::old('ticketsubject')) ? Input::old('ticketsubject') : $ticket->subject, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!}            
           </div>          
            <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
               {!! Form::label('Description', trans("ticket.description"), array('class' => 'control-label')) !!} 
               {!! Form::text('description', null !==(Input::old('description')) ? Input::old('description') : $ticketdescription, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!}   
            </div>
            <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
               {!! Form::label('status', trans("ticket.status"), array('class' => 'col-form-label')) !!}
               {!! Form::text('status', null !==(Input::old('status')) ? Input::old('description') : $ticket_statuses, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
            </div> 
            <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
               {!! Form::label('priority', trans("ticket.priority"), array('class' => 'col-form-label')) !!}
               {!! Form::text('priority', null !==(Input::old('priority')) ? Input::old('priority') : $ticket_priorities, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
            </div>
            <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
               {!! Form::label('department', trans("ticket.department"), array('class' => 'col-form-label')) !!}
               {!! Form::text('department', null !==(Input::old('department')) ? Input::old('department') : $ticket_departments, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
            </div>
            
			</div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>

@endsection @section('scripts') @endsection