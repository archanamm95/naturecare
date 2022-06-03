@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
<style type="text/css">
  td,label{
        white-space: nowrap;
  }
</style>
@parent
@endsection



        {{-- Content --}}
        @section('main')
<div id="settings-page">
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.commission_settings')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <fieldset class="mb-3">
              <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                  <li class="nav-item active"><a href="#steps-commission-tab1" class="nav-link  steps-commission active " data-toggle="tab" data-payment='binary_commission' >{{trans('controlpanel.level_commission')}}</a></li>
                  <li class="nav-item"><a href="#steps-commission-tab2" class="nav-link steps-commission" data-toggle="tab" data-payment='level_commission'>{{trans('controlpanel.leadership_bonus')}} </a></li>
                  <li class="nav-item"><a href="#steps-commission-tab3" class="nav-link steps-commission" data-toggle="tab" data-payment='sponsor_commission'>{{trans('controlpanel.refferal_bonus')}}</a></li>
                   <li class="nav-item"><a href="#steps-commission-tab5" class="nav-link steps-commission" data-toggle="tab" data-payment='level_commission'>{{trans('controlpanel.sales_bonus')}} </a></li>
                   <li class="nav-item"><a href="#steps-commission-tab6" class="nav-link steps-commission" data-toggle="tab" data-payment='cashback_commission'>{{trans('controlpanel.cashback_bonus')}} </a></li>
                  <!-- <li class="nav-item"> <a href="#steps-commission-tab4" class="nav-link steps-commission" data-toggle="tab" data-payment='binary_matching_bonus'>{{trans('controlpanel.international_pool_bonus')}}</a></li> -->
                </ul> 
              </div>
              <div class="tab-content">
                <div class="tab-pane active  " id="steps-commission-tab1">
                  <!-- <div class="row">
                  <div class="col-sm-6"> -->
                  <form id="binaryform" class="form-horizontal" action="{{url('admin/control-panel/add-binarycommission')}}" method="post"  name="form-wizard">
                    {{csrf_field()}}    
                    <table class="table table-borderless">
                      <thead>
                      <tr>
                        <th><b>LEVELS</b></th>
                        <th><b>COMMISSION (MYR)</b></th>
                        <th><b>CRITERIA</b></th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label for="name" class="col-sm-6 control-label">First Level</label></td>
                          <td><input type="number" class="form-control" id="first_level" placeholder="{{trans('controlpanel.enter_first_level_commission')}}" name="first_level" value={{$level_commission->level_1}}></td>
                          <td><input type="number" class="form-control" id="first_level_criteria" placeholder="{{trans('controlpanel.enter_first_level_criteria')}}" name="first_level_criteria" value={{$level_commission->criteria_l1}}></td>
                        </tr>
                        <tr>
                          <td><label for="name" class="col-sm-6 control-label">Second Level</label></td>
                          <td><input type="number" class="form-control" id="second_level" placeholder="{{trans('controlpanel.enter_second_level_commission')}}" required="" name="second_level" value="{{$level_commission->level_2}}"></td>
                          <td><input type="number" class="form-control" id="second_level_criteria" placeholder="{{trans('controlpanel.enter_second_level_criteria')}}" required="" name="second_level_criteria" value="{{$level_commission->criteria_l2}}"></td>
                        </tr>
                        <tr>
                          <td><label for="name" class="col-sm-6 control-label">Third Level</label></td>
                          <td><input type="number" class="form-control" id="third_level" placeholder="{{trans('controlpanel.enter_third_level_commission')}}" required="" name="third_level" value="{{$level_commission->level_3}}"></td>
                          <div></div>
                          <td>
                          <input type="number"  class="form-control col-sm-6" id="third_level_criteria" placeholder="{{trans('Own Sales')}}" required="" name="third_level_criteria" value="{{$level_commission->criteria_l3}}">
                          </td>
                          <td>
                          <input type="number"  class="form-control col-sm-6" id="third_level_criteria2" placeholder="{{trans('Referral Sales')}}" required="" name="third_level_criteria2" value="{{$level_commission->criteria2_l3}}">
                          </td>

                        </tr>
                        <tr>
                          <td colspan="3">
                           <button style="margin-left: 570px;" class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                           </td>
                        </tr>
                       <!--  <tr colspan="3"><td></td><button class="btn bg-dark" type="submit" > {{trans('controlpanel.save')}}</button></td></tr> -->

                      </tbody>
                    </table>
                    <!-- <div class="pair_show"> -->
                        <!-- <div class="row"> -->
                          <!-- <div class="col-sm-6"> -->
                            <!-- <label for="name" class="col-sm-6 control-label">First Level</label> -->
                          <!-- </div> -->
                          <!-- <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pair_value" placeholder="{{trans('controlpanel.enter_pair_value')}}" name="pair_value" value={{$level_commission->nlevel_1}}> -->
                              <!-- <input type="number" class="form-control" id="first_level" placeholder="{{trans('controlpanel.enter_first_level_commission')}}" name="first_level" value={{$level_commission->level_1}}> -->
                          <!-- </div>  -->
                        <!-- </div> -->
                    <!-- </div> -->
                   <!--  <br>      
                    <div class="">
                      <div class="row">
                        <div class="col-sm-6">
                          <label for="name" class="col-sm-6 control-label">Monthly Maintenance</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="number" class="form-control" id="monthly_maintenance" placeholder="monthly maintenance" name="monthly_maintenance" value="{{$binary_commission->monthly_maintenance}}">
                        </div>     
                      </div>    
                    </div> -->
                   <!--  <br> -->
                   <!--  <div class="row">
                     <div class="col-sm-6">
                     <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.binary_cap') }} </label>
                     </div>
                      <div class="col-sm-6">
                           <label class="form-check-label d-flex align-items-center">
                               <input name="binary_cap" {{($binary_commission->binary_cap == "yes" ? 'checked' : '' )}}  class="form-check-input form-check-paymentcontrol-switch" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text=" {{trans('controlpanel.off')}}" data-on-color="success" data-on-text=" {{trans('controlpanel.on')}}" data-size="small" id="binary_cap" type="checkbox"/>  
                           </label>
                      </div>
                    </div> -->
                    <!-- <br>
                    <div class="cap_show">
                      <div class="row">
                        <div class="col-sm-6">
                           <label for="name" class="col-sm-6 control-label">Second Level</label>
                        </div>
                        <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pack_2" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_2" value="{{$level_commission->nlevel_2}}"> -->
                             <!--  <input type="number" class="form-control" id="second_level" placeholder="{{trans('controlpanel.enter_second_level_commission')}}" required="" name="second_level" value="{{$level_commission->level_2}}">
                         </div>
                      </div><br>      
                      <div class="row">
                          <div class="col-sm-6">
                            <label for="name" class="col-sm-6 control-label">Third Level</label>
                          </div>
                          <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pack_3" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_3" value="{{$level_commission->nlevel_3}}"> -->
                             <!--  <input type="number" class="form-control" id="third_level" placeholder="{{trans('controlpanel.enter_third_level_commission')}}" required="" name="third_level" value="{{$level_commission->level_3}}">
                          </div>
                      </div> <br> -->
                      <!-- <div class="row">
                        <div class="col-sm-6">
                           <label for="name" class="col-sm-6 control-label">Premium</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="number" class="form-control" id="pack_4" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_4" value="{{$binary_commission->pack_4}}">
                       </div>
                      </div> -->
                   <!--  </div>
                    <br> -->
                    <!-- <div class="row">
                      <div class="col-sm-4">
                         <button class="btn bg-dark" type="submit" > {{trans('controlpanel.save')}}</button>
                      </div>
                    </div> -->

                  <!-- </form> -->
                <!-- </div> -->
                <!-- <div class="col-sm-6"> -->
                   <!-- <form id="binaryform" class="form-horizontal" action="{{url('admin/control-panel/add-level-commission-criteria')}}" method="post"  name="form-wizard">
                    {{csrf_field()}}    --> 
                    <!-- <div class="pair_show">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="name" class="col-sm-6 control-label">First Level Criteria</label>
                          </div>
                          <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pair_value" placeholder="{{trans('controlpanel.enter_pair_value')}}" name="pair_value" value={{$level_commission->nlevel_1}}> -->
                             <!--  <input type="number" class="form-control" id="first_level_criteria" placeholder="{{trans('controlpanel.enter_first_level_criteria')}}" name="first_level_criteria" value={{$level_commission->criteria_l1}}>
                          </div> 
                        </div>
                    </div> -->
                   <!--  <br>      
                    <div class="">
                      <div class="row">
                        <div class="col-sm-6">
                          <label for="name" class="col-sm-6 control-label">Monthly Maintenance</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="number" class="form-control" id="monthly_maintenance" placeholder="monthly maintenance" name="monthly_maintenance" value="{{$binary_commission->monthly_maintenance}}">
                        </div>     
                      </div>    
                    </div> -->
                   <!--  <br> -->
                   <!--  <div class="row">
                     <div class="col-sm-6">
                     <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.binary_cap') }} </label>
                     </div>
                      <div class="col-sm-6">
                           <label class="form-check-label d-flex align-items-center">
                               <input name="binary_cap" {{($binary_commission->binary_cap == "yes" ? 'checked' : '' )}}  class="form-check-input form-check-paymentcontrol-switch" data-handle-width="auto" data-label-width="5" data-off-color="danger" data-off-text=" {{trans('controlpanel.off')}}" data-on-color="success" data-on-text=" {{trans('controlpanel.on')}}" data-size="small" id="binary_cap" type="checkbox"/>  
                           </label>
                      </div>
                    </div> -->
                   <!--  <br>
                    <div class="cap_show">
                      <div class="row">
                        <div class="col-sm-6">
                           <label for="name" class="col-sm-6 control-label">Second Level Criteria</label>
                        </div>
                        <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pack_2" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_2" value="{{$level_commission->nlevel_2}}"> -->
                              <!-- <input type="number" class="form-control" id="second_level_criteria" placeholder="{{trans('controlpanel.enter_second_level_criteria')}}" required="" name="second_level_criteria" value="{{$level_commission->criteria_l2}}">
                         </div>
                      </div><br>      
                      <div class="row">
                          <div class="col-sm-6">
                            <label for="name" class="col-sm-6 control-label">Third Level Criteria</label>
                          </div>
                          <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pack_3" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_3" value="{{$level_commission->nlevel_3}}"> -->
                             <!--  <input type="number" class="form-control" id="third_level_criteria" placeholder="{{trans('controlpanel.enter_third_level_criteria1')}}" required="" name="third_level_criteria" value="{{$level_commission->criteria_l3}}">
                          </div>
                      </div> <br>
                      <div class="row">
                          <div class="col-sm-6">
                            <label for="name" class="col-sm-6 control-label">Third Level Criteria2</label>
                          </div>
                          <div class="col-sm-2"> -->
                              <!-- <input type="number" class="form-control" id="pack_3" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_3" value="{{$level_commission->nlevel_3}}"> -->
                             <!--  <input type="number" class="form-control" id="third_level_criteria2" placeholder="{{trans('controlpanel.enter_third_level_criteria2')}}" required="" name="third_level_criteria2" value="{{$level_commission->criteria2_l3}}"> -->
                          <!-- </div> -->
                      <!-- </div> <br> -->
                      <!-- <div class="row">
                        <div class="col-sm-6">
                           <label for="name" class="col-sm-6 control-label">Premium</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="number" class="form-control" id="pack_4" placeholder="{{trans('controlpanel.enter_ceiling')}}" required="" name="pack_4" value="{{$binary_commission->pack_4}}">
                       </div>
                      </div> -->
                    <!-- </div> -->
                   <!--  <br>
                    <div class="row">
                      <div class="col-sm-4">
                         <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                      </div>
                    </div> -->
                    
                  </form>
                <!-- </div>
              </div> -->
                </div>
    
                <div class="tab-pane fade" id="steps-commission-tab2">
                  <form id="levelform" class="form-horizontal" action="{{url('admin/control-panel/add-levelcommission')}}" method="post"  name="form-wizard">
                    {{csrf_field()}}
                      <div class="levelnopack_show">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.leadership_bonus') }}  </label>
                          </div>
                          <div class="col-sm-2">
                            <input type="number" class="form-control" id="1" placeholder="Enter leadership bonus" name="levelno1" value="{{$leadershipbonus->service_charge}}">
                          </div> 
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-sm-4">
                          <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                        </div>
                      </div>
                  </form>
                </div>

           

            <div class="tab-pane fade" id="steps-commission-tab3">
                <form id="sponsorform" class="form-horizontal" action="{{url('admin/control-panel/add-sponsorcommission')}}" method="post"  name="form-wizard">
                  {{csrf_field()}}
                    <div class="sponnopack_show">
                      <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.refferal_bonus') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="{{$sponsor_commission->id}}" placeholder="{{trans('Enter referral bonus')}}" name="sponsor_commission" value="{{$leadershipbonus->sponsor_Commisions}}">
                      </div>
                     
                               
                      </div>
                    </div><br>
                    <div class="row">
                             <div class="col-sm-4">
                       <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                       </div>
                    </div>
                </form>
            </div>
            <!-- sales commission changes done by archana -->
            <!-- <div class="tab-pane fade" id="steps-commission-tab5">
                <form id="sponsorform" class="form-horizontal" action="{{url('admin/control-panel/add-salescommission')}}" method="post"  name="form-wizard">
                  {{csrf_field()}}
                    <div class="sponnopack_show">
                      <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.sales_bonus_1') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="bonus_1" placeholder="{{trans('enter sales bonus 1')}}" name="bonus_1" value="{{$leadershipbonus->bonus_1 }}">
                      </div>
                     
                               
                      </div>
                    </div><br>
                    <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.sales_bonus_2') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="bonus_2" placeholder="{{trans('enter sales bonus 2')}}" name="bonus_2" value="{{$leadershipbonus->bonus_2 }}">
                      </div>
                     
                               
                      </div>
                    
                    <div class="row">
                             <div class="col-sm-4">
                       <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                       </div>
                    </div>
                </form>
            </div> -->

            <div class="tab-pane fade" id="steps-commission-tab5">
                <form id="sponsorform" class="form-horizontal" action="{{url('admin/control-panel/add-salescommission')}}" method="post"  name="form-wizard">
                  {{csrf_field()}}
                    <div class="sponnopack_show">
                      <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.minimum_personal_sale') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="personal_sale_amount" placeholder="{{trans('Enter min PS')}}" name="personal_sale_amount" value="{{$leadershipbonus->min_p_sales }}" required="true" min="0" >
                      </div>
                     
                               
                      </div>
                    </div><br>
                    <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.sale_percentage') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="sale_percentage" placeholder="{{trans('Enter sale %')}}" name="sale_percentage" value="{{$leadershipbonus->p_sales_per }}" required="true" min="0">
                      </div>
                     
                               
                      </div>
                    
                    <div class="row">
                             <div class="col-sm-4">
                       <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                       </div>
                    </div>
                </form>
            </div>

            <!-- sales changes end by archana -->

            <div class="tab-pane fade" id="steps-commission-tab6">
                <form id="sponsorform" class="form-horizontal" action="{{url('admin/control-panel/add-cashbackcommission')}}" method="post"  name="form-wizard">
                  {{csrf_field()}}
                    <div class="sponnopack_show">
                      <table >
                        <thead>
                          <th>Sales Count</th>
                          <th>CashBack</th>
                        </thead>
                        <tbody>
                          
                      @foreach($cashback_bonus as $value)
                      <tr>
                        <td>
                           <div>
                       
                          <input type="number" class="form-control" id="sale_count{{$value->id}}" placeholder="{{trans('Enter sales count')}}" name="sale_count{{$value->id}}" value="{{$value->sale_count}}">
                      </div>
                          <!-- <label for="name" >{{$value->sale_count}}</label> -->
                      </td>
                      <td>
                       <div>
                       
                          <input type="text" class="form-control" id="cash_back{{$value->id}}" placeholder="{{trans('Enter caskback bonus')}}" name="cash_back{{$value->id}}" value="{{$value->cash_back}}">
                      </div>
                     
                      </td>         
                     

                      </tr>
                     @endforeach

                     </tbody>
                     </table>
                    </div><br>
                    <div class="row">
                             <div class="col-sm-4">
                       <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                       </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="steps-commission-tab4">
                 <form id="matchingform" class="form-horizontal" action="{{url('admin/control-panel/add-matchingbonus')}}" method="post"  name="form-wizard">
                 {{csrf_field()}}
                              
                    <div class="row">
                       
                         <div class="col-sm-6">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.international_pool_bonus') }} (%)</label>
                      </div>
<!--                             <div class="col-sm-6">
                            <label class="radio-inline"><input type="radio" name="type" value="fixed" {{ ($matching_bonus->type === "fixed" ? 'checked' : '') }}>{{ trans('controlpanel.fixed') }}</label>
                            <label class="radio-inline"><input type="radio" name="type" value="percent" {{ ($matching_bonus->type === "percent" ? 'checked' : '') }}>{{ trans('controlpanel.percent') }}</label>
                           
                            </div> -->
                        
            <!--         </div>
                    <br>
 -->
<!--                         <div class="row">
                         <div class="col-sm-4">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.commission_based_on_package') }} </label>
                          </div>
                            <div class="col-sm-6">
                              
                                
                               <select class="form-control selectmatchcriteria" name="matchcriteria" id="matchcriteria" required >
                                 <option value="{{$matching_bonus->criteria}}">{{$matching_bonus->criteria}}</option>
                                 @if($matching_bonus->criteria == 'yes')
                                <option value="no" ) >{{ trans('controlpanel.no')}}</option>
                                @else
                                <option value="yes">{{ trans('controlpanel.yes')}}</option>
                                @endif
                            </select>
                            </div>
                        
                    </div> -->
<!--                     <br>

                       <div class="matchpack_show">
                        {{ trans('controlpanel.package_matching_bonus') }}
                      <div class="row">
                          <table class="table table-invoice">
                          <thead>
                         <tr>
                          <th>{{trans('controlpanel.package')}}</th>  
                           <th>{{trans('controlpanel.level_1')}}</th>      
                            <th>{{trans('controlpanel.level_2')}}</th>                       
                            <th>{{trans('controlpanel.level_3')}}</th>                        
                          
                              </tr>
                          </thead>
                        <tbody>
                          
                      
                      @foreach($level_settings as $key=>$level)
                     
                        <tr>
                     <td>
                     {{$level->package}}
                    </td>
                      
                    <td>                       
                          <input type="number" class="form-control" id="{{$level->id}}" placeholder="{{trans('controlpanel.enter_package_matching_bonus1')}}" name="matchpack1[]" value="{{$level->matching_level1}}">
                    </td>
                     <td>
                             <input type="number" class="form-control" id="{{$level->id}}" placeholder="{{trans('controlpanel.enter_package_matching_bonus2')}}" name="matchpack2[]" value="{{$level->matching_level2}}">
                        </td>
                      <td>
                            <input type="number" class="form-control" id="{{$level->id}}" placeholder="{{trans('controlpanel.enter_package_matching_bonus3')}}" name="matchpack3[]" value="{{$level->matching_level3}}">
                     </td>
                   </tr>

                       @endforeach
                        </tbody>
                        </table>
                </div>
             </div>
              <br> -->

                       <div class="matchnopack_show">
                     <!--  <div class="row">
                         <div class="col-sm-4">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.matching_bonus') }} </label>
                      </div> -->
                   
                       <div class="col-sm-3">
                        <!-- {{trans('controlpanel.level_1')}} -->
                       
                          <input type="number" class="form-control" id="{{$matching_bonus->id}}" placeholder="{{trans('controlpanel.enter_level1_matching_bonus')}}" name="matchno1" value="{{$matching_bonus->matching_level1}}" style="    width: 400%;">
                      </div>
                      <!--  <div class="col-sm-2">
                        {{trans('controlpanel.level_2')}}
                             <input type="number" class="form-control" id="{{$matching_bonus->id}}" placeholder="{{trans('controlpanel.enter_level2_matching_bonus')}}" name="matchno2" value="{{$matching_bonus->matching_level2}}">
                         </div>
                          <div class="col-sm-2">
                            {{trans('controlpanel.level_3')}}
                            <input type="number" class="form-control" id="{{$matching_bonus->id}}" placeholder="{{trans('controlpanel.enter_package_level3_matching_bonus')}}" name="matchno3" value="{{$matching_bonus->matching_level3}}">
                       </div> -->
                       
                </div>
             </div><br>

          
                <div class="row">
                     <div class="col-sm-4">
               <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
               </div>
                </div>


          </form>
                </div>

                </div>
</fieldset>
    </div>

</div>
<div class="card card-white" id="steps-commission-tab10">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.ifluencer_commission_settings')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
          <form id="sponsorform" class="form-horizontal" action="{{url('admin/control-panel/add-ifluencercommission')}}" method="post"  name="form-wizard">
                  {{csrf_field()}}
                    <div class="sponnopack_show">
                      <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.ifluencer_level1_bonus') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="ifluencer_level1" placeholder="{{trans('controlpanel.enter_ifluencer_level1_bonus')}}" name="ifluencer_level1" value="{{$leadershipbonus->influencer_level }}">
                      </div>
                     
                               
                      </div>
                    </div><br>
                    <div class="row">
                          <label for="name" class="col-sm-6 control-label">{{ trans('controlpanel.influencermanager_bonus') }}  </label>
                      
                       <div class="col-sm-2">
                       
                          <input type="number" class="form-control" id="influencermanager_bonus" placeholder="{{trans('controlpanel.enter_influencermanager_bonus')}}" name="influencermanager_bonus" value="{{$leadershipbonus->influencer_manager }}">
                      </div>
                     
                               
                      </div>
                    
                    <div class="row">
                             <div class="col-sm-4">
                       <button class="btn bg-dark" type="submit"> {{trans('controlpanel.save')}}</button>
                       </div>
                    </div>
                </form>
        </div>
        </div>
</div>
@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection
@section('overscripts') @parent
<script type="text/javascript">
</script>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">

    $(document).ready(function(){
        var simple = '<?php echo $type; ?>';
        var binary_cap='<?php echo $binary_cap; ?>';
        var criteria='<?php echo $criteria; ?>';
        var spon_criteria='<?php echo $spon_criteria; ?>';
        var matching_criteria='<?php echo $matching_criteria; ?>';
        if(simple == 'fixed'){
         $(".pair_show").show(); 
         $(".percent_show").hide();
         $(".cap_show").hide(); 
        }
        else{
         $(".pair_show").hide(); 
         $(".percent_show").show();
         $(".cap_show").hide(); 
        }
        if(binary_cap == 'yes'){
          $(".cap_show").show(); 
        }
        else{
          $(".cap_show").hide(); 
        }
        if(criteria == 'yes'){
          $(".levelpack_show").show(); 
          $(".levelnopack_show").hide(); 
        }
        else{
          $(".levelnopack_show").show(); 
          $(".levelpack_show").hide(); 
        }
        if(spon_criteria == 'yes'){
          $(".sponpack_show").show(); 
          $(".sponnopack_show").hide(); 
        }
        else{
            $(".sponnopack_show").show(); 
            $(".sponpack_show").hide();
        }
        if(matching_criteria == 'yes'){
             $(".matchnopack_show").hide(); 
             $(".matchpack_show").show(); 
        }
        else{
            $(".matchnopack_show").show(); 
            $(".matchpack_show").hide();

        }

          
    });
    </script>
    <script type="text/javascript">
       
$('.selectype[name=type]').change(function() {
    var type=$(this).val();
    if(type=='fixed'){
     $(".pair_show").show();
     $(".percent_show").hide();
    }else if(type=='percentage'){
     $(".percent_show").show();
     $(".pair_show").hide();
    }else{
     $(".pair_show").hide();
     $(".percent_show").hide();
     $(".cap_show").hide();
    }

})
</script>

<script type="text/javascript">
    
    $('.seleccriteria[name=criteria]').change(function() {
      var criteria=$(this).val();
      if(criteria=='yes'){
         $(".levelpack_show").show();
         $(".levelnopack_show").hide();
      }else{
         $(".levelnopack_show").show();
         $(".levelpack_show").hide();
      }

    })
</script>

<script type="text/javascript">
    
    $('.selecsponcriteria[name=sponcriteria]').change(function() {
     var criteria=$(this).val();
        if(criteria=='yes'){
         $(".sponpack_show").show(); 
         $(".sponnopack_show").hide(); 
        }else{
         $(".sponnopack_show").show();
         $(".sponpack_show").hide();
        }

    })

</script>

<script type="text/javascript">
    
    $('.selectmatchcriteria[name=matchcriteria]').change(function() {
     var criteria=$(this).val();
        if(criteria=='yes'){
         $(".matchnopack_show").hide(); 
         $(".matchpack_show").show(); 
        }else{
         $(".matchnopack_show").show(); 
         $(".matchpack_show").hide(); 
        }

    })

</script>
    
<script type="text/javascript">
  $(document).ready(function () {
    $('.form-check-paymentcontrol-switch').each(function(e) {
          var switch_elem = $(this);
          key = switch_elem.attr('name');
          val_boolean = switch_elem.bootstrapSwitch('state'); 
          switch_elem.bootstrapSwitch('state', val_boolean);    
    });
  });

  $('.form-check-paymentcontrol-switch').on('switchChange.bootstrapSwitch', function(e) {
    var switch_elem = $(this);
    switch_key = switch_elem.attr('name');
    switch_val_boolean = switch_elem.bootstrapSwitch('state'); 
    $("<input />").attr("type", "hidden")
          .attr("name", "check")
          .attr("value", switch_val_boolean)
          .appendTo("#binaryform");
     if(switch_val_boolean == true){
        $(".cap_show").show();}
     else{
        $(".cap_show").hide();}
  });



</script>
@stop
