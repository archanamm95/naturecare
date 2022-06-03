
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
                {{trans('controlpanel.brand')}} : {{trans('controlpanel.basic_information')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               {!! Form::model($options,['url' => '/admin/control-panel/branding', 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
      


             <div class="required row form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                <label class="col-form-label col-lg-2">{{trans('controlpanel.company_name')}}</label>
                <div class="col-lg-12">
                    <input type="text" name="company_name" class="form-control" data-popup="tooltip" title="" placeholder="{{trans('controlpanel.company_name')}}" data-original-title="Company name." value="{{ option('app.company_name') }}">
                </div>
            </div>
           
             <div class="required row form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                <label class="col-form-label col-lg-2">{{trans('controlpanel.company_email')}}</label>
                <div class="col-lg-12">
                    <input type="email" name="company_email" class="form-control" data-popup="tooltip" title="" placeholder="{{trans('controlpanel.company_email')}}" data-original-title="Company email." value="{{ option('app.company_email') }}">
                </div>
            </div>
           
              <div class="required row form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                <label class="col-form-label col-lg-2">{{trans('controlpanel.company_address')}}</label>
                <div class="col-lg-12">
                    <textarea rows="5" class="form-control" name="company_address" data-popup="tooltip" title=""  data-original-title="Company Address.">{{ option('app.company_address') }}</textarea>
                </div>
            </div>
            <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>
           
{!! Form::close() !!}

              
                
            </div>    
        </div>
    </div> 


    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.brand')}} : {{trans('controlpanel.logo')}} 
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               
              

               <div class="form-group row">
                    <div class="col">
                        <label class="col-lg-6 col-form-label font-weight-bold">{{trans('controlpanel.brand_logo')}} 

                            
                        ({{trans('controlpanel.light_version')}}) (206:32):</label>
                        <div class="col-lg-12 text-center">
                            <input type="file" name="file" multiple="false" class="file-input-logo-light" data-fouc>                       
                        </div>


                    </div>
                    <div class="col">
                        <label class="col-lg-6 col-form-label font-weight-bold">{{trans('controlpanel.brand_logo')}} ({{trans('controlpanel.dark_version')}})  (206:32):</label>
                        <div class="col-lg-12 text-center">
                            <input type="file" name="file" multiple="false" class="file-input-logo-dark" data-fouc>                       
                        </div>
                    </div>
                </div> 
                
            </div>    
        </div>
    </div>    
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
               {{trans('controlpanel.brand')}} : {{trans('controlpanel.logo_icons')}} 
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <div class="form-group row ">
                    <div class="col">
                        <label class="col-lg-6 col-form-label font-weight-bold">{{trans('controlpanel.brand_logo_title_icon')}}  ({{trans('controlpanel.light_version')}} ):</label>
                        <div class="col-lg-12 text-center">
                            <input type="file" name="file" multiple="false" class="file-input-logo-tile-light" data-fouc>                       
                        </div>
                    </div>
                    <div class="col">
                        <label class="col-lg-6 col-form-label font-weight-bold">{{trans('controlpanel.brand_logo_title_icon')}}  ({{trans('controlpanel.dark_version')}} ):</label>
                        <div class="col-lg-12 text-center">
                            <input type="file" name="file" multiple="false" class="file-input-logo-tile-dark" data-fouc>                       
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
@stop

@section('styles')@parent
<style type="text/css">
.file-preview-frame .kv-file-content {
    padding: 10px;
}
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">
    $('document').ready(function(){

        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header align-items-center">\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';


             // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
            fullscreen: 'btn btn-light btn-icon btn-sm',
            borderless: 'btn btn-light btn-icon btn-sm',
            close: 'btn btn-light btn-icon btn-sm'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        };

        // File actions
        var fileActionSettings = {

            showDrag :false,
            showUpload: true,
            showRemove: false,
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',

        };


         $('.file-input-logo-light').fileinput({
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialPreview: [
                '{{ url("img/cache/original/".$logo_light)}}',
            ],
            initialPreviewConfig: [
                {caption: 'current logo (light)',  url: '{$url}', initialPreviewShowDelete: false,showRemove: false, showUpload: false, showClose: false},
            ],
            initialPreviewAsData: true,
            overwriteInitial: true,
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
           
            browseLabel: 'Browse',
            browseClass: 'btn bg-slate-700',
            browseIcon: '<i class="icon-image2 mr-2"></i>',

            fileActionSettings: fileActionSettings,
            showCaption:false,
            allowedFileExtensions: ["jpg", "gif", "png"],
            maxFileCount:'1',
            browseOnZoneClick:true,
            autoReplace: true,
            showUploadedThumbs: false,
            uploadAsync:false,
            showRemove: false,
            showClose: false,
            uploadUrl:CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            uploadExtraData: {'type': 'logo_light'},
        });
        
        $('.file-input-logo-dark').fileinput({
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialPreview: [
                '{{ url("img/cache/original/".$logo_dark)}}',
            ],
            initialPreviewConfig: [
                {caption: 'current logo (dark)',  url: '{$url}', initialPreviewShowDelete: false,showRemove: false, showUpload: false, showClose: false},
            ],
            initialPreviewAsData: true,
            overwriteInitial: true,
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,

            browseLabel: 'Browse',
            browseClass: 'btn bg-slate-700',
            browseIcon: '<i class="icon-image2 mr-2"></i>',

            fileActionSettings: fileActionSettings,
            showCaption:false,
            allowedFileExtensions: ["jpg", "gif", "png"],
            maxFileCount:'1',
            browseOnZoneClick:true,
            autoReplace: true,
            showUploadedThumbs: false,
            uploadAsync:false,
            showRemove: false,
            showClose: false,
            uploadUrl:CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            uploadExtraData: {'type': 'logo_dark'},
        }); 

        $('.file-input-logo-tile-light').fileinput({
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialPreview: [
                '{{ url("img/cache/original/".$logo_icon_light)}}',
            ],
            initialPreviewConfig: [
                {caption: 'current logo icon (light)',  url: '{$url}', initialPreviewShowDelete: false,showRemove: false, showUpload: false, showClose: false},
            ],
            initialPreviewAsData: true,
            overwriteInitial: true,
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,

            browseLabel: 'Browse',
            browseClass: 'btn bg-slate-700',
            browseIcon: '<i class="icon-image2 mr-2"></i>',

            fileActionSettings: fileActionSettings,
            showCaption:false,
            allowedFileExtensions: ["jpg", "gif", "png"],
            maxFileCount:'1',
            browseOnZoneClick:true,
            autoReplace: true,
            showUploadedThumbs: false,
            uploadAsync:false,
            showRemove: false,
            showClose: false,
            uploadUrl:CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            uploadExtraData: {'type': 'logo_icon_light'},
        });

        $('.file-input-logo-tile-dark').fileinput({
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialPreview: [
                '{{ url("img/cache/original/".$logo_icon_dark)}}',
            ],
            initialPreviewConfig: [
                {caption: 'current logo icon (dark)',  url: '{$url}', initialPreviewShowDelete: false,showRemove: false, showUpload: false, showClose: false},
            ],
            initialPreviewAsData: true,
            overwriteInitial: true,
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
                        
            browseLabel: 'Browse',
            browseClass: 'btn bg-slate-700',
            browseIcon: '<i class="icon-image2 mr-2"></i>',

            fileActionSettings: fileActionSettings,
            showCaption:false,
            allowedFileExtensions: ["jpg", "gif", "png"],
            maxFileCount:'1',
            browseOnZoneClick:true,
            autoReplace: true,
            showUploadedThumbs: false,
            uploadAsync:false,
            showRemove: false,
            showClose: false,
            uploadUrl:CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            uploadExtraData: {'type': 'logo_icon_dark'},
        });

    });
</script>
@stop
