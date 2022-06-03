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
<div class="col-sm-8">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('contacts.contact_list')}}</h5>
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
        
    
    
        
    
    <table class="table datatable-basic table-striped table-hover" id="contact-lists-table" data-search="false">
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
        <h5 class="card-title">{{trans('contacts.create_contact_list')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open(array('action' => 'Admin\Marketing\Contacts\ContactsController@createContactList' , 'method' => 'post','class'=>'form-vertical contactlistsform ','data-parsley-validate'=>'true','role'=>'form','onsubmit'=>'checkForm(this)') )!!}


                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          {!! Form::label('name', trans("contact.list_name"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.list_name")]) !!}                                           
                    </div>                    

                    <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          {!! Form::label('description', trans("contact.list_description"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('description', Input::old('description'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.list_description")]) !!}                                           
                    </div>           

                                     
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-department" id="add_contact" name="add_contact"><b><i class=" icon-folder-plus2"></i></b> {{trans('contact.add_Group')}}</button>
                    </div>
               {!! Form::close() !!}
    </div>
</div>
</div>
</div>

@endsection @section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_contact.disabled = true;
   
   return true;
 }

</script>
@stop
