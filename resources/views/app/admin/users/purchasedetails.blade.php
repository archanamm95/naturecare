@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">   {{trans("users.purchase_details")}} </h5>
        <div class="heading-elements">
            <!-- <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul> -->
        </div>
    </div>


     @include('app.admin.users.userinfo')

     
      <div class="card card-body">
      
    <div class="table-responsive">
    <table  class="table  ">
         <thead class="">
            <tr  >
                <th>
                    {{trans('report.seller_name')}}
                </th>
                 <th>
                    {{trans('products.product')}}
                </th>
                <th>
                    {{trans('products.product_count')}}
                </th>
                <th>
                    {{trans('products.amount')}}
                </th>
                <th>
                    {{trans('report.date')}}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase as $pur)
       

            <tr class="">
                <td>
                    {{$pur->username}}
                </td>
                <td>
                    {{$pur->product_name}}
                </td>
                <td>
                  {{$pur->count}} 
                </td>
                <td>
                    {{currency(round($pur->total_amount))}}
                </td>
                <td>
                    {{$pur->created_at}}
                </td>
            </tr>
            @endforeach
             @if(count($purchase) == 0)  
      <tr>
       <td class="text-center" colspan="8"> {{trans('report.no_data_found')}}</td>
     </tr>   
       @endif
        </tbody>
       
    </table>
</div>

         
       


    </div>
</div>

 @stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop

