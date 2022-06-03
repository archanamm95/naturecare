@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
<style type="text/css">
    .form-check-input {
        position:absolute;
        margin-top:.6rem;
        margin-left:-.800rem
    }
</style>
@parent
@endsection

{{-- Content --}}
        @section('main')
   

<div id="settings-page">
    <div class="card card-flat">
        <div class="card-header pb-1 pt-1 bg-dark" >
            <h5 class="mb-0 font-weight-light">
                
                {{trans('controlpanel.organization_tree')}}:{{trans('controlpanel.options')}}

            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered responsive">
            <fieldset class="mb-3">

                <legend class="text-uppercase font-size-sm font-weight-bold">
                    {{trans('controlpanel.options')}} : {{trans('controlpanel.basic')}}
                </legend>

                <div class="form-group row">
                    <label class="col-form-label col-lg-3">
                        {{trans('controlpanel.tree_images')}}
                    </label>
                    <div class="col-lg-8">
                       <div class="d-inline-block">
                           <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input name="tree_images_option" {{ ($tree_images_option === "1" ? 'checked' : '') }} class="form-check-input option-checkbox"  type="checkbox"/>
                            
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input name="tree_images_show_option" {{ ($tree_images_show_option === "1" ? 'checked' : '') }} class="custom-control-input show-option-checkbox" id="tree_images_show_option" type="checkbox"/>
                                
                                <label class="custom-control-label position-static" for="tree_images_show_option" data-popup="tooltip" data-original-title="{{trans('controlpanel.checking_this_option_will_show_this_control_on_top_of_the_tree')}}" data-placement="top">
                                    {{trans('controlpanel.allow_manual_control')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">
                       {{trans('controlpanel.tree_grid')}}
                    </label>
                    <div class="col-lg-8">
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input name="tree_grid_option" {{ ($tree_grid_option === "1" ? 'checked' : '') }} class="form-check-input option-checkbox" type="checkbox"/>
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input name="tree_grid_show_option" {{ ($tree_grid_show_option === "1" ? 'checked' : '') }} class="custom-control-input show-option-checkbox" id="tree_grid_show_option" type="checkbox"/>
                                <label class="custom-control-label position-static" for="tree_grid_show_option" data-popup="tooltip" data-original-title="{{trans('controlpanel.checking_this_option_will_show_this_control_on_top_of_the_tree')}}" data-placement="top">
                                    {{trans('controlpanel.allow_manual_control')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3">
                       {{trans('controlpanel.tree_map')}}
                    </label>
                     <div class="col-lg-8">
                        <div class="d-inline-block">
                             <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                            <input name="tree_map_option" {{ ($tree_map_option === "1" ? 'checked' : '') }} class="form-check-input option-checkbox" type="checkbox"/>
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input  name="tree_map_show_option" {{ ($tree_map_show_option === "1" ? 'checked' : '') }} class="custom-control-input show-option-checkbox" id="tree_map_show_option" type="checkbox"/>
                                <label class="custom-control-label position-static" for="tree_map_show_option" data-popup="tooltip" data-original-title="{{trans('controlpanel.checking_this_option_will_show_this_control_on_top_of_the_tree')}}" data-placement="top">
                                    {{trans('controlpanel.allow_manual_control')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                     <label class="col-form-label col-lg-3">
                       {{trans('controlpanel.tree_zooming')}}
                    </label>
                     <div class="col-lg-8">
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input name="tree_zooming_option" {{ ($tree_zooming_option === "1" ? 'checked' : '') }} class="form-check-input option-checkbox"  type="checkbox"/>
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                            <input  name="tree_zooming_show_option" {{ ($tree_zooming_show_option === "1" ? 'checked' : '') }} class="custom-control-input show-option-checkbox" id="tree_zooming_show_option" type="checkbox"/>
                                <label class="custom-control-label position-static" for="tree_zooming_show_option" data-popup="tooltip" data-original-title="{{trans('controlpanel.checking_this_option_will_show_this_control_on_top_of_the_tree')}}" data-placement="top">
                                   {{trans('controlpanel.allow_manual_control')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                     <label class="col-form-label col-lg-3">
                        {{trans('controlpanel.tree_pan')}}
                    </label>
                    <div class="col-lg-8">
                         <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                            <input name="tree_pan_option" {{ ($tree_pan_option === "1" ? 'checked' : '') }} class="form-check-input option-checkbox" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text="off" data-on-color="success" data-on-text="On" data-size="small" id="toggle-pan_ax" type="checkbox"/>
                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input  name="tree_pan_show_option" {{ ($tree_pan_show_option === "1" ? 'checked' : '') }} class="custom-control-input show-option-checkbox" id="tree_pan_show_option" type="checkbox"/>
                                <label class="custom-control-label position-static" for="tree_pan_show_option" data-popup="tooltip" data-original-title="{{trans('controlpanel.checking_this_option_will_show_this_control_on_top_of_the_tree')}}" data-placement="top">
                                 {{trans('controlpanel.allow_manual_control')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-label col-lg-3">
                       {{trans('controlpanel.tree_more_details')}}
                    </label>
                    <div class="col-lg-8">
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input name="tree_more_details_option" {{ ($tree_more_details_option === "1" ? 'checked' : '') }} class="form-check-input option-checkbox" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text="Off" data-on-color="success" data-on-text="On" data-size="small"  type="checkbox" data-switch-url=""/>

                            </div>
                        </div>
                        <div class="d-inline-block">
                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline">
                                <input  name="tree_more_details_show_option" {{ ($tree_more_details_show_option === "1" ? 'checked' : '') }} class="custom-control-input show-option-checkbox" id="tree_more_details_show_option" type="checkbox"/>
                                <label class="custom-control-label position-static" for="tree_more_details_show_option" data-popup="tooltip" data-original-title="{{trans('controlpanel.checking_this_option_will_show_this_control_on_top_of_the_tree')}}" data-placement="top">
                                   {{trans('controlpanel.allow_manual_control')}}
                                </label>
                            </div>
                        </div>
                    </div>
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


$('.option-checkbox').on('click', function(e) {

    switch_key = $(this).attr('name');
    switch_val_boolean = $(this).is(':checked');
    if(switch_val_boolean == true){
        switch_val = 1;
    }else{
        switch_val = 0;
    }
    $.ajax({
        method: 'POST',
        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/organization-tree-settings',
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


$('.show-option-checkbox').on('click', function(e) {

    switch_key = $(this).attr('name');
    
    switch_val_boolean = $(this).is(':checked');
    if(switch_val_boolean == true){
        switch_val = 1;
    }else{
        switch_val = 0;
    }
    $.ajax({
            method: 'POST',
            url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/organization-tree-settings',
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

function changeCookiePrefix(){
    var random_prefix_key = Math.floor((Math.random() * 100) + 1);
    $.ajax({
        method: 'POST',
        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/organization-tree-settings',
        data: {
            'key': 'cookie_prefix',
            'value': 'cookie_'+random_prefix_key+'_'
        },
        dataType: 'json',
        success: function(data){
            console.log('cookie_prefix changed');
        }
    });
}

</script>
@stop
