@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main')



<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{$title}}</h4>
    
    </div>
        
<div class="card-body">
  <p>{{trans("users.payment_completed_successfully")}}</p>
  <br>
  <div class="row">
  <div class=col-sm-12>
 
     <img class="ajax-loader" src="{{ url('global_assets/pp.gif')}}"> <span class="loader-text"><font color="green"> {{trans("users.you_will_be_automatically_redirect_to_preview")}}</font></span>
    
</div>
</div>
</div>            
</div>
            
@endsection @section('overscripts') @parent

@endsection @section('scripts') @parent

 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('user/get-bitaps-status/'.$purchase_id)}}", function( data ) { 
                 if(data['status'] == 'finish'){

                         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/register/preview/' + data['id'];
                
                  window.location = redirectPath
                 }
                 
            });
     }, 4000);

 </script>
@endsection







