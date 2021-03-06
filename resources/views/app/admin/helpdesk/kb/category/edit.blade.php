@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


 <div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Edit article category : <b>{{$category->name}}</b></h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">

{!! Form::model($category,['url' => 'admin/helpdesk/kb/category/'.$category->id , 'method' => 'PATCH'] )!!}

        <div class="row">
            <div class="col">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name',Lang::get('lang.name')) !!}<span class="text-red"> *</span>

                {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>
        </div>
            <div class="col">

            <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }}">
                {!! Form::label('parent',Lang::get('lang.parent')) !!}

                {!!Form::select('parent',[''=>'Select a Group','Categorys'=>$categories],null,['class' => 'form-control select']) !!}
            </div>
        </div>
            <div class="col">

            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('status',Lang::get('lang.status')) !!}

                <div class="row">
                    <div class="col-xs-4">
                        {!! Form::radio('status','1',true) !!} {{Lang::get('lang.active')}}
                    </div>
                    <div class="col-xs-6">
                        {!! Form::radio('status','0',null) !!} {{Lang::get('lang.inactive')}}
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-12 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {!! Form::label('description',Lang::get('lang.description')) !!}<span class="text-red"> *</span>

                {!! Form::textarea('description',null,['class' => 'form-control summernote','size' => '128x10','id'=>'description','placeholder'=>'Enter the description']) !!}
            </div>
        </div>
    
        {!! Form::submit(Lang::get('lang.update'),['class'=>'form-group btn btn-primary'])!!}
    </div>
</div>
@stop