 <div class="card card-body">
                    <div class="card-heading">
                        <h6 class="card-title">
                            {{trans('dashboard.recent_plan_top_up')}}
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>
                                        {{trans('dashboard.username')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.plan')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.count')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.date')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent as $item)
                                <tr>
                                    <td>
                                        <a href="{{url('admin/userprofiles/')}}/{{$item->username}}" target="_blank">
                                            {{$item->username}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$item->package }}
                                    </td>
                                    <td>
                                        {{$item->count }}
                                    </td>
                                    <td>
                                        {{date('d M Y H:i:s',strtotime($item->created_at)) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>