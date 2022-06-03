
 <div class="card card-body">
                    <div class="card-heading">
                        <h6 class="card-title">
                            {{trans('dashboard.Pool_details')}}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>
                                        {{trans('dashboard.total_bv')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.total_sale')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.pool_bonus')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.qualified_user_count')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.share_amount')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.date')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pool_history as $item)
                                <tr>
                                    <td>
                                        {{$item->total_bv}}
                                    </td>
                                    <td>
                                        {{$item->total_count }}
                                    </td>
                                    <td>
                                        {{$item->poolbonus }}
                                    </td>
                                     <td>
                                        {{$item->qualified_user_count }}
                                    </td>
                                    <td>
                                        {{$item->share_amount }}
                                    </td>
                                    <td>
                                        {{date('d M Y ',strtotime($item->created_at)) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>