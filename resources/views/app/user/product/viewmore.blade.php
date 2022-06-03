@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('assets/globals/reg/parsley.css')}}" rel="stylesheet"/>

<style type="text/css">
.product-thumb {
   text-align: right;
   margin-right: 20px;
   height: 20px;
} 
</style>
  
@endsection
{{-- Content --}}
@section('main')
    
      @include('flash::message')

      @include('utils.errors.list')

  <div class="panel panel-success" data-sortable-id="ui-widget-11">
  <br>
    <div class="product-thumb transition">
        <a href="javascript:;" onclick="window.print()" class="btn btn-md btn-success m-b-10">
          <i class="fa fa-print m-r-5"></i>print
        </a>
    </div>
  <br>

    <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Invoice ID</th>
              <th>List Products</th>
              <th>Unit Order</th>
            </tr>
          </thead>
          <tbody>
          @foreach($product as $key=>$items)
       
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$items->invoice_id}}</td>
              <td>
              @foreach($product_list as $products)
                @if($products->order_id == $items->order_id)
                  {{$products->name}}<br/>
                @endif
              @endforeach 
              </td>
              <td>
              @foreach($product_list as $productslist)
                @if($productslist->order_id == $items->order_id)
                  {{$productslist->count}}<br/>
                @endif
              @endforeach 
              </td>
            </tr>
           
          @endforeach
          </tbody>
        </table>
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
<script type="text/javascript">
  $('select').select2();
</script>
<script>
        // $(document).ready(function() {
            // App.init();           
        // });
</script>

@endsection