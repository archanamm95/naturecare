<div class="row">
    <div class="col-sm-12">
        <div class="card card-flat border-top-success">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">{{trans('dashboard.Top Recruiters')}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <!-- <tr>
                                <th>User</th>
                                <th>Followers Count</th>
                                <th></th>
                            </tr> -->
                        </thead>
                        <tbody>
                            @foreach($top_recruiters as $user)
                            <tr>
                                <td class="w-100">
                                    <div class="media">
                                        <div class="mr-3">
                                            <a href="{{url('admin/userprofiles/')}}/{{$user->username}}">
                                                {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $user->profile]), $user->username, array('class' => 'rounded','width'=>'38','height'=>'38')) }}
                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <div class="media-title font-weight-semibold">{{$user->name}}</div>
                                            <span class="text-muted">{{$user->username}}</span>
                                        </div>

                                        <div class="ml-3 align-self-center">
                                            <span class="badge bg-success border-success">{{$user->count}}</span>
                                        </div>
                                    </div>


                                </td>
                                <td>
                                    <a href="{{url('/admin/sponsortree?st='.$user->username)}}" target="_blank"
                                        class="btn btn-info btn-labeled btn-labeled-right">
                                        {{trans('dashboard.tree')}}
                                        <b><i class="icon-tree7"></i></b>
                                    </a>
                                    <a href="{{url('/admin/userprofiles',$user->username )}}" target="_blank"
                                        class="btn btn-success btn-labeled btn-labeled-right">
                                        {{trans('dashboard.profile')}}
                                        <b><i class="icon-vcard"></i></b>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>