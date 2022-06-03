@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
<style type="text/css">
    ul.tips,div.description,.form-item div.description {
        margin: 5px 0;
        line-height: 1.231em;
        font-size: .923em;
        color: #666
    }

    ul.tips li {
        margin: .25em 0 .25em 1.5em
    }

    body div.form-type-radio div.description,body div.form-type-checkbox div.description {
        margin-left: 1.5em
    }

label {
    display: block;
    font-weight: 700;
}

label.option {
    display: inline;
    font-weight: 400;
}
textarea.form-control {
    height: auto;
}
ul.nav.nav-tabs.nav-tabs-vertical {
    background: #eaeaea;
}

.nav-tabs-vertical .nav-item.show .nav-link, .nav-tabs-vertical .nav-link.active{
    background-color: #fff;
    border-color: #ddd #0000;
}
div#settings-page .form-control {
    font-size: 14px;
}
</style>
@endsection



        {{-- Content --}}
        @section('main')
<div id="settings-page">
   
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
               {{trans('controlpanel.cms_manager')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                   <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
               </div>
        </div>
     
        <div class="card-body bordered">
            <div class="d-md-flex">
                <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#terms_and_conditions">
                            {{trans('controlpanel.terms_and_conditions')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cookie_policy">
                             {{trans('controlpanel.cookie_policy')}}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="terms_and_conditions">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="terms_and_conditions" style="display: block;">
                          <form action="{{url('admin/control-panel/cms_manager')}}"  method="post" >
                              {{ csrf_field() }}
                            <div class="row">
                              <label class="col-sm-4" for="terms">
                                     {{trans('controlpanel.content')}}:
                                  <span class="symbol required">
                                      </span>
                              </label>
                            </div><hr>
                            <div class="row" >

                              <textarea name="terms_and_conditions" class="summernote" id="terms_and_conditions"></textarea>
                              <input type="hidden" name="id" value="1">
                            </div>
                            <br>
                              <button type="submit" class="btn btn-info"> {{trans('controlpanel.submit')}}</button>
      
                          </form>
                        </fieldset>
                    </div>
                    <div class="tab-pane fade" id="cookie_policy">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="cookie_policy" style="display: block;">
                          <form action="{{url('admin/control-panel/cms_manager')}}"  method="post" >
                              {{ csrf_field() }}
                            <div class="row">
                                <label class="col-sm-4" for="cookie">
                                       {{trans('controlpanel.content')}}:
                                    <span class="symbol required">
                                      </span>
                                </label>
                            </div>
                                <hr>
                            <div class="row" >

                              <textarea name="cookie_policy" class="summernote1" id="cookie_policy"></textarea>
                                <input type="hidden" name="id" value="2">
                            </div>
                            <br>
                              <button type="submit" class="btn btn-info"> {{trans('controlpanel.submit')}}</button>
      
                        </form>                                
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection



@section('scripts') @parent
 
<script type="text/javascript"> 

   $(document).ready(function() {
           //initialize summernote
           $('.summernote').summernote();
           //assign the variable passed from controller to a JavaScript variable.
           var content = {!! json_encode($terms->content) !!};
           //set the content to summernote using `code` attribute.
           $('.summernote').summernote('code', content);
           
            $('.summernote1').summernote();
           var cookie = {!! json_encode($terms->cookie) !!};
           $('.summernote1').summernote('code', cookie);
       });
</script>

@endsection
