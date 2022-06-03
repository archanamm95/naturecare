
@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->

<div class="row">
     
    
    @foreach($stock as $key=>$data)
   
    <div class="col">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{round($data->balance,2)}}</h3>
                <div class="text-muted text-size-small">
                 {{ucwords(str_replace('_',' ',$data->Products))}} 
                </div>
            </div>
        </div>
    </div>
    
    @endforeach
</div>

<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
      <h5 class="card-title"> {{trans('products.stock_history')}}</h5>
        <!-- <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div>
    <table class="table datatable-basic table-striped table-hover" id="stock-user-table">
    <thead>
        <tr>
            <th><b>
                {{trans('products.product_name')}}</b>
            </th>
            <th><b>
                {{trans('products.in')}}</b>
            </th>
       
            <th><b>
                {{trans('products.out')}}</b>
            </th>
       
            <th><b>
                {{trans('products.balance')}}</b>
            </th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($stock as $key=>$data)
            <tr>
                <td>{{ucwords(str_replace('_',' ',$data->Products))}} </td>
                <td>{{$data->in}}</td>
                <td>{{$data->out}}</td>
                <td>{{$data->balance}}</td>
            </tr>  
        @endforeach              
    </tbody>
  </table>
 </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop