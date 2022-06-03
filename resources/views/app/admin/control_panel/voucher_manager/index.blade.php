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
                {{trans('controlpanel.voucher_manager')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <form class="form-vertical" action="{{url('admin/control-panel/voucher-manager/savelimit')}}" method="POST" data-parsley-validate="true" role="form">
                {!! csrf_field() !!}
                <div class="required row form-group">
                    <label class="col-form-label col-lg-4">
                      {{trans('controlpanel.user_request_voucher')}}
                    </label>
                    <div class="col-lg-6">
                        <select class="form-control" name="voucher_user_request">
                            <option value="{{$voucher_user_request}}">{{$voucher_user_request}}</option>
                            @if($voucher_user_request == 'yes')
                            <option value="no">no</option>
                            @else
                            <option  value="yes">yes</option>
                            @endif
                        </select>
                    </div>
                </div>
                 <div class="required row form-group">
                    <label class="col-form-label col-lg-4">
                      {{trans('controlpanel.admin_approval_need')}}
                    </label>
                    <div class="col-lg-6">
                        <select class="form-control" name="voucher_admin_approval">
                           <option value="{{$voucher_admin_approval}}">{{$voucher_admin_approval}}</option>
                            @if($voucher_admin_approval == 'yes')
                            <option value="no">no</option>
                            @else
                            <option value="yes">yes</option>
                            @endif
                        </select>
                    </div>
                </div>

                 <div class="required row form-group">
                    <label class="col-form-label col-lg-4">
                      {{trans('controlpanel.daily_limit_for_voucher_creation')}}
                    </label>
                    <div class="col-lg-6">
                        <input type="text" name="voucher_daily_limit" class="form-control" data-popup="tooltip" title="" placeholder="{{trans('controlpanel.daily_limit_for_voucher_creation')}}" data-original-title="{{trans('controlpanel.daily_limit_for_voucher_creation')}}" value="{{$limit}}">
                    </div>
                </div>
                <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>
                </form>
            </div>
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
