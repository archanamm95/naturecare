@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
@endsection

{{-- Content --}}
@section('main')
@include('utils.errors.list')

<div class="card card-flat timeline-content">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$sub_title}}</h4>
    </div>
    <div class="card-body"> 
        <form action="{{URL::to('admin/maintain-members')}}" method="post">
            <input type="hidden" name="_token"  value="{{csrf_token()}}">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-3">{{trans('report.choose_month')}}</label>
                    <div class="col-sm-6">
                        <div class="input-group">  
                            <!-- <input type="text" autocomplete="off" class="form-control daterange-single" name="start" id="start" value="{{ date('m/01/Y') }}" required="true"> -->
                            <!-- <label for="start" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label> -->
                            <select name="month" class="form-control">
                                <option @if($month == '01')selected @endif value='01'>Janaury</option>
                                <option @if($month == '02')selected @endif value='02'>February</option>
                                <option @if($month == '03')selected @endif value='03'>March</option>
                                <option @if($month == '04')selected @endif value='04'>April</option>
                                <option @if($month == '05')selected @endif value='05'>May</option>
                                <option @if($month == '06')selected @endif value='06'>June</option>
                                <option @if($month == '07')selected @endif value='07'>July</option>
                                <option @if($month == '08')selected @endif value='08'>August</option>
                                <option @if($month == '09')selected @endif value='09'>September</option>
                                <option @if($month == '10')selected @endif value='10'>October</option>
                                <option @if($month == '11')selected @endif value='11'>November</option>
                                <option @if($month == '12')selected @endif value='12'>December</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label class="form-label col-sm-3">{{trans('report.choose_type')}}</label>
                    <div class="col-sm-6">
                        <div class="input-group">  
                            <select name="type" class="form-control">
                                <option selected value="1">Weekly  ( 1 to 7)</option>
                                <option value="2">Monthly ( 8 to End)</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group col-sm-offset-6" >
                <button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>
            </div>
        </form>  
    </div>
</div> 
@endsection
@section('scripts') @parent
@endsection