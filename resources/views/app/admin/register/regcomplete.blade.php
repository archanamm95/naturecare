@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent


@endsection
{{-- Content --}}
@section('main')
    
@include('flash::message')

@include('utils.errors.list')

<!-- <div class="card text-center  p-4" style="width: 61rem;">
    <div class="icon-object border-success-400 text-success test" > 
      
        <div class="test" style="font-size:90px">&#128181</div>
    </div>
        <h4 class="mb-0"><b>Payment Completed!!</b></h4>
            <p class="mb-15"> Payment Completed Successfully
           <p><font color="green"> You Will Be Automatically Redirect To Preview</font></p></p>
               
</div> -->


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


<!-- 
 <div class="row">
    <div class="col-lg-5 offset-lg-4">
        <div class="card mb-0">
            <div class="card-body">
            
      <div class="text-center mb-3">
               
                <h5 class="mb-0">Payment Completed</h5>
                             
                </div>
     
 

       
                    <div class="form-group">
                       Payment Completed Successfully
                    </div>
                


            <span> <img class="ajax-loader" src="{{ url('global_assets/pp.gif')}}"> <span class="loader-text"><p><font color="green"> You Will Be Automatically Redirect To Preview</font></p></span></span>
  </div>
        </div>
    </div>
</div>
 -->


              
@endsection @section('overscripts') @parent

@endsection @section('scripts') @parent

 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('admin/get-bitaps-status/'.$purchase_id)}}", function( data ) { 
                 if(data['status'] == 'finish'){

                         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/preview/' + data['id'];
                
                  window.location = redirectPath
                 }
                 
            });
     }, 4000);

 </script>
@endsection







