@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') @include('flash::message') @include('utils.errors.list')
  <div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('ticket_config.view_news')}}</h5>
        <div class="header-elements">
              <a href="{{url('admin/getnews')}}" class="btn btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i>{{trans('ticket_config.back')}}</a>
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    
        <div class="card-body">
        {{$post->title}}
       {!!$post->content!!}
     
    </div>
</div>


@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
 @parent
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

 @endsection