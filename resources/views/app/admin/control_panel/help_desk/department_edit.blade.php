@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection



        {{-- Content --}}
        @section('main')
 <div class="row">
 <div class="col-sm-8">
        <div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('settings.edit_department')}} : <b> {{$department->name}}</b></h5>
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
        {!! Form::model($department,['url' => '/admin/helpdesk/tickets/department/'.$department->id , 'method' => 'PATCH'] )!!}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          {!! Form::label('name', trans("ticket.department_name"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.department_name")]) !!}                                           
                    </div>                    

                    <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          {!! Form::label('description', trans("ticket.department_description"), array('class' => 'col-form-label')) !!} 
                          {!! Form::text('description', Input::old('description'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.department_description")]) !!}                                           
                    </div>           

                                     
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-department"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.update_department')}}</button>
                    </div>
                </form>
    </div>

</div>
</div>


@stop

@section('styles')@parent

@endsection


