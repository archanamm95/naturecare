@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}}
@section('main')
<!-- Notes grid -->


<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
            All activities are listed here
        </h4>
    </div>
    <div class="card-body">
    <div class="row">

    <div class="col-sm-12">
   <div class="timeline timeline-left">
        @if (!$all_activities->isEmpty())
        <div class="timeline-container">

                                @foreach($all_activities as $activity)
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <a href="#">
                                            {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $activity->profile]), $activity->username, array('class' => '','style'=>'')) }}
                                        </a>
                                    </div>
                                    <div class="card card-flat timeline-content">
                                        <div class="card-header header-elements-inline">
                                            <h6 class="card-title">
                                                <span class="text-bold">{{$activity->username}} </span>
                                                
                                                

                                            </h6>
                                            <div class="header-elements">
                                                <span class="badge badge-primary heading-text">
                                                    <i class="icon-history position-left text-white">
                                                    </i>
                                                    {{$activity->created_at->diffForHumans()}}
                                                </span>

                                                <a class="ml-3 mx-3 badge badge-success heading-text" href="{{url('admin/userprofiles/')}}/{{$activity->username}}" target="_blank"> View profile <i class="icon-link"></i></a>
                                                
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <span>{{$activity->description}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

        {{ $all_activities->links() }}

        @else
        <div class="row">
        <div class="alert alert-info no-border">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold"></span> No activity yet!
        </div>

        </div>
        
        @endif

    </div>
    </div>
</div>
</div>
</div>
@endsection

@section('styles')
@parent
<style type="text/css">
</style>
@endsection
@section('scripts')
<script type="text/javascript">
</script>
@endsection
