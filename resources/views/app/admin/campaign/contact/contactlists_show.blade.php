@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-xs') 

@section('styles')
@parent
@endsection
@section('sidebar')
@parent
@include('app.admin.campaign.sidebar')
@endsection





{{-- Content --}}
@section('main')
 

<div class="row">
<div class="col-sm-12">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('contacts.showing_contacts_in_the_list')}} : {{ $contact->name }}</h5><div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        
    <hr/>
    <button type="button" class="btn bg-success" data-toggle="modal" data-target="#modal_theme_success"> {{trans('contacts.add_new_contact')}} <i class="icon-play3 ml-2"></i></button>
    <hr/>
    
        
    <input type="hidden" name="id" value="{{$contact->id}}">
    <table class="table datatable-basic table-xs table-hover" id="contact-list-single-table">
        <thead>
            <tr>
                        
                <th>
                    {{trans('contact.firstname')}}
                </th>             
                <th>
                    {{trans('contact.lastname')}}
                </th>            
                <th>
                    {{trans('contact.email')}}
                </th> 
                <th>
                    {{trans('contact.address')}}
                </th>    
                <th>
                    {{trans('contact.mobile')}}
                </th>                                    
                <th>
                    {{trans('contact.actions')}}
                </th>
                
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>

</div>
</div>



<!-- Success modal -->
<div id="modal_theme_success" class="modal fade" tabindex="-1">
    <div class="modal-dialog">

         {!! Form::open(array('action' => array('Admin\Marketing\Contacts\ContactsController@store') , 'method' => 'post','class'=>'form-vertical contactlistform ','data-parsley-validate'=>'true','role'=>'form') )!!}

        <div class="modal-content">
            <div class="modal-header bg-success">
                    <h6 class="modal-title">{{trans('contacts.add_new_contact')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

        <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="row">
            <div class="col-sm-6">
                <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('firstname', trans("contact.firstname"), array('class' => 'col-form-label')) !!} 
                    {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.firstname")]) !!}                                           
                </div>
                <div class="required form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('name', trans("contact.email"), array('class' => 'col-form-label')) !!} 
                    {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.email")]) !!}                                           
                </div>
                <div class="required form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    {!! Form::label('mobile', trans("contact.mobile"), array('class' => 'col-form-label')) !!} 
                    {!! Form::text('mobile', Input::old('mobile'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.mobile")]) !!}                                           
                </div>
            </div>
            <div class="col-sm-6">
                <div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    {!! Form::label('name', trans("contact.lastname"), array('class' => 'col-form-label')) !!} 
                    {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.lastname")]) !!}                                           
                </div>
                <div class="required form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    {!! Form::label('name', trans("contact.address"), array('class' => 'col-form-label')) !!} 
                    {!! Form::text('address', Input::old('address'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.address")]) !!}                                           
                </div>
                <div class="required form-group{{ $errors->has('list') ? ' has-error' : '' }}">
                    {!! Form::label('list', trans("register.contact_list"), array('class' => 'col-form-label')) !!} 

                    {!! Form::select('list', $contact_lists ,NULL,['class' => 'form-control','id' => 'list','required' => 'required','data-parsley-required-message' => trans("all.please_select_list"),'data-parsley-group' => 'block-1']) !!}   
                                
                </div>
            </div>
        </div>                        
        <div class="form-group">
                            
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-success submit-contact"><b><i class=" icon-folder-plus2"></i></b> {{trans('contact.add_contact')}}</button>
        </div>
        </div>
        {!! Form::close() !!}
    </div>
    </div>
<!-- /success modal -->



<div class="col-sm-4">
    <div class="card card-flat">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">{{trans('contacts.create_new_list')}}</h5>
            <div class="header-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>


        <div class="card-body">
            {!! Form::open(array('action' => 'Admin\Marketing\Contacts\ContactsController@createContactList' , 'method' => 'post','class'=>'form-vertical departmentsform ','data-parsley-validate'=>'true','role'=>'form') )!!}

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', trans("contact.Group_name"), array('class' => 'col-form-label')) !!} 
                    {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.Group_name")]) !!}                                           
                </div>                    

                <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description', trans("contact.Group_description"), array('class' => 'col-form-label')) !!} 
                    {!! Form::text('description', Input::old('description'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.Group_description")]) !!}                                           
                </div>                              
                <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-department"><b><i class=" icon-folder-plus2"></i></b> {{trans('contact.add_Group')}}</button>
                </div>
               {!! Form::close() !!}
        </div>
    </div>
</div>


</div>

@endsection		 

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">



 if ($('#contact-list-single-table').length) {
     $(document).ready(function() {
        var id = $("[name='id']").val();
            oTable = $('#contact-list-single-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                // "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/campaign/contacts/data",
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/campaign/contactlist/data/"+id+"/?listid="+id+"",
                "columns": [
                    { "data": "name" },
                    { "data": "lastname" },
                    { "data": "email" },
                    { "data": "mobile" },
                    { "data": "address" },
                    { "data": "action" }
                ],
                "fnDrawCallback": function(oSettings) {}
            });
        });
        function reloadDataTable() {
            oTable.ajax.reload();
        } 

    $('.content').on('click', '.btn-delete-contactgroup', function(e) {
    	 var id = $(this).data('id');   
        // var $dlbtn = $(this);
        $dlbtnparent = $(this).parents('tr');
        swal({
            title: "Are you sure?",
            text: "This contact will be deleted ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
           
            $.ajax(
                {
                    url: CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/contacts/'+id,
                    type: 'delete', // replaced from put
                    dataType: "JSON",
                    data: {
                        "id": id// method and token not needed in data
                    },
                    success: function (response)
                    {
                    $dlbtnparent.remove();

                        swal('Contact deleted!');
                     },
                    error: function(xhr) {
                        //alert('Some problem occured!!!')
                     console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    // do something here because of error
                   }
                });


        });
    }); 




    //     var id = $(this).data('id');       
    //     swal({
    //         title: "Are you sure?",
    //         text: "All related contacts  will be deleted from this group",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonClass: "btn-danger",
    //         confirmButtonText: "Yes, delete it!",
    //         closeOnConfirm: false
    //     }, function() {
    //         window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/contacts/destroygruop/' + id;
    //     });
    // }); 
 }


</script>
@stop
