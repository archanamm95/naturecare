@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
@endsection
{{-- Content --}}
@section('main')
      @include('utils.errors.list')
<div class="card card-flat timeline-content">
                    <div class="card-header header-elements-inline">
                        <h4 class="card-title">{{trans('report.top_earners_report')}}</h4>
     </div>
     <div class="card-body"> 
     <form action="{{URL::to('admin/topearners')}}" method="post">
     	<input type="hidden" name="_token"  value="{{csrf_token()}}">
     	<div class="row">
     		<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>
	     		<div class="col-sm-6">
	     			<div class="input-group">
	     				<input type="text" autocomplete="off" class="form-control daterange-single" name="start" id="start"  value="{{ date('m/01/Y') }}"  required="true">
                        <label for="start" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>

	     			<!-- <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span>
 -->

	     			</div>
	     		</div>
	     	</div>
	     	<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>
	     		<div class="col-sm-6">
	     			<div class="input-group"> 
	     				<input type="text" autocomplete="off" class="form-control daterange-single" name="end" id="end"  value="{{ date('m/t/Y') }}" required="true">
                        <label for="end" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>
	     				<!-- <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span> -->

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
                        <h4 class="card-title">{{trans('report.top_seller_report')}}</h4>
     </div>
     <div class="card-body"> 
     <form action="{{URL::to('admin/topseller')}}" method="post">
        <input type="hidden" name="_token"  value="{{csrf_token()}}">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" autocomplete="off" class="form-control daterange-single" name="start" id="start"  value="{{ date('m/01/Y') }}"  required="true">
                        <label for="start" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>

                    <!-- <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span>
 -->

                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>
                <div class="col-sm-6">
                    <div class="input-group"> 
                        <input type="text" autocomplete="off" class="form-control daterange-single" name="end" id="end"  value="{{ date('m/t/Y') }}" required="true">
                        <label for="end" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>
                        <!-- <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22 "></i></span>
                                        </span> -->

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




        <h4 class="card-title">{{trans('report.top_enroller_report')}}</h4>



     </div>



     <div class="card-body"> 



     <form action="{{URL::to('admin/topenrollerreport')}}" method="post">



        <input type="hidden" name="_token"  value="{{csrf_token()}}">




        <div class="row">

            <div class="form-group col-sm-6">

                <label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>

                <div class="col-sm-6">

                    <div class="input-group"> 

                        <input type="text" autocomplete="off" class="form-control daterange-single" name="start" id="start" value="{{ date('m/01/Y') }}"  required="true">
                        <label for="start" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>

                   
                



                    </div>

                </div>

            </div>

            <div class="form-group col-sm-6">

                <label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>

                <div class="col-sm-6">

                    <div class="input-group"> 

                        <input type="text" autocomplete="off" class="form-control daterange-single" name="end" id="end" value="{{ date('m/t/Y') }}"  required="true">
                        <label for="end" class="input-group-text"> <i class="icon-calendar22 open-datetimepicker" style=" color: #5B5B5B;"></i></label>

                       
                

                    </div>

                </div>

            </div>

        </div>
<div class="row">
            <div class="form-group col-sm-6">
            
             <label class="col-sm-3 control-label" for="username">
            {{trans('ewallet.username')}}: <span class="symbol required"></span>
            </label>
            <div class="col-sm-6">
                 <input class="form-control autocompleteusers" id="username" name="autocompleteusers" type="text" placeholder=" {{trans('ewallet.search_username')}}" >
                    <input class="form-control key_user_hidden" name="username" type="hidden" >
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
    <script>
        $(document).ready(function() {
            $(".datetimepicker").datepicker()  
        });
    </script>
    <script type="text/javascript" src="{{asset('assets/globals/js/autosuggest.js')}}" charset="utf-8"></script>


    <script>

        $(document).ready(function() {

           

            $(".datetimepicker").datepicker()          

        });

   var options = {
                script:"{{url('admin/suggestlist')}}?json=true&limit=10&",
                varname:"input",
                json:true,
                shownoresults:false,
                maxresults:10,
                callback: function (obj) { document.getElementById('testid').value = obj.id; }
            };
            var as_json = new bsn.AutoSuggest('username', options);        
             

   

    </script>

    @endsection