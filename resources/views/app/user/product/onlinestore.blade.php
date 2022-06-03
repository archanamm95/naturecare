@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('assets/globals/reg/parsley.css')}}" rel="stylesheet"/>
<style type="text/css">
.product-thumb .image {
text-align: center;
margin-top: 10px;
margin-bottom: 10px;
margin-bottom: 10px;
height: 90px;
}
.product-thumb {
border: 2px solid #ddd;
margin-bottom: 10px;
} 
.price {
background: none repeat scroll 0 0 #231f20;
color: #fff;
font-size: 16px;
font-weight: 700;
padding-bottom: 20px;
padding-top: 20px;
}
</style>
@endsection
{{-- Content --}}
@section('main')
@include('flash::message')
@include('utils.errors.list')
<div class="panel panel-success" data-sortable-id="ui-widget-11">
  <div class="panel-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9" >
          <div class="col-md-2">
            @foreach($product as $items)
            <img src="{{ url('images/'.$items->image) }}" alt="product" height="90" width="90"/>
            <h4>{{$items->name}}</h4>
            <p class="price">
              <span class="price-tax">Price : {{$items->price}}</span><br>                   
            </p>
            <form class="form-horizontal" action="{{url('user/add_to_cart')}}" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}"> 
              <input type="hidden" name="product_id" value="{{$items->id}}">
              <input type="text" class="form-control" id="cart_quantity"  name="cart_quantity" value="" style="width: 60px;"><br>
              <button type="submit" value="{{$items->id}}" class="addtocart btn-success"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Confirm</span></button><br><br>
            </form>
            @endforeach
          </div>
        </div>
          <div class="col-md-3" >
            @if($cart_amount >0)
            <table class="table table-hover">
              <tbody>
                @foreach($products as $key => $value)
                  <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->cart_quantity}}</td>
                    <td>
                      <a href="{{url('user/deletecart/'.$value->id)}}"><button class="btn btn-danger" >X</button></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
              <form class="form-horizontal" action="{{url('user/shippingaddress')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="1" name="option">Direct Delivery
                    </label>
                  </div>
                  <p>Total Amount : {{$cart_amount}}</p>
                </div>
                <button type="submit" value="{{$items->id}}" class="addtocart btn-success">Submit</button><br><br>
              </form>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts') @parent

<!-- Start JS Validation -->
<script src="{{asset('assets/globals/reg/parsley.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/globals/reg/bwizard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/globals/reg/form-wizards-validation.demo.min.js')}}" type="text/javascript"></script>
<!-- End JS Validation -->
<script type="text/javascript" src="{{asset('assets/globals/js/autosuggest.js')}}" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- <script>
$(document).ready(function() {
App.init(); 
});
</script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection