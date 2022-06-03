@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
 @include('app.user.layouts.wallet')

<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
           {{trans('wallet.fund_transfer')}}
        </h4>
    </div>
    <div class="card-body">
        <form action="{{url('user/fund-transfer')}}" class="smart-wizard form" method="post" onsubmit="return checkForm(this);">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-4 col-form-label" for="username">
                    {{trans('wallet.username')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control " id="key-word-user" name="autocompleteusers" type="text" placeholder=" {{trans('ewallet.enter_username')}}" required="" autocomplete="off">
                 
                     <input id="key_user_hidden" name="username" type="hidden"/>
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 col-form-label" for="amount">
                     {{trans('wallet.amount')}} :
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                     <input type="number" id="amount" name="amount" class="form-control" required="" min="1" placeholder=" {{trans('ewallet.enter_amount')}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 col-form-label" for="note">
                    {{trans('ewallet.note')}}
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <textarea name="note" id="note" class="form-control" required=""></textarea>
                </div>
            </div>

              <div class="form-group">
                <label class="col-sm-4 col-form-label" for="note">
                   {{trans('ewallet.transaction_password')}}
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                     <input type="password" id="trans_pass" name="trans_pass" class="form-control" required=""  placeholder=" {{trans('ewallet.enter_transaction_password')}}" autocomplete="disable">
                </div>
            </div>

            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                       <button class="btn btn-info" tabindex="4" name="add_amount" id="add_amount" type="submit" value="Add Amount"> {{trans('wallet.send_amount')}}</button > 
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>




                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">
   function checkForm(form)
 {
  
   form.add_amount.disabled = true;
   form.debit_amount.disabled = true;
   return true;
 }

</script>
@stop



 