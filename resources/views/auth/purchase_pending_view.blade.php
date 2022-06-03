@extends('layouts.auth_store')
@section('styles') @parent
<style type="text/css">
    #mobile-logo{
        display: none;
    }
</style>
@endsection
@section('content')
@include('flash::message')
@include('utils.errors.list')

<div class="content">
    <div class="row">
                    
        <div class="col-md-4 offset-md-4">
            <div class="card card-default">
                <div class="card-header">
                 <!--    <h3 class="panel-title">
                        Payment Details  
                    </h3> -->
                      <span> <!-- <img class="ajax-loader" src="{{ url('assets/pp.gif')}}">  --><span class="loader-text" style="font-size: 18px" style="text-align:center;">PAYMENT PROCESSING!</span></span>
                </div>
                <div class="card-body" style="margin-left: 23px;"><!-- 
                    
                   <div class="form-group text-center">
                        <h3 for="cardNumber" class="bg-h3">Amount : {{$userdet->amount}} </h3>
                        
                    </div> -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="{{ url('assets/images/payment_pro.gif')}}">                       
                        </div>                         
                    </div>                     

                   <p class="text-center">
                       When your Payment processed then system will redirect you automatically.
                    </p>
                </div>
            </div>
            
         
        </div>
    </div>
</div>

    
 

              

@endsection

@section('scripts') @parent
 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('getpreviewpayment/'.$userdet->id)}}", function( data ) { 
                console.log(data['status']);
                 if(data['payment_status'] == 'finish' || data['payment_type'] == 'register'){
                        window.location.href = '/viewinvoice/'+data['purchase_id'];
                 }
                 if(data['payment_status'] == 'complete' ){
                            $(".ajax-loader").attr("src","{{ url('assets/images/payment_pro.gif')}}");
                            $(".loader-text").html(" Payment received processing your request");
                 }
            });
     }, 4000);
 </script>
 
@endsection