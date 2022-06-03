@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
@endsection

{{-- Content --}}
@section('main')

      @include('utils.errors.list')

<div class="card card-flat timeline-content">
                    <div class="card-header header-elements-inline">
                        <h4 class="card-title">{{trans('report.joining_report')}}</h4>
     </div>
     <div class="card-body"> 
     <form action="{{URL::to('admin/joiningreport')}}" method="post">
     	<input type="hidden" name="_token"  value="{{csrf_token()}}">
          <input type="hidden" name="type"  value="normal">
     	<div class="row">
     		<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-6">{{trans('report.pick_start_date')}}</label>
	     		<div class="col-sm-6">
	     			<div class="input-group">  
	     				<input type="text" autocomplete="off" class="form-control daterange-single" name="start" id="start" value="{{ date('m/01/Y') }}"  required="true">
                        <label for="start" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>
                                    <!-- <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span> -->
	     			</div>
	     		</div>
	     	</div>


	     	<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-6">{{trans('report.pick_end_date')}}</label>
	     		<div class="col-sm-6">
	     			<div class="input-group"> 
	     				<input type="text" autocomplete="off" class="form-control daterange-single" name="end" id="end" value="{{ date('m/t/Y') }}"   required="true">
                        <label for="end" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>
	     				  <!-- <span class="input-group-prepend"> -->
                                            <!-- <span class="input-group-text"><i class="icon-calendar22 "></i></span> -->
                                        <!-- </span> -->
	     		
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

<div class="card card-flat timeline-content">
                    <div class="card-header header-elements-inline">
                        <h4 class="card-title">{{trans('report.joining_report_by_sponsor')}}</h4>
     </div>
   <div class="card-body"> 
     <form action="{{URL::to('admin/joiningreport')}}" method="post">
     	<input type="hidden" name="_token"  value="{{csrf_token()}}">
          <input type="hidden" name="type"  value="sponsor">
     	
     	
     		
	     	<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-6">{{trans('report.enter_sponsor')}}</label>
	     		<div class="col-sm-6">
	     			<!-- <input type="text" class="form-control" id="sponsor" required name="sponsor" autocomplete="off">  -->
                    <input class= "form-control" type="text" placeholder="Enter Sponsor" id="key-word"/ required="">
                  <input type="hidden" id="key_user_hidden" name="key_user_hidden"/>
	     		</div>
	     	</div>
     	
     	<div class="form-group col-sm-offset-6" >
     		<button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>
     	</div>

     	
     </form>  

                      
	</div>


</div>
       <div class="card card-flat timeline-content">
                    <div class="card-header header-elements-inline">
                        <h4 class="card-title">{{trans('report.joining_report_by_country')}}</h4>
     </div>
   <div class="card-body"> 
     <form action="{{URL::to('admin/joiningreport')}}" method="post">
     	<input type="hidden" name="_token"  value="{{csrf_token()}}">
            <input type="hidden" name="type"  value="country">
     	
     	<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-6">{{trans('report.choose_country')}}</label>
	     		<div class="col-sm-6">
	     			<select class="form-control" name="country" id="country" required="true">
	     				@foreach($countries as $key =>$country)
	     					<option value="{{$key}}" >{{$country}}</option>
	     				@endforeach

	     			</select>

	     		</div>
	     	</div>
	    <div class = "row">
     	<div class="form-group col-sm-offset-6" >
     		<button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>
     	</div>
     </div>
     	
     </form>  

                     
	</div>


</div>           

           

            
@endsection



@section('scripts') @parent
   
    @endsection