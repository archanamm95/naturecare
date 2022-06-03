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
            <h2 class="mb-0 font-weight-light">
                <!-- Mail -->
            </h2>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
            <div class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="text-center d-lg-none w-100">
                      <!--   <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#welcome"> -->
                          <!--   <i class="icon-calendar3 mr-2"></i>
                              {{trans('controlpanel.welcome')}} -->
                        <!-- </button> -->
                    </div>


                    {{trans('controlpanel.s')}}{{trans('controlpanel.m')}}{{trans('controlpanel.t')}}{{trans('controlpanel.p')}}   {{trans('controlpanel.settings')}}

      <!--               <div class="navbar-collapse collapse" id="navbar-second">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a href="#welcome" class="navbar-nav-link active" data-toggle="tab">
                                    <i class="icon-pencil mr-2"></i>
                                    Welcome Mail
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#payout" class="navbar-nav-link" data-toggle="tab">
                                    <i class="icon-pencil mr-2"></i>
                                   Payout Mail
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="#smtp" class="navbar-nav-link active" data-toggle="tab">
                                    <i class="icon-pencil mr-2"></i>
                                   SMTP Settings
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                             -->
                        
           </div>
            <div class="content">

                <!-- Inner container -->
                <!-- <div class="d-flex align-items-start flex-column flex-md-row"> -->

                    <!-- Left content -->
                    <!-- <div class="tab-content w-100 order-2 order-md-1"> -->
                    <!--   <div class="active tab-pane  " id="welcome">
                          @include('app.admin.control_panel.system_settings.welcome')
                      </div> -->
                    <!--   <div class="tab-pane fade in " id="payout">
                        <div class="card-body"> 
                            <div class="card-header header-elements-inline">

                            <h4 class="card-title">{{trans('Payout_email')}}</h4>
                            <div class="header-elements">
                               
                            </div>
                            </div>
                            <form  id="settings" method="post" action="{{url('admin/control-panel/control-payout_email')}}" data-parsley-validate="parsley">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                              <legend>Payout Mail</legend>
                                @foreach($set as $ra)
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                              <label  class="form-label" for="point_value">From</label>   
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="from" type="text" value="{{$ra->from}}">
                                              
                                            
                                            </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <label  class="form-label" for="point_value">{{trans('subject')}}:</label>    
                                          </div>
                                          <div class="col-sm-8">
                                              <input class="form-control" name="subject" type="text" value="{{$ra->subject}}">
                                              
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <label  class="form-label" for="point_value">Mail Content:</label>
                                          </div>
                                          <div class="col-sm-8" >
                                             <textarea class="form-control" name="description" rows="7" value="{{$ra->mail_content}}">{{ $ra->mail_content }}</textarea>
                                            
                                        
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                       <button class="btn bg-dark" type="submit">Save</button>
                                      </div> 
                                  </div>  
                                </form>
                            @endforeach
                        </div>
                    </div> -->
                    <!-- <div class="tab-pane fade in " id="smtp"> -->
                      <div class="card-body"> 
                        <div class="card-header header-elements-inline">
                          <h4 class="card-title"> {{trans('controlpanel.s')}}{{trans('controlpanel.m')}}{{trans('controlpanel.t')}}{{trans('controlpanel.p')}} {{trans('settings.settings')}}</h4>
                          <div class="header-elements">
                          </div>
                        </div>
                        <form method="post" action="{{url('admin/control-panel/control-smtp_settings')}}" data-parsley-validate="parsley">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <legend>   {{trans('controlpanel.s')}}{{trans('controlpanel.m')}}{{trans('controlpanel.t')}}{{trans('controlpanel.p')}}  </legend>
                        
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label  class="form-label" for="host">{{trans('settings.host')}}:</label>  
                                  </div>
                                     <div class="col-sm-8" >
                                        <input class="form-control" name="host" type="text" value="{{$email_setting->host}}">
                                     </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label  class="form-label" for="port">{{trans('settings.port')}}:</label>  
                                  </div>
                                     <div class="col-sm-8" >
                                        <input class="form-control" name="port" type="text" value="{{$email_setting->port}}">
                                     </div>
                                </div>
                              </div>
                            
                             
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label  class="form-label" for="username">{{trans('settings.username')}}:</label>  
                                  </div>
                                     <div class="col-sm-8" >
                                         <input class="form-control" name="username" type="text" value="{{$email_setting->username}}">
                                </div>
                              </div>
                             
                           </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label  class="form-label" for="password">{{trans('settings.password')}}:</label>  
                                  </div>
                                     <div class="col-sm-8" >
                                        <input class="form-control" name="password" type="text" value="{{$email_setting->password}}">
                                     </div>
                                </div>
                            </div>

                                 <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label  class="form-label" for="from_name">{{trans('settings.from_name')}}:</label>  
                                  </div>
                                     <div class="col-sm-8" >
                                        <input class="form-control" name="from_name" type="text" value="{{$email_setting->from_name}}">
                                     </div>
                                </div>
                            </div>

                                 <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label  class="form-label" for="from_email">{{trans('settings.from_email')}}:</label>  
                                  </div>
                                     <div class="col-sm-8" >
                                        <input class="form-control" name="from_email" type="email" value="{{$email_setting->from_email}}">
                                     </div>
                                </div>
                            </div>
                            <div class="form-group row">
                              <button class="btn bg-dark" type="submit">{{trans('settings.save')}}</button>
                            </div>  
                        </form>
                      <!-- </div> -->
                    </div>

                <!-- </div> -->
            <!-- </div> -->
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
if ($('#enable').length) {
    $(function() {
        $('#enable').click(function() {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.settings').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/welcomeemail',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
</script>
@stop
