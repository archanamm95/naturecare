@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

	<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Edit category : <b> {{$category->category}}</b></h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($category,['url' => '/admin/helpdesk/tickets/category/'.$category->id , 'method' => 'PATCH'] )!!}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          {!! Form::label('category', trans("ticket.category_name"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('category', Input::old('category'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.category_name")]) !!}                                           
                    </div>                    

                    <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          {!! Form::label('description', trans("ticket.category_description"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('description', Input::old('description'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.category_description")]) !!}                                           
                    </div>           

                                     
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-category"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.update_category')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>
@endsection @section('scripts') @endsection