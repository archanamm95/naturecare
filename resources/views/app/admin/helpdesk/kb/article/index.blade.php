@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-xs') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')



{!! Form::open(array('action' => 'Admin\Helpdesk\kb\ArticleController@store' , 'method' => 'post','class'=>'form-vertical kbarticleform ','data-parsley-validate'=>'true','role'=>'form','onsubmit'=>'checkForm(this)') )!!}
<div class="row">
    <div class="col-sm-8">
        <div class="card card-default border-top-xlg border-top-warning">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">
                    {!! trans('article.add_article') !!}
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

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! Form::label('description',trans('article.description')) !!}
                    <span class="text-red">
                        *
                    </span>
                    <div class="form-group" style="background-color:white">
                        {!! Form::textarea('description',null,['class' => 'form-control summernote','id'=>'editor','size' => '128x20','placeholder'=>trans('article.enter_the_description')]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        
            <div class="card card-default border-top-xlg border-top-warning">
                <div class="card-header header-elements-inline card-border-top">
                    <h5 class="card-title">
                        {{trans('article.publish')}}
                    </h5>
                </div>
                <div class="card-body">
                                <div class="form-group mb-3 mb-md-2">
                                    <label class="d-block font-weight-semibold">Set status</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="type" id="custom_radio_inline_unchecked" checked>
                                        <label class="custom-control-label" for="custom_radio_inline_unchecked">Published</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="type" id="custom_radio_inline_checked">
                                        <label class="custom-control-label" for="custom_radio_inline_checked">Draft</label>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3 mb-md-2">
                                    <label class="d-block font-weight-semibold">Set visibility</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="custom_radio_inline_unchecked_1" checked>
                                        <label class="custom-control-label" for="custom_radio_inline_unchecked_1">Public</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="custom_radio_inline_checked_1">
                                        <label class="custom-control-label" for="custom_radio_inline_checked_1">Private</label>
                                    </div>
                                </div>

                   
                   
                    @php
                        $format = 'H:i:s';
                        $tz = 'Asia/Kolkata';
                        date_default_timezone_set($tz);
                        $date = date($format);
                        $dateparse = date_parse_from_format($format, $date);
                        $month = $dateparse['month'];
                        $day = $dateparse['day'];
                        $year = $dateparse['year'];
                        $hour = $dateparse['hour'];
                        $minute = $dateparse['minute'];
                        @endphp
                    <div class="form-group">
                       <br/>
                        <div class="">
                            {!! Form::label('month',trans('article.publish_immediately')) !!}
                        </div>
                        <div class="">
                            <span class="form-inline">
                                {!! Form::selectMonth('month',$month,['style'=>'width:98px',
                                'class'=>'form-control'])  !!}
                                   
                                {!! Form::selectRange('day', 1, 31, $day,['style'=>'width: 60px;','class'=>'form-control'])!!}
                                
                                {!! Form::text('year',date('Y'),['style'=>'width: 70px;','class' => 'form-control'])  !!} 
                              
                                <input name="hour" class="form-control" style="width: 50px;" type="text" value="{{$hour}}"/><label class="col-xs-4">:</label>
                              
                                <input name="minute" class="form-control" style="width: 50px;" type="text" value="{{$minute}}"/>
                                </span>
                                </div>
                           
                        </div>
                    </div>
               
                <div class="card-footer">
                    <div class="col-sm-12">                        
                        {!! Form::submit(trans('article.publish'),['id '=>'add_pub', 'name'=>'add_pub','class'=>'btn btn-primary'])!!}
                    </div>
                </div>
            </div>
        
        
            <div class="card card-default border-top-xlg border-top-warning">
                <div class="card-header header-elements-inline card-border-top">
                    <h5 class="card-title">
                        {{trans('article.category')}}
                        <span class="text-red">
                            *
                        </span>
                    </h5>
                </div>
                <div class="card-body" style="height:190px; overflow-y:auto;">
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        @foreach($category as $key=>$val)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input name="category_id[]" type="radio" class="styled" value="<?php echo $key; ?>"/>
                                </div>
                                <div class="col-md-10">
                                    <?php echo $val; ?>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-sm-12">                                            
                    <span class="btn btn-info btn-sm" data-target="#j" data-toggle="modal">
                        {{trans('article.add_category')}}
                    </span>
                </div>
                   
                </div>
            </div>
       
    </div>
</div>
{!! Form::close() !!}

 <div class="modal" id="j">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!! Form::open(['method'=>'post','action'=>'Admin\Helpdesk\kb\CategoryController@store']) !!}
                                <div class="modal-header">
                                    <h5 class="modal-title">{{trans('article.add_category')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            {!! Form::label('name',trans('article.name')) !!}
                                                            {!! $errors->first('name', '
                                            <spam class="form-text">
                                                :message
                                            </spam>
                                            ') !!}
                                                            {!! Form::text('name',null,['class' => 'form-control']) !!}
                                        </div>
                                        
                                        <div class="col form-group {{ $errors->has('status') ? 'has-error' : '' }}">

                                    {!! Form::label('status',trans('article.status')) !!}
                                    {!! $errors->first('status', '<spam class="form-text">:message</spam>') !!}

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    {!! Form::radio('status','1',true,['class'=>'styled']) !!}&nbsp;{!! trans('article.active') !!}
                                                </div>
                                                <div class="col-xs-6">
                                                    {!! Form::radio('status','0',null,['class'=>'styled']) !!}&nbsp;{!! trans('article.inactive') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                        {!! Form::label('description',trans('article.description')) !!}
                                                                {!! $errors->first('description', '
                                        <spam class="form-text">
                                            :message
                                        </spam>
                                        ') !!}

                                        {!! Form::textarea('description',null,['class' => 'form-control summernote','size' => '50x10','id'=>'myNicEditor','placeholder'=>trans('article.enter_the_description')]) !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add </button>
                                    <button class="btn btn-secondary float-left" data-dismiss="modal" type="button">
                                        Close
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
<div class="row">
<div class="col-sm-12">
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">
            {{trans('kb.all_articles')}}
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table datatable-basic table-striped table-hover editable-table" data-search="false" id="kb-article-table">
                        <thead>
                            <tr>
                                <th>
                                    {{trans('kb.article_title')}}
                                </th>
                                <th>
                                    {{trans('kb.publish_time')}}
                                </th>                                
                                <th>
                                    {{trans('kb.actions')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection @section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_pub.disabled = true;
   
   return true;
 }

</script>
@stop
