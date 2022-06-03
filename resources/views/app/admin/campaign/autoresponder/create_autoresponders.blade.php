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

<form class="form" action="{{ url('admin/campaign/autoresponders/create_autoresp')}}" method="POST" onsubmit="return checkForm(this);">
        {!!  csrf_field() !!}
   <div class="card card-flat">
                           <div class="card-header header-elements-inline">
                                <h5 class="card-title">{{trans('campaign.create_new_autoresponder')}}<a class="header-elements-toggle"></a></h5>
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
        <div class="form-group">
            <label class="col-lg-4 col-form-label">{{trans('campaign.subject')}}:</label>
                <div class="col-lg-12">
                    <input type="text" name="subject" class="form-control" required="" >
                </div>
        </div>  

         <div class="form-group">
            <label class="col-lg-4 col-form-label">{{trans('campaign.email_content')}}</label>
                <div class="col-lg-12">
                    <textarea  name="autoresponderemail" id="ss" class="form-control" required="">
                                                       
                    </textarea>
                </div>
        </div> 

          <div class="form-group">
            <label class="col-lg-4 col-form-label"></label>
            <div class="col-lg-12">
                <select name="campaign" id=campaign selected="selected" class="form-control" 
data-parsley-required-message="" data-parsley-group="block-0">
                    <option value="" >{{trans('campaign.choose_campaign')}}</option>
                    @foreach($campaign as $camp)
                        
                            <option value="{{$camp->id}}"> {{$camp->name}}</option>
                        @endforeach
                </select>
            
                
                   
                </div>
        </div> 
         <div class="form-group">
            <label class="col-lg-4 col-form-label"></label>
            <div class="col-lg-12">
                <select name="date" id=date selected="selected" class="form-control" 
data-parsley-required-message="" data-parsley-group="block-0">
                    <option >-------------------------------{{ trans('admin/autoresponse.select_date')}}-------------------------</option>
                        @for ($i = 1; $i <= 31; $i++) :
                            <option value="{{$i}}"> {{$i}}</option>
                        @endfor
                </select>
            
                
                   
                </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 col-form-label"></label>
            <button type="submit" class="btn btn-primary" id="add_camp" name="add_camp">{{trans('campaign.insert')}} <i class="icon-arrow-right14 position-right"></i></button>
        </div>
                                
    </div>  
    </form> 
     <div class="card card-flat">
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