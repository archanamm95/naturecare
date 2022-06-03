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
<div class="card card-body">
    <div class="row">
    	<div style="margin-top: 5px;"> </div>
    	<div class="col-sm-6">
    		<div class="mt-10 mb-10">
				<a href="{{url('admin/campaign/autoresponders/create')}}" class="btn bg-blue  btn-labeled btn-labeled-right"><i class="icon-paperplane"></i> {{trans('campaign.create_new_autoresponder')}}</a>							
			</div>
    	</div>
    </div>
    
        <div class="row">
            <div class="col-md-12">
<div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>{{trans('campaign.subject')}}</th>
                        <th>{{trans('campaign.description')}}</th>
                        <th>{{trans('campaign.date')}}</th>
                        <th>{{trans('campaign.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($autoresponse as $item)
                    <tr>
                        <td>{{$item->subject}}</td>
                        <td>{{$item->content}}</td>
                        <td>{{$item->date}}</td>

                        <td>
                            <a class="btn btn-primary " href= "{{url('admin/campaign/autoresponders/edit_autoresponder/'.$item['id'])}}"  name="id" value="{{$item['id']}}">{{trans('wallet.edit')}}</a>
                            
                            <a class="btn btn-danger" href= "{{url('admin/campaign/autoresponders/delete_autorespnse/'.$item->id)}}" name="id" value="{{$item['id']}}">{{trans('wallet.delete')}}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> 
    </div>
    </div>
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
