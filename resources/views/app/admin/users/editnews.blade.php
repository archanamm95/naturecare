@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: 
@endsection {{-- Content --}}
@section('main')
@include('flash::message') 
@include('utils.errors.list')

  <div class="card card-flat" style="overflow: auto;">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('ticket_config.edit_news')}}</h5>
        <div class="header-elements">
          <a href="{{url('admin/getnews')}}" class="btn btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i>{{trans('ticket_config.back')}}</a>
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    
        <div class="card-body">

   <form action="{{url('admin/posteditnews')}}"  method="post" >
      <input type="hidden" name="post_id" value="{{$news->id}}">
   
        {{ csrf_field() }}
          <div class="row">
           
                <label class="col-sm-4" for="post_name" >
                   {{trans('ticket_config.name')}}:
                    <span class="symbol required">
                        </span>
                  
                </label>
                <div class="col-sm-4">
                    <input class="form-control" name="post_name" id="post_name" value="{{$news->title}}"  type="text" required="true">
                    </input>
                </div>
   
            </div>
  
                  <br>
             <div class="row">
                  
            <label class="col-sm-4" for="post_name" >
                  Short Text:
                    <span class="symbol required">
                        </span>
                  
                </label>
                <div class="col-sm-4">
                    <input class="form-control" name="shorttext" id="shorttext"  type="text" required="true">
                 
                </div>
              </div>
   
               <br>
   
        <div class="row">
              <label class="col-sm-4" for="content">
                   {{trans('ticket_config.content')}}:
                    <span class="symbol required">
                        </span>
                </label>
        </div>
          <div class="row">
        <textarea name="summernoteInput" class="summernote"></textarea>
    </div>
        <br>
        <button type="submit" class="btn btn-info">{{trans('ticket_config.submit')}}</button>
       
    </form>
 
           
        </div>
    </div>

   





@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

    $(document).ready(function() {
            //initialize summernote
            $('.summernote').summernote();
            //assign the variable passed from controller to a JavaScript variable.
            var content = {!! json_encode($news->content) !!};
            //set the content to summernote using `code` attribute.
            $('.summernote').summernote('code', content);
        });
</script>



@endsection
