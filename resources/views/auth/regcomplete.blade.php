@extends('layouts.auth')



@section('styles') @parent
<style type="text/css">
    h4{
        margin-top: 70px;
    }
    .test{
        position: auto;
        left: auto;
        top: 30px;
    }
    .card{
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        top: 90px;

    }
</style>
@endsection
@section('content')
<!-- 
<div class="card text-center  p-4" style="width: 50rem;">
    <div class="icon-object border-success-400 text-success test" > 
   
        <div class="test" style="font-size:90px">&#128181</div>
    </div>
        <h4 class="mb-0"><b>Payment Completed!!</b></h4>
            <p class="mb-15"> Payment Completed Successfully
           <p><font color="green"> You Will Be Automatically Redirect To Preview</font></p></p>
               
</div>
 -->

 
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
       
    </div>
        
<div class="card-body">
  <p> {{trans("users.payment_completed_successfully")}}</p>
  <br>
  <div class="row">
  <div class=col-sm-12>
    @if($reg_type != 6)
    <img class="ajax-loader" src="{{ url('global_assets/pp.gif')}}"> <span class="loader-text"><font color="green"> {{trans("users.you_will_be_automatically_redirect_to_preview")}}</font></span>
    @else
      <img class="ajax-loader" src="{{ url('global_assets/pp.gif')}}"> <span class="loader-text"><font color="green"> {{trans("users.you_need_administrator_approval_to_complete_this_registration")}}</font></span>
    @endif
</div>
</div>
</div>            
</div>




@endsection

@section('topscripts')
@parent

@endsection

@section('scripts')
@parent

 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('ajax/get-bitaps-status/'.$purchase_id)}}", function( data ) { 
                 if(data['status'] == 'finish'){
                        var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/register/preview/' + data['id'];
                
                  window.location = redirectPath
                 }
                 
            });
     }, 4000);

 </script>

  
@endsection