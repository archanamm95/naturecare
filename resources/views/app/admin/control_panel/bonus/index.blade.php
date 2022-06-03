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
                {{trans('controlpanel.leadership_management')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">


             <div class="table-responsive">
             <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('packages.package') }} </th>
                                <th>{{ trans('packages.level_1') }}</th>
                                <th>{{ trans('packages.level_2') }}</th>
                                <th>{{ trans('packages.level_3') }}</th>
                                                               
                            </thead>
                            <tbody>
                                @foreach($settings as $item)

                                <tr>
                                    <td>  {{$item->package}}  </td>

                                    <td> <a class="leadership" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title=" {{trans('controlpanel.enter_level_1')}}" data-name="level_1">
                                                
                                             {{$item->level_1}}  </a> </td>

                                    <td><a class="leadership" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('controlpanel.enter_level_2')}}" data-name="level_2">
                                                
                                            {{$item->level_2}} </a> </td>

                                         
                                    <td><a class="leadership" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('controlpanel.enter_level_3')}}" data-name="level_3">
                                                
                                           {{$item->level_3}} </a> </td>
                                    

                                      <td>                                        
                                         <a href="{{url('admin/control-panel/bonus-settings/edit/'.$item->id)}}"> {{trans('controlpanel.view')}}/{{trans('controlpanel.edit')}} <i class="icon-play3 ml-2"></i></a>
                                        
                                       </td>


                                       

                                       

                                           
                                </tr> 



                                @endforeach
                                
                            </tbody>


                          </table>  
                      </div>

           



        </div>
    </div>




     <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('packages.matching_bonus')}}
            </h5>
        </div>
        <div class="card-body bordered">


             <div class="table-responsive">
             <table class="table table-striped">
                            <thead> 
                                <th>{{trans('packages.position_title')}}</th>
                                <th> {{trans('controlpanel.p')}}{{trans('controlpanel.v')}} %</th>
                                                               
                            </thead>
                            <tbody>
                                @foreach($matching_bonus as $matching)

                                <tr>
                                    <td>  {{$matching->package}}  </td>

                                    <td> <a class="matching" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('controlpanel.enter_matching_bonus_pv')}}" data-name="pv">
                                                
                                            {{$matching->pv}}  </a> </td>


                                    <td> <a href="{{url('admin/control-panel/bonus-settings/matchingbonus/edit/'.$matching->id)}}"> {{trans('controlpanel.view')}}/{{trans('controlpanel.edit')}} <i class="icon-play3 ml-2"></i></a> </td>


                                       

                                       

                                           
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
