@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-white">
    <div class="card-heading">
        <h5 class="card-title"><th>{{trans('products.my_order')}}</th></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <table class="table datatable-basic table-striped table-hover" id="user-cart">
                            <thead>
                                <tr>
                                    <th>{{trans('products.invoice')}} ID</th>
                                    <th>{{trans('products.order_date')}}</th>
                                    <th>{{trans('products.total_price')}}</th>
                                    <!-- <th>Bank Slip</th> -->
                                   <th>{{trans('products.payment_status')}}</th>
                                  <th>{{trans('products.invoice')}}</th>                          
                                </tr>
                            </thead>
                               
                        </table>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent

@stop