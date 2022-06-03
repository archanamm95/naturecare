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
                System : Settings
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">
                                <legend class="text-uppercase font-size-sm font-weight-bold">System Settings</legend>

                                

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">Select Redirection </label>
                                    <div class="col-lg-3">
                                        
                                                <form id="update-system-settings" data-parsley-validate="true">

                                            <div class="input-group">
                                                   <select class="form-control select2" name="leg" id="leg" required data-parsley-group="block-0">
                                                        <option  value="landpage">Landing Page</option>
                                                        <option  value="loginpage">Login Page</option>
                                                    </select>
                                            <span class="input-group-append">
                                                <span class="input-group-text"> <button type="submit" class="btn p-0 m-0 btn-link btn-primary timeout-delay-update-btn">Update </button> </span>
                                            </span>
                                        </div>  
                                        </form>                                   


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


</script>
@stop
