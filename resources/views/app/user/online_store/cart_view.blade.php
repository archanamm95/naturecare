@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('assets/globals/reg/parsley.css')}}" rel="stylesheet"/>

<style type="text/css">
 .panelstyle{
  padding: 60px 20px;
    background: #f8f9f9;
    color: #0c4e79;
    text-align: center;
    font-size: 123%;
    margin-bottom: 20px;
 }
</style>
  
@endsection
{{-- Content --}}
@section('main')
    
@include('flash::message')

@include('utils.errors.list')

<div class="card card-success" data-sortable-id="ui-widget-11">
    <div class="card-heading">
       
          <h4 class="card-title" style="padding: 20px">{{trans('all.cart_products')}}</h4>  
    </div>
    
    <div class="card-body">
        @if($total_price->total_price > 0)
        <div class="table-responsive">
      <table class="table " id="viewcart">
        <thead class="headerfooter">
          
        <th><b>{{trans('all.product')}}</th>
        <!-- <th></th> -->
        <th><b>{{trans('all.quantity')}}</th>
        <th><b>{{trans('all.price')}}</th>
        <th><b>{{trans('all.total')}}</th>
        <th></th>

        </thead>
        <tbody>
          @foreach($data as $key=>$value)
          <tr> 

            <td><img src="/uploads/documents/{{$value->image}}" height="50" width="50"/>
              <strong>{{$value->name}}</strong>
            </td>

            <!-- <td align="left"><strong>{{$value->name}}</strong><br><br> -->
             <!-- </td> -->

            <td>
              <form class="form-horizontal" action="{{url('user/updatecart')}}" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}"> 
              <input type="hidden" name="requestid" value="{{$value->id}}">
                <div class="row">
                  <div class="col-sm-12 col-xs-12 col-md-3">
                    <input type="number" class="form-control" id="cart_quantity" placeholder="{{$value->cart_quantity}}" name="cart_quantity" value="{{$value->cart_quantity}}" min = 1 required="">
                  </div>
                  <div class="col-sm-12 col-xs-12 col-md-3">
                  <button type="submit" class="btn-success"><i class="icon-checkmark4" aria-hidden="true"></i></button>
                </div>
                </div>
              </form>
            </td>

            <td> {{$value->price}} </td>
            <td> {{$value->cart_quantity*$value->price}} </td>
            <td><a href="{{url('user/deletecart/'.$value->id)}}" ><i title="Remove" class="fa fa-times-circle-o   fa-2x"  ></i></a></td>
            
          </tr>
          @endforeach
        
           <tr>
            <td></td>
            <td></td>
            <td>{{trans('all.total_price')}}</td>
          
            <td><b>{{$total_price->total_price}}<b></td>
            <td></td>
          </tr>  
            @else
        <span class="hidden-xs hidden-sm hidden-md"><p class="panelstyle">{{trans('all.your_cart_is_empty')}}</p></span>
       @endif


          <tr>
            <td><a href="{{url('user/onlinestore')}}"><button type="button" title="shop" class="btn btn-success" align="left"><i class="fa fa-shopping-cart" aria-hidden="true"> {{trans('all.back_to_shop')}}</i></button></a></td>
            <td></td>
            <td></td>
           @if($total_price->total_price > 0)
            <td><a href="{{url('user/clearcart')}}"><button type="button" title="clear" class="btn btn-success" align="left"><i class="fa fa-eraser" aria-hidden="true"></i>{{trans('all.clear')}}</button></a></td>
            <td><a href="{{url('user/shippingaddress')}}"><button type="button" title="checkout" class="btn btn-success" align="left"><i class="fa fa-eraser" aria-hidden="true"></i>{{trans('all.checkout')}}</button></a></td>
            @endif
          </tr>                  
         
        </tbody>
      </table>
    </div>
    </div>
</div>
            
@endsection
@section('scripts') @parent

<!-- Start JS Validation -->

<!-- End JS Validation -->







@endsection