@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection
@section('sidebar')
@parent
<!-- Secondary sidebar -->
@include('app.admin.control_panel.sidebar')
<!-- /secondary sidebar -->
@endsection


        {{-- Content --}}
        @section('main')

<div id="settings-page">
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light float-left">
                {{trans('controlpanel.product_manager')}}
            </h5>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#myModalProduct" title="Add Product" ><i class="icon-cart-add2" aria-hidden="true"></i></button>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
             </div>
                      <div class="modal fade" id="myModalProduct" role="dialog">
                       <div class="modal-dialog modal-xl">
                        <!-- Modal content-->
                        <div class="modal-content">
                         <div class="modal-header bg-primary">
                          <h5 class="modal-title">{{trans('packages.add_product')}}</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
                          <div class="modal-body">
                          <form class="form-horizontal" action="{{url('admin/control-panel/add-product')}}" method="post" enctype="multipart/form-data" name="form-wizard" onsubmit="return checkForm2(this);">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                            <input type="hidden" name="requestid" value="">
                            <div class="wizard-step-1">
                             <fieldset>
                              <div class="form-group">
                               <label for="name" class="col-sm-6 control-label">{{ trans('packages.product_name') }} </label>
                               <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" placeholder="{{trans('packages.enter_product_name')}}" name="name"  required>
                               </div>
                              </div>
                              <div class="form-group">
                               <label for="name" class="col-sm-6 control-label">SKU</label>
                               <div class="col-sm-12">
                                <input type="number" class="form-control" id="sku" placeholder="Enter SKU" name="sku"  required>
                               </div>
                              </div>
                            <div class="form-group">
                              <label for="name" class="col-sm-4 control-label">BV </label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="bv" placeholder="{{trans('packages.enter_quantity')}}" name="bv"  required min="1">
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="name" class="col-sm-4 control-label">Retail Price  </label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="price" placeholder="Enter Retail Price" name="price" min =0 required>
                                </div>
                            </div>  
                            <div class="form-group">
                              <label for="name" class="col-sm-4 control-label">Member Price  </label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="member_price" placeholder="Enter Member Price" name="member_price" min =0 required>
                                </div>
                            </div>   
                            <div class="form-group">
                              <label for="name" class="col-sm-4 control-label">Stock </label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="stock" placeholder="Enter Stock" name="stock" min =0 required>
                                </div>
                            </div>
                            <div class="form-group">
                            
                              <label for="name" class="col-sm-4 control-label">{{ trans('packages.image') }} </label>
                                <div class="col-sm-12">
                                  <input name="savefile" type="file" required>
                                </div>
                            </div>
                           </div>
                           <div class="modal-footer bg-link">
                            <button type="submit" class="btn btn-primary" name="add_product" id="add_product">{{trans('packages.add')}} </button>
                             <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('packages.close')}}</button>
                           </div>
                          </form>
                        </div>
                      </div>
                    </div>
                   </div>
        <div class="card-body bordered">


             <div class="table-responsive">
             <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('packages.product_name') }}</th>
                                <th>SKU</th>
                                <th>BV</th>
                                <th>{{ trans('wallet.retail_price') }}</th>
                                <th>{{ trans('wallet.member_price') }}</th>
                                <th>{{ trans('wallet.stock') }}</th>
                                <th>{{ trans('packages.image') }}</th>
                              <!--   <th>{{ trans('packages.revenue_share_rs') }}</th>
                                <th>{{ trans('packages.binary_percentage') }} </th>                                
                                <th>{{ trans('packages.daily_pv_limit') }} </th>                  -->               
                            </thead>
                            <tbody>
                                @foreach($products as $package)

                                <tr>
                                    <td>  <a class="packages" id="package{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_package_name')}} " data-name="package">
                                                
                                              {{$package->name}}  </a> </td>
                                    <td>  <a class="packages" id="package{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_package_name')}} " data-name="package">
                                                
                                              {{$package->sku}}  </a> </td>


                                    <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_points')}}" data-name="pv">
                                                
                                           {{$package->bv}} </a> </td>
                                    <td> <a class="packages" id="amount{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="Enter Product Count" data-name="product_count">
                                                
                                             {{$package->category_id}}  </a> </td>
                                    <td> <a class="packages" id="amount{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="Enter Product Count" data-name="product_count">
                                                
                                             {{$package->price}}  </a> </td> 
                                    <td> <a class="packages" id="amount{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="Enter Product Count" data-name="product_count">
                                                
                                             {{$package->quantity}}  </a> </td>
                                    <td> <button type="button"  class="btn btn-default" data-toggle="modal" data-target="#myModal{{$package->id}}"><svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#eye" /></svg></button> </td>
                                     <!-- Modal -->

        <div id="myModal{{$package->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">

      <!-- Modal content-->

        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body" style="overflow: auto !important;">

       <center> 

        <embed src="/uploads/documents/{{$package->image}}" style="width:400px; height:auto;" frameborder="0">
      
        </center>


        </div>                 
        </form>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
        </div>
        <script type="text/javascript">

        $("#myModal").on("hidden.bs.modal", function () {
        oTable.ajax.reload();
        })
        </script>
<!--                                     <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_revenue_share')}}" data-name="rs">
                                                
                                           {{$package->rs}} </a> </td>
                                    <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_serial_code_count')}}" data-name="code">
                                                
                                           {{$package->code}} </a> </td>
                                     <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_daily_pv_limit')}}" data-name="daily_limit">
                                                
                                           {{$package->daily_limit}} </a> </td>  -->

                                      <td>                                        
                                         <a href="{{url('admin/control-panel/product-manager/edit/'.$package->id)}}"> {{trans('controlpanel.view')}}/{{trans('controlpanel.edit')}} <i class="icon-play3 ml-2"></i></a>
                                        
                                       </td>


                                       

                                       

                                           
                                </tr> 



                                @endforeach
                                
                            </tbody>


                          </table>  
                      </div>

           



        </div>
    </div>
</div>

@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">

</script>
@stop
