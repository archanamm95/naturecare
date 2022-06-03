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
                  {{trans('campaign_manager.edit')}} :  {{trans('campaign_manager.campaign_group')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>

     <div class="card-body bordered">
      <div class="mb-3">
         <fieldset class="mb-3">
            <legend class="text-uppercase font-size-sm font-weight-bold">  {{trans('campaign_manager.edit_campaign_group')}}</legend>
              <form action="{{ url('admin/control-panel/campaign-manager/editgroup')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                  
                  <div class="form-group row">
                    <label class="form-label col-sm-3">{{trans('currency.group_name')}}</label>
                      <div class="col-sm-3">
                        <input type="text" autocomplete="off" class="form-control " name="group_name" id="group_name" value="{{$group->name}}">
                          <input type="hidden" name="id" value="{{$group->id}}">
                      </div>
                  </div>
              
              <div class="form-group row">
                  <label class="form-label col-sm-3">{{trans('currency.group_description')}}</label>
                    <div class="col-sm-3">
                        
                        <input type="text" autocomplete="off" class="form-control " name="group_description" id="group_description" value="{{$group->description}}">
                        
                    </div>
                </div>

                
                 
                      <button type="submit" class="btn btn-primary"> {{trans('campaign_manager.edit')}} </button> 
                  
             
              
          </form>
           </fieldset>    
    </div>
</div>
</div>
</div>
@stop

@section('styles')@parent
<style type="text/css">
.parsley-errors-list.filled {
    position: absolute;
    top: 40px;
}
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">


</script>
@stop
