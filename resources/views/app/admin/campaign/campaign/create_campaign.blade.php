@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-xs') 

@section('styles')
@parent
@endsection

@section('sidebar')
@parent

@include('app.admin.campaign.sidebar')
<!-- /secondary sidebar -->
@endsection




{{-- Content --}}
@section('main')
<!-- Single line -->

		

<div id="campaigns-page">
	<div class="card card-flat">
    	
    	<div class="col-sm-6"style="margin-top: 5px;">
    		
			<a href="{{url('admin/control-panel/campaign-manager')}}" class="btn bg-blue  btn-labeled btn-labeled-right"><i class="icon-paperplane"></i>
					 {{trans('campaign.create_campaign_group')}}</a>
    	</div>
 

	<form class="form" action="{{ url('admin/campaign/save')}}" method="POST" onsubmit="return checkForm(this);">
		{!!  csrf_field() !!}
		<div class="card-header header-elements-inline">
			<h5 class="card-title">{{trans('campaign.create_campaign')}}<a class="header-elements-toggle"></a></h5>
				<div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
				<div class="header-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<fieldset>
						<legend class="text-semibold"><i class="icon-git-branch position-left"></i>{{trans('campaign.campaign_details')}}</legend>
							<div class="form-group">
								<label class="col-lg-4 col-form-label">{{trans('campaign.campaign_name')}}:</label>
									<div class="col-lg-9">
										<input type="text" name="name" class="form-control" placeholder="Cloud MLM email campaign" required="" >
									</div>
							</div> 	
						<div class="form-group">
							<label class="col-lg-4 col-form-label">{{trans('campaign.customer_group')}}:</label>
								<div class="col-lg-9">
									<select name="customer_group" class="form-control">
										<!-- <option>{{trans('campaign.select_group')}}</option> -->
									
											@foreach($group as $item)
												<option value="{{$item->id}}">{{$item->name}}</option>
													@endforeach
									</select>
								</div>
						</div> 	
						<legend class="text-semibold"><i class="icon-time position-left"></i> {{trans('campaign.set_up_your_schedule')}}</legend>
							<div class="form-group">
								<label class="col-lg-6 col-form-label">{{trans('campaign.send_at_a_specific_date')}}:</label>
									<div class="col-lg-9">		
										<input type="text" autocomplete="off" class="form-control daterange-single" name="datetime" placeholder="date time" required=""   >
									</div>
							</div> 
					</fieldset>
				</div>
				<div class="col-md-6">
					<fieldset>
						<legend class="text-semibold"><i class="far fa-clock position-left"></i> {{trans('campaign.email_details')}}</legend>

							<div class="form-group">
								<label class="col-lg-3 col-form-label">{{trans('campaign.from_name')}}:</label>
									<div class="col-lg-9">
										<div class="row">
											<div class="col-md-6">
												<input type="text" name="first_name" placeholder="From name"  class="form-control" required="">
											</div>
											<div class="col-md-6">
												<input type="text" name="last_name" placeholder="Last name"  class="form-control" required="">
											</div>
										</div>
									</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 col-form-label">{{trans('campaign.from_email')}}:</label>
									<div class="col-lg-9">
										<input type="text" placeholder="campaign@cloudmlm.com"  name="from_email" class="form-control" required="">
									</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 col-form-label">{{trans('campaign.subject')}}:</label>
									<div class="col-lg-9">
										<input type="text" placeholder="CloudMLM Registration Event " s name="subject" class="form-control" required="">
									</div>
							</div>
										
					</fieldset>
				</div>
			</div>
		
								<div class="row">

									<div class="col-md-12">
										<fieldset>
											<legend class="text-semibold"><i class=" position-left"></i> {{trans('campaign.email_body')}}</legend>

											<div class="form-group">
												<div class="col-lg-12">
													<textarea  name="campaignemail" id="" class="form-control">
														@if(isset($emailcampaign->campaignemail))
														{{$emailcampaign->campaignemail}}
														@else
															@include('app.admin.campaign.campaign.campaigns-default-email')
														@endif
													</textarea>


													 
												</div>
											</div> 											 
										</fieldset>
									</div>

								</div>
				<div class="text-right">
					<button type="submit" class="btn btn-primary" id="add_camp" name="add_camp">{{trans('campaign.submit_form')}} <i class="icon-arrow-right14 position-right"></i></button>
				</div>
		</div>
						
	</form>

   </div>
</div>
<!-- /single line -->
@stop

@section('styles')@parent

@endsection
@section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_camp.disabled = true;
  
   return true;
 }

</script>
@stop