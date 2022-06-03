
@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
@if($user_type == 'Influencer' || $user_type == 'InfluencerManager')
<div class="row">
    @foreach($result as $key=>$data)
    
    <div class="col">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{currency(round($data,2))}}</h3>

            
            <div class="text-muted text-size-small">
                 {{ucwords(str_replace('_',' ',$key))}} 
             </div>
            
            </div>
        </div>
    </div> 
    @endforeach
   <div class="col">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{currency(round($balance,2))}} </h3>
                <div class="text-muted text-size-small"> {{trans('wallet.balance')}}</div>
            </div>
        </div>
    </div>
 <div class="col ">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">RM {{$montly_groupsale}}</h3>
                <div class="text-muted text-size-small"> Groupsale</div>
            </div>
        </div>
    </div>    
</div>
@else
<div class="row">
     
    
    @foreach($payment as $key=>$data)
     @if($key != 'level' )
    <div class="col">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{currency(round($data,2))}}</h3>

             @if($key == 'referral_bonus' )
                <div class="text-muted text-size-small">
                 {{ucwords(str_replace('_',' ',$key))}} from {{$bonus_count['referral_bonus']}} Refferals
             </div>
             @else
            <div class="text-muted text-size-small">
                 {{ucwords(str_replace('_',' ',$key))}} 
             </div>
             @endif
            </div>
        </div>
    </div>
     @else
     <div class="col">
        <div class="card border-info">
            <div class="card-body metric_user_level">
                <!-- <h3 class="no-margin text-semibold">{{currency(round($data,2))}}</h3> -->
                <div class="card-header bg-white border-0 header-elements-inline pb-0"> 
                    <h3 class="no-margin text-semibold"><span id="total_users_level_total" class="level"
                        >{{currency(round($data,2))}}</span></h3>
                     <div class="header-elements">
            <div class="d-flex justify-content-between">

                <div class="list-icons ml-3">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                           <!--  <div class="dropdown-header">Show data from : </div>
                            <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button>  -->
                            <button data-range="1"
                                class="dropdown-item btn range">level1</button>
                            <button data-range="2"
                                class="dropdown-item btn range">level2</button>
                            <button data-range="3"
                                class="dropdown-item btn range">level3</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <div class="text-muted text-size-small">
                   
                 Level Bonus
                 
             </div>

            </div>
        </div>
    </div>
    @endif
    
    @endforeach
</div>
<div class="row">
    <div class="col">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{currency(round($balance,2))}} </h3>
                <div class="text-muted text-size-small"> {{trans('wallet.balance')}} </div>
            </div>
        </div>
    </div>
 <div class="col ">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">RM {{$montly_groupsale}} </h3>
                <div class="text-muted text-size-small"> Groupsale</div>
            </div>
        </div>
    </div>  
   
    <div class="col ">
        <div class="card border-info">
            <div class="card-body">
                <h3 class="no-margin text-semibold">{{currency(round($cashback,2))}}</h3>
                <div class="text-muted text-size-small"> Monthly cashback</div>
            </div>
        </div>
    </div>  
<div class="col-md-3 col-sm-12"> 
        <!-- <div class="card card-body border-top-primary">
                <div class="text-center">
                     <h2 class="font-weight-semibold">Target to Leadership Bonus!</h2>
                       @if($countof_dealership_bonus > 0)
                     Achieved your Leadership Bonus! You recieved Leadership Bonus {{$countof_dealership_bonus}} times.
                    @else  
                    You did not recieved Leadership bonus yet
                           <h4>You reffered {{$remain_referrals}} persons</h4>
                    @endif
                </div>

                <div class="progress rounded-pill" >
                     <div class="progress-bar bg-primary" style="width:{{($remain_referrals/10)*100}}%;" >
                            <span>{{$remain_referrals}}/10 persons</span>
                     </div>
                </div>
              
          </div> -->
          <div class="card card-body border-top-primary">
                <div class="text-center">
                     <!-- <h6 class="no-margin text-semibold">Target to Leadership Bonus!</h6> -->
               
                @if($bonus_count['leadership_bonus'] > 0)

                     <h6 class="font-weight-semibold">You recieved Leadership Bonus {{$bonus_count['leadership_bonus']}} times.Now {{$remain_referrals}}/10persons </h6>
                      @else  
                <h6 class="font-weight-semibold">No Leadership bonus yet</h6>
                    
                           <h6>You reffered {{$remain_referrals}}/10 persons</h6>
                    @endif
                    
                </div>

                <div class="progress rounded-pill" style="height: 0.925rem;" >
                     <div class="progress-bar bg-primary" style="width:{{($remain_referrals/10)*100}}%;" >
                            <span>{{$remain_referrals}}/10 persons</span>
                     </div>
                </div>
              
          </div>

     </div>  
 </div>
 @endif
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{trans('ewallet.wallet')}}</h5>
        <!-- <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div>
    <table class="table datatable-basic table-striped table-hover" id="ewallet-user-table">
    <thead>
        <tr>
            <th>
                {{trans('ewallet.username')}}
            </th>
            <th>
                {{trans('ewallet.from_user')}}
            </th>
       
            <th>
                {{trans('ewallet.amount_type')}}
            </th>
       
            <th>
                {{trans('ewallet.amount')}}
            </th>
            <th>
                {{trans('ewallet.date')}}
            </th>
        </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
 </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop