@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-main-hidden ') 

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
        <h5 class="card-title">Edit List : <b> {{$contactlist->name}}</b></h5>
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

      {!! Form::model($contactlist,['url' => 'admin/campaign/contactlist/'.$contactlist->id.'/edit', 'method' => 'POST','data-parsley-validate'=>'true','role'=>'form'] )!!}



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
                        <button type="submit" class="btn btn-primary submit-contact-list"><b><i class=" icon-folder-plus2"></i></b> {{trans('contact.update_list')}}</button>
                    </div>
                {!! Form::close() !!}
    </div>
</div>
</div>
</div>
@endsection @section('scripts') @endsection