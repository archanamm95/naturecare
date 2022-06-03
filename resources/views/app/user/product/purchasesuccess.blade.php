@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('main')
 @include('utils.errors.list')





<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$title}}</h4>
    
    </div>
        
<div class="card-body">
  <p> {{trans('products.purchase_completed_successfully')}}</p>

</div>            
</div>

              
@endsection @section('overscripts') @parent

@endsection @section('scripts') @parent

 
@endsection







