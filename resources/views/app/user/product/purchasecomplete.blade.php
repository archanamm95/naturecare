@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('main')
 @include('utils.errors.list')



<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$title}}</h4>
    
    </div>
        
<div class="card-body">
  <p> {{trans('products.payment_completed_successfully')}}</p>
  <br>
  <div class="row">
  <div class=col-sm-12>
    <img class="ajax-loader" src="{{ url('global_assets/pp.gif')}}"> <span class="loader-text"><font color="green">{{trans('products.you_will_be_automatically_redirect_to_preview')}}</font></span>
</div>
</div>
</div>            
</div>

              
@endsection @section('overscripts') @parent

@endsection @section('scripts') @parent

 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('user/get-purcomplete-status/'.$purchase_id)}}", function( data ) { 
                 if(data['status'] == 'finish'){
                       

                         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/purchase/complete/' + data['id'];
                
                  window.location = redirectPath
                 }
                 
            });
     }, 4000);

 </script>
@endsection







