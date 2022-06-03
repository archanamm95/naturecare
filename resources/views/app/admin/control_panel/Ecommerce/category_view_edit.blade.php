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
               {{trans('packages.edit_category')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">

             {!! Form::model($options,['url' => '/admin/control-panel/category-edit', 'method' => 'POST','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
            <input type="hidden" name="id" value="{{$category->id}}"/>

            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">
                     {{trans('packages.category_details')}}
                </legend>

                <div class="row">

                    <div class="col-sm-6">

                         

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6">   {{trans('packages.category_name')}}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="name" value="{{$category->category_name}}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6">{{trans('packages.status')}}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                     <select class="form-control chosen-select" name="status" id="status" required="true">
                                        @if($category->status == 'yes')
                                        <option value="yes" selected=""> {{trans('packages.enable')}}</option>
                                        <option value="no"> {{trans('packages.disable')}}</option>
                                        @else
                                        <option value="yes" > {{trans('packages.enable')}}</option>
                                        <option value="no" selected=""> {{trans('packages.disable')}}</option>
                                        @endif
                                     </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    


            
                </div>

            </fieldset>

                   <button class="btn bg-dark" type="submit">{{trans('packages.save')}}</button>

{!! Form::close() !!}


        </div>
    </div>
</div>
@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">

</script>
@stop
