@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop  {{-- Content --}} @section('main') 
@section('styles') 
@parent 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('assets/globals/reg/parsley.css')}}" rel="stylesheet" />
@endsection
@section('scripts')
@parent 
@endsection
{{-- Content --}}
@section('main')
@include('utils.errors.list')
@include('flash::message')
<div class="panel panel-flat" >
    <div class="panel-body"> 
        <p align="center" >
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add New Product</button>
        </p>
        <div class="container" style="text-align: left;">   
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="col-md-12" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Product</h4>
                  </div>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="{{url('admin/product/add')}}" method="post" enctype="multipart/form-data" name="form-wizard">
                   <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                   <input type="hidden" name="requestid" value="">

                    <div class="wizard-step-1">
                    <fieldset>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-3 control-label">Product Name <span style="color:red">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name"  required>
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-3 control-label">Description <span style="color:red">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="description" placeholder="Enter description" name="description"  required>
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-3 control-label">quantity <span style="color:red">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity"  required>
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-3 control-label">price <span style="color:red">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="price" placeholder="Enter price" name="price"  required>
                        </div>
                    </div>
                    <div class="form-group">
                    
                      <label for="name" class="col-sm-3 control-label">Image <span style="color:red">*</span></label>
                        <div class="col-sm-7">
                          <input name="savefile" type="file" required>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="create" class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-primary" style="margin-left: 60px">Create Product</button>
                        </div>
                    </div>

                    </fieldset>
                    </div>
                  </form>
                </div>           
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="panel panel-flat" >
    <div class="panel-heading">
    <h4 class="panel-title">{{trans('products.products_management')}} </h4> 
        <div class="heading-elements"> 
            <button id="enable" type="submit" class="btn btn-primary">{{trans('products.enable_edit_mode')}}</button>
        </div>
    </div>
    <div class="panel-body"> 
        <form id="settings">  
            <table class="table table-striped">
                <thead> 
                    <th>Image</th>
                    <th>Product Name </th>
                    <th>Description </th>
                    <th>quantity </th>
                    <th>price </th>
                </thead>
                <tbody>
                @foreach($settings as $item)
                    <tr>
                        <td><img src="{{ url('/images/'.$item->image) }}" height="50" width="50"/></td>
                        <td>  <a class="settings" id="pricepackage{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter Products name' data-name="name">{{$item->name}}  </a> </td>
                        <td> <a class="settings" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter description ' data-name="description">{{$item->description}}  </a> </td>
                        <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter quantity' data-name="quantity">{{$item->quantity}} </a> </td>
                        <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter price' data-name="price">{{$item->price}} </a> </td>
                        <td> <a href="{{url('admin/product/delete/'.$item->id) }}" class="btn btn-danger"> 
                        <i class="fa fa-trash" > </i> {{trans('products.delete')}}
                        </a> </td>
                    </tr> 
                @endforeach
                </tbody>
            </table>                           
        </form>
    </div>
</div>
@endsection
@section('scripts') @parent
<script src="{{asset('assets/globals/reg/parsley.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/globals/reg/bwizard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/globals/reg/form-wizards-validation.demo.min.js')}}" type="text/javascript"></script>
<!-- End JS Validation -->
<script type="text/javascript" src="{{asset('assets/globals/js/autosuggest.js')}}" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('assets/admin/js/product-editable.js') }}"></script>
<script>
$(document).ready(function() {
App.init();           
});
</script>
@endsection