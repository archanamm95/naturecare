@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
@include('flash::message') 
@include('utils.errors.list')

  


   
   @if(count($result) > 0)

    <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{ trans('users.videos')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
      <div class="card-body">
    <div class="row">
      @foreach ($result as $key=>$video)
        <div class="col-sm-6">
            {!! $video['url'] !!}
            <br>
           {{ $video['title'] }}
            
        </div>
        @endforeach


</div>
</div>
</h4>
@endif


@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>


@endsection
