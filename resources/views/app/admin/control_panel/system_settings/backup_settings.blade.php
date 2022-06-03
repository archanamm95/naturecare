@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection
@section('sidebar')
@parent
<!-- Secondary sidebar -->
@include('app.admin.control_panel.sidebar')
<!-- /secondary sidebar -->
@endsection


        {{-- Content --}}
        @section('main')
<div id="settings-page">

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('packages.backup')}} : {{trans('packages.settings')}}
            </h5>
                <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">

                <legend class="text-uppercase font-size-sm font-weight-bold">{{trans('packages.backup_manager')}}</legend>
                <form action="{{url('admin/control-panel/postbackupmanager')}}" data-parsley-validate="true" method="post">
                    {{csrf_field()}}

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{trans('packages.client')}} {{trans('packages.i')}}{{trans('packages.d')}}</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" name="client_id" value="{{$backup_setting->client_id}}" required>   
                  </div>
                </div>


                 <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{trans('packages.client_secret')}}</label>
                            <div class="col-lg-8">
                             <input type="text" class="form-control" name="client_secret" value="{{$backup_setting->client_secret}}" required >   
                            </div>
                </div>


               <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{trans('packages.refresh_token')}}</label>
                        <div class="col-lg-8">
                             <input type="text" class="form-control" name="refresh_token" value="{{$backup_setting->refresh_token}}" required >   
                        </div>
                   
                </div>

                      <div class="form-group row">
                    <label class="col-form-label col-lg-2">{{trans('packages.folder_i')}}{{trans('packages.d')}}</label>
                        <div class="col-lg-8">
                             <input type="text" class="form-control" name="folder_id" value="{{$backup_setting->folder_id}}" >   
                        </div>
                   
                </div>




                 <div class="form-group row">
                     <button class="btn bg-dark" type="submit">{{trans('packages.save')}}</button>
                </div>

                </form>
            </fieldset>

              
                
            </div>    
        </div>
    </div> 


</div>
@stop

@section('styles')@parent
<style type="text/css">
.parsley-errors-list.filled {
    position: absolute;
    top: 40px;
}
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent

@stop
