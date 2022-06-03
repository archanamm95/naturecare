@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')

<div class="card card-flat">
    <div class="card-header pb-1 pt-1 bg-light">
        <h4 class="card-title">{{trans('registration.send_mail') }}</h4>
    </div>
    <div class="card-body bordered">
        <form action="{{url('admin/send-mail-to-users')}}" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">

           <div class="row form-group">
                    
                     <label class="col-sm-2 control-label" for="username">
                    {{trans('ewallet.username')}}: <span class="symbol required"></span>
                    </label>
                    <div class="no-padding sendtoone col-md-4" id="sendtoone">
                       
                    <input type="text" name="to" id="to" class="tagsinput-typeahead form-control autocompleteusersforemail" data-parsley-required-message = "{{trans('all.at_least_one_reciepient_required')}}" placeholder="Add recipients" data-role="tagsinput" />
                   
            <div id="email2" class="m-b-15" style="display: none">
            <input type="text" name="users" class="form-control"  value="All Users" readonly>
            </div>

                    </div>
                                <div class="col-md-4" >
                                <label class="control-label">{{trans('wallet.select_all')}}</label>
                                <input id="select_all" name="select_all" class="select_all" type="checkbox" /> 
                                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" for="mail">
                    {{trans('all.select_mail')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                   <select class="form-control" id="mail" name="mail" type="text" required>
                    @foreach($emailTemplate as $key=>$data)
                      <option value="{{$data->id}}">{{$data->title}}</option>
                         @endforeach
                    </select>
                                     
                   
                </div>
            </div>
            <div class="col-sm-offset-4">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-4">
                        <button class="btn btn-primary" id="save" name="save" tabindex="4" type="submit" value="{{trans('all.save')}}">
                            {{trans('mail.send')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <a href="{{url('admin/email-templates')}}" target="_blank" type="button" class="btn btn-primary">{{trans('all.create_template')}}</a>
    </div>
</div>
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-light" style="">
            <h3 class="mb-0 font-weight-light">
                 {{trans('wallet.edit_view_template')}}
            </h3>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <div class="row row-tile no-gutters text-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4 ">
                        <div class="quickLink">
                            <a href="{{url('admin/email-templates')}}" data-popup="tooltip" data-html="true" data-original-title="{{trans('controlpanel.email_manager')}}" data-placement="top">
                                <i class="icon-envelop4">
                                </i>
                                <span>
                                     {{trans('settings.email_template')}}
                                </span>
                            </a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        
        
    </div> 
@endsection


@section('scripts') @parent


    <script>

        $(document).ready(function() {

            App.init(); 

            $(".datetimepicker").datepicker()          

        });
             
$('document').ready(function(){

if ($('.autocompleteusersforemail').length) {
// console.log(345);
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

</script>
<script type="text/javascript">
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
@endsection