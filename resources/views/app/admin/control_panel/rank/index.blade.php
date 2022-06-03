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


<?php use App\Ranksetting; ?>
<div id="settings-page">
    <div class="card card-flat">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
            {{trans('controlpanel.rank_settings')}}
            </h5> <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
             {!! Form::model($options,['url' => '/admin/control-panel/rank-settings', 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>

            <fieldset>
                <legend class="text-uppercase font-size-sm font-weight-bold">
                     {{trans('controlpanel.rank_settings')}}
                </legend>


                <div class="table-responsive">
                 <table class="table table-hover">
                            <thead>
                                <!-- <th>{{ trans('settings.no') }}</th> -->
                                <th style="width: 22%;">{{ trans('settings.rank_name') }}</th>
                                <th>{{ trans('settings.left_count') }} </th>
                                <th>{{ trans('settings.right_count') }} </th>
                                <th>{{ trans('settings.direct_refferal_left') }}</th>
                                <th>{{ trans('settings.direct_refferal_right') }}</th>
                                <th>{{ trans('settings.direct_refferal_rank') }}</th>
                            </thead>
                            <tbody>
                                @foreach($settings as $rank)
                                <tr>
                                    <!-- <td> {{$rank->id}}</td> -->
                                    <td>
                                        <div class="form-group ">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="rank_name[{{$rank->id}}]" value="{{$rank->rank_name}}" >
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group ">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="quali_rank_id[{{$rank->id}}]" value="{{$rank->quali_rank_id}}" id="quali_rank_id">
                                        </div>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="form-group ">
                                        <div class="input-group">
                                            <input class="form-control" type="number" name="quali_rank_count[{{$rank->id}}]" value="{{$rank->quali_rank_count}}" id="quali_rank_count">   
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group ">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="left_puser_count[{{$rank->id}}]" value="{{$rank->left_puser_count}}" id="quali_rank_id">
                                        </div>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="form-group ">
                                        <div class="input-group">
                                            <input class="form-control" type="number" name="right_puser_count[{{$rank->id}}]" value="{{$rank->right_puser_count}}" id="quali_rank_count">   
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group ">
                                        <div class="input-group">
                                            <select class="form-control" type="number" name="top_up[{{$rank->id}}]" id="quali_rank_count">
                                                    <option @if($rank->top_up == 0 )selected @endif value="0">Any Rank</option>
                                                @foreach($settings as $ra)
                                                    <option @if($ra->id == $rank->top_up)selected @endif value="{{$ra->id}}">{{$ra->rank_name}}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>    

                        </table>

</div>
            
            </fieldset>
                </div>

            <div class="row" align="right">
                <div class="col-md-12">
                    <div class="col-md-4" align="center">
                        <button class="btn bg-dark" type="submit" style="margin-bottom: 20px;"> {{trans('controlpanel.save')}}</button>
                    </div>
                    <div class="col-md-8"></div>
                </div>
            </div>
                   

{!! Form::close() !!}


        <!-- </div> -->
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
