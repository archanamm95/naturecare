@extends('app.user.layouts.default') @section('page_class', 'sidebar-xs')  {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.user.helpdesk.tickets.layout.sidebar')

<style type="text/css">
.invoice>div:not(.invoice-footer) {
    margin-bottom: 43px;
}
.invoice-price .invoice-price-right {
    padding: 3px;
}
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet"href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endsection
{{-- Content --}}
@section('main')
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('menu.ticket')}} ID : <b>{{$ticket->ticket_number}}</b></h5>
             
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px;">
                    <li>
                        <a class="btn btn-xs btn-default" id="edit_Ticket" href="{{url('/user/helpdesk/ticket/')}}/{{$ticket->id}}/edit"><i class="fa fa-edit" style="color:green;"> </i> {{trans('menu.edit')}} </a>
                    </li>
                    
                  
                    <li>
                  <a class="nav-link btn-delete-tickets" data-id="{{$ticket->id}}" href="javascript:void(0)"><i class="fa fa-trash-o" style="color:red;" > </i>{{trans('menu.delete')}}</a>
              </li>
                </ul>
            </div>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
    </div>

<div class="card card-flat ">
    <div class="table-responsive">
    <table class="table table-invoice" id = "">
        <thead  class="alert bg-indigo-800"style="height:90px;width:1200px; ">
            <th> <b>SLA {{trans('menu.plam')}} : NIL </b></th>
            <th> <b>{{trans('menu.created_date')}} : </b> {{$ticket->created_at}}</th>
            <th> <b>{{trans('menu.due_date')}} : </b> {{$ticket->created_at}}</th> 
            <th></th>
        </thead>    
        <tbody>
            <tr>
                <td><b>{{trans('menu.status')}} :</b></td>
                <td>  {!!$ticket_status_markup!!}</td>
                 <td></td>  <td></td>    
               
            </tr>
            <tr> 
                <td><b>{{trans('menu.department')}} :</b></td>
                <td>{{$ticket->departmentR->name}}</td>
         
                <td><b>{{trans('menu.email')}} :</b></td>
                <td>{{$ticket->userR->email}}</td> 
            </tr>
            <tr>
                <td><b>{{trans('menu.category')}} :</b></td>
                <td>{{$ticket->categoryR->category}}</td> 
              
                <td><b>{{trans('menu.username')}} :</b></td>
                <td>{{$ticket->UserR->username}}</td> 
            </tr>
            <tr> 
                <td><b>{{trans('menu.last_message')}} :</b></td>
                <td>{{$ticket->last_message_at->diffForHumans() }}</td>
                 <td><b>{{trans('menu.priority')}} :</b></td>
                <td>{{$ticket->priorityR->priority}}</td>    
            </tr>
        </tbody>
    </table>
    </div>
<hr>
     <div class="row">
                <div class="col-sm-12">
                    <div class="card card-flat border-left-xlg border-left-info">
                       <div class="card-header header-elements-inline">
                            <h4 class="card-title"><span class="text-semibold">{{$ticket->subject}}</span></h4>
                        </div>
                        <div class="card-body">
                            {!!$ticket->description!!}
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>  

    <div class="row">
<div class="col-sm-12">

     <div class="card card-flat border-left-xlg border-left-info">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title"><span class="text-semibold">{{trans('menu.reply')}}  </span></h6>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('action' => 'user\Helpdesk\Ticket\TicketsController@ticketReplyPost' , 'method' => 'post','class'=>'form-vertical ticketform ','data-parsley-validate'=>'true','role'=>'form') )!!}
                    
                     <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

                
                <div class="mt-10 mb-10">                       
                         {{trans('menu.variables_you_can_use')}}  :  <span class="text-bold"> {name} </span> | <span class="text-bold"> {username}</span> | <span class="text-bold"> {email} </span>| <span class="text-bold"> {ticket_id} </span>
                    </div>

            <div class="required form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', trans("ticket.title"), array('class' => 'control-label')) !!} {!! Form::text('title', Input::old('title'), ['id'=>'ticket_title', 'class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.title")]) !!}
            </div>  

                <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('body', trans("ticket.reply"), array('class' => 'control-label')) !!} {!! Form::textarea('body', Input::old('body'), ['id'=>'ticket_body','class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("ticket.body")]) !!}
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary submit-ticket-reply"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.submit_reply')}}</button>
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
                                                <div class="heading-elements">
                                                    <span class="heading-text"><i class="icon-history position-left text-success"></i> {{trans('menu.updated')}}  {{$reply->created_at}}</span>
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
                {!! Form::open(array('action' => 'user\Helpdesk\Ticket\TicketsController@changeOwner' , 'method' => 'PATCH','class'=>'form-vertical ticketform','id'=>'changeownerform','data-parsley-validate'=>'true','role'=>'form') )!!}
                <div class="modal-header">
                   
                    <h4 class="modal-title">{{trans('menu.change_owner_of_ticket')}}  : <b> {{$ticket->ticket_number}}</b></h4> <button type="button" class="close" id="close101" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="ahah1">
                            <div class="modal-body">

                                <h3>{{trans('menu.select_new_owner')}} </h3>
                                <input type="hidden" name="ticketid" value="{{$ticket->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="key-word-user" name="key-word-user" placeholder="{{trans('menu.search_member')}} ">
                                        <input type="hidden" id="key_user_hidden" name="key_user_hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="dismis42">{{trans('menu.close')}} </button>
                            <!--<input type='checkbox' name='send-mail' class='icheckbox_flat-blue' value='".$ticket->id."'><span disabled class="btn btn-sm">Check to notify user</span></input>-->
                            <button type="submit" class="btn btn-primary pull-right" id="submt2">{{trans('menu.update')}} </button>
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
@endsection
@section('scripts') @parent
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>


<script>
    $(document).ready(function(){
        $('#joiningreport').DataTable( {
            dom: "<'row'<'col-sm-6'l><'col-sm-6'fr>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row'<'col-sm-2'i><'col-sm-5'<'pull-left'p>><'col-sm-5'<'pull-right'B>> >" ,
 
            buttons: [{ 
              "extend": 'pdf', 
              "pageSize":'A3',
              "orientation":'landscape',
              "text":'<span class="fa fa-print"> PDF</span>',
              "className": 'btn  btn-xs  btn-primary paginate_button ' 
            }] 
        });
    });
 </script>
   
    @endsection