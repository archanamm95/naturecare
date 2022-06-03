@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.helpdesk.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main')

<div class="row">
    <div class="col-md-12">
    <div class="card card-flat border-top-success">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Ticket ID : <b>{{$ticket->ticket_number}}</b></h5>
           <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
              
                    <div class="row">
                        <div class="col-md-6 table-responsive">
                            <table class="table table-hover">
                                <div id="refresh">
                                    <tr>
                                        <td><b>Status:</b></td>
                                        <td title="{{$ticket->statusR->properties}}">{{$ticket->statusR->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Priority:</b></td>
                                        <td title="{{$ticket->priorityR->priority_desc}}">{{$ticket->priorityR->priority}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Department:</b></td>
                                        <td title="{{$ticket->departmentR->description}}">{{$ticket->departmentR->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td>{{$ticket->userR->email}}</td>
                                    </tr>
                                </div>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <td><b>Category:</b></td>
                                    <td title="{{$ticket->categoryR->description}}">{{$ticket->categoryR->category}}</td>
                                </tr>
                                <tr>
                                    <td><b>Username:</b></td>
                                    <td title="{{$ticket->UserR->username}}">{{$ticket->UserR->username}}</td>
                                </tr>
                                <div id="refresh3">
                                    <tr>
                                        <td><b>Last message:</b></td>
                                        <td>{{$ticket->last_message_at->diffForHumans() }}</td>
                                    </tr>
                                </div>
                                <tr>
                                    <td><b>Subject:</b></td>
                                    <td title="{{$ticket->categoryR->description}}">{{$ticket->subject}}</td>
                                </tr>
                            </table>
                        </div>
 
               
           

                    </div>
                </div>
            </div>
            <hr/>
            
           
           
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-sm-12">

     <div class="card card-flat border-left-xlg border-left-info">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title"><span class="text-semibold">Reply </span></h6>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsController@ticketReplyPost' , 'method' => 'post','class'=>'form-vertical ticketform ','data-parsley-validate'=>'true','role'=>'form' ,'onsubmit'=>'checkForm(this)') )!!}
                    
                     <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

               
                <div class="mt-10 mb-10">                       
                         Variables you can use :  <span class="text-bold"> {name} </span> | <span class="text-bold"> {username}</span> | <span class="text-bold"> {email} </span>| <span class="text-bold"> {ticket_id} </span>
                    </div>

            <div class="required form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', trans("ticket.title"), array('class' => 'col-form-label')) !!} {!! Form::text('title', Input::old('title'), ['id'=>'ticket_title', 'class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.title")]) !!}
            </div>  

                <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('body', trans("ticket.reply"), array('class' => 'col-form-label')) !!} {!! Form::textarea('body', Input::old('body'), ['id'=>'ticket_body','class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("ticket.body")]) !!}
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary submit-ticket-reply" id="add_reply" name="add_reply"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.submit_reply')}}</button>
            </div>


                {!!Form::close()!!}
                        </div>
                    </div>


                
</div>
</div>
<div class="row">
<div class="col-sm-12">
           <div class="timeline timeline-left">
                                <div class="timeline-container">

                                    @foreach($ticket_replies as $reply)
                                        <div class="timeline-row">
                                        <div class="timeline-icon">
                                             <i class=" icon-radio-checked" style="font-size: 40px;color: #4baf4a;"></i>
                                        </div>
                                        <div class="card card-flat timeline-content">
                                            <div class="card-header header-elements-inline">
                                                <h6 class="card-title"> {{$reply->title}} : <small>{{$reply->userR->name}} ({{$reply->userR->username}})</small></h6>
                                                <div class="header-elements">
                                                    <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated {{$reply->created_at}}</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                {!! $reply->body !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    
                                    
                                  
                                </div>
                            </div>
</div>
</div>

<!-- page modals -->
<div>
    <!-- Change Owner Modal -->
    <div class="modal fade" id="ChangeOwner">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsController@changeOwner' , 'method' => 'PATCH','class'=>'form-vertical ticketform','id'=>'changeownerform','data-parsley-validate'=>'true','role'=>'form') )!!}
                <div class="modal-header">
                    <button type="button" class="close" id="close101" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change owner for ticket <b> {{$ticket->ticket_number}}</b></h4>
                </div>
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="ahah1">
                            <div class="modal-body">

                                <h3>Select new owner</h3>
                                <input type="hidden" name="ticketid" value="{{$ticket->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="key-word" name="key-word" placeholder="Search Member">
                                        <input type="hidden" id="key_user_hidden" name="key_user_hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal" id="dismis42">Close</button>
                            <!--<input type='form-check' name='send-mail' class='iform-check_flat-blue' value='".$ticket->id."'><span disabled class="btn btn-sm">Check to notify user</span></input>-->
                            <button type="submit" class="btn btn-primary float-right" id="submt2">Update</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
                <!--tab-content-->
            </div>
            <!--nav-tabs-custom-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection @section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_reply.disabled = true;
   
   return true;
 }

</script>
@stop