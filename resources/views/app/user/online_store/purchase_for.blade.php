@extends('app.user.layouts.default')  {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
<style type="text/css">
</style>
@endsection {{-- Content --}} @section('main') @include('utils.errors.list') 
<div class="card card-white">
  <div class="card-header header-elements-inline">
    <h6 class="card-title">{{$title}}</h6>
    <div class="header-elements">
      <ul class="icons-list">
        <li><a data-action="collapse"></a></li>
      </ul>
    </div>
  </div>
  <div class="card-body">
    <form >
      <input type="hidden" name="_token" value="{{csrf_token() }}">
      <div class="form-group">

        <div class="row">
          <div class="col-md-2">
            <label for="name" class="col-form-label" style="padding-top: 0px;
            font-size: 15px;">Purchase For</label>
          </div>
          <div class="col-md-8">
            <input type="radio" name="verification" value="1" checked>Own
            <input type="radio" name="verification" value="0"> Third Party
          </div>
        </div>
        <div class="user-verify" style="display: none;">
          <div class="row" style="margin-top: 10px;">
            <div class="col-md-2">
              <label for="name" class="col-form-label" style="padding-top: 0px;
              font-size: 15px;">Username</label>
            </div>
            <div class="col-md-4" id="searchtreeholder">
              <span class="input-group">
                <input class="form-control" id="key-word-user" name="key-word-user-binary" placeholder=" {{trans('tree.search_member')}}" type="text" />
                <input id="key_user_hidden" name="key_user_hidden" type="hidden"/>
              </span>
            </div>
            <div class="col-md-2" class="user_verify_btn">
             <button class="btn btn-primary" id="user_verify_btn" name="user_verify_btn">
              Verify
            </button>
          </div>
        </div>
        <div class="row">
         <div class="third_party col-md-8" style="text-align: center;display: none;"> 
          <a class="btn btn-primary" href="{{url('user/onlinestore')}}" style="margin-right: 70px;margin-top: 20px;">
             Proceed To Product Catalogue 
             <i class="icon-arrow-right14 position-right">
             </i>
           </a>
         </div>
       </div>
     </div>
   </div>
   <div class="product_show">
    <a class="btn btn-primary" href="{{url('user/onlinestore')}}" style="margin-top: -20px;">
     Proceed To Product Catalogue 
     <i class="icon-arrow-right14 position-right">
     </i>
   </a>
 </div>
</div>
</form>
</div>
</div>



@endsection

@section('topscripts')
@parent

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
   $('input[type="radio"]').change(function() {
    if ($(this).val() == 0) {
      $('.product_show').hide();
      $('.user-verify').show();
    }else{
      $('.product_show').show();
      $('.user-verify').hide();
    }
  });
   $('#user_verify_btn').click(function(e){
    e.preventDefault();
    var user = $('#key-word-user').val();
    var username=$('#key_user_hidden').val();
    $.ajax({
      url: "{{URL::to('user/purchasefor')}}",
      type: "post",
      data: {
        id: user
      },
      dataType: 'json',
      success: function (data) {
        console.log(data);
        if (data.data != '') {
         swal("User verified", "", "success");
         $('.third_party').show();
       } else{
        swal("User not verified", "", "warning");
        $('.third_party').hide();
      }
    }
  });
    
  }); 
 });

</script>
@parent

@endsection

