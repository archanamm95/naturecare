@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')
@include('flash::message')
@include('utils.errors.list')

<fieldset> 
    <div class="card-body">
    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
      <li class="nav-item active"><a href="#steps-firstorderbonus-tab1" class="nav-link steps-plan-payment active" data-toggle="tab" data-payment='FirstOrderBonus'>{{trans('ewallet.a')}}. {{trans('ewallet.change_password')}}</a></li>
      <!-- <li class="nav-item"><a href="#steps-binarymatchbonus-tab2" class="nav-link steps-plan-payment " data-toggle="tab" data-payment='BinaryMatchBonus'>{{trans('ewallet.b')}}. {{trans('ewallet.change_transaction_password')}}</a></li> -->
    
    </ul>

  <div class="tab-content" style="margin-top: -19px;">
  	 <!-- password -->
    <div class="tab-pane active" id="steps-firstorderbonus-tab1" >
     
      <div class="card-body card " style="border-radius:-3.5rem;">
       <form class="form" method="post"	action="{{ URL::to('admin/users/edit') }}"autocomplete="off">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div id="searchtreeholder"  class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
						<label class="col-sm-4 col-form-label" for="username">
							{{trans('ewallet.username')}} <span class="symbol required"></span>
						</label>
						<div class="col-sm-4">
							<span class="input-group"> 
							 <input type="text" class="form-control" id="key-word" name="key-word" placeholder="{{trans('ewallet.search_member')}}" required>
							  <input type="hidden" id="key_user_hidden" name="username" >
							  <span class="input-group-btn">
							  		<button class="btn btn-danger" type="button"  id="btn-cancel"><i class="icon-cross"></i></button>
							  </span>
							</span>							 
						</div>
					</div>
					<div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
						<label class="col-md-4 col-form-label" for="password">{{
						trans('users.password') }}</label>
						<div class="col-md-4">
							<input class="form-control" tabindex="6" placeholder="{{ trans('users.password') }}"	type="password" name="password" id="password" value="" autocomplete="new-password" required minlength="6" />
							{!!$errors->first('password', '<label class="col-form-label"	for="password">:message</label>')!!}
							
						</div>
					</div>
				
                 <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
					<label class="col-md-4 col-form-label" for="password_confirmation">{!!
						trans('users.password_confirmation') !!}</label>
						<div class="col-md-4">
							<input class="form-control" type="password" tabindex="6"
							placeholder="{{ trans('users.password_confirmation') }}"
							name="password_confirmation" id="password_confirmation" value="" autocomplete="new-password" required minlength="6" />
							{{$errors->first('password_confirmation', '<label
							class="col-form-label" for="password_confirmation">:message</label>')}}
						</div>
				</div>

           <div class="col-md-12">
					<div class="col-md-6 col-md-offset-4">
						
						<button type="reset" class="btn btn-sm btn-secondary">
						<span class="glyphicon glyphicon-remove-circle"></span> {{
						trans("modal.reset") }}
						</button>
						<button type="submit" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-ok-circle"></span>
						
						{{ trans("modal.change_password") }}
						
						</button>
					</div>
			</div>
        </form>     
    	</div>
    </div>

  
    <!-- transaction_passwoed -->

      
    <div class="tab-pane fade" id="steps-binarymatchbonus-tab2" >
   

	<div class="card card-body">
		<form class="form" method="post"	action="{{ URL::to('admin/change_transaction_password') }}"autocomplete="off">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			 	<div id="searchtreeholder"  class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
						<label class="col-sm-4 col-form-label" for="username">
							{{trans('ewallet.username')}} <span class="symbol required"></span>
						</label>
						<div class="col-sm-4">
							<span class="input-group"> 
							 <input type="text" class="form-control" id="key-word1" name="key-word1" placeholder="{{trans('ewallet.search_member')}}" required>
							  <input type="hidden" id="key_user_hidden1" name="username1" >
							  <span class="input-group-btn">
							  		<button class="btn btn-danger" type="button"  id="btn-cancel1"><i class="icon-cross"></i></button>
							  </span>
							</span>							 
						</div>
					</div>
                <div class="form-group {{{ $errors->has('transaction_password') ? 'has-error' : '' }}}">
					<label class="col-md-4 col-form-label" for="transaction_password">{{
						trans('users.transaction_password') }}</label>
						<div class="col-md-4">
							<input class="form-control" tabindex="6" placeholder="{{ trans('users.transaction_password') }}"	type="password" name="transaction_password" id="transaction_password" value="" autocomplete="new-password" required />
							{!!$errors->first('transaction_password', '<label class="col-form-label"	for="transaction_password">:message</label>')!!}
							
						</div>
				</div>
				<div class="form-group {{{ $errors->has('tpassword_confirmation') ? 'has-error' : '' }}}">
					<label class="col-md-4 col-form-label" for="tpassword_confirmation">{!!
						trans('users.password_confirmation') !!}</label>
						<div class="col-md-4">
						<input class="form-control" type="password" tabindex="6"
							placeholder="{{ trans('users.password_confirmation') }}"
							name="tpassword_confirmation" id="tpassword_confirmation" value="" autocomplete="new-password" required />
							{{$errors->first('password_confirmation', '<label
							class="col-form-label" for="tpassword_confirmation">:message</label>')}}
						</div>
				</div>

				<div class="col-md-12">
					<div class="col-md-6 col-md-offset-4">
						
						<button type="reset" class="btn btn-sm btn-secondary">
						<span class="glyphicon glyphicon-remove-circle"></span> {{
						trans("modal.reset") }}
						</button>
						<button type="submit" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-ok-circle"></span>
						
						{{ trans("modal.change_transaction__password") }}
						
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
      
  </div>
  </div>
</fieldset>

@endsection

@section('scripts') 
@parent 



@endsection