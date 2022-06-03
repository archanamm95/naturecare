@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- <link href="{{asset('assets/globals/reg/parsley.css')}}" rel="stylesheet"/> -->
<style type="text/css">
.product-thumb .image {
   text-align: center;
   margin-top: 10px;
   margin-bottom: 10px;
   margin-bottom: 10px;
   height: 90px;
}
.product-thumb {
   border: 2px solid #ddd;
   margin-bottom: 10px;
} 
.price {
    background: none repeat scroll 0 0 #231f20;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    padding-bottom: 20px;
    padding-top: 20px;
    }
</style>
<link rel="stylesheet" href="{{asset('assets/globals/css/autosuggest.css')}}" type="text/css" media="screen" charset="utf-8" />
<link href="{{asset('assets/globals/reg/bwizard.min.css')}}" rel="stylesheet" />
<!-- <link href="{{asset('assets/globals/reg/parsley.css')}}" rel="stylesheet" /> -->
<style type="text/css">
 #err{
    display:none;
    background:#f2dede;
    border-radius: 5px;
    height: 50px;
    padding-top: 10px;
    color: #a94442;
}

label > span { color:red;}
/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;  background-color: #ffffff;  padding: 0 !important;  border-radius: 4px;  -moz-border-radius: 4px;  border:1px solid #ddd;  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);  box-shadow: 0 6px 12px rgba(0,0,0,.175);  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);  background-clip: padding-box;  opacity: 0.97;  filter: alpha(opacity=97);}
div.bhoechie-tab-menu{  padding-right: 0;  padding-left: 0;  padding-bottom: 0;}
div.bhoechie-tab-menu div.list-group{  margin-bottom: 0;}
div.bhoechie-tab-menu div.list-group>a{  margin-bottom: 0;}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {  color: #00acac;}
div.bhoechie-tab-menu div.list-group>a:first-child{  border-top-right-radius: 0;  -moz-border-top-right-radius: 0;}
div.bhoechie-tab-menu div.list-group>a:last-child{  border-bottom-right-radius: 0;  -moz-border-bottom-right-radius: 0;}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{  background-color: #00acac;  background-image: #00acac;  color: #ffffff;}
div.bhoechie-tab-menu div.list-group>a.active:after{  content: '';  position: absolute;  left: 100%;  top: 50%;  margin-top: -13px;  border-left: 0;  border-bottom: 13px solid transparent;  border-top: 13px solid transparent;  border-left: 10px solid #00acac;}
div.bhoechie-tab-content{  background-color: #ffffff;  /* border: 1px solid #eeeeee; */  padding-left: 20px;  padding-top: 10px;}
div.bhoechie-tab div.bhoechie-tab-content:not(.active){  display: none;}
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {    z-index: 2;    color: #fff;    background-color: #00acac;    border-color: #00acac;}
</style>
@endsection
{{-- Content --}}
@section('main')
@include('flash::message')
@include('utils.errors.list')

 <div class="row">
  <!-- begin col-12 -->
  <div class="col-md-12 ui-sortable">
    <!-- begin panel -->
    <div class="panel panel-info">


      <div class="panel-body">
     
              <form class="wizard-form steps-planpurchase" action="{{url('user/shippingcreation')}}" method="POST"  name="form-wizard">

              <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="payable_vouchers[]" value="">
          <input type="hidden" name="payment" id="payment" value="ewallet">
          <input type="hidden" name="option" id="option" value="{{$option}}">
        {!! csrf_field() !!}

            <h6>Shipping Address </h6>
            <fieldset>

            @if($option == 1)
        
               


<div id="myRadioGroup">
  <span style="margin-left: 20px;">
<input type="radio" name="radio_address" checked="checked" value="1" /><span style=" color: red; font-size: 16px;">&nbsp&nbspCopy Default Address </span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="radio" name="radio_address" value="2" /><span style=" color: red; font-size: 16px;">&nbsp&nbspNew Address</span>
</span>
 


<div id="radio_address1" class="desc">

  <br/>

          <div class="row">

          <!-- begin col-6 -->
          <div class="col-md-6">
          <div class="form-group">
          <label>Full Name<span>*</span></label>
          <input type="text" name="fname1" class="form-control" value="{{$full_name}}"  >
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
          <label>Country <span>*</span> </label>
          <input type="text" name="country1" class="form-control" value="{{$country}}"  readonly="true">
          </div>
          </div>
          </div>

          <div class="row">


          <div class="col-md-6 hidden">
          <div class="form-group">
          <label>Email Address<span>*</span> </label>
          <input type="text" name="email1" class="form-control" placeholder="{{$def_email}}" value="{{$def_email}}"  >
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
          <label>State <span>*</span> </label>

          <input type="text" name="state1" class="form-control" value="{{$state->name}}"  readonly="true">

          </div>
          </div>
            
             <div class="col-md-6">
          <div class="form-group">
          <label>Pincode<span>*</span> </label>
          <input type="text" name="pincode1" class="form-control" value="{{$zip}}"  readonly="true">
          </div>
          </div>
          
          </div>

          <div class="row">
          <!-- begin col-6 -->
          

          <div class="col-md-6">
          <div class="form-group">
          <label>Contact Number<span>*</span> </label>
          <input type="text" name="contact1" class="form-control" placeholder="{{$def_mob}}" value="{{$def_mob}}"  >
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
          <label>City<span>*</span> </label>
          <input type="text" name="city1" class="form-control" value="{{$street}}"  readonly="true">
          </div>
          </div>

          </div>
          </span>
          <div class="row">
          <!-- begin col-6 -->


          <div class="col-md-6">
          <div class="form-group">
          <label>Address<span>*</span> </label>
          <input type="text" name="address1" class="form-control" value="{{$address1}} {{$address2}}" readonly="true" >
          </div>
          </div>

         
          </div>





</div>
<div id="radio_address2" class="desc" style="display: none;">

          <div class="row">

          <!-- begin col-6 -->
          <div class="col-md-6">
          <div class="form-group">
          <label>Full Name<span>*</span></label>
          <input type="text" name="fname2" class="form-control" placeholder="Enter firstname" >
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
          <label>Country <span>*</span> </label>
          <select name="country2" id="country" class="form-control"  >
                                                          @foreach($countries as $countries)
                                                              @if($countries->country_id == 129)
                                                                  <option value="{{$countries->country_id}}" selected="true">{{$countries->name}}</option>
                                                              @else
                                                                  <option value="{{$countries->country_id}}">{{$countries->name}}</option>
                                                              @endif
                                                          @endforeach
                                                        </select>
          </div>
          </div>
          </div>

          <div class="row">
          <!-- begin col-6 -->
          <div class="col-md-6 hidden">
          <div class="form-group">
          <label>Last Name<span>*</span> </label>
          <input type="text" name="lname2" class="form-control" placeholder="Enter Lastname" value=" "  >
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
          <label>State <span>*</span> </label>

          <select name="state2" id="state2" class="form-control" >
                                                          @foreach($statess as $states)
                                                          <option value="{{$states->zone_id}}">{{$states->name}}</option>
                                                          @endforeach
                                                        </select>

          </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
          <label>City<span>*</span> </label>
          <input type="text" name="city2" class="form-control" value=""  >
          </div>
          </div>
          </div>

          <div class="row">
          <!-- begin col-6 -->
          <div class="col-md-6 hidden">
          <div class="form-group">
          <label>Address<span>*</span> </label>
          <input type="text" name="email2" class="form-control" placeholder="Email Address" value="{{$def_email}}" >
          </div>
          </div>

          
          </div>
          </span>
          <div class="row">
          <!-- begin col-6 -->
          <div class="col-md-6">
          <div class="form-group">
          <label>Contact Number<span>*</span> </label>
          <input type="text" name="contact2" class="form-control" placeholder="Enter Contact Number" value=""  >
          </div>
          </div>

          <div class="col-md-6">
          <div class="form-group">
          <label>Address<span>*</span> </label>
          <input type="text" name="address2" class="form-control" value=""  >
          </div>
          </div>
          </div>

          <div class="row">
          <div class="col-md-6">
          <div class="form-group">
          <label>Pincode<span>*</span> </label>
          <input type="text" name="pincode2" class="form-control" value=""  >
          </div>
          </div>
          </div>
          
</div>
</div>




            

            @endif


                           
              </fieldset>
            <h6>Payment Method</h6>
            <fieldset style="text-align: center;"> 


            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="shipping_details">Payment Details</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Details</h4>
      </div>
      <div class="modal-body">
        <h1><p class="text-success"> Shipping Cost : <span name="shipping_fee" id="shipping_fee1"></span></p></h1>
                              
                              <h1><p class="text-success"> Total Product Price : <span name="fee" id="price1"></span></p></h1>

                              <h1><p class="text-success"> Final Order Price : <span name="total_fee" id="total_fee1"></span></p></h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

            <input type="hidden" name="total_amount" id="total_amount" >
            <input  type= "hidden" name="quantity" id="quantity" value="{{$quantity}}">
            <input type="hidden" name="shippingcost" id="shippingcost">
              <div class="jumbotron m-b-0 text-center" style="background: white;">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                        <div class="list-group">
                          <!--<a href="#" payment="cheque" class="list-group-item text-center active">-->
                          <!--  <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.ewallet')}}</a>-->
                          <!-- <a href="#" payment="ewallet" class="list-group-item text-center" class="">
                            <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.ewallet')}}</a>
                          <a href="#" payment="paypal" class="list-group-item text-center" class="">
                            <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.paypal')}}</a>
                          <a href="#" payment="voucher" class="list-group-item text-center" class="">
                            <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.voucher')}}</a> -->
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                        <div class="list-group">
                          <!--<a href="#" payment="cheque" class="list-group-item text-center active">-->
                          <!--  <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.ewallet')}}</a>-->
                          <a href="#" payment="ewallet" class="list-group-item text-center" class="">
                            <h4 class="glyphicon glyphicon-send"></h4><br/>Ewallet</a>
                          <!-- <a href="#" payment="bank_transfer" class="list-group-item text-center" class="">
                            <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.bank_transfer')}}</a> -->
                          <!-- <a href="#" payment="voucher" class="list-group-item text-center" class="">
                            <h4 class="glyphicon glyphicon-send"></h4><br/>{{trans('user/onlinestore.voucher')}}</a> -->
                        </div>
                      </div>

                        <div class="bhoechie-tab-content active">
                          <div class="text-center">
                            <div class="text-center">
                                
                              <h1><p class="text-danger"> Balance E-Wallet :  {{$balace_ewallet}}<span name="balance" ></span></p></h1>
                              

                              <textarea rows="4" placeholder="Add a feed back here . . . " name="my_feed_back1" style="width: 40%;border-color: #c54f4f;border-width: initial;margin-bottom: 9px;margin-right: -14px;" value=""></textarea>

                              <!-- <h3>{{trans('user/onlinestore.confirm_purchase')}}</h3> -->
                              <p><button class="btn btn-success btn-lg" role="button" id="cheque" style=" margin-right: -221px;">Complete</button></p>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="bhoechie-tab-content ">
                          <div class="text-center">
                            <div class="text-center">

                              <h1><p class="text-danger"> Balance E-Wallet :  {{$balace_ewallet}}<span name="balance" ></span></p></h1>
                              
                              
                              <textarea rows="4" placeholder="Add a feed back here . . . " name="my_feed_back2" style="width: 40%;border-color: #c54f4f;border-width: initial;margin-bottom: 9px;margin-right: -221px;" value=""></textarea>
                            <h1><p class="text-success">{{trans('user/onlinestore.total_amount')}}: {{$price}}</p></h1>
                              <h3>{{trans('user/onlinestore.confirm_purchase')}}</h3>
                              <p><button class="btn btn-success btn-lg"  role="button" id="bank_transfer" style=" margin-right: -221px;">Complete</button></p>
                            </div>
                          </div>
                        </div> -->

                        <div class="bhoechie-tab-content">
                          <div class="text-center">
                            <input type="hidden" name="PAYMENTREQUEST_0_ITEMAMT" value="{{$price}}"/>
                            <input type="hidden" name="PAYMENTREQUEST_0_AMT" value="{{$price}}" readonly/>
                              <h1><p class="text-success"> {{trans('user/onlinestore.total_amount')}} : {{$price}}<span name="fee" id="paypal_joining"></span></p></h1>
                            <div id="myContainer" style ="margin-top:100px">
                            </div>
                          </div>
                        </div>
<!--                         <div class="bhoechie-tab-content ">
                          <div class="text-center">
                            <div class="text-center">
                              <h1> <p class="text-success" id="totalpay"></p></h1>
                              <div class="row">
                                <div class="col-sm-2">
                                  <h4>voucher</h4>
                                </div>
                                <div  class="col-sm-4">
                                  <input type="text" name="key" id="key" placeholder="voucher key" class="form-control" />
                                </div>
                                <div  class="col-sm-2">
                                  <a href="" id="verify" class="btn btn-default">verify</a>
                                </div>
                                <div  class="col-sm-4">
                                  <div id ="err"></div>
                                </div>
                              </div>
                              <table class="table" id="resulttable">
                                <tr>
                                  <th>Voucher code</th>
                                  <th>Total amount</th>
                                  <th>Balance</th>
                                </tr>
                              </table><br>
                              <p><button id="conf" class="btn btn-success" role="button">confirm</button></p>
                            </div>
                          </div>
                        </div> -->
<!--                         <div class="bhoechie-tab-content ">
                          <div class="text-center">
                            <div class="text-center">
                            <h1><p class="text-success" id="totalpay"> {{trans('user/onlinestore.total_amount')}}: {{$price}}</p></h1>
                              <div class="row">
                                <div class="col-sm-2">
                                  <h4>{{trans('user/onlinestore.voucher')}}</h4>
                                </div>
                                <div   class="col-sm-4">
                                  <input type="text" name="key" id="key" placeholder="{{trans('user/onlinestore.voucher_key')}}" class="form-control" />
                                </div>
                                <div   class="col-sm-2">
                                  <a href="" id="verify" class="btn btn-success btn-sm">{{trans('user/onlinestore.verify')}}</a>
                                </div>
                                <div   class="col-sm-4">
                                  <div id ="err"></div>
                                </div>
                              </div>
                              <table class="table" id="resulttable">
                                <tr>
                                  <th>{{trans('user/onlinestore.voucher_code')}}</th>
                                  <th>{{trans('user/onlinestore.total_amount')}}</th>
                                  <th>{{trans('user/onlinestore.balance')}}</th>
                                </tr>
                              </table><br>
                              <p><button id="conf" class="btn btn-success" role="button">{{trans('user/onlinestore.confirm')}}</button></p>
                            </div>
                          </div>
                        </div>  -->
                        <div class="bhoechie-tab-content">
                          <div class="text-center">
                            <div class="text-center">
                              <h1><p class="text-success">{{trans('user/onlinestore.total_amount')}}: {{$price}}</p></h1>
                              <div class="row">
                                <div class="col-sm-2">
                                  <h4>{{{ trans('all.voucher') }}}</h4>
                                </div>
                                <div   class="col-sm-4">
                                  <input type="text" name="key" id="key" placeholder="{{{ trans('all.voucher_key') }}}" class="form-control" />
                                </div>
                                <div   class="col-sm-2">
                                  <a href="" id="verify" class="btn btn-default">{{{ trans('all.verify') }}}</a>
                                </div>
                                <div class="col-sm-4">
                                  <div id ="err"></div>
                                </div>
                              </div>
                              <table class="table" id="resulttable">
                                <tr>
                                  <th>{{{ trans('all.voucher_code') }}}</th>
                                  <th>{{{ trans('all.total_amount') }}}</th>
                                  <th>{{{ trans('all.balance') }}}</th>
                                </tr>
                              </table><br>
                              <p><button id="conf" class="btn btn-success" role="button">{{{ trans('all.confirm') }}}</button></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

             <!--  <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                  <li class="nav-item active"><a href="#steps-planpurchase-tab1" class="nav-link  steps-plan-payment active " data-toggle="tab" data-payment='cheque' >{{trans('products.cheque')}}</a></li>
                  <li class="nav-item"><a href="#steps-planpurchase-tab2" class="nav-link steps-plan-payment" data-toggle="tab" data-payment='ewallet'>{{trans('products.ewallet')}}</a></li>
       
                </ul> 

                <div class="tab-content">
                  <div class="tab-pane active  " id="steps-planpurchase-tab1">
                    <input type="hidden" name="steps_plan_payment" value="cheque" >
                     {{trans('products.send_your_payment_checque_to_the_company')}}  <code>{{trans('products.order_will_process_after_payment_received')}}  </code>, {{trans('product.thanks')}}.
                  </div>

                  <div class="tab-pane fade" id="steps-planpurchase-tab2">
                     {{trans('products.ewallet_comment')}}
                  </div>

     
                </div>
              </div> -->




             
                
              
            </fieldset>

             

             
          </form>
      </div>
    </div>
    <!-- end panel -->
  </div>
  <!-- end col-12 -->
</div>
              

@endsection

@section('scripts') @parent

<!-- Start JS Validation -->
<!-- <script src="{{asset('assets/globals/reg/parsley.js')}}" type="text/javascript"></script> -->
<script src="{{asset('assets/globals/reg/bwizard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/globals/reg/form-wizards-validation.demo.min.js')}}" type="text/javascript"></script>
<!-- End JS Validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>

    $(document).ready(function() {

        App.init(); 
    });

</script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>
<!-- <script src="{{asset('assets/globals/reg/parsley.js')}}" type="text/javascript"></script> -->
<script src="{{asset('assets/globals/reg/bwizard.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/globals/reg/form-wizards-validation.demo.min.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('assets/globals/plugins/slick/slick.js')}}" type="text/javascript"></script> -->
<script type="text/javascript" src="{{asset('assets/globals/js/autosuggest.js')}}" charset="utf-8"></script>
<script src="{{ asset('assets/globals/reg/apps.min.js')}}" type="text/javascript"></script>
<script src="https://js.braintreegateway.com/web/3.11.0/js/client.min.js"></script>
  <script src="https://js.braintreegateway.com/web/3.11.0/js/hosted-fields.min.js"></script>
  <script src="https://js.braintreegateway.com/web/3.11.0/js/paypal-checkout.min.js"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#conf").hide();
    var voucherbalance = 0;
    var voucher = [];
    var joiningfe ={{$price}};
    $("table#resulttable").hide();
    $('body').on('click','#verify',function(e){
         $("#err").hide();
        e.preventDefault();
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
       if(jQuery.inArray($('#key').val(), voucher) == -1){
            $.ajax({
            url: '/register/data',
            type: "post",
            async: false,
            dataType: "json",
            data:{key:$('#key').val()},
            success: function(data,textStatus, jqXHR) {
                    if(data[0]==undefined){
                         $("#err").show();
                         document.getElementById("err").innerHTML = "<strong> {{trans('all.error') }}!</strong> {{trans('all.invalid_voucher_code') }}";
                    }
                    voucher.push(data[0].voucher_code);
                    if(voucherbalance<joiningfe)
                        {
                             voucherbalance += parseInt(data[0].total_amount);
                        $("table#resulttable").show();
                        drawTable(data);
                   payable_vouchers.push(data[0]);
                        }
                        else{
                              $("#err").show();

                             document.getElementById("err").innerHTML = "<strong> {{trans('all.error') }}!</strong> {{trans('all.reached_max_joining_fee') }} ";
                          $("#conf").show();
                            voucherbalance -= parseInt(data[0].total_amount);
                      }
                    }
            });
         }
        else{
              $("#err").show();
             document.getElementById("err").innerHTML = "<strong> {{trans('all.error') }}!</strong> {{trans('all.voucher_code_already_used') }}  ";
            }
    });
});


function drawTable(data) {

    for (var i = 0; i < data.length; i++) {

        drawRow(data[i]);
    }
}

function drawRow(rowData) {

    var row = $("<tr />");

    $("#resulttable").append(row);

    row.append($("<td><input type='hidden' name='payable_vouchers[]' value='" + rowData.voucher_code + "'>" + rowData.voucher_code + "</td>"));

    row.append($("<td>" + rowData.total_amount + "</td>"));

    row.append($("<td>" + rowData.balance_amount + "</td>"));
}


</script>


<script type="text/javascript">
$('#state').change(function(){

  var selected = $(this).find('option:selected');
  var extra = selected.data('foo');
  var quantity = document.getElementById("quantity").value;
   extra = extra * quantity;
   // alert(extra);
  $('#shipping_fee').html(extra);
 
  $('#shippingcost').val(extra);
});
$('#country').change(function(){

  var selected = $(this).find('option:selected');
  var country = selected.data('coo');


  
    

});

</script>

<script>

      $(document).ready(function() {
          App.init();
          FormWizardValidation.init();
          var options = {
                script:"{{url('admin/suggestlist')}}?json=true&limit=10&",
                varname:"input",
                json:true,
                shownoresults:true,
                maxresults:10,
                callback: function (obj) { document.getElementById('testid').value = obj.id; }
          };
          var as_json = new bsn.AutoSuggest('sponsor', options);

        });
        $(document).ready(function() {
        
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        $('#payment').val($(this).attr('payment'));
    });
});
</script>
<script type="text/javascript">
    window.paypalCheckoutReady = function () {
        paypal.checkout.setup('supersandy_api1.gmail.com', {
             container: 'myContainer',
             environment: 'sandbox'
        });
    };
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("input[name$='radio_address']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#radio_address" + test).show();
    });
});
</script>

<script type="text/javascript">
    $('select[name=country]').change(function() {
    var country_country_id = $(this).val();

    if(country_country_id){
        $.ajax({
            type:"GET",
            url:"{{url('user/get-state-list')}}?id="+country_country_id,
            success:function(res){               
                if(res){
                    $("#state").empty();
                    $("#state").append('<option>Select</option>');
                    $.each(res,function(key,value){
                        $("#state").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                    $("#state").empty();
                }
            }
        });
    }else{
        $("#state").empty();
    }
   });

</script>
<script type="text/javascript">
   $('select[name=country2]').change(function() {
   var country_country_id = $(this).val();

   if(country_country_id){
       $.ajax({
           type:"GET",
           url:"{{url('user/get-state-list')}}?id="+country_country_id,
           success:function(res){               
               if(res){
                   $("#state2").empty();
                   $("#state2").append('<option>Select</option>');
                   $.each(res,function(key,value){
                       $("#state2").append('<option value="'+key+'">'+value+'</option>');
                   });

               }else{
                   $("#state2").empty();
               }
           }
       });
   }else{
       $("#state").empty();
   }
  });

</script>
<script>
$(document).ready(function(){
    
    $("#shipping_details").on("click", function(){
      var radio = $("input[name='radio_address']:checked").val();

      if(radio == 2){

        var state = document.getElementById("state2");
        
        var zone_id = state.options[state.selectedIndex].value;
        


        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
        var zone_shipping_cost = null;
        $.ajax({
          url: '{{url('/getshipping/cost')}}',
          type: "post",
          async: false,
          dataType: "json",
          data:{zone_id:zone_id},
          success: function(data,textStatus, jqXHR) {
            var extra = data;
            var quantity = document.getElementById("quantity").value;
            extra = extra * quantity;
    
            var price = {{$price}};
            var total_fee =extra + price;
    
            $('#shipping_fee').html(extra);
            $('#shipping_fee1').html(extra);
            $('#shipping_fee2').html(extra);
    
    
            $('#price1').html(price);
            $('#price2').html(price);  
            
            $('#total_fee1').html(total_fee);
            $('#total_fee2').html(total_fee);

            $('#total_amount').val(total_fee);
    
    
    
            $('#shippingcost').val(extra);
          }
        });
      }
      if(radio == 1){
        var extra = {{$shipping_state_cost}};
         var quantity = document.getElementById("quantity").value;
        extra = extra * quantity;

        var price = {{$price}};
        var total_fee =extra + price;

        $('#shipping_fee').html(extra);
        $('#shipping_fee1').html(extra);
        $('#shipping_fee2').html(extra);


        $('#price1').html(price);
        $('#price2').html(price);  
        
        $('#total_fee1').html(total_fee);
        $('#total_fee2').html(total_fee);

        $('#total_amount').val(total_fee);



        $('#shippingcost').val(extra);
      }
       
    });
    
    var option = {{$option}};
    if(option == 2){
        var extra = 0;
         var quantity = document.getElementById("quantity").value;
        extra = extra * quantity;

        var price = {{$price}};
        var total_fee =extra + price;

        $('#shipping_fee').html(extra);
        $('#shipping_fee1').html(extra);
        $('#shipping_fee2').html(extra);


        $('#price1').html(price);
        $('#price2').html(price);  
        
        $('#total_fee1').html(total_fee);
        $('#total_fee2').html(total_fee);

        $('#total_amount').val(total_fee);


        $('#shippingcost').val(extra);
    }
    
});
</script>

<script type="text/javascript">
 $('select[name=country2]').change(function() {
 var country_country_id = $(this).val();

 if(country_country_id){
     $.ajax({
         type:"GET",
         url:"{{url('api/get-shipping-state-list')}}?id="+country_country_id,
         success:function(res){               
             if(res){
                 $("#state2").empty();
                 $("#state2").append('<option>Select</option>');
                 $.each(res,function(key,value){
                     $("#state2").append('<option value="'+key+'">'+value+'</option>');
                 });

             }else{
                 $("#state2").empty();
             }
         }
     });
 }else{
     $("#state2").empty();
 }
});

</script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>

<script type="text/javascript">

    $(document).ready(function() {
        totalamount();

        $('#alert-danger').hide();
        $('#alert-danger-rp').hide();
        $('#alert-danger-date').hide();
        // $(".shipping_address").hide();
        // $('.shipping_firstname').removeAttr('required');
        // $('.shipping_lastname').removeAttr('required');
        // $('.shipping_address').removeAttr('required');
        // $('.shipping_address2').removeAttr('required');
        // $('.shipping_city').removeAttr('required');
        // $('.shipping_zip').removeAttr('required');
        // $('.shipping_country').removeAttr('required');
        // $('.shipping_state').removeAttr('required');
        $('#shipping').change(function() {
            $('.shipping_address').show();
            $('.shipping_firstname').attr('required',true);
            $('.shipping_lastname').attr('required',true);
            $('.shipping_address').attr('required',true);
            // $('.shipping_address2').attr('required',true);
            $('.shipping_city').attr('required',true);
            $('.shipping_zip').attr('required',true);
            $('.shipping_country').attr('required',true);
            $('.shipping_state').attr('required',true);
            
            if(this.checked){
                $('.shipping_address').hide();
                $('.shipping_firstname').removeAttr('required');
                $('.shipping_lastname').removeAttr('required');
                $('.shipping_address').removeAttr('required');
                $('.shipping_address2').removeAttr('required');
                $('.shipping_city').removeAttr('required');
                $('.shipping_zip').removeAttr('required');
                $('.shipping_country').removeAttr('required');
                $('.shipping_state').removeAttr('required');
            }
        });
    });  
</script>
<script type="text/javascript">


   $('#country').change(function(){
   var countryID = $(this).val(); 
    if (countryID != 'MY') {
        $(this).val('MY');
        alert('Sorry! Your country is temporary not available for registration at the moment.');
        return false;
    }
   if(countryID){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-state-list')}}?country_id="+countryID,
          success:function(res){               
           if(res){
               $("#state").empty();
               $.each(res,function(key,value){
                   $("#state").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#state").empty();
           }
          }
       });
   }else{
       $("#state").empty();
       $("#city").empty();
   }      
  });
</script>
<script type="text/javascript">

   $('#shipping_country').change(function(){
   var countryID = $(this).val(); 
   if (countryID != 'MY') {
        $(this).val('MY');
        alert('Sorry! Your country is temporary not available for registration at the moment.');
        return false;
    }
   if(countryID){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-state-list')}}?country_id="+countryID,
          success:function(res){               
           if(res){
               $("#shipping_state").empty();
               $.each(res,function(key,value){
                   $("#shipping_state").append('<option value="'+key+'">'+value+'</option>');
               });
          
           }else{
              $("#shipping_state").empty();
           }
          }
       });
   }else{
       $("#shipping_state").empty();
       $("#city").empty();
   }      
  });
</script>
@endsection





