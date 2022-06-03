     <div class="card card-body border-top-danger">
            <div class="card-heading">
                <h6 class="card-title text-semibold">
                    {{trans('dashboard.recent_activities')}}
                </h6>
            </div>
            <div class="row">
                @foreach($all_activities->chunk(10) as $chunk)
                <div class="col-sm-12">
                    <ul class="list-feed media-list">
                        @foreach($chunk as $activity)
                        <li class="media">
                            <div class="media-body">
                                <a href="{{url('admin/userprofiles/')}}/{{$activity->username}}" target="_blank">
                                    {{$activity->name}}
                                </a>
                                {{$activity->description}}
                            </div>
                            <div class="media-right">
                                <ul class="icons-list icons-list-extended text-nowrap">
                                   
                                    <li>
                                        <a href="{{url('admin/all_activities')}}">
                                            <i class="icon-circle-right2">
                                            </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            <hr class="mb-10 mt-10"/>
            <div class="text-center">
                <a class="btn btn-primary" href="{{url('admin/all_activities')}}">
                    <i class="icon-make-group position-left">
                    </i>
                    {{trans('dashboard.view_all_activities')}}
                </a>
            </div>
        </div>