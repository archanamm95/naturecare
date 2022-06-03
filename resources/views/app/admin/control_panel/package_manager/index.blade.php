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
                {{trans('controlpanel.package_manager')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">


             <div class="table-responsive">
             <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('packages.spot_plan_name') }} </th>
                                <th>BV</th>
                                <th>Product Count</th>
                              <!--   <th>{{ trans('packages.revenue_share_rs') }}</th>
                                <th>{{ trans('packages.binary_percentage') }} </th>                                
                                <th>{{ trans('packages.daily_pv_limit') }} </th>                  -->               
                            </thead>
                            <tbody>
                                @foreach($packages as $package)

                                <tr>
                                    <td>  <a class="packages" id="package{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_package_name')}} " data-name="package">
                                                
                                              {{$package->package}}  </a> </td>


                                    <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_points')}}" data-name="pv">
                                                
                                           {{$package->pv}} </a> </td>
                                    <td> <a class="packages" id="amount{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="Enter Product Count" data-name="product_count">
                                                
                                             {{$package->product_count}}  </a> </td>

<!--                                     <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_revenue_share')}}" data-name="rs">
                                                
                                           {{$package->rs}} </a> </td>
                                    <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_serial_code_count')}}" data-name="code">
                                                
                                           {{$package->code}} </a> </td>
                                     <td><a class="packages" id="pv{{$package->id}}" data-type='text' data-pk="{{$package->id}}" data-title="{{trans('controlpanel.enter_daily_pv_limit')}}" data-name="daily_limit">
                                                
                                           {{$package->daily_limit}} </a> </td>  -->

                                      <td>                                        
                                         <a href="{{url('admin/control-panel/package-manager/edit/'.$package->id)}}"> {{trans('controlpanel.view')}}/{{trans('controlpanel.edit')}} <i class="icon-play3 ml-2"></i></a>
                                        
                                       </td>


                                       

                                       

                                           
                                </tr> 



                                @endforeach
                                
                            </tbody>


                          </table>  
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

</script>
@stop
