@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
 <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
            Payment Status
        </h4>
    </div>
    <div class="card-body">
       <p> Payment Completed
    </div>
</div>
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop



 