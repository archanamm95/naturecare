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
              {{trans('controlpanel.edit_matching_bonus')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">

             {!! Form::model($options,['url' => '/admin/control-panel/bonus-settings/matchingbonus/edit/'.$matching->id, 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>

            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">
                    {{trans('controlpanel.package_details')}}
                </legend>

                <div class="row">

                    <div class="col-sm-6">

                        

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6">{{trans('controlpanel.position_title')}}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="package" value="{{$matching->package}}" readonly="true">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6">{{ trans('packages.level_1') }}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="pv" value="{{$matching->pv}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    


            
                </div>

            </fieldset>

                   <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>

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
