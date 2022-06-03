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

@endsection




{{-- Content --}}
@section('main')
<!-- Single line -->


<div id="campaigns-page">

    <div class="row mb-2">
    	
    	<div class="col-sm-6">
    		<div class="mt-10 mb-10">
                <a href="{{url('admin/campaign/create')}}" class="btn bg-blue  btn-labeled btn-labeled-right"><b><i class="icon-paperplane"></i></b> {{trans('campaign.start_new_campaign')}}</a>							
			</div>
    	</div>

    </div>
    <div class="row campaign-list">
       <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        @forelse($emailcampaignlist as $item)
        
            <div class="col-md-6">
            <div class="card invoice-grid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="text-semibold no-margin-top">
                                                {{$item->name}}
                            </h6>
                            <ul class="list list-unstyled">
                                <li>
                                    {{trans('campaign.campaign')}} ID #:  {{str_pad($item->id, 4, '0', STR_PAD_LEFT)}}
                                </li>
                                <li>
                                    {{trans('campaign.campaign_created_on')}}:
                                    <span class="text-semibold">
                                         {{date('Y/m/d',strtotime($item->created_at))}}
                                    </span>
                                </li>
                                <li>
                                   {{trans('campaign.customer_group')}}:
                                    <span class="text-semibold">
                                      
                                       @php $group=App\CampaignGroup::find($item->customer_group)->name;
                                       @endphp 
                                       {{$group}}
                                    </span>
                                </li>
                               <!--  <li>
                                    Unique Clicks:
                                    <span class="text-semibold">
                                        12
                                    </span>
                                </li> -->
                            </ul>
                        </div>
                        <div class="col-sm-6">
                           <!--  <h6 class="text-semibold text-right no-margin-top">
                                352 Recipients
                            </h6> -->
                            <ul class="list list-unstyled text-right">
                                <li>
                                    {{trans('campaign.scheduled')}}:
                                    <span class="text-semibold">
                                       {{$item->datetime}}   
                                    </span>
                                </li>
                                
                                <li class="dropdown">
                                    {{trans('campaign.status')}}:
                                    <a class="badge badge-primary  statusname  {{($item->status == 'pending')? 'bg-success-400' : 'bg-danger-400'  }} dropdown-toggle" data-toggle="dropdown" href="#">
                                        {{$item->status}}
                                        <span class="caret">
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right active statusdropbtn">
                                        
                                        	@if($item->status == 'pending')
                                            <a class="dropdown-item changecampaignstatus" data-id="{{$item->id}}"   data-status="complete" href="#"><i class="icon-alarm"></i>{{trans('campaign.complete')}}</a>
                                    
                                            @endif
                                       
                                           <!--  <a href="{{url('admin/campaign/delete/'.$item->id)}}" class="dropdown-item"><i class="icon-checkmark3"></i>Delete</a> -->
                                        
                                            <a href="{{url('admin/campaign/delete/'.$item->id)}}" class="dropdown-item"><i class="icon-cross3"></i>{{trans('campaign.delete')}}</a>
                                       
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="heading-text">
                            <span class="status-mark border-danger position-left">
                            </span>
                            @if( $item->status == 'complete')
                            {{trans('campaign.ends_on')}}:
                            <span class="text-semibold">
                              {{date('Y-m-d H:i:s', strtotime($item->updated_at))}}

                            </span>
                            @endif
                        </span>
                                </div>

                                <div>
                                   

                                   <ul class="list-inline list-inline-condensed heading-text pull-right">
                           
                            <li class="dropdown">
                                <a class="text-default dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-menu7">
                                    </i>
                                   
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{url('admin/campaign/view',$item->id)}}">
                                            <i class="icon-printer">
                                            </i>
                                            {{trans('campaign.view_campaign')}}
                                        </a>
                                        <a class="dropdown-item" href="{{url('admin/campaign/edit',$item->id)}}">
                                            <i class="icon-file-download">
                                            </i>
                                            {{trans('campaign.edit_campaign')}}
                                        </a>
                                        <!--   <a class="dropdown-item" href="#">
                                           <i class="icon-file-plus">
                                           </i>
                                           {{trans('campaign.view_report')}}
                                       </a> -->
                                       
                                </div>
                            </li>
                        </ul>


                                </div>
                            </div>


                
            </div>
        </div> 

        @empty

        


        @endforelse

        
        
    </div>
</div>
<!-- /single line -->
@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
</script>
@stop
