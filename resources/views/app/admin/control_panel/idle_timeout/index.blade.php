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
                {{trans('controlpanel.system')}} : {{trans('controlpanel.idle_timeout_options')}}
            </h5>
                <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">
                                <legend class="text-uppercase font-size-sm font-weight-bold">{{trans('controlpanel.idle_timeout_settings')}}</legend>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{trans('controlpanel.timeout')}}</label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                           
                                              <label class="form-check-label d-flex align-items-center">
                                                
                                                <input name="idle_timeout" {{ ($idle_timeout === "1" ? 'checked' : '') }} class="form-check-input form-check-input-switch" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text="{{trans('controlpanel.off')}}" data-on-color="success" data-on-text="{{trans('controlpanel.on')}}" data-size="small" id="toggle-idle-timeout" type="checkbox"/>
                                                
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                 <div class="timeout_show">

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{trans('controlpanel.time_out_delay')}} ({{trans('controlpanel.in_seconds')}})</label>
                                    <div class="col-lg-3">
                                        
                                                <form id="timeout_delay_form" data-parsley-validate="true">

                                            <div class="input-group">

                                                    <input name="idle_timeout_delay" id="idle_timeout_delay" value="{{$idle_timeout_delay}}" type="text" class="form-control" placeholder="{{trans('controlpanel.seconds')}}" min="60000" max="600000" step="60000"     data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="number"  required/>
                                                        <span class="input-group-append">
                                                              <button type="submit" class="btn btn-info timeout-delay-update-btn">{{trans('controlpanel.update')}} </button>  
                                            </span>
                                        </div>   
                                        <div class="help-block">
                                            <span class="form-text text-muted">{{trans('controlpanel.in_milliseconds')}}.(1 {{trans('controlpanel.min')}} = 60000)</span>
                                        </div>
                                        </form>                                   


                                    </div>
                                </div>
                            </div>

                                
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

     $(document).ready(function(){
         var idle_timeout = '<?php echo $idle_timeout; ?>';
          if(idle_timeout == '1'){
          $(".timeout_show").show(); 
        }
        else{
          $(".timeout_show").hide(); 
        }
        });



     $('.form-check-input-switch').each(function(e) {
               var switch_elem = $(this);
               key = switch_elem.attr('name');
               val_boolean = switch_elem.bootstrapSwitch('state'); 
               switch_elem.bootstrapSwitch('state', val_boolean);
    });



 
$('.form-check-input-switch').on('switchChange.bootstrapSwitch', function(e) {

    var switch_elem = $(this);
    switch_key = switch_elem.attr('name');
    switch_val_boolean = switch_elem.bootstrapSwitch('state'); 
    if(switch_val_boolean == true){
        switch_val = 1;
    }else{
        switch_val = 0;
    }

     if(switch_val_boolean == true){
        $(".timeout_show").show();}
     else{
        $(".timeout_show").hide();}
    $.ajax({
        method: 'POST',
        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/idle-timeout',
        data: {
            'key': switch_key,
            'value': switch_val
        },
        dataType: 'json',
        success: function(data){
             new PNotify({
                text: 'Updated',
                delay: 1000,                            
                nonblock: {
                    nonblock: false
                }
            });

            console.log(data);
        }
    });
});


$('.timeout-delay-update-btn').on('click', function(e) {
    e.preventDefault();

    var $selector = $('#timeout_delay_form'),
    form = $selector.parsley();

    form.validate();


    if(form.isValid()){


    var timeout_delay = $("#idle_timeout_delay").val();

    $.ajax({
        method: 'POST',
        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/idle-timeout',
        data: {
            'key': 'idle_timeout_delay',
            'value': timeout_delay
        },
        dataType: 'json',
        success: function(data){
             new PNotify({
                text: 'Updated',
                delay: 1000,                            
                nonblock: {
                    nonblock: false
                }
            });

            console.log(data);
        }
    });


    }



});



</script>
@stop
