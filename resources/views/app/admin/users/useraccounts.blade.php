@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent

@endsection @section('main')
<div class="card card-flat border-top-success">
     <div class="card-header bg-white header-elements-xl-inline">
      
       
           <div class=""><h5>{{trans("users.user_account")}}</h5></div>
            <div class="header-elements text-center">
                <a data-action="collapse">
                </a>
            </div>
       
    </div>

<div class="card card-flat">
   <!--  <div class="panel-heading">
        <h5 class="panel-title">   User Account </h5>
        <div class="heading-elements">
             <a data-action="collapse">
                </a>
        </div>
    </div> -->
      <div class="card-body">
       
         
            <form action="{{url('admin/useraccounts')}}" class="smart-wizard form-horizontal" method="post"  >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
             <div class="form-group" >
              <div class="row">
                 <div class="col-md-4">
                  <input class= "form-control" type="text" placeholder="{{trans("users.search_member")}}" id="key-word" required="" />
                  <input type="hidden" id="key_user_hidden" name="key_user_hidden"/>
                </div>    
                  <button class="btn btn-info" tabindex="4" name="Search" id="Search" type="submit" value="Search" >  <i class="fa fa-search" aria-hidden="true"> </i>{{trans("users.search")}} </button >   
       
                </div>
             </div>   
        </form>
     
     
       
<!-- <div class="col-sm-12">
                <span class="input-group">
                    <form action="{{url('admin/useraccounts')}}" class="smart-wizard form-horizontal" method="post"  >
                    <input class="form-control" id="key-word" name="key-word" placeholder="Search Member" type="text"/>
                    <input id="key_user_hidden" name="key_user_hidden" type="hidden"/>
                    <span class="input-group-prepend">
                        <button class="btn-icon btn btn-info" id="btn-filter-node" name="Search" id="Search" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                            Search
                        </button>
                    </span>
                     </form>
                </span>
            </div>  -->
    </div>
    
</div>
</div>

 @if($request->has('key_user_hidden'))
         @include('app.admin.users.userinfo')
 @endif

 @stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop