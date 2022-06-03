@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-full') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection


        {{-- Content --}}
        @section('main')

<div id="settings-page">
    <div class="card card-white">
    <div class="card-header">
      <h2>Application settings</h2>
    </div>
    <div class="card-body bordered">
        
      <div class="mb-3">
              <div class="row row-tile no-gutters text-center">
                <div class="col-2">
                 <button type="button" class="btn btn-success"><span>Company Settings</span></button>
                </div>
                <div class="col-2">
                 <button type="button" class="btn btn-success btn-float"><i class="icon-html52 icon-2x"></i> <span>Download</span></button>
                </div>
                <div class="col-2">
                 <button type="button" class="btn btn-success btn-float"><i class="icon-html52 icon-2x"></i> <span>Download</span></button>
                </div>
                <div class="col-2">
                 <button type="button" class="btn btn-success btn-float"><i class="icon-html52 icon-2x"></i> <span>Download</span></button>
                </div>
                <div class="col-2">
                 <button type="button" class="btn btn-success btn-float"><i class="icon-html52 icon-2x"></i> <span>Download</span></button>
                </div>
                <div class="col-2">
                 <button type="button" class="btn btn-success btn-float"><i class="icon-html52 icon-2x"></i> <span>Download</span></button>
                </div>
                

              </div>
            </div>


    </div>
  </div>
</div>

@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">
$('document').ready(function(){



});
</script>
@stop
