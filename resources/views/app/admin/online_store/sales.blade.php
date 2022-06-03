@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop  {{-- Content --}} @section('main') 
@section('styles') 
@parent 

@endsection
@section('scripts')
@parent 

@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat">
    <div class="card-heading">
        <h5 class="card-title">{{trans('products.total_sales')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
      <div class="table-responsive">
    <table class="table datatable-basic table" id="sales-table" >
                            <thead>
                                <tr>
                                     <th>{{trans('products.invoice')}} ID</th>
                                    <th>{{trans('products.username')}}</th>
                                    <th>{{trans('products.shipping_address')}}</th>
                                    <!-- <th>Image</th> -->
                                    <!-- <th>Name</th> -->
                                    <th>{{trans('products.quantity')}}</th>
                                    <!-- <th>Unit price</th> -->
                                    <th>{{trans('products.total_price')}}</th>
                                    <th>{{trans('products.date')}}</th>
                                    <th>{{trans('products.invoice')}}</th>
                                    <!-- <th>View Invoice</th> -->

                                </tr>
                            </thead>
                        
                     </table>
                   </div>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent

@stop