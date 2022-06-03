@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop  {{-- Content --}} @section('main') 
@section('styles') 
@parent 

@endsection
@section('scripts')
@parent 

@endsection 

<!--RECORDS WIDGET START-->
    @include('app.admin.layouts.onlinestore')
<!--RECORDS WIDGET END-->
<div class="row display-flex">
    <div class="col-xl-6">
        <!--Order  START-->
        @include('app.admin.online_store.order_graph')
        <!--Order END-->
    </div>
    <div class="col-xl-6">
        <!--Category START-->
            @include('app.admin.online_store.category_graph')
        <!--category END-->
    </div>
  
</div>
<br>
<div class="row display-flex">
    <div class="col-xl-12 col-sm-12">
        <!--JOIN_MAP WIDGET START-->
            @include('app.admin.online_store.recent_order_status')
        <!--JOIN_MAP WIDGET END-->
    </div>
    <!-- <div class="col-xl-5 col-sm-12"> -->
        <!--JOIN_MAP WIDGET START-->
          
        <!--JOIN_MAP WIDGET END-->
    <!-- </div> -->
</div>



@endsection


@section('scripts')
@parent
<script type="text/javascript">
</script>
@endsection
