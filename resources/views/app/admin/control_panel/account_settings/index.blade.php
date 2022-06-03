@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
<style type="text/css">
    ul.tips,div.description,.form-item div.description {
        margin: 5px 0;
        line-height: 1.231em;
        font-size: .923em;
        color: #666
    }

    ul.tips li {
        margin: .25em 0 .25em 1.5em
    }

    body div.form-type-radio div.description,body div.form-type-checkbox div.description {
        margin-left: 1.5em
    }

label {
    display: block;
    font-weight: 700;
}

label.option {
    display: inline;
    font-weight: 400;
}
textarea.form-control {
    height: auto;
}
ul.nav.nav-tabs.nav-tabs-vertical {
    background: #eaeaea;
}

.nav-tabs-vertical .nav-item.show .nav-link, .nav-tabs-vertical .nav-link.active{
    background-color: #fff;
    border-color: #ddd #0000;
}
div#settings-page .form-control {
    font-size: 14px;
}
</style>
@endsection



        {{-- Content --}}
        @section('main')
<div id="settings-page">
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
               {{trans('controlpanel.account_settings')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <fieldset class="form-wrapper" id="edit-registration-cancellation">
                <legend>
                    <span class="fieldset-legend">
                        {{trans('controlpanel.registration')}}
                    </span>
                </legend>
                <div class="fieldset-wrapper">
                    <div class="form-item form-type-radios form-item-user-register">
                        <label for="edit-user-register">
                            {{trans('controlpanel.who_can_register_accounts')}}?
                        </label>
                   
                        <div class="form-radios" id="edit-user-register">
                            <div class="form-item form-type-radio form-item-user-register">

                            <input {{ ($user_registration === "1" ? 'checked' : '') }} onchange="user_registration()" class="radioID" name="user_registration" id="edit-user-register"type="radio"   value="1" >

                               <!--  <input checked="checked" class="form-radio" id="edit-user-register" name="user_register" type="radio" value="0"/> -->
                                <label class="option" for="edit-user-register-0">
                                   {{trans('controlpanel.administrators_only')}}
                                </label>
                            </div>
                            <div class="form-item form-type-radio form-item-user-register">

                            <input {{ ($user_registration === "2" ? 'checked' : '') }} onchange="user_registration()" class="radioID" name="user_registration" id="edit-user-register"type="radio"   value="2" >

                               <!--  <input checked="checked" class="form-radio" id="edit-user-register" name="user_register" type="radio" value="0"/> -->
                                <label class="option" for="edit-user-register-0">
                                    {{trans('controlpanel.administrators_and_users_only')}}
                                </label>
                            </div>

                            <div class="form-item form-type-radio form-item-user-register">
                                  <input  {{ ($user_registration === "3" ? 'checked' : '') }} onchange="user_registration()" class="radioID" name="user_registration" id="edit-user-register"type="radio"   value="3" >

                               <!--  <input class="form-radio" id="edit-user-register" name="user_register" type="radio" value="1"/> -->
                                <label class="option" for="edit-user-register-1">
                                     {{trans('controlpanel.visitors')}}
                                </label>
                            </div>


                            <div class="form-item form-type-radio form-item-user-register">
                                  <input  {{ ($user_registration === "4" ? 'checked' : '') }} onchange="user_registration()" class="radioID" name="user_registration" id="edit-user-register"type="radio"   value="4" >

                               <!--  <input class="form-radio" id="edit-user-register" name="user_register" type="radio" value="1"/> -->
                                <label class="option" for="edit-user-register-1">
                                    {{trans('controlpanel.administrators_and_visitors_only')}}
                                </label>
                            </div>

                            <div class="form-item form-type-radio form-item-user-register">
                                  <input  {{ ($user_registration === "5" ? 'checked' : '') }} onchange="user_registration()" class="radioID" name="user_registration" id="edit-user-register"type="radio"   value="5" >

                               <!--  <input class="form-radio" id="edit-user-register" name="user_register" type="radio" value="1"/> -->
                                <label class="option" for="edit-user-register-1">
                                  {{trans('controlpanel.administrators_users_and_visitors')}}
                                </label>
                            </div>
                     <div class="form-item form-type-radio form-item-user-register">
                                  <input {{ ($user_registration === "6" ? 'checked' : '') }} onchange="user_registration()" class="radioID" name="user_registration" id="edit-user-register"type="radio"   value="6" >
                               

                               <!--  <input class="form-radio" id="edit-user-register" name="user_register" type="radio" value="2"/> -->
                                <label class="option" for="edit-user-register-2">
                                     {{trans('controlpanel.visitors')}}, {{trans('controlpanel.but_administrator_approval_is_required')}}
                                    
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-item form-type-checkbox form-item-user-email-verification">
                        
                        <input class="form-checkbox" id="email_verification" name="email_verification" type="checkbox" value="1" {{ ($email_verification === "1" ? 'checked' : '') }}/>

                        <label class="option" for="edit-user-email-verification">
                            
                            {{trans('controlpanel.require_email_verification_when_a_visitor_creates_an_account')}}
                        </label>
                        <div class="description">
                        
                             {{trans('users.new_users_will_be_required_to_validate_their_email_address_prior_to_logging_into_the_site_and_will_be_assigned_a_system')}} {{trans('users.generated_password')}}. {{trans('controlpanel.with_this_setting_disabled')}}, {{trans('controlpanel.users_will_be_logged_in_immediately_upon_registering')}}, {{trans('controlpanel.and_may_select_their_own_passwords_during_registration')}}
                        </div>
                    </div>
            
                </div>
            </fieldset>
        </div>
    </div>
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                  {{trans('controlpanel.emails')}}
            </h5>
        </div>
        
        <div class="card-body bordered">
            <div class="d-md-flex">
                <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#edit-email-admin-created">
                             {{trans('controlpanel.welcome')}} ( {{trans('controlpanel.new_user_created_by_administrator')}})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-pending-approval">
                             {{trans('controlpanel.welcome')}} ( {{trans('controlpanel.awaiting_approval')}})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-no-approval-required">
                             {{trans('controlpanel.welcome')}} ( {{trans('controlpanel.no_approval_required')}})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-activated">
                           {{trans('controlpanel.account_activation')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-blocked">
                             {{trans('controlpanel.account_blocked')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-cancel-confirm">
                            {{trans('controlpanel.account_cancellation_confirmation')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-canceled">
                             {{trans('controlpanel.account_cancelled')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-email-password-reset">
                            {{trans('controlpanel.password_recovery')}}
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit-payout-notification-email">
                            {{trans('controlpanel.payout_notification_email')}}
                        </a>
                    </li>
                </ul>
              
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="edit-email-admin-created">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-admin-created" style="display: block;">
                            <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[0]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                     {{trans('controlpanel.welcome')}} ({{trans('controlpanel.new_user_created_by_administrator')}})
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                  
                                     {{trans('controlpanel.edit_the_welcome_email_messages_sent_to_new_member_accounts_created_by_an_administrator')}}.  {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}
                                </div>
                                <div class="form-item form-type-textfield form-item-user-mail-register-admin-created-subject">
                                    <label for="subject">
                                         {{trans('controlpanel.subject')}}
                                    </label>
                                    <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[0]->subject}}"/>

                                </div>
                                <div class="form-item form-type-textarea form-item-user-mail-register-admin-created-body">
                                    <label for="body">
                                         {{trans('controlpanel.body')}}
                                    </label>
                                    <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control summernote" cols="60" id="body" name="body" rows="20">
                                           {{$email[0]->body}}
                                        </textarea>
                                        <div class="grippie">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                        {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[0]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[0]->id}}" type="radio" value="yes"> {{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[0]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[0]->id}}" type="radio" value="no"> {{trans('controlpanel.disable')}}
                        </label>
                             </div>
                            </div>
                            <br>
                              <button type="submit" class="btn btn-info"> {{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                    <div class="tab-pane fade" id="edit-email-pending-approval">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-pending-approval" style="display: block;">
                            <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[1]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                     {{trans('controlpanel.welcome')}} ( {{trans('controlpanel.awaiting_approval')}})
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                     {{trans('controlpanel.edit_the_welcome_email_messages_sent_to_new_members_upon_registering')}}, {{trans('controlpanel.when_administrative_approval_is_required')}}.  {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}.
                                </div>
                                <div class="form-item form-type-textfield form-item-user-mail-register-pending-approval-subject">
                                    <label for="subject">
                                        {{trans('controlpanel.subject')}}
                                    </label>
                                    <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[1]->subject}}"/>
                                </div>
                                <div class="form-item form-type-textarea form-item-user-mail-register-pending-approval-body">
                                    <label for="body">
                                        {{trans('controlpanel.body')}}
                                    </label>
                                    <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control summernote" cols="60" id="body" name="body" rows="10">
                                            {{$email[1]->body}}
                                        </textarea>
                                        <div class="grippie">
                                        </div>
                                    </div>
                                </div>

                                       <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                       {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[1]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[1]->id}}" type="radio" value="yes">{{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[1]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[1]->id}}" type="radio" value="no">{{trans('controlpanel.disable')}}
                        </label>
                             </div>
                            </div>
                            <br>
                              <button type="submit" class="btn btn-info">{{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                    <div class="tab-pane fade" id="edit-email-no-approval-required">
                       <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-no-approval-required" style="display: block;">
                             <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[2]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                   {{trans('controlpanel.no_account_approval_required')}}
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                               
                                {{trans('controlpanel.edit_the_welcome_email_messages_sent_to_new_members_upon_registering')}}, {{trans('controlpanel.when_no_administrator_approval_is_required')}}. {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}.
                            </div>
                                
                            <div class="form-wrapper" id="edit-settings--2">
                                <div class="form-item form-type-textfield form-item-user-mail-register-no-approval-required-subject">
                                    <label for="subject">
                                    {{trans('controlpanel.subject')}}
                                    </label>
                                    <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[2]->subject}}"/>
                                </div>
                                <div class="form-item form-type-textarea form-item-user-mail-register-no-approval-required-body">
                                <label for="body">
                                    {{trans('controlpanel.body')}}
                                </label>
                                <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                    <textarea class="form-control summernote" cols="60" id="body" name="body" rows="20">
                                        {{$email[2]->body}}
                                    </textarea>
                                    <div class="grippie">
                                    </div>
                                </div>
                            </div>
                                   <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                       {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[2]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[2]->id}}" type="radio" value="yes">{{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[2]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[2]->id}}" type="radio" value="no">{{trans('controlpanel.disable')}}
                        </label>
                             </div>
                                </div>
                            </div>
                             <br>
                              <button type="submit" class="btn btn-info">{{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset> 
                    </div>
                    <div class="tab-pane fade" id="edit-email-activated">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-activated" style="display: block;">
                             <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[3]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                   {{trans('controlpanel.account_activation')}}
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                   
                                    {{trans('controlpanel.enable_and_edit_email_messages_sent_to_users_upon_account_activation')}}({{trans('controlpanel.when_an_administrator_activates_an_account_of_a_user_who_has_already_registered,_on_a_site_where_administrative_approval_is_required')}}). {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}
                                </div>
                                <div class="form-item form-type-checkbox form-item-user-mail-status-activated-notify">
                                    <input  name="notify" type="checkbox" value="1" {{ ($email[3]->notify === "1" ? 'checked' : '') }}> 
                   

                                   <!--  <input class="form-checkbox" id="notify" name="notify" type="checkbox" value="1" {{ ($email[3]->notify === "1" ? 'checked' : '') }}/> -->

                                    
                                        <label class="option" for="activated-notify">
                                            {{trans('controlpanel.notify_user_when_account_is_activated')}}
                                        </label>
                                   
                                </div>
                                <div class="form-wrapper" id="edit-settings--3">
                                    <div class="form-item form-type-textfield form-item-user-mail-status-activated-subject">
                                        <label for="subject">
                                            {{trans('controlpanel.subject')}}
                                        </label>
                                        <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[3]->subject}}"/>
                                    </div>
                                    <div class="form-item form-type-textarea form-item-user-mail-status-activated-body">
                                        <label for="body">
                                            {{trans('controlpanel.body')}}
                                        </label>
                                        <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                            <textarea class="form-control summernote" cols="60" id="body" name="body" rows="20">
                                                {{$email[3]->body}}
                                            </textarea>
                                            <div class="grippie">
                                            </div>
                                        </div>
                                    </div>
                                           <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                       {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[3]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[3]->id}}" type="radio" value="yes">{{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[3]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[3]->id}}" type="radio" value="no">{{trans('controlpanel.disable')}}
                        </label>
                             </div>
                                </div>
                            </div>
                             <br>
                              <button type="submit" class="btn btn-info">{{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                    
                   <div class="tab-pane fade" id="edit-email-blocked">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-blocked" style="display: block;">
                            <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[4]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                    {{trans('controlpanel.account_blocked')}}
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                   
                                    {{trans('controlpanel.enable_and_edit_email_messages_sent_to_users_when_their_accounts_are_blocked')}}. {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}
                                </div>
                                <div class="form-item form-type-checkbox form-item-user-mail-status-blocked-notify">
                                <input  name="notify" type="checkbox" value="1" {{ ($email[4]->notify === "1" ? 'checked' : '') }}>
                                    <label class="option" for="edit-user-mail-status-blocked-notify">
                                        {{trans('controlpanel.notify_user_when_account_is_blocked')}}
                                    </label>
                                
                            </div>
                                <div class="form-wrapper" id="edit-settings--4">
                                    <div class="form-item form-type-textfield form-item-user-mail-status-blocked-subject">
                                    <label for="subject">
                                         {{trans('controlpanel.subject')}}
                                    </label>
                                    <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[4]->subject}}"/>
                                </div>
                                       <div class="form-item form-type-textarea form-item-user-mail-status-blocked-body">
                                    <label for="body">
                                         {{trans('controlpanel.body')}}
                                    </label>
                                    <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control summernote" cols="60" id="body" name="body" rows="4">
                                            {{$email[4]->body}}
                                        </textarea>
                                        <div class="grippie">
                                        </div>
                                    </div>
                                </div>

                                       <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                        {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[4]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[4]->id}}" type="radio" value="yes"> {{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[4]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[4]->id}}" type="radio" value="no"> {{trans('controlpanel.disable')}}
                        </label>
                             </div>
                                </div>
                            </div>
                             <button type="submit" class="btn btn-info"> {{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                  
                    <div class="tab-pane fade" id="edit-email-cancel-confirm"> 
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-cancellation" style="display: block;">
                            <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[5]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                   {{trans('controlpanel.account_cancellation_confirmation')}}
                                </span>
                            </legend>
                        <div class="fieldset-wrapper">
                            <div class="fieldset-description">
                               
                                 {{trans('controlpanel.edit_the_email_messages_sent_to_users_when_they_attempt_to_cancel_their_accounts')}}. {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is _provided_below')}}
                            </div>
                            <div class="form-item form-type-textfield form-item-user-mail-cancel-confirm-subject">
                                <label for="subject">
                                    {{trans('controlpanel.subject')}}
                                </label>
                                <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[5]->subject}}"/>
                            </div>
                            <div class="form-item form-type-textarea form-item-user-mail-cancel-confirm-body">
                                <label for="body">
                                    {{trans('controlpanel.body')}}
                                </label>
                                <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                    <textarea class="form-control summernote" cols="60" id="body" name="body" rows="15">
                                        {{$email[5]->body}}
                                    </textarea>
                                    <div class="grippie">
                                    </div>
                                </div>
                            </div>
                                   <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                       {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[5]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[5]->id}}" type="radio" value="yes">{{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[5]->status === "no" ? 'checked' : '') }} onchange="mailstatus_change6()" class="radioID" name="mailstatus" id="{{$email[5]->id}}" type="radio" value="no">{{trans('controlpanel.disable')}}
                        </label>
                             </div>
                        </div>
                     <button type="submit" class="btn btn-info">{{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                    
                    <div class="tab-pane fade" id="edit-email-canceled">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-canceled" style="display: block;">
                             <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[6]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                   {{trans('controlpanel.account_cancelled')}}
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                  
                                    {{trans('controlpanel.enable_and_edit_email_messages_sent_to_users_when_their_accounts_are_canceled')}}. {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}
                                </div>
                                <div class="form-item form-type-checkbox form-item-user-mail-status-canceled-notify">
                                     <input  name="notify" type="checkbox" value="1" {{ ($email[6]->notify === "1" ? 'checked' : '') }}>
                                        <label class="option" for="edit-user-mail-status-canceled-notify">
                                          
                                            {{trans('controlpanel.notify_user_when_account_is_canceled')}}. 
                                        </label>
                                    
                                </div>
                                <div class="form-wrapper" id="edit-settings--5">
                                    <div class="form-item form-type-textfield form-item-user-mail-status-canceled-subject">
                                        <label for="subject">
                                             {{trans('controlpanel.subject')}}
                                        </label>
                                        <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[6]->subject}}"/>
                                    </div>
                                       <div class="form-item form-type-textarea form-item-user-mail-status-canceled-body">
                                        <label for="body">
                                             {{trans('controlpanel.body')}}
                                        </label>
                                        <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                            <textarea class="form-control summernote" cols="60" id="body" name="body" rows="10">
                                                {{$email[6]->body}}
                                            </textarea>
                                            <div class="grippie">
                                            </div>
                                        </div>
                                    </div>

                                           <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                        {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[6]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[6]->id}}" type="radio" value="yes"> {{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[6]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[6]->id}}" type="radio" value="no"> {{trans('controlpanel.disable')}}
                        </label>
                             </div>
                                </div>
                            </div>
                             <button type="submit" class="btn btn-info"> {{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                     
                    <div class="tab-pane fade" id="edit-email-password-reset">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-password-reset" style="display: block;">
                             <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[7]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                    {{trans('controlpanel.password_recovery')}}
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                  
                                     {{trans('controlpanel.edit_the_email_ messages_sent_to_users_who_request_a_new_password')}}.  {{trans('controlpanel.edit_the_email_ the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}
                                </div>
                                <div class="form-item form-type-textfield form-item-user-mail-password-reset-subject">
                                    <label for="subject">
                                        {{trans('controlpanel.subject')}}
                                    </label>
                                    <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[7]->subject}}"/>
                                </div>
                                <div class="form-item form-type-textarea form-item-user-mail-password-reset-body">
                                    <label for="body">
                                        {{trans('controlpanel.body')}}
                                    </label>
                                    <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control summernote" cols="60" id="body" name="body" rows="15">
                                            {{$email[7]->body}}
                                        </textarea>
                                        <div class="grippie">
                                        </div>
                                    </div>
                                </div>
                                       <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                       {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[7]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[7]->id}}" type="radio" value="yes">{{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[7]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[7]->id}}" type="radio" value="no">{{trans('controlpanel.disable')}}
                        </label>
                             </div>
                            </div>
                             <button type="submit" class="btn btn-info">{{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>



                   <div class="tab-pane fade" id="edit-payout-notification-email">
                        <fieldset class="form-wrapper vertical-tabs-pane" id="edit-email-blocked" style="display: block;">
                            <form action="{{url('admin/control-panel/email_settings')}}"  method="post" >
                              {{ csrf_field() }}
                               <input id="type" name="type"type="hidden" value="{{$email[8]->type}}">
                            <legend>
                                <span class="fieldset-legend">
                                    {{trans('controlpanel.edit_payout_notification_email')}}
                                </span>
                            </legend>
                            <div class="fieldset-wrapper">
                                <div class="fieldset-description">
                                   
                                    {{trans('controlpanel.enable_and_edit_email_messages_sent_to_users_when_their_payout_is_success')}}. {{trans('controlpanel.the_list_of_available_tokens_that_can_be_used_in_emails_is_provided_below')}}
                                </div>
                         
                                <div class="form-wrapper" id="edit-settings--4">
                                    <div class="form-item form-type-textfield form-item-user-mail-status-blocked-subject">
                                    <label for="subject">
                                         {{trans('controlpanel.subject')}}
                                    </label>
                                    <input class="form-control" id="subject" maxlength="180" name="subject" size="60" type="text" value="{{$email[8]->subject}}"/>
                                </div>
                                       <div class="form-item form-type-textarea form-item-user-mail-status-blocked-body">
                                    <label for="body">
                                         {{trans('controlpanel.body')}}
                                    </label>
                                    <div class="form-control-wrapper resizable textarea-processed resizable-textarea">
                                        <textarea class="form-control summernote" cols="60" id="body" name="body" rows="4">
                                            {{$email[8]->body}}
                                        </textarea>
                                        <div class="grippie">
                                        </div>
                                    </div>
                                </div>

                                       <div class="row">
                                    <div class="col-sm-3">
 
                                    <label for="status">
                                        {{trans('controlpanel.status')}}
                                    </label>
                                </div>
                                 
                         <label class="radio-inline">
                                  
                          <input {{ ($email[8]->status === "yes" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[8]->id}}" type="radio" value="yes"> {{trans('controlpanel.enable')}}

                        
                        </label>
                        &nbsp&nbsp
                        <label class="radio-inline">
                              <input {{ ($email[8]->status === "no" ? 'checked' : '') }}  class="radioID" name="mailstatus" id="{{$email[8]->id}}" type="radio" value="no"> {{trans('controlpanel.disable')}}
                        </label>
                             </div>
                                </div>
                            </div>
                             <button type="submit" class="btn btn-info"> {{trans('controlpanel.submit')}}</button>
                        </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection



@section('scripts') @parent

<script type="text/javascript"> 

    function user_registration() {
        var user_register = $('input:radio[name="user_registration"]:checked').val();
        console.log(user_register);
        $.ajax({
            method: 'POST',
            url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/account-settings',
            data: {
                'key': 'user_registration',
                'value': user_register
            },
            dataType: 'json',
            success: function(data){
                 new PNotify({
                    text: 'Updated',
                    delay: 1000,                            
                    nonblock: {
                        nonblock: false
                    }
                });

                console.log(data);
            }
        });
    };

$('#email_verification').on('change', function(){
   this.value = this.checked ? 1 : 0;
     console.log(this.value);
     $.ajax({
            method: 'POST',
            url: CLOUDMLMSOFTWARE.siteUrl+'/admin/control-panel/account-settings',
            data: {
                'key': 'email_verification',
                'value': this.value
            },
            dataType: 'json',
            success: function(data){
                 new PNotify({
                    text: 'Updated',
                    delay: 1000,                            
                    nonblock: {
                        nonblock: false
                    }
                });

                console.log(data);
            }
        });



})

 


    </script>

@endsection
