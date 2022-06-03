@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection
@section('sidebar')
@parent
<!-- Secondary sidebar -->
@include('app.admin.control_panel.sidebar')
<!-- /secondary sidebar -->
@endsection


        {{-- Content --}}
        @section('main')
<div id="settings-page">

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                 {{trans('settings.ban')}} {{trans('settings.i')}}{{trans('settings.p')}} {{trans('settings.manager')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">

                <legend class="text-uppercase font-size-sm font-weight-bold"> {{trans('settings.ban')}} {{trans('settings.i')}}{{trans('settings.p')}} {{trans('settings.manager')}}</legend>
                <form id="update-system-settings" data-parsley-validate="true" method="post" action="{{url('admin/control-panel/ban-ip')}}" onsubmit="return checkForm(this);">
                    {{csrf_field()}}

                <div class="form-group row">
                    <label class="col-form-label col-lg-2"> {{trans('settings.enter')}} {{trans('settings.i')}}{{trans('settings.p')}}  </label>
                    <div class="col-lg-3">
                            <input type="text" class="form-control" name="ip" value="" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">

                    </div>
                </div>

                 <div class="form-group row">

                      <button class="btn bg-dark" type="submit" name="add_ip" id="add_ip">{{trans('settings.ban')}} {{trans('settings.i')}}{{trans('settings.p')}} </button>
                </div>

                </form>
            </fieldset>

              
                
            </div>    
        </div>
    </div> 


</div>
<div id="settings-page">

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('settings.list_of')}} {{trans('settings.ban')}} {{trans('settings.i')}}{{trans('settings.p')}} 
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">

                <legend class="text-uppercase font-size-sm font-weight-bold">{{trans('settings.list_of')}} {{trans('settings.ban')}} {{trans('settings.i')}}{{trans('settings.p')}} {{trans('settings.address')}} </legend>
                
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>
                               {{trans('settings.no')}}.
                            </th>
                            <th>
                                {{trans('settings.ban')}} {{trans('settings.i')}}{{trans('settings.p')}} {{trans('settings.address')}}
                            </th>
                            <th>
                                {{ trans('autoresponse.action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($block_ips as $key=>$block_ip)
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{$block_ip->ip}}
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{url('admin/control-panel/ban_ip/delete/'.$block_ip->id)}}">
                                    <i class="icon-trash" aria-hidden="true"></i>

                                </a>
                            </td>
                        </tr>
                        @endforeach 
                        @if(!count($block_ips))
                        <tr>
                            <td>
                                {{ trans('ticket_config.no_data')}}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
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
@section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_ip.disabled = true;
  
   return true;
 }

</script>
@stop



