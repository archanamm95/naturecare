@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection



        {{-- Content --}}
        @section('main')
<div id="settings-page">
 <div class="card card-white">
       <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                 {{trans('campaign_manager.campaign_group')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
     <div class="card-body bordered">
      <div class="mb-3">
         <fieldset class="mb-3">
            <legend class="text-uppercase font-size-sm font-weight-bold">  {{trans('campaign_manager.create_campaign_group')}}</legend>
          <form action="{{ url('admin/control-panel/campaign-manager/add')}}" method="post" onsubmit="return checkForm(this);">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
              <div class="form-group row">
                  <label class="form-label col-sm-3">{{trans('currency.group_name')}}</label>
                    <div class="col-sm-3">
                        <input type="text" autocomplete="off" class="form-control " name="group_name" id="group_name" required="">
                        
                    </div>
                </div>
              
             <div class="form-group row">
                <label class="form-label col-sm-3">{{trans('currency.group_description')}}</label>
                    <div class="col-sm-3">
                        
                        <input type="text" autocomplete="off" class="form-control " name="group_description" id="group_description" required="">
                        
                    </div>
                </div>
              
               <div class="form-group row">
               <button type="submit" class="btn btn-primary" name="add_camp" id="add_camp"> {{trans('campaign_manager.create')}} </button>
            </div>
       
          </form>
          </fieldset>     
    </div>
</div>
</div>
 <div class="card card-white" style="overflow: auto;">
         <div class="card-header pb-1 pt-1 bg-dark" >
            <h5 class="mb-0 font-weight-light" >
                {{trans('campaign_manager.campaign_group_list')}}
            </h5>
           
        </div>
        <div class="card-body">
          <div class="">
            <table class="table table-striped">
                <thead>
                    <th>{{trans('currency.name')}}</th>
                    <th> {{trans('campaign_manager.description')}}</th>
                   
                    <th>{{trans('currency.action')}}</th>
                </thead>
                <tbody>
                    @foreach($group as $item)
                
                    <tr>
                        <td> 
                            {{$item->name}}
                        </td>
                            <td>{{$item->description}}  </td>
                           <td>
                              <a href="{{url('admin/control-panel/campaign-manager/edit_group/'.$item->id) }}" class="btn btn-primary"> {{trans('campaign_manager.edit')}}</a>
                            
                            <a href="{{url('admin/control-panel/campaign-manager/delete/'.$item->id) }}" class="btn btn-danger">
                             {{trans('campaign_manager.delete')}}</a>
                         </td>
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