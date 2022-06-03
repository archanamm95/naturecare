 <div class="card card-body">
                    <div class="card-heading">
                        <h6 class="card-title">
                           {{trans('products.recent_purchases')}}
                        </h6>
                    </div>
                    <div class="card-body">
                         <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>
                                       {{trans('products.invoice')}}
                                    </th>
                                    <th>
                                        {{trans('products.username')}}
                                    </th>
                                    <th>
                                        {{trans('products.ship')}}
                                    </th>
                                    <th>
                                        {{trans('products.price')}}
                                    </th>
                                    <th>
                                        {{trans('products.status')}}
                                    </th>
                                    <th>
                                        {{trans('products.date')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                <tr>
                                    <td>
                                        
                                            #{{$item->invoice}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$item->username }}
                                    </td>
                                    <td>
                                        {{$item->shipping_country }}
                                    </td>
                                     <td>
                                        {{$item->total_amount }}
                                    </td>  
                                    <td>
                                        {{$item->status }}
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