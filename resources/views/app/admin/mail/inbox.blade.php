@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
<style type="text/css">
    .test{
        top: 15px;
    }
    .boarder{
        top: 15px;
    }
     .subject{
      font-size: 18px;
    }
    .text-semibold {
  font-weight: 500;
}

.edit-card {
 
    position: inherit;
    width: initial;
   
    padding: 5px;
    margin-left: 20px;

  
}
.rounded-circle{
    border-radius:50%;
    }
    .img-md {
  width: 40px ;
  height: 40px;
}
.media-left
 {
  padding-left: 10px;
}
.bg-teal-400 {
  background-color: #26A69A;
}
.btn-xs
 {
  border-radius: 5px;
   margin-right: 10px;
}
.media-body {
  word-wrap: break-word;
  word-break: break-word;
}
.mail-container-read {
  max-width: 100%;
  overflow: auto;
  padding: 20px;
  border-top: 1px solid #ddd;
}
#myFooter, #myHeader
{
    display: none;
}

</style>
@parent
@endsection

@section('sidebar')
@parent
<!-- Secondary sidebar -->
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">
    <div class="sidebar-content">
        <!-- Actions -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span>
                {{trans('mail.actions')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <a class="btn bg-indigo-400 btn-block" href="#" id="composeMailbtn">
                    {{trans('mail.compose_mail')}}
                </a>
            </div>
        </div>
        <!-- /actions -->
        <!-- Sub navigation -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span>
                    {{trans('mail.navigations')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <div class="tab-base">
                <ul class="nav nav-sidebar" data-nav-type="accordion" id="myTab">
                    <li class="nav-item-header">
                         {{trans('mail.folder')}}
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" id="showInBox" data-toggle="tab">
                            <i class="icon-drawer-in">
                            </i>
                           {{trans('mail.inbox')}}
                            <span class="badge bg-success badge-pill ml-auto">
                                {{$unread_count}}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" id="showOutBox" data-toggle="tab" >
                        <a class="nav-link" href="#">
                            <i class="icon-drawer-out">
                            </i>
                            {{trans('mail.sent_mails')}}
                        </a>

                    </li>
                </ul>
            </div>
            </div>
        </div>
        <!-- /sub navigation -->
        <!-- Latest messages -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span>
                     {{trans('mail.latest_messages')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body no-padding">
                <ul class="media-list media-list-linked left-mail-links">
                    @if($limit_out_mail>0)

                    {{--//$filtered = $all_mail->whereNotIn('username', 'admin');
                    //$filteredunread = $filtered->whereNotIn('read', 'yes');--}}
                    @php
                    $filtered = $all_mail;
                    @endphp

                    @foreach ($filtered as $mail)

                    @php



                    if(!isset($mail->profile) || $mail->profile === '600'){
                        $profilepic = 'avatar-big.png';
                    }else{
                        $profilepic = $mail->profile;
                    }
                    $subject = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message_subject);
                    $message = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message);
                    @endphp
                    <li class="media">
                        <a class="media-link left-mail-link" data-datetime="{{$mail->created_at}}" data-emailid="{{$mail->email}}" data-mailid="{{Crypt::encrypt($mail->id)}}" data-message="{{$message}}" data-profilepic="{{$profilepic}}" data-subject="{{$subject}}" data-totalmailfromuser="{{$mail->id}}" data-username="{{$mail->username}}" href="#">
                            <div class="media-left">
                                <img alt="" class="rounded-circle img-xs" src="{{url('img/cache/profile/')}}/{{$profilepic}}" style="height: 33px;" />
                                   <span class="media-heading text-semibold">
                                    {{$mail->username}}
                                </span>
                            </div>
                            <div class="media-body">
                                <span class="text-muted" style="margin-left: 51px;">
                                    {{ str_limit(strip_tags($subject), $limit = 10, $end = '...') }}
                                </span>
                            </div>
                    
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <!-- /latest messages -->
    </div>
</div>
<!-- /secondary sidebar -->
@endsection
        {{-- Content --}}
        @section('main')
<!-- Single line -->
<div id="email-page">

    <div class="card card-white" id="single-compose" style="display: none;">

        <form action="{{url('admin/register')}}" class="mailcomposeform" method="POST" name="parsley-mail">
            <!-- Mail toolbar -->

            <div class="bg-light rounded-top">
                                    <div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2 rounded-top">
                                        <div class="text-center d-lg-none w-100">
                                            <button type="button" class="navbar-toggler w-100 h-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-write">
                                                <i class="icon-circle-down2"></i>
                                            </button>
                                        </div>

                                        <div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-write">

                                            <div class="mt-3 mt-lg-0 mr-lg-3">
                                                <button type="submit" class="btn bg-blue submitmail"><i class="icon-paperplane mr-2"></i> {{trans('mail.send_mail')}}</button>
                                            </div>


                                            <div class="mt-3 mt-lg-0 mr-lg-3">
                                                <div class="btn-group">
                                                  
                                                    <button type="button" class="btn btn-default button-email-compose-cancel">
                                                        <i class="icon-cross2"></i>
                                                        <span class="d-none d-lg-inline-block ml-2">{{trans('mail.cancel')}}</span>
                                                    </button>
                                                   
                                                </div>
                                            </div>

                                            
                                        </div>
                                        <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
                                    </div>
                                </div>


           
            <!-- /mail toolbar -->
            <!-- Mail details -->
            <div class="mail-details-write table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td >
                                  {{trans('mail.to')}}:
                            </td>
                            <td class="no-padding sendtoone" id="sendtoone">
                                <input class="tagsinput-typeahead form-control autocompleteusersforemail" data-parsley-required-message="{{trans('all.at_least_one_reciepient_required')}}" data-role="tagsinput" id="to" name="to" placeholder="Add recipient" required="required" type="text"/>
                                <div id="email2" class="m-b-15" style="display: none">
                                    <input type="text" name="users" class="form-control"  value="All Users" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="m-b-15" >
                                <label class="control-label">Select All</label>
                                <input id="select_all" name="select_all" class="select_all" type="checkbox" /> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               {{trans('mail.subject')}}:
                            </td>

                            <!-- <td class="no-padding">
                                <input class="form-control" data-parsley-required-message="{{trans('all.specify_email_subject')}}" id="subject" name="subject" placeholder="Add subject" required="required" type="text"/>
                            </td> -->
                            <td class="no-padding"><input type="text" name="subject" class="form-control" required="required" placeholder="Add subject" data-parsley-required-message = "{{trans("all.specify_email_subject")}}"></td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /mail details -->
            <!-- Mail container -->
            <div class="mail-container-write">
                <div class="mailcomposer">
                </div>
            </div>
            <!-- /mail container -->
        </form>
    </div>
    <div class="card card-white" id="singlemailtab" style="display: none;">
        <!-- Mail toolbar -->
        <div class="card-toolbar card-toolbar-inbox">
            <div class="navbar navbar-default">
         <!--        <ul class="nav navbar-nav d-block d-sm-none-block no-border">
                    <li>
                        <a class="text-center collapsed" data-target="#inbox-toolbar-toggle-single" data-toggle="collapse">
                            <i class="icon-circle-down2">
                            </i>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single"> -->
                <div class="btn-group navbar-btn no-border test flex-wrap">
                    <a class="btn btn-default btn-mail-reply-single" id="back-to-mail-list" href="#">
                        <i class="icon-arrow-left13">
                        </i>
                        <span class="hidden-xs position-right">
                          {{trans('mail.back')}}
                        </span>
                    </a>

                 <!--    <button id="back-to-mail-list" class="btn btn-default" >
                        <i class="icon-arrow-left13">
                        </i>
                        <span class="hidden-xs position-right">
                            Back
                        </span>
                    </button> -->
                    <a class="btn btn-default btn-mail-reply-single" data-mailid="" data-to="" href="#">
                        <i class="icon-reply">
                        </i>
                        <span class="hidden-xs position-right">
                           {{trans('mail.reply')}}
                        </span>
                    </a>
                    <a class="btn btn-default btn-mail-forward-single" data-mailid="" href="#">
                        <i class="icon-forward">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.forward')}}
                        </span>
                    </a>
                    <a class="btn btn-default btn-mail-delete-single" data-mailid="" href="#">
                        <i class="icon-bin">
                        </i>
                        <span class="hidden-xs position-right">
                           {{trans('mail.delete')}}
                        </span>
                    </a>

                </div>
                    <div class="float-right">
                        <p class="navbar-text">
                            <span id="datetimeplaceholder">
                            </span>
                        </p>
                        <div class="btn-group nav-carousel-item">
                            <a class="btn btn-default" href="#" id="printThisEmail">
                                <i class="icon-printer">
                                </i>
                                <span class="d-none position-right">
                                     {{trans('mail.print')}}
                                </span>
                            </a>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <!-- /mail toolbar -->
        <!-- Mail details -->
      
        <div class="media stack-media-on-mobile mail-details-read" >

            <a class="media-left" href="#" >
                <div id="profipicplaceholder" >
                </div>
            </a>
            <!-- <div class="media-body" >
                <h6 class="media-heading">
                    <div id="subjectplaceholder" class="edit-card subject" >
                    </div>
                </h6>
                <div class="text-semibold">
                    <div id="usernameplaceholder" class="edit-card" >
                    </div>
                    <a href="#">
                        <span id="emailplaceholder">
                        </span><hr>
                        
                    </a>
                </div>
            </div> -->
            <div class="media-body">
            <h6 class="media-heading">
               <div id="subjectplaceholder" class="edit-card subject"></div>
            </h6>
            
            <div class="letter-icon-title text-semibold">
                <div id="usernameplaceholder" class="edit-card"></div>
                <a href="#" class="edit-card">
                    &lt;<span id="emailplaceholder"></span>&gt;
                </a>
            </div>
        </div>
             <div class="media-right media-middle text-nowrap">
            <ul class="list-inline list-inline-condensed no-margin">
                <li>
                    <!-- <span class="btn bg-teal-400 btn-xs">
                        <div id="totalmailfromuserplaceholder"></div>
                    </span> -->
                </li>
            </ul>
        </div>
        </div>
        <!-- /mail details -->
        <!-- Mail container -->
         <div class="mail-container-read">
        <div id="messageplaceholder"></div>
    </div>
        <!-- /mail container -->
    </div>
    <div class="card card-white" id="maillist" style="display: none;">

        <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title"> {{trans('mail.my_inbox')}}</h6>

                        <div class="header-elements">
                            <span class="badge bg-blue"> {{$unread_count}}  {{trans('mail.new')}}  </span>

                            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
                        </div>

                    </div>

                    <!--include mail toolbar here-->
                    @include('app.admin.mail.widget_inbox_toolbar')
                    <!--include mail toolbar here-->

                    <!--include mail toolbar here-->
                    @include('app.admin.mail.widget_inbox_list')
                    <!--include mail toolbar here-->

    
    </div>
    <div class="card card-white" id="outlist" style="display: none;">
        <div class="card-header bg-transparent  header-elements-inline">
            <h6 class="card-title">
                {{trans('mail.outbox')}}
            </h6>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        
                    <!--include mail toolbar here-->
                    @include('app.admin.mail.widget_outbox_toolbar')
                    <!--include mail toolbar here-->
                    
                    <!--include mail toolbar here-->
                    <div id="table_data">
                    @include('app.admin.mail.widget_outbox_list')
                </div>
                    <!--include mail toolbar here-->

        
    </div>
</div>
<!-- /single line -->
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script src="../jquery.js" ></script>
<script type="text/javascript" src="../GitProjects/Parsley.js/parsley.js"></script>
<script type="text/javascript">
	

  $(document).ready(function(){

  var page={{$page_num_out}};
  var from={{$from}};
  if(from == "1"){
   $('#pageprev').prop('disabled', true);
  }
  if(page == "1" || page == "0"){
	$('#pageprev').prop('disabled', true);
	$('#pagenext').prop('disabled', true);
  }

  console.log(from,"kk");
	  // $('#nextpre').prop('disabled', true);
 $(document).on('click', '.next', function() { 
  // event.preventDefault(); 
  var page =  $(this).attr('data-from');
  var total =  $(this).attr('data-all');
  var total_page={{$page_num_out}};
  // console.log("hi");
  console.log(page,total_page,"next");
  // console.log(total);
  fetch_data(page);
  $('#pageprev').prop('disabled', false);
  if(page== total_page){
  	$('#pagenext').prop('disabled', true);
  }
 });
  $(document).on('click', '.prev', function() { 
  // event.preventDefault(); 
  var page =  $(this).attr('data-from');
  var total =  $(this).attr('data-all');
  var total_page={{$page_num_out}};
  // console.log("hi");
  console.log(page,total_page,"prev");
  if(page== "1"){
  	$('#pageprev').prop('disabled', true);
  	$('#pagenext').prop('disabled', false);
  }
  // console.log(total);
  fetch_data(page);
 });

 function fetch_data(page)
 {
  $.ajax({
   url: CLOUDMLMSOFTWARE.siteUrl+"/admin/pagination/fetch_data?page="+page,
   dataType: 'json',
   async: true,
   type: 'get',
   success:function(data){
    console.log(data.data);
    $("#out_list").empty();
       
    for (var i = 0; i < data.count; i++) {
    drawRow(data.data[i]);
    }
   var k=parseInt(page)+1;
   var m=parseInt(page)-1;
     $(".nextpage").attr("data-from",k);
     $(".prevpage").attr("data-from",m);
     $('#cur_p').html(page);
   }
  });
 }

 function drawRow(rowData) {
    // var row = $("<tr/>");
    if(rowData.read == 'yes'){
      var actc='read';}
    else{
      var actc='unread';}
    // console.log(actc);

    var row = $("<tr class='mail-link "+actc+"'/>");
 
    // console.log(rowData);
    // console.log(rowData.email);
    $(".out_list").append(row);  
     row.append($("<td class='table-inbox-checkbox rowlink-skip'> <input class='styled' type='checkbox'/></td>"));
    row.append($("<td class='table-inbox-star rowlink-skip'> <a href='#'><i class='icon-star-full2 text-warning-300'></i></a></td>"));
    row.append($("<td class='table-inbox-image'><img src={{asset('img/cache/profile')}}/" +  rowData.image   + " class='rounded-circle' width='32' height='32 alt=''></td>"));
    row.append($("<td class='table-inbox-name'><a href='mail_read.html' class='letter-icon-title text-default'> " +  rowData.username   + "</td>"));
    row.append($("<td class='table-inbox-message'>  <span class='table-inbox-subject'>"+rowData.litsub+"</span>  <span class='text-muted font-weight-normal'>"+
        rowData.litmsg+"</span></td>"));
    row.append($("<td class='table-inbox-attachment'></td>"));
    row.append($("<td class='table-inbox-time'>" +  rowData.editcreate   + "</td>"));
    row.each(function( index ) {
        $(this).attr("data-mailid", rowData.encryt_id);
        $(this).attr("data-emailid", 'na');
        $(this).attr("data-subject", rowData.rep_subject);
        $(this).attr("data-message", rowData.repmessage);
        $(this).attr("data-username", rowData.username);
        $(this).attr("data-datetime", rowData.created_at);
        $(this).attr("data-profilepic", rowData.image);
        $(this).attr("data-totalmailfromuser", rowData.id);

    });   
// row.append($("<td>" + rowData.random_string + "</td>"));
    
    } 
});

</script>

<script type="text/javascript">
$('document').ready(function(){
var hash_inbox = "/u/mail/inbox";
var hash_read = "/u/mail/read";
var hash_reply = "/u/mail/reply";
var hash_forward = "/u/mail/forward";
var hash_delete = "/u/mail/delete";
var hash_compose = "/u/mail/compose";
var hash_outbox = "/u/mail/outbox";

if(window.location.hash) {
    /* alert(window.location.hash);*/
    var current_hash = window.location.hash;
    var current_href = window.location.href;
    if(current_href.indexOf(hash_inbox) > -1){
        showMailList();
    }
    if(current_href.indexOf(hash_outbox) > -1){
        showOutBox();
    }
      
    var mystr = window.location.hash;
    var myarr = mystr.split("usnm=");
    var use=myarr[1];
      if(use){
        $('#to').attr('value',use);
        $('#to').tagsinput('add', use);
        $('#to').tagsinput('refresh');
        showMailCompose();
    }

    if(current_href.indexOf(hash_compose) > -1){
        showMailCompose();
    }


}else{
 showMailList();
 parent.location.hash = hash_inbox;
}




 $('.table-inbox').on('click', '.mail-link td:not(".table-inbox-checkbox,.table-inbox-star")', function(e) {
    e.preventDefault();

   

    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 500);
    var this_context = $(this).parent('tr');

    console.log(this_context);

    var mail_id = this_context.data('mailid');
    var emailid = this_context.data('emailid');

    // console.log(emailid);
  
    var mail_subject = this_context.data('subject');
    var mail_message = this_context.data('message');
    var mail_username = this_context.data('username');
    var mail_datetime = this_context.data('datetime');
    var mail_profilepic = this_context.data('profilepic');
    var total_mail_from_user = this_context.data('totalmailfromuser');


    $('#singlemailtab #profipicplaceholder').html('<img alt="" class="rounded-circle img-md" src='+CLOUDMLMSOFTWARE.siteUrl+'/img/cache/profile/'+mail_profilepic+'/>');

    $('#singlemailtab #subjectplaceholder').html(mail_subject);
    $('#singlemailtab #usernameplaceholder').html(mail_username);
    $('#singlemailtab #emailplaceholder').html(emailid);
    $('#singlemailtab #totalmailfromuserplaceholder').html(total_mail_from_user);
    $('#singlemailtab #datetimeplaceholder').html(mail_datetime);
    $('#singlemailtab #messageplaceholder').html(mail_message);

    $('#singlemailtab .btn-mail-delete-single').attr('data-mailid','');
    $('#singlemailtab .btn-mail-reply-single').attr('data-mailid','');
    $('#singlemailtab .btn-mail-reply-single').attr('data-mail_username','');
    $('#singlemailtab .btn-mail-forward-single').attr('data-mailid','');
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_subject','');
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_message','');

    $('#singlemailtab .btn-mail-delete-single').attr('data-mailid',mail_id);
    $('#singlemailtab .btn-mail-reply-single').attr('data-mailid',mail_id);
    $('#singlemailtab .btn-mail-reply-single').attr('data-mail_username',mail_username);
    $('#singlemailtab .btn-mail-forward-single').attr('data-mailid',mail_id);
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_subject',mail_subject);
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_message',mail_message);

    parent.location.hash = hash_read +'/'+mail_id;
    $.get(
    'mark-as-read/'+mail_id,
        { msg_id: mail_id },
        function(response) {
            this_context.removeClass('unread');
        });
    showMailSingle();


 });




 $('.left-mail-links').on('click', '.left-mail-link', function(e) {
    e.preventDefault();



    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 500);
    var this_context = $(this);
    var mail_id = this_context.data('mailid');
    var emailid = this_context.data('emailid');

    var mail_subject = this_context.data('subject');
    var mail_message = this_context.data('message');
    var mail_username = this_context.data('username');
    var mail_datetime = this_context.data('datetime');
    var mail_profilepic = this_context.data('profilepic');
    var total_mail_from_user = this_context.data('totalmailfromuser');


    $('#singlemailtab #profipicplaceholder').html('<img alt="" class="rounded-circle img-md" src='+CLOUDMLMSOFTWARE.siteUrl+'/img/cache/profile/'+mail_profilepic+'/>');

    $('#singlemailtab #subjectplaceholder').html(mail_subject);
    $('#singlemailtab #usernameplaceholder').html(mail_username);
    $('#singlemailtab #emailplaceholder').html(emailid);
    $('#singlemailtab #totalmailfromuserplaceholder').html(total_mail_from_user);
    $('#singlemailtab #datetimeplaceholder').html(mail_datetime);
    $('#singlemailtab #messageplaceholder').html(mail_message);

    $('#singlemailtab .btn-mail-delete-single').attr('data-mailid','');
    $('#singlemailtab .btn-mail-reply-single').attr('data-mailid','');
    $('#singlemailtab .btn-mail-reply-single').attr('data-mail_username','');
    $('#singlemailtab .btn-mail-forward-single').attr('data-mailid','');
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_subject','');
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_message','');

    $('#singlemailtab .btn-mail-delete-single').attr('data-mailid',mail_id);
    $('#singlemailtab .btn-mail-reply-single').attr('data-mailid',mail_id);
    $('#singlemailtab .btn-mail-reply-single').attr('data-mail_username',mail_username);
    $('#singlemailtab .btn-mail-forward-single').attr('data-mailid',mail_id);
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_subject',mail_subject);
    $('#singlemailtab .btn-mail-forward-single').attr('data-mail_message',mail_message);

    parent.location.hash = hash_read +'/'+mail_id;
    $.get(
    'mark-as-read/'+mail_id,
        { msg_id: mail_id },
        function(response) {
            this_context.removeClass('unread');
        });
    showMailSingle();


 });


$('#email-page').on('click', '.btn-mail-delete-single', function(e) {
    deleteMail($(this).data('mailid'));
    showMailList();
});

$('#email-page').on('click', '.btn-mail-reply-single', function(e) {

    $('#to').attr('value',$(this).data('mail_username'));
    $('#to').tagsinput('add', $(this).data('mail_username'));
    $('#to').tagsinput('refresh');
    showMailCompose();

});

$('#email-page').on('click', '.btn-mail-forward-single', function(e) {


    var subject = $(this).attr('data-mail_subject');
    var message = $(this).attr('data-mail_message');

    showMailCompose();
    $("input[name=subject]").val(subject);
    $(".mailcomposer").summernote('code',message);



});
$('#email-page').on('click', '#back-to-mail-list', function(e) {
    showMailList();
});

$('#email-page').on('click', '.button-email-compose', function(e) {
    showMailCompose();
});

$('#email-page').on('click', '.button-email-compose-cancel', function(e) {

    $('#to').attr('value','');
    $('#to').tagsinput('removeAll');
    $('#to').tagsinput('refresh');

    $("input[name=subject]").val('');
    $(".mailcomposer").summernote('code','');


    showMailList();
});

$('#email-page').on('click', '.submitmail', function(e) {
    e.preventDefault();
    $('.mailcomposeform').submit();
});



$('body').on('click', '#showOutBox', function(e) {
    e.preventDefault();
    showOutBox();
});


$('body').on('click', '#showInBox', function(e) {
    e.preventDefault();
    showMailList();
});


$('body').on('click', '#composeMailbtn', function(e) {
    e.preventDefault();
    showMailCompose();
});



function showMailSingle(){
    $('#singlemailtab').show();
    $('#maillist').hide();
    $('#single-compose').hide();
    $('#outlist').hide();
}

function showMailList(){
    parent.location.hash = hash_inbox;
    $('#singlemailtab').hide();
    $('#single-compose').hide();
    $('#maillist').show();
    $('#outlist').hide();
    $('#singlemailtab #profipicplaceholder').html('');
    $('#singlemailtab #subjectplaceholder').html('');
    $('#singlemailtab #usernameplaceholder').html('');
    $('#singlemailtab #emailplaceholder').html('');
    $('#singlemailtab #totalmailfromuserplaceholder').html('');
    $('#singlemailtab #messageplaceholder').html('');
}

function showOutBox(){
    parent.location.hash = hash_outbox;
    $('#singlemailtab').hide();
    $('#single-compose').hide();
    $('#maillist').hide();
    $('#outlist').show();
    $('#singlemailtab #profipicplaceholder').html('');
    $('#singlemailtab #subjectplaceholder').html('');
    $('#singlemailtab #usernameplaceholder').html('');
    $('#singlemailtab #emailplaceholder').html('');
    $('#singlemailtab #totalmailfromuserplaceholder').html('');
    $('#singlemailtab #messageplaceholder').html('');
}

function showMailCompose(){
    parent.location.hash = hash_compose;
    $('#singlemailtab').hide();
    $('#single-compose').show();
    $('#maillist').hide();
    $('#outlist').hide();
    $('#email-page .note-editor input[type=checkbox]').attr('name','note-editable-chkbox');
    $('#email-page textarea.note-codable').attr('required','required');
    $('#email-page textarea.note-codable').attr('data-parsley-required-message','Email cannot be empty');
}

function deleteMail(mailids){

                var block = $(this).parent().parent();

               $.ajax({
               url: CLOUDMLMSOFTWARE.siteUrl+'/admin/mail/delete',
               data: {mailids: mailids},
               dataType: 'json',
               async: true,
               type: 'post',
               beforeSend: function() {


                    $(block).block({
                        message: '<i class="icon-spinner2 spinner"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait',
                            'box-shadow': '0 0 0 1px #ddd'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'none'
                        }
                    });

               },
               success: function(response) {
                     $(block).unblock();


                     new PNotify({
                        text: 'Email Deleted',

                        type: 'success',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    parent.location.hash = hash_inbox;
                    $('#singlemailtab').hide();
                    $('#single-compose').hide();
                    $('#maillist').show();

               },error: function(response){

                new PNotify({
                        text: response.responseJSON.message,
                        type: 'danger',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    $(block).unblock();
               }

           });


}


$(".mailcomposeform").submit(function(e) {
        e.preventDefault();
 
      
        var to = $(this).find('input[name=to]').val();       

        if ($('input.select_all').is(':checked')) {
           var checked="true";

        }else   var checked="false";
       
        if(checked=="true"){
           var to = "all";
        }
       
        var subject = $(this).find('input[name=subject]').val();
        var message = $(this).find('.note-editable[contenteditable=true]').html();
        
        var postvalues = {to: to, subject: subject, message: message};


        // $('.mailcomposeform').parsley().validate();
        
            //if ($('.mailcomposeform').parsley().isValid()) {

               var block = $(this).parent().parent();

               $.ajax({
               url: CLOUDMLMSOFTWARE.siteUrl+'/admin/send',
               data: postvalues,
               dataType: 'json',
               async: true,
               type: 'post',
               beforeSend: function() {


                    $(block).block({
                        message: '<i class="icon-spinner2 spinner"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait',
                            'box-shadow': '0 0 0 1px #ddd'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'none'
                        }
                    });

               },
               success: function(response) {

                
                     $(block).unblock();
                     $('.mailcomposeform').find("input[type=text], textarea").val("");

                     new PNotify({
                        text: 'Email Sent',

                        type: 'success',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    parent.location.hash = hash_inbox;
                    $('#singletab').hide();
                    $('#single-compose').hide();
                    $('#maillist').show();

               },error: function(response){

               

                new PNotify({
                        text: response.responseJSON.message,
                        /*// styling: 'brighttheme',*/
                        /*// icon: 'fa fa-file-image-o',*/
                        type: 'danger',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    $(block).unblock();
               }

           });







            // } else {

            //     console.log('not valid');
            // }


    });



if ($('.mailcomposer').length) {
        $('.mailcomposer').summernote({
          callbacks: {
        onKeyup: function(e) {
        $('#email-page textarea.note-codable').text($('#email-page .note-editable').html());
    }
  }
    });
}


if ($('.btn-checkbox-all').length) {
    $(".btn-checkbox-all").click(function () {
        if ($(".btn-checkbox-all input[type=checkbox]").is(':checked')) {
            $(".table-inbox input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
                $(this).attr("checked", true);
                $(this).trigger("change");
                $.uniform.update();
            });
            analyzeCheckBoxes();

        } else {
            $(".table-inbox input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
                $(this).attr("checked", false);
                $.uniform.update();
                $(this).trigger("change");
            });
            analyzeCheckBoxes();
        }
    });




    var data = [];
    $(".table-inbox  input[type='checkbox']").on('change', function(){
        var state = $(this).prop("checked");
        var mailid = $(this).parent().parent().parent().parent().data('mailid');
        var idx = $.inArray(mailid, data);
        if (idx == -1) {
          data.push(mailid);
        } else {
          data.splice(idx, 1);
        }
        analyzeCheckBoxes();
    });

}




function analyzeCheckBoxes(){
     var checkboxs = $(".table-inbox input[type=checkbox]:checked");
     var i =0, box;
     $('.deleteAllCheckedMails').attr('disabled',true);
         while(box = checkboxs[i++]){
         if(!box.checked)continue;
         $('.deleteAllCheckedMails').attr('disabled',false);
         break;
         }
     }


if ($('.deleteAllCheckedMails').length) {
    $('#email-page').on('click', '.deleteAllCheckedMails', function(e) {
        var data =  [];
        email_ids = GetAllCheckedMails();
        if(deleteMail(email_ids)){
            location.reload();
        }else{
            location.reload();
        }
    });
}

if ($('#printThisEmail').length) {
    $('#email-page').on('click', '#printThisEmail', function(e) {
        $('#messageplaceholder').printThis();
    });
}



function GetAllCheckedMails(){

    var data = [];
    $(".table-inbox input[type=checkbox]:checked").each(function(){
        var mailid = $(this).parent().parent().parent().parent().data('mailid');
        data.push(mailid);
    });
    return data;
}





    if ($('.autocompleteusersforemail').length) {

$(function() {

    /*//
    // Typeahead implementation
    //*/

    /*// Matcher*/
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            /*// an array that will be populated with substring matches*/
            matches = [];

            /*// regex used to determine if a string contains the substring `q`*/
            substrRegex = new RegExp(q, 'i');

            /*// iterate through the pool of strings and for any string that*/
            /*// contains the substring `q`, add it to the `matches` array*/
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {

                    /*// the typeahead jQuery plugin expects suggestions to a*/
                    /*// JavaScript object, refer to typeahead docs for more info*/
                    matches.push({ value: str });
                }
            });
            cb(matches);
        };
    };



    /*Attach typeahead*/

    $('.autocompleteusersforemail').tagsinput('input').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'to',
            displayKey: 'value',

            source: function(query, syncResults, asyncResults) {
              $.ajax({
                url: "search/autocomplete",
                type: "POST",
                dataType: "json",
                data: { term: query  },
                success: function (data) {
                    asyncResults(data);
                }
              })


              }
        }
    ).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', datum.username);
        this.tagsinput('input').typeahead('val', '');
    }, $('.autocompleteusersforemail')));


});



    }







});

$('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
            
                $('#sendtoone').hide();
                document.getElementById('email2').style.display = 'block';        
            }
            else if($(this).prop("checked") == false){
                $('#sendtoone').show();
                document.getElementById('email2').style.display = 'none';
            }
        });

</script>
@stop
