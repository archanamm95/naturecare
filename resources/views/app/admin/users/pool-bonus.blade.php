@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent

@endsection @section('main')
             @include('app.admin.users.pooldata')
<div class="card card-flat border-top-success">
     <div class="card-header bg-white header-elements-xl-inline">
      
       
           <div class=""><h5>{{$title}}</h5></div>
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
         <div class="table-responsive">
         <table class="table ">
            <thead>
                <th> {{trans("users.rank")}}</th>
                <th> {{trans("users.user_count")}}</th>
                <th>{{trans("users.total_share")}}</th>
            </thead>

            <tbody>

            @foreach($user_rank_data as $key => $value)
                <tr>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['count']}} <!-- Button trigger modal -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalLong{{$key}}" title="User Details">
  <svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use></svg>
</button>

<!-- Modal -->
<div class="modal fade " id="exampleModalLong{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{$value['name']}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($value['username'] as $key1 => $value1)
          <p><span>{{$value1->username}} :  {{$value1->name}}  {{$value1->lastname}}</span></p>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</td>
                    <td>{{$value['share']}}</td>
                </tr>
            @endforeach
             </tbody>
             
         </table>
         </div>
         <br>
         <br>
         <br>
            <form action="{{url('admin/users/pool-bonus')}}" class="smart-wizard form-horizontal" method="post"  >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="one_share" value="{{$one_share}}">
            <input type="hidden" name="total_share" value="{{$total_share}}">
            <input type="hidden" name="total_users" value="{{$total_users}}">
            <input type="hidden" name="pool_balance" value="{{$pool_balance}}">
            <input type="hidden" name="pool_percentage" value="{{$pool_percentage}}">
             <div class="form-group" >
              <div class="row">
                 <div class="col-md-4">
                  
                </div>    
                  <button class="btn btn-success" tabindex="4" name="Search" id="Search" type="submit" value="Search" > {{trans("users.release_pool_bonus")}} </button >   
       
                </div>
             </div>   
        </form>
     
     
    </div>
    
</div>
</div>

<div class="card card-flat border-top-success">
     <div class="card-header bg-white header-elements-xl-inline">
      
       
           <div class=""><h5>{{trans("users.pool_history")}}</h5></div>
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
      <div class="table-responsive">
        <table class="table table-invoice" id = "ewalletreport">
          <thead class="headerfooter">
            <tr>
              <th>{{trans('report.no')}}</th>      
                        <th>{{trans('users.pool_amount')}}</th>                                            
                        <th>{{trans('users.total_share_count')}} </th>
                        <th>{{trans('users.total_user_count')}} </th>
                        <th> {{trans('users.one_share_amount')}} </th>
                        <th>{{trans('report.date')}} </th>                     
                    </tr>
                </thead>
              <tbody>
                @foreach($pool_history as $key=> $report)
                <tr>
                  <td>{{$key +1 }}</td> 
                        <td>{{number_format($report->poolbonus,2)}}RM</td>
                        <td>{{$report->qualified_user_count}}</td>
                        <td>{{$report->total_count}}</td>
                        <td>{{number_format($report->share_amount,2)}}RM</td>
                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
          </tr>
                  @endforeach   
        </tbody>
          </table>
        </div>
     
     
    </div>
    
</div>
</div>




 @stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop