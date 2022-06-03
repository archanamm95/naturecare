@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.user.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


{!! Form::model($article,['url' => 'user/helpdesk/kb/article/'.$article->id , 'method' => 'PATCH','data-parsley-validate'=>'true','role'=>'form'] )!!}

<div class="row">
    <div class="col-sm-8">
        <div class="card card-default border-top-xlg border-top-warning">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">
                   Show Article
                </h5>
            </div>
            <div class="card-body">
               
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name',trans('article.name')) !!}
                      
                       <div class="form-group" style="background-color:white">
                        {!! Form::text('name', null !==(Input::old('name')) ? Input::old('description') : $aid->name, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
                    </div>
                    </div>                   
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('slug',trans('article.slug')) !!}
                        {!! Form::text('slug', null !==(Input::old('name')) ? Input::old('slug') : $aid->slug, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
                    </div>                    
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        {!! Form::label('Description', 'Description', array('class' => 'control-label')) !!} 
                        {!! Form::text('description', null !==(Input::old('description')) ? Input::old('description') : $description, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        {!! Form::label('publish time', 'publish time', array('class' => 'control-label')) !!} 
                        {!! Form::text('publish time', null !==(Input::old('publish time')) ? Input::old('description') : $aid->publish_time, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
                    </div>
                
              
              
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}


@endsection