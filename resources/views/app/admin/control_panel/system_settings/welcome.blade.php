<div class="card-body"> 
  <div class="card-header header-elements-inline">
    <h4 class="card-title">{{trans('ticket_config.welcome_email')}}</h4>
    <div class="header-elements">
     
    </div>
  </div>
  <form id="settings" method="post" action="{{url('admin/control-panel/control-welcomemail_settings')}}" data-parsley-validate="parsley">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <legend>{{trans('welcome_email')}}</legend>
    @foreach($settings as $rank)
      <div class="col-sm-12">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4">
              <label  class="form-label" for="point_value">{{trans('From')}} :</label>   
            </div>
            <div class="col-sm-8">
              <input class="form-control" name="from" type="text" value="{{$rank->to_email}}">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4">
              <label  class="form-label" for="point_value">{{trans('Subject')}}:</label>    
            </div>
            <div class="col-sm-8">
               <input class="form-control" name="subject" type="text" value="{{$rank->subject}}">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-4">
              <label  class="form-label" for="point_value">{{trans('Welcome_email_message')}}:</label>
            </div>
            <div class="col-sm-8" >
             <textarea class="form-control" name="description" rows="7" value="{{$rank->body}}">{{ $rank->body }}</textarea>
            
            </div>
          </div>
        </div>
         <div class="form-group row">
          <button class="btn bg-dark" type="submit">Save</button>
        </div>  
    </div>  
  </form>
  @endforeach
</div>