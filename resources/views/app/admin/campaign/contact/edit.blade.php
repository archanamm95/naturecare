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
        <h5 class="card-title">Edit contact</h5>
        
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        
    <hr/>
    <a href="{{ url('admin/campaign/contacts/') }}" class="btn bg-success" ><i class="icon-arrow-left52 mr-2"> </i> Back to contacts</a>
    <hr/>
   {!! Form::model($contact,['url' => 'admin/campaign/contacts/'.$contact->id.'/', 'method' => 'PATCH','data-parsley-validate'=>'true','role'=>'form'] )!!}
  
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
          {!! Form::select('list_id', $contact_lists ,Input::old('list_id'),['class' => 'form-control','id' => 'list_id','required' => 'required','data-parsley-required-message' => trans("all.please_select_list"),'data-parsley-group' => 'block-1']) !!}  
        </div>                                          
      </div>
    </div>
    <div class="form-group">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn bg-success submit-contact"><b><i class=" icon-folder-plus2"></i></b> {{trans('contact.edit_contact')}}</button>
  </div>
  </div>
{!! Form::close() !!}

</div>
</div>
            




@endsection		 


