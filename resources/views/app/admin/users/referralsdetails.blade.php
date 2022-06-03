@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">   {{trans("users.referral_details")}} </h5>
        <div class="heading-elements">
           <!--  <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul> -->
        </div>
    </div>

     @include('app.admin.users.userinfo')
      <div class="card card-body">
       
     @include('app.admin.users.referrals')

         
       


    </div>
</div>

 @stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop
