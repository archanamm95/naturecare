@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main')
<div class="alert bg-success alert-styled-left">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">{{trans('register.registration_completed')}}!</span> {{trans('register.you_have_successfully_registered')}} <strong>{{$userresult->username}} ({{$userresult->name}} {{$userresult->lastname}})</strong>  {{trans('register.under_sponsor')}}, <strong>{{$sponsorUserName}}</strong>. {{trans('register.payment_done_via')}}<strong>
{{Ucwords(str_replace('_', ' ', $userresult->register_by))}}..</strong>
<br>
<span><strong>Account email verification has been send to your email, Kindly verified your email to activate your account.</strong></span>
</div>
<div class="card">
    <div class="card-header header-elements-inline bg-primary">
        <h6 class="card-title">{{trans('register.registration_details')}}</h6>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-sm-6">
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <th><strong class="h6">{{trans('register.network')}}</strong></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>{{trans('register.username') }}</th>
                        <td>{{$userresult->username}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.email') }}</th>
                        <td>{{$userresult->email}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.password') }}</th>
                        <td>{{trans('register.this_password_is')}} <strong>{{trans('register.encrypted')}}</strong> - {{trans('register.you_can_change_in_settings_if_you_have_forgotten_it')}}!</td>
                    </tr>
                    <tr>
                        <th class="col-md-2">{{trans('register.sponsor') }}</th>
                        <td>{{$sponsorUserName}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.package') }}</th>
                        <td>{{$userresult->profile_info->package_detail->package}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.firstname') }}</th>
                        <td>{{$userresult->name}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.lastname') }}</th>
                        <td>{{$userresult->lastname}}</td>
                    </tr>
                   <!--  <tr>
                        <th>{{trans('register.gender') }}</th>
                        <td>
                            @if($userresult->profile_info->gender == 'm') {{trans('register.male') }}@elseif($userresult->profile_info->gender == 'other') Trans @else {{trans('register.female') }} @endif
                        </td>
                    </tr> -->
                    <tr>
                        <th>{{trans('register.phone') }}</th>
                        <td>{{$userresult->profile_info->mobile}}</td>
                    </tr>
                   <!--  <tr>
                        <th>{{trans('register.wechat') }}</th>
                        <td>{{$userresult->id}}</td>
                    </tr> -->
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-sm-6">
           <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <th><strong class="h6">{{trans('register.locale')}}</strong></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>{{trans('register.country') }}</th>
                        <td>{{$country}}</td>
                    </tr>
                    <tr>
                        <th>
                            <div class="flag-icon flag-icon-{{strtolower($userresult->profile_info->country)}}" style="height:200px;width:200px"></div>
                        </th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>{{trans('register.state') }}</th>
                        <td>{{$state}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.zipcode') }}</th>
                        <td>{{$userresult->profile_info->zip}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.address') }}</th>
                        <td>{{$userresult->profile_info->address1}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.city') }}</th>
                        <td>{{$userresult->profile_info->city}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="header-elements">
            
            <div class="heading-btn float-right">

                

                <a href="{{url('admin/genealogy')}}" class="btn btn-success btn-labeled btn-labeled-left btn-sm">
                <b>
                <i class="icon-tree7"></i>
                </b>
                {{trans('register.go_to_tree_view') }}
            </a>
            </div>
        </div>
    </div>
</div>
@endsection @section('scripts') @parent @endsection