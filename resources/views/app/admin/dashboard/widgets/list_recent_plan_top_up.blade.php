 <div class="card card-body">
                    <div class="card-heading">
                        <h6 class="card-title">
                            {{trans('dashboard.Recent Sales')}}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>
                                        {{trans('dashboard.order_id')}}
                                    </th>
                                    <th>
                                        {{trans('dashboard.Buyer')}}
                                    </th>
                                    
                                    <th>
                                        {{trans('dashboard.Seller')}}
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
                                       # {{$item->invoice_id}}
                                    </td>
                                    <td>
                                        <a href="{{url('admin/userprofiles/')}}/{{$item->username}}" target="_blank">
                                            {{$item->username}}
                                        </a>
                                    </td>
                                    
                                    <td>
                                        {{$item->sponsorusername}}
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
                </div>