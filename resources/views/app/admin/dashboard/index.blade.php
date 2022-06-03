@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop
{{-- Content --}} @section('main')
@section('styles')
@parent
<style type="text/css">
.text-4xl {
    font-size: 1.75rem!important;
}
</style>
@endsection
@section('scripts')
@parent

@endsection

@if(Auth::user()->id==1)
<div class="row dashboard-records" id="dashboard-records-1">
    <div class="col-xl-12">
        <div class="row">
            <!--WIDGET BOXES-->
            @include('app.admin.dashboard.widgets.boxes')
            <!--WIDGET BOXES ENDS-->
        </div>
    </div>
</div>
        <!--LINKS AND GRAPH-->
        @include('app.admin.dashboard.widgets.widget_links_and_graph')
        <!--LINKS AND GRAPH END-->





<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-12">
                <!--TOP USERS WIDGET START-->
                @include('app.admin.dashboard.widgets.list_top_users')
                <!--TOP USERS WIDGET END-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- RECENT PLAN TOPUP WIDGET START-->
                @include('app.admin.dashboard.widgets.list_recent_plan_top_up')
                <!--RECENT PLAN TOPUP WIDGET END-->
            </div>
        </div>
     
        <div class="row">
            <div class="col-md-12">
                <!-- RECENT PLAN TOPUP WIDGET START-->
                @include('app.admin.dashboard.widgets.list_new_registered_users')
                <!--RECENT PLAN TOPUP WIDGET END-->
            </div>
        </div>
    </div>
        <div class="row">

    <div class="col-xl-4 col-sm-12">

        <!-- RECENT PLAN TOPUP WIDGET START-->
        @include('app.admin.dashboard.widgets.list_recent_activities')
        <!--RECENT PLAN TOPUP WIDGET END-->


    </div>
</div>
    <!-- Dashboard content -->
</div>
@endif
@endsection


@section('scripts')
@parent


@endsection