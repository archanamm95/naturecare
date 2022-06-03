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
      <h5 class="mb-0 font-weight-light">{{trans('packages.category_management')}}</h5>
      <div class="text-right d-lg-none w-100">
            <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
      </div>
    </div>
    <div class="card-body bordered">
      <div class="heading-elements ">
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal" title="add category" ><i class="icon-cart-add" aria-hidden="true"></i>Add</button>
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title">{{trans('packages.add_category')}}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form action="{{URL::to('admin/control-panel/category')}}" method="post" onsubmit="return checkForm1(this);">
                <div class="modal-body">
                    <input type="hidden" value="{{csrf_token() }}" name="_token">
                      <div class="row">
                        <div class="col-sm-4">
                             {{trans('packages.category_name')}}
                        </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" value="" name="name" required="" placeholder="{{trans('packages.enter_category_name')}}">
                        </div>                                     
                      </div>
                      <div class="row">
                        <div class="col-sm-4">{{trans('packages.status')}}</div>
                        <div class="col-sm-8">
                          <select class="form-control chosen-select" name="status" id="status" required="true">
                            <option value="yes" selected="">{{trans('packages.enable')}}</option>
                            <option value="no">{{trans('packages.disable')}}</option>
                          </select>
                        </div>                                     
                      </div>
                </div>
                <div class="modal-footer">

                  <button type="submit" class="btn btn-primary" name="add_cat" id="add_cat">{{trans('packages.add')}} </button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('packages.close')}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead> 
            <th>{{ trans('packages.no') }} </th>
            <th>{{ trans('packages.category') }}</th>
            <th>{{ trans('packages.status') }}</th>
            <th></th>
          </thead>
          <tbody>
            @foreach($category as $key=>$item)

            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->category_name}}</td>
              <td>@if($item->status == 'yes') {{trans('packages.enable')}}  @else {{trans('packages.disable')}}  @endif </td>
              <td>                                        
                  <a href="{{url('admin/control-panel/category-edit/'.$item->id)}} "  class="btn btn-primary" title="{{trans('packages.view_or_edit')}}"> {{trans('packages.view')}}/{{trans('packages.edit')}} <i class="icon-play3 ml-2"></i></a>
                  <a href="{{url('admin/control-panel/category-delete/'.$item->id)}}" class="btn btn-danger"title="{{trans('packages.delete')}}"> <i class="icon-bin"></i></a>
                </td>
            </tr> 

            @endforeach         
          </tbody>
        </table>  
      </div>
    </div>
  </div>

   <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('packages.product_management')}}
            </h5>
        </div>
        <div class="card-body bordered">
          <div class="heading-elements ">
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#myModalProduct" title="{{trans('packages.add_product')}}" ><i class="icon-cart-add2" aria-hidden="true"></i></button>


              
                      <div class="modal fade" id="myModalProduct" role="dialog">
                      <div class="modal-dialog modal-sm">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header bg-primary">
                                              <h5 class="modal-title">{{trans('packages.add_product')}}</h5>
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                          <div class="modal-body">
                           <div class="row">
                         
                     
                           
                         </div>
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
                    
                      <label for="name" class="col-sm-6 control-label">{{ trans('packages.description') }}</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="description" placeholder="{{trans('packages.enter_description')}}" name="description"  required>
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-4 control-label">{{ trans('packages.category') }}</label>
                        <div class="col-sm-12">
                         
                            <select class="form-control chosen-select" name="category" id="category" required="">
                            <option value="">{{trans('packages.select_category')}}</option>
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-4 control-label">{{ trans('packages.quantity') }} </label>
                        <div class="col-sm-12">
                          <input type="number" class="form-control" id="quantity" placeholder="{{trans('packages.enter_quantity')}}" name="quantity"  required min="1">
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-4 control-label">{{ trans('packages.price') }}  </label>
                        <div class="col-sm-12">
                          <input type="number" class="form-control" id="price" placeholder="{{trans('packages.enter_price')}}" name="price" min =0 required>
                        </div>
                    </div>
                      <div class="form-group">
                    
                      <label for="name" class="col-sm-4 control-label">{{ trans('packages.status') }}  </label>
                        <div class="col-sm-12">
                            <select class="form-control chosen-select" name="status" id="status" required="true">
                            <option value="yes" selected="">{{trans('packages.yes')}}</option>
                            <option value="no">{{trans('packages.no')}}</option>
                            </select>
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

                     
             <div class="table-responsive">
            
                <table class="table table-invoice" id = "producttable">
                            <thead> 
                                <th>{{ trans('packages.no') }} </th>
                                <th>{{ trans('packages.product') }}</th>
                                <th>{{ trans('packages.name') }}</th>
                                <th>{{ trans('packages.description') }}</th>
                                <th>{{ trans('packages.category') }}</th>
                                <th>{{ trans('packages.quantity') }}</th>
                                <th>{{ trans('packages.price') }}</th>
                                <th>{{ trans('packages.status') }}</th>
                                <th>{{ trans('packages.action') }}</th>
                         
                                                               
                            </thead>
                            <tbody>
                                @foreach($products as $key=>$item)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><img src="{{url('products/'.$item->image)}}" height="50" width="50"/></td>
                                    <td> {{$item->name}}   </td>
                                    <td> {{$item->description}}  </td>
                                    <td>@php $flag = 0; @endphp
                                      @foreach($category as $categories)
                                        @if($categories->id == $item->category_id) 
                                        {{$categories->category_name}}
                                        @php $flag = 1; @endphp
                                        @endif
                                      @endforeach 
                                      @if($flag == 0)
                                        Deleted Category
                                      @endif
                                 </td>
                       
                        
                                <td>{{$item->quantity}} </td>
                                <td>{{$item->price}} </td>
                                <td>{{$item->status}}  </td>
                                <td> 
                                    <a href="{{url('admin/control-panel/product-edit/'.$item->id)}} "  class="btn btn-primary" title="{{trans('packages.view')}}/{{trans('packages.edit')}}"> {{trans('packages.view')}}/{{trans('packages.edit')}} <i class="icon-play3 ml-2"></i></a>
                                    <a href="{{url('admin/control-panel/delete-product/'.$item->id) }}" class="btn btn-danger" title="{{trans('packages.delete')}}"> <i class="icon-bin" > </i></a> 
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




  

@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
 
<script>
function checkForm1(form)
{
 
 
  form.add_cat.disabled = true;
  return true;
}
function checkForm2(form)
{
 
  form.add_product.disabled = true;
  return true;
}
 </script>
@stop
