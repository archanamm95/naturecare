@extends('layouts.auth')

@section('content')
<br>
<br>
<div class="row">
    <div class="col-lg-5 offset-lg-4">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
               
                <h5 class="mb-0">{{trans('register.bitaps_payment')}}</h5>
                                <!-- <span class="d-block text-muted">All fields are required</span> -->
                </div>
       
                    <div class="form-group">
                       <div class="text-center">
                        <label for="cardNumber">BTC {{$package_amount}} </label>
                        <div class="input-group">

                            <input type="text" class="form-control selectall copyfrom form-control" readonly="" id="cardNumber" value="{{$payment_details->address}}"
                                required autofocus />
                          <!--   <span class="input-group-addon"  data-clipboard-target="#replicationlink"> <i class="fa fa-copy"></i> </span> -->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                         <div class="text-center" style="margin: 0 auto;">
                            <img src="https://bitaps.com/api/qrcode/png/{{$payment_details->address}}">
                        </div>                         
                    </div>                     

                    <p>
                      {{trans('register.make_your_payment_of')}} <b>BTC {{$package_amount}}</b>{{trans('register.to_the_above_wallet')}}, {{trans('register.when_your_payment_processed_then_system_will_redirect_you_automatically')}},

                    </p>


            <span> <img class="ajax-loader" src="{{ url('global_assets/pp.gif')}}"> <span class="loader-text">{{trans('register.waiting_for_your_payment')}}</span></span>
                                                        
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
            $.get("{{url('ajax/get-bitaps-status/'.$trans_id)}}", function( data ) { 
                 if(data['status'] == 'finish'){
                        window.location.href = 'register/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
  
@endsection
