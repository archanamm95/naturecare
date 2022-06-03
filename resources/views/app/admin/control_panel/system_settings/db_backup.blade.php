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
<div class="alert alert-success" id="success-alert" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>  {{trans('controlpanel.success')}}!!! </strong>   {{trans('controlpanel.set')}} <span id="frequency"></span>   {{trans('controlpanel.database_backup_successfully')}}.
</div>
<div id="settings-page">
        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                  {{trans('controlpanel.database')}} :   {{trans('controlpanel.settings')}}
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">  {{trans('controlpanel.database_settings')}}</legend>
                <form id="myform" method="post" action="" class="myform">
                    <div>  {{trans('controlpanel.choose_option')}}:</div>
                    @for($i=1;$i<=4;$i++)
                    @if($i == $radio)
                    <input type="radio" name="db_options" value="{{$i}}" checked="checked" /> @if($i == 1) Daily @elseif($i == 2)   {{trans('controlpanel.weekly')}} @elseif($i==3)   {{trans('controlpanel.monthly')}} @elseif($i == 4)   {{trans('controlpanel.yearly')}} @endif<br> 
                    @else
                    <input type="radio" name="db_options" value="{{$i}}" /> @if($i == 1) Daily @elseif($i == 2)   {{trans('controlpanel.weekly')}} @elseif($i==3)   {{trans('controlpanel.monthly')}} @elseif($i == 4)   {{trans('controlpanel.yearly')}} @endif <br> 
                    @endif
                    @endfor
                    <br>
                    <!-- <div><p><input type="button" value="Set Database Frequency"></p></div> -->
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var sz = document.forms['myform'].elements['db_options'];

    for (var i=0, len=sz.length; i<len; i++) {
        sz[i].onclick = function() { 
            var radioValue = this.value;
            if (radioValue == 1) {
                var frequency = "Daily";
            }
            if(radioValue == 2)
            {
                var frequency = "Weekly";
            }
            if (radioValue == 3) {
                var frequency = "Monthly";
            }
            if(radioValue == 4)
            {
                var frequency = "Yearly";
            }
            $('#frequency').html(frequency);
            $.ajax({
               url:"{{url('admin/control-panel/db_management')}}",
               type: 'POST',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: {radioValue : radioValue},
               dataType: "json",
                success: function(json) {
                   $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });
                },
                error: function(e) {
                    console.log(e.message);
                }
            });
        };
    }
});
</script>
@stop