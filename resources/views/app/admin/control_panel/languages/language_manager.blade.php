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
                {{trans('controlpanel.language_manager')}} :  {{trans('controlpanel.options')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">
                     {{trans('controlpanel.options')}} :  {{trans('controlpanel.basic')}}
                </legend>
               <i>  {{trans('controlpanel.check_radio_button_for_changing_default_language')}}</i>
                <br><br>

                <div class="form-group row">
                     @foreach($languages as $language)
                    <label class="col-form-label col-lg-2">
                        {{$language->language}}
                    </label>
                    <div class="col-lg-2">
                        <!-- <div class="d-inline-block mr-3"> -->
                            <label class="form-check-label d-flex align-items-center">
                                <input name="{{$language->id}}" {{ ($language->status === "yes" ? 'checked' : '') }} class="form-check-input form-check-input-switch" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text=" {{trans('controlpanel.off')}}" data-on-color="success" data-on-text=" {{trans('controlpanel.on')}}" data-size="small" id="{{$language->id}}" type="checkbox"/>
                            </label>
                    <!-- </div> -->
                </div>
                     <div class="col-lg-2">
  
                            
                             <div class="radio">
                              <label><input {{ ($language->default === "yes" ? 'checked' : '') }} onchange="language_change()" class="radioID" name="language" id="{{$language->id}}" type="radio" value="yes"></label>
                            </div>
                        </div> 

                     @endforeach  
                </div>
         
                
            </fieldset>
        </div>


         
    </div>
</div>



@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">
 
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
    console.log(switch_val_boolean);
    if(switch_val_boolean == true){
        switch_val = 'yes';
    }else{
        switch_val = 'no';
    }
    $.ajax({
        method: 'POST',
        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/postlanguagemanager',
        data: {
            'key': switch_key,
            'value': switch_val
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
            changeCookiePrefix();
        }
    });
});

 

 

 function language_change() {
        var language_change = $('input:radio[name="language"]:checked').attr('id');
      
        $.ajax({
            method: 'POST',
            url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/defaultlanguagechange',
            data: {
                'key': language_change,
                'value': 'yes'
            },
            dataType: 'json',
            success: function(data){
                 new PNotify({
                    text: data.state,
                    delay: 1000,                            
                    nonblock: {
                        nonblock: false
                    }
                });

                console.log(data);
            }
        });
    };

</script>
@stop
