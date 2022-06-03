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

<div class="card card-flat" >
	<div class="card-header header-elements-inline">
    	<div class="card-header header-elements-inline-btn">
			
        <h4 class="card-title">{{trans('ticket_config.change_username')}} </h4>
            
            
            
        </div>
     </div>
     <div class="card-body">
    <form action="{{url('admin/users/changeusername')}}" class="smart-wizard form" method="post"  >
    <input type="hidden" name="_token" value="{{csrf_token()}}">


        <div class="form-group">


                    <div id="searchtreeholder"  class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
                        <label class="col-sm-4 col-form-label" for="username">
                            {{trans('ewallet.username')}} <span class="symbol required"></span>
                        </label>
                        <div class="col-sm-4">
                            <span class="input-group"> 
                             <input type="text" class="form-control" id="key-word" name="key-word" placeholder="{{trans('ewallet.search_member')}}">
                              <input type="hidden" id="key_user_hidden" name="username" >
                              <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button"  id="btn-cancel"><i class="icon-cross"></i></button>
                              </span>
                            </span>                          
                        </div>
                        
                    </div>


          
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-form-label" for="amount">
                 {{trans('ticket_config.new_username')}}: <span class="symbol required"></span>
            </label>
                <div class="col-sm-4">
                <input type="text" id="new_username" name="new_username" class="form-control" required>
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
                        
                        Update
                        
                        </button>
                    </div>
                </div>


    </form>
</div>
    



	</div>


              

           

            
@endsection
