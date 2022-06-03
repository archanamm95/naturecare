@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('documents.manage_documents')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
     <div class="card-body">

    <form action="{{URL::to('admin/postuploadusers')}}" enctype="multipart/form-data" method="post">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="user-edit-image-buttons" files="true">
                      
                        <div class="row">                            
                            <div class="col-sm-12">                            
                                <div class="form-group">
                                        <label class="col-form-label">{{trans('documents.select_file')}} (xlsx,ods {{trans('ticket_config.files_only')}}): </label>
                                        <input type="file" name="file" class="file-input" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary" data-remove-class="btn btn-light" data-fouc accept=".xlsx">
                                </div>
                            </div>
                        </div>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                         
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-md-3 col-form-label">
                        </label>
                        <div class="col-sm-6 col-form-label">
                            <button class="btn btn-primary p-l-40 p-r-40" id="btn_submit" type="submit">
                                {{trans('ticket_config.upload')}}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                     <a class="btn btn-success" href="{{url('admin/download/'.$doc)}}" name="requestid">
                            <i class="fa fa-download"></i>Download
                        </a>
                </div>
                </div>
            </form>
      
  </div>
</div>
                  
@stop  