  <div class="row">
            <!-- <div class="col-sm-12"> -->
        <div class="col-sm-4">
            <div class="content-group">
                <div class="text-center " style="background: white; background-size:contain;height:300px;padding: .1px;">
                    <div class="thumbnail no-padding">
                                <div class="thumb mt-1">
                                   <img src="{{ url('img/cache/profile',$data[0]->profile) }}" class="img-circle img-responsive" alt="" style=" margin-top: 73px;>
                                </div>
                            
                                <div class="caption text-center">
                                    <h6 class="text-semibold no-margin">{{ $data[0]->name }} {{ $data[0]->lastname }}</h6><small class="display-block">{{ $data[0]->username }}</small><br><small class="display-block">{{ $data[0]->user_type }}</small>
                                   
                                </div>
                            </div>
               
             
                </div>     
            </div>   
        </div>

        <div class="col-sm-4">
            <div class="content-group card card-body">
            <div class="form-group mt-4">
                <label class="text-semibold">{{trans("users.username")}}:</label>
                <span class="pull-right-sm"> {{ $data[0]->username }}</span>
            </div>
            <div class="form-group">
                <label class="text-semibold">{{trans("users.full_name")}}:</label>
                <span class="pull-right-sm">{{ $data[0]->name }} {{ $data[0]->lastname }}</span>
            </div>
            <!--   <div class="form-group">
                <label class="text-semibold">{{trans("users.gender")}}:</label>
                <span class="pull-right-sm">{{ ($data[0]->profile_info->gender == 'm') ? 'Male' : 'Female' }}</span>
            </div> -->
            <div class="form-group">
                <label class="text-semibold">{{trans("users.phone_number")}}:</label>
                <span class="pull-right-sm">{{ $data[0]->mobile }}</span>
            </div>
            <div class="form-group">
                <label class="text-semibold"> {{trans("users.email")}}:</label>
                <span class="pull-right-sm"> {{ $data[0]->email }}</span>
            </div>    
            <div class="form-group">
                <label class="text-semibold"> {{trans("report.bank_details")}}:</label>
                <span class="pull-right-sm">{{ $data[0]->account_number}}
                <!--  @if($data[0]->account_number != "NULL"){{$data[0]->account_number}} @else Not Provided @endif -->
             </span>
            </div> 
           
            <div class="form-group">
                <label class="text-semibold"> {{trans("users.ic_number")}}:</label>
                <span class="pull-right-sm"> {{ $data[0]->passport}}</span>
            </div>
        </div>
    </div>

        <div class="col-sm-4">
            <div class="content-group card card-body">
                <div class="panel-body border-radius-top" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;height:300px;padding: 15px;">
                    <ul class="navigation" style="margin: 10;padding:0px;list-style: none;line-height:40px;">
                        <li class="navigation-header" style="color: #000;">{{trans("users.navigations")}}</li>
                        <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 1px;"><a  target="blank" href="{{ url('admin/userprofiles',$data[0]->username) }}" style="background-color:#000000;" ><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.profile")}}</a></li>
                        @if(Auth::user()->id == 1)
                       <!--  <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 2px;"><a  target="blank"href="{{ url('admin/incomedetails',$data[0]->id) }}" style="background-color:#000000;"><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.income_details")}}</a></li> -->
                         <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 2px;"><a  target="blank"href="{{ url('admin/salesdetails',$data[0]->id) }}" style="background-color:#000000;"><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.sales_details")}}</a></li>
                          <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 2px;"><a  target="blank"href="{{ url('admin/purchasedetails',$data[0]->id) }}" style="background-color:#000000;"><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.purchase_details")}}</a></li>
                        <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 1px;"><a target="blank" href="{{ url('admin/referraldetails',$data[0]->id) }}" style="background-color:#000000;"><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.referral_details")}}  </a></li>
                        <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 1px;"><a target="blank" href="{{url('admin/ewalletdetails',$data[0]->id)}}" style="background-color:#000000;"><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.ewallet_details")}}</a></li>
                        <!-- <li class="active" style="background-color: black;margin-left: -14px;    margin-right: -15px;margin-top: 1px;"><a target="blank" href="{{url('admin/payoutdetails',$data[0]->id)}}" style="background-color:#000000;"><i class="icon-files-empty" style="margin-left: 14px;"></i> {{trans("users.released_income_details")}}</a></li> -->
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>