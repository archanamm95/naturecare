@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


<div class="col-sm-12">
	<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('wallet.create_canned_response')}}</h5>
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

 {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsCannedResponseController@store' , 'method' => 'post','class'=>'form-vertical cannedresponseform ','data-parsley-validate'=>'true','role'=>'form') )!!}

    	
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="required form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                          {!! Form::label('title', trans("ticket.canned_response_title"), array('class' => 'col-form-label')) !!} 

                          {!! Form::text('title', Input::old('title'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.canned_response_title")]) !!}

                                            
                    </div>                    
                   <div class="required form-group{{ $errors->has('subject') ? ' has-error' : '' }}">

                          {!! Form::label('subject', trans("ticket.canned_response_subject"), array('class' => 'col-form-label')) !!} 

                          {!! Form::text('subject', Input::old('subject'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.canned_response_subject")]) !!}
                    
                    </div>                    
                    <div class="required form-group{{ $errors->has('message') ? ' has-error' : '' }}">

                         {!! Form::label('message', trans("ticket.canned_response_message"), array('class' => 'col-form-label')) !!} 

                          {!! Form::textarea('message', Input::old('message'), ['class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("all.canned_response_message")]) !!}
                   
                    </div>                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-canned-response"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_canned_response')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>

<!-- Basic datatable -->
<div class="col-sm-12">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('wallet.canned_responses')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        
    
    
        
    <div class="table-responsive">
    <table class="table datatable-basic table-striped table-hover" id="ticket-canned-response-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('ticket_canned_response.title')}}
                    </th>           
                    <th>
                        {{trans('ticket_canned_response.subject')}}
                    </th>                         
                                                                  
                    <th>
                        {{trans('ticket_canned_response.actions')}}
                    </th>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
       

        </div>

    </div>
</div>


@endsection @section('scripts') @endsection