@extends('app.admin.layouts.default')
{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop
@section("styles") @parent
<style type="text/css">

body {
  color: #6a6c6f;
  background-color: #f1f3f6;
}

.container {
  max-width: 960px;
}

.card-default>.card-heading {
  color: #333;
  background-color: #fff;
  border-color: #e4e5e7;
  padding: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.card-default>.card-heading a {
  display: block;
  padding: 10px 15px;
}

.card-default>.card-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.card-default>.card-heading a[aria-expanded="true"] {
  background-color: #eee;
}

.card-default>.card-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.card-default>.card-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.accordion-option {
  width: 100%;
  float: left;
  clear: both;
  margin: 15px 0;
}

.accordion-option .title {
  font-size: 20px;
  font-weight: bold;
  float: left;
  padding: 0;
  margin: 0;
}

.accordion-option .toggle-accordion {
  float: right;
  font-size: 16px;
  color: #6a6c6f;
}

.accordion-option .toggle-accordion:before {
  content: "Expand All";
}

.accordion-option .toggle-accordion.active:before {
  content: "Collapse All";
}
.more-less {
    float: right;
    color: #212121;
}
form label {
    font-weight: 500;
    padding: 15px;
}
</style>
@stop
{{-- Content --}}
@section('main')
 @include('flash::message')



  <div class="card card-flat">
    <div class="card-body">

    

         <form action="{{url('admin/save-roles')}}" method="post">
            <input type="hidden" name="emp_id" id="emp_id" value="{{$emp_id}}"> 
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-sm-12 col-md-10">
                <div class="card-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="container">
                    <div class="accordion-option">
                    <h3 class="title">Assign Roles</h3>
                    <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="card-group" id="accordion" role="tablist" aria-multiselectable="true" style="border: solid;"><br>



<div class="card card-default" style="    margin: 16px;">

    @foreach($roles as $roless)  
      <div class="card-heading" role="tab" id="headingOne">
        <h4 class="card-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$roless->id}}" aria-expanded="true" aria-controls="collapseOne{{$roless->id}}">

       {{trans($roless->role_name)}}
        </a>
      </h4>
      </div>
      <div id="collapseOne{{$roless->id}}" class="card-collapse collapse in" role="tabpanel" aria-labelledby="headingOne{{$roless->id}}">
        <div class="card-body">
          @if($roless->submenu_count==1)
           <label for="usr">
                                        <input type="checkbox"  class="checkbox-inline" 
                                            @if(isset($menu_id))
                                            @if(in_array($roless->id,$menu_id,true))  checked="true"  @endif  @endif 
                                           id="menu" name="menu[]" value="{{$roless->id}}">

                                            {{trans($roless->role_name)}}</label>
          @else

           @foreach($sub_roles as $sub_item)        
                            @if($sub_item->parent_id ==  $roless->id)   
                                    <label for="usr">
                                        <input type="checkbox"  class="checkbox-inline" 
                                            @if(isset($menu_id))
                                            @if(in_array($sub_item->id,$menu_id,true))  checked="true"  @endif  @endif 
                                           id="menu" name="menu[]" value="{{$sub_item->id}}">

                                            {{trans($sub_item->role_name)}}</label>

                                           
                            @endif
                        @endforeach
             @endif
        </div>
      </div>
      @endforeach
    </div>






                    
                </div><br>
                   
                        </div> 
                <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                {{trans('registration.assign_roles')}}
                            </button>
                        </div>
                </div>
            </div>
         </form> 
        </div>
    </div>




@endsection
@section('scripts') @parent



  <script type="text/javascript">
      $(document).ready(function() {

  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .card-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .card-collapse.in').collapse('hide');
  }
     
});
  </script>
    @stop


    

