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
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.currency')}} : {{trans('controlpanel.add')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <form action="{{ url('admin/control-panel/currency-manager/add')}}" method="post" onsubmit="return checkForm(this);">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-6">{{trans('currency.currency_name')}}</label>
                    <div class="col-sm-6">
                        
                        <input type="text" autocomplete="off" class="form-control " name="name" id="name" required="">
                        
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-6">{{trans('currency.currency_code')}}</label>
                    <div class="col-sm-6">
                        
                        <input type="text" autocomplete="off" class="form-control " name="code" id="code"required="" >
                        
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-6">{{trans('currency.symbol')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="symbol" id="symbol" required="">
                        
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-6">{{trans('currency.format')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="format" id="format" required="">
                        
                        
                    </div>
                </div>
                
                
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-6">{{trans('currency.exchange_rate')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="exchange_rate" id="exchange_rate" required="">
                        
                        
                    </div>
                </div>
                
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-3">{{trans('currency.active')}}</label>
                    <div class="col-sm-6">
                        <input type="number" autocomplete="off" min="0" max="1" class="form-control " name="active" id="active" required="">
                        
                        
                    </div>
                </div>
                
            </div>
            
            <div class="form-group col-sm-offset-6">
                <button type="submit" class="btn btn-primary" name="add_currency" id="add_currency">{{trans('currency.add_currency')}} </button>
            </div>
        </form>


              
                
            </div>    
        </div>
    </div>  

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.currency')}} : {{trans('controlpanel.list')}}
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
              <form id="settings">
                <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>{{trans('currency.name')}}</th>
                    <th>{{trans('currency.code')}}</th>
                    <th>{{trans('currency.symbol')}} </th>
                    <th>{{trans('currency.format')}} </th>
                    <th>{{trans('currency.exchange_rate')}}</th>
                    <th>{{trans('currency.active')}}</th>
                    <th>{{trans('currency.action')}}</th>
                </thead>
                <tbody>
                    @foreach($settings as $item)
                
                    <tr>
                        <td>  <a class="currency" id="package{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('controlpanel.enter_currency_name')}}" data-name="name">
                            
                            {{$item->name}}  </a>   @if($item->id == 1) <span>(Default)</span>   @endif </td>
                            <td> <a class="currency" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('controlpanel.enter_currency_code')}}" data-name="code">
                                
                            {{$item->code}}  </a> </td>
                            

                            <td><a class="currency" id="{{$item->id}}" data-pk="{{$item->id}}" data-type='text' data-title="{{trans('controlpanel.enter_symbol')}}" data-name="symbol">
                                
                            {{$item->symbol}}</a> </td>

                            <td><a class="currency" id="{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title="{{trans('controlpanel.enter_format')}}" data-name="format">                            
                            {{$item->format}} </a> </td>

                            <td><a class="currency" id="{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title="{{trans('controlpanel.enter_exchange_rate')}}" data-name="exchange_rate">
                            {{$item->exchange_rate}} </a> </td>                            
                            <td><a class="currency" id="{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title="{{trans('controlpanel.enter_active')}}" data-name="active">
                            {{$item->active}} </a> </td>
                            <td>
                                @if($item->id > 1)
                                <a href="{{url('admin/control-panel/currency-manager/delete/'.$item->id) }}" class="btn btn-danger">
                                    <i class="fa fa-trash" > </i> {{trans('currency.delete')}}
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                </div>
                
            </form>
        
              
                
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


    function checkForm(form)
 {
  
   form.add_currency.disabled = true;
  
   return true;
 }

</script>
@stop

