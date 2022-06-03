@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
@endsection
{{-- Content --}}
@section('main')



<div class="card card-flat" >
                        <div class="card-header">
                            
                            <h4 class="card-title">{{trans('voucher_request.view_voucher_requests')}}</h4>
                        </div>
                        <div class="card-body">
                        	<div class="table-responsive">
							<table class="table table-sm">
							@if($voucher_count > 0)
								<thead class="">
									<tr>
										<th>{{trans('voucher_request.username')}}</th>
										<th>{{trans('voucher_request.voucher_amount')}}</th>
										<th>{{trans('voucher_request.count')}}</th>
										<th>{{trans('voucher_request.total_amount')}}</th>
										<th>{{trans('voucher_request.request_date')}}</th>
										<th>{{trans('voucher_request.approve')}}</th>
										<th>{{trans('voucher_request.delete')}}</th>
									</tr>
								</thead>
								<tbody>						
									
									@foreach($vocherrquest as $request)
									<tr class="text-bold">
									<td class="sorting_1">{{$request->username}}</td>
									<td>{{currency($request->amount)}}</td>
									<td>{{$request->count}}</td>
									<td>{{currency($request->total_amount)}}</td>
									<td>{{$request->created_at}}</td>
									<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{{$request->id}}"><i class="icon-check"></i></button>

									  <!-- Modal -->
									  <div class="modal fade" id="myModal{{$request->id}}" role="dialog">
									    <div class="modal-dialog modal-sm">
									    
									      <!-- Modal content-->
									      <div class="modal-content">
									      	 <div class="modal-header bg-success">
                                              <h5 class="modal-title">{{trans('voucher_request.edit_request')}}</h5>
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
									        <div class="modal-body">
									         <div class="row">
									       
											 <div class="col-sm-4">
									          {{trans('voucher_request.username')}}
									          </div>
									          <div class="col-sm-8">
									           {{$request->username}}
									           </div>
									         
									       </div>
										          <form action="{{URL::to('admin/vouchercreate')}}" method="post">
												<input type="hidden" value="{{csrf_token() }}" name="_token">
												<input type="hidden" value="{{$request->id}}" name="requestid">
													
													<br>
													<div class="row">
													<div class="col-sm-4">
													  {{trans('voucher_request.amount')}}
													</div>
													<div class="col-sm-8">
														<input type="number" class="form-control" value="{{$request->amount}}" name="amount" min="1">
														</div>                                     
													</div>
													<br>
													<div class="row">
													<div class="col-sm-4">
														{{trans('voucher_request.count')}}
														</div>
														<div class="col-sm-8">

														<input type="number" class="form-control" value="{{$request->count}}" name="count" min="1">
														</div>                                     
													
													</div>
													<br>
													
													
											
									        </div>
									        <div class="modal-footer">

													
												<button type="submit" class="btn btn-success" name="submit">{{trans('voucher_request.approve')}} </button>
												
									         <button type="button" class="btn btn-link" data-dismiss="modal">{{trans('voucher_request.close')}}</button>
									        </div>
									        </form>
									      </div>
									      
									    </div>
									  </div>
									  
									</td>
									<td>


											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_theme_danger-{{$request->id}}"><i class="icon-trash"></i></button>




                              <!-- Danger modal -->
                <div id="modal_theme_danger-{{$request->id}}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h6 class="modal-title">{{trans('voucher_request.delete_request')}}?</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                             
								<form action="{{URL::to('admin/voucherdelete')}}" method="post">
								<input type="hidden" value="{{csrf_token() }}" name="_token">
								<input type="hidden" value="{{$request->id}}" name="requestid">
                                <div class="modal-body">
                                    <h6 class="font-weight-semibold">{{trans('all.are_you_sure_you_want_to_delete')}}?</h6>
                                    <p>{{trans('voucher_request.username')}} {{$request->username}}</p>

                                    <hr>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-dismiss="modal">{{trans('voucher_request.close')}}</button>
                                    <button type="submit" class="btn bg-danger"> {{trans('all.delete')}}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /default modal -->



									 
									</td>
									</tr>
									@endforeach
									@else
										{{trans('voucher_request.there_is_no_voucher_requests_yet')}} !!
							@endif
								</tbody>
						</table>
					</div>
 
    					</div>  
</div>      

 {!! $vocherrquest->render() !!}



  
@stop
