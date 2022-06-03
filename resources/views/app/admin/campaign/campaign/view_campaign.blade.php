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
							<div class="card-header header-elements-inline">
								<h5 class="card-title">{{trans('campaign.view_campaign')}}</h5>
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
							<input type="hidden" name="id" value="{{$emailcampaign->id}}">

							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold"><i class="icon-git-branch position-left"></i> {{trans('campaign.campaign_details')}}</legend>

											<div class="form-group">
												<label class="col-lg-4 col-form-label">{{trans('campaign.campaign_name')}}:</label>
												<div class="col-lg-9">
													<input type="text" name="name" class="form-control" placeholder="Cloud MLM email campaign" value="{{isset($emailcampaign->name)? $emailcampaign->name :'Cloud MLM email campaign'}}" readonly="">
												</div>
											</div> 	
											<div class="form-group">
												<label class="col-lg-4 col-form-label">{{trans('campaign.customer_group')}}:</label>
												<div class="col-lg-9">
												<input type="text" name="customer_group" class="form-control" value="{{$emailcampaign->customer_group}}" readonly>	
												</div>
											</div> 
											<legend class="text-semibold"><i class="icon-time position-left"></i> {{trans('campaign.set_up_your_schedule')}}</legend>

											<div class="form-group">
												<label class="col-lg-6 col-form-label">{{trans('campaign.send_at_a_specific_date')}}:</label>
												<div class="col-lg-9">


													<input type="text" name="datetime" id="" placeholder="date time" value="{{isset($emailcampaign->datetime)? $emailcampaign->datetime :''}}" class="form-control" readonly>
												</div>
											</div> 											 
										</fieldset>
									</div>

									<div class="col-md-6">
										<fieldset>
						                	<legend class="text-semibold"><i class="far fa-clock position-left"></i> {{trans('campaign.email_details')}}</legend>

											<div class="form-group">
												<label class="col-lg-3 col-form-label">{{trans('campaign.from name')}}:</label>
												<div class="col-lg-9">
													<div class="row">
														<div class="col-md-6">
															<input type="text" name="first_name" placeholder="From name" value="{{isset($emailcampaign->first_name)? $emailcampaign->first_name :'CloudMLM'}}" class="form-control" readonly>
														</div>

														<div class="col-md-6">
															<input type="text" name="last_name" placeholder="Last name" value="{{isset($emailcampaign->last_name)? $emailcampaign->last_name :'Software'}}" class="form-control" readonly>
														</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-3 col-form-label">{{trans('campaign.from_email')}}:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="campaign@cloudmlm.com" value="{{isset($emailcampaign->from_email)? $emailcampaign->from_email :'campaign@cloudmlm.com'}}" name="from_email" class="form-control" readonly>
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-3 col-form-label">{{trans('campaign.subject')}}:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="CloudMLM Registration Event " value="{{isset($emailcampaign->subject)? $emailcampaign->subject :'CloudMLM Registration Event'}} " name="subject" class="form-control" readonly>
												</div>
											</div>
											
											 
										</fieldset>
									</div>
								</div>

								<div class="row">

									<div class="col-md-12">
										<fieldset>
											<legend class="text-semibold"><i class=" position-left"></i>{{trans('campaign.email_body')}}</legend>

											<div class="form-group">
												<div class="col-lg-12">
													<textarea  name="campaignemail" id="campaignemail" class="form-control" readonly>
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

								
							</div>
						</div>
					</form>

   
</div>
<!-- /single line -->
@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
</script>
@stop
