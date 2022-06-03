@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


{!! Form::model($article,['url' => 'admin/helpdesk/kb/article/'.$article->id , 'method' => 'PATCH','data-parsley-validate'=>'true','role'=>'form'] )!!}

<div class="row">
    <div class="col-sm-8">
        <div class="card card-default border-top-xlg border-top-warning">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">
                   View Article
                </h5>
                <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
            </div>
            <div class="card-body">
               
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name',trans('article.name')) !!}
                        <span class="text-red">
                            *
                        </span>
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>                   
                    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('slug',trans('article.slug')) !!}
                        <span class="text-red">
                            *
                        </span>
                        {!! Form::text('slug',null,['class' => 'form-control']) !!}
                    </div>
                
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                   
                    
                    <div class="form-group" style="background-color:white">
                       {!! Form::label('Description', 'Description', array('class' => 'control-label')) !!} 
                        {!! Form::text('description', null !==(Input::old('description')) ? Input::old('description') : $description, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                   
                    
                    <div class="form-group" style="background-color:white">
                       {!! Form::label('publishdate', 'publish date', array('class' => 'control-label')) !!} 
                        {!! Form::text('publishdate', null !==(Input::old('publishdate')) ? Input::old('publishdate') : $article->created_at, ['class' => 'form-control','data-parsley-group' => 'block-1']) !!} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}


@endsection