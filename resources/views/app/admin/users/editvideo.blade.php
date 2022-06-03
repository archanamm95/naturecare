@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')

<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
            {{ trans('ewallet.edit_video') }}
        </h4>
         <a href="{{url('admin/addvideos')}}" class="btn btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
    </div>
    <div class="card-body">
        <!-- @include('utils.errors.list') -->
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('admin/posteditvideo')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
             <input type="hidden" name="id" value="{{$editvideo->id}}">
            
            <div class="form-group">
              <div class="row">
                
                <label class="col-sm-3">{{trans('users.title')}}</label>
                <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{$editvideo->title}}" />
                </div>
              </div>
            </div>  
                 <div class="form-group">
                <div class="row">
                    <div class="col-sm-3" >
                         <label class="form-label ">{{trans('packages.change_video')}}</label>
                    </div>
                    <div class="col-sm-9" >
                         <input type="text" name="videos" value="{{$editvideo->url}}" class="form-control name_list" />
                                   
                             
                        </div>
                    </div>
                </div>

           
           
            <div class="form-group">
                
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-sm btn-success">{{trans('users.save')}}</button>
                </div>
            </div>
            
        </form>
    </div>
    



    </div>

     

                      
@endsection
{{-- Scripts --}}
@section('scripts')
    @parent

    
@stop
