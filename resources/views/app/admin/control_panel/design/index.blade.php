@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection



        {{-- Content --}}
        @section('main')
<div id="settings-page">

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.design')}} : {{trans('controlpanel.theme_options')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               {!! Form::model($options,['url' => '/admin/control-panel/design', 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
                <div class="row mb-3">
                    <div class="col-md-4 nopad text-center">
                        <h4>{{trans('controlpanel.default_skin')}}</h4>

                        <label class="image-radio">
                            <img class="img-fluid" src="{{ url('img/cache/original/skin-default.png')}}" />
                            <input type="radio" name="theme_skin" {{ $selected_skin === "1" ? "checked=true" : "" }}  value="1" />
                            <i class="icon-checkmark hidden"></i>
                        </label>
                    </div>
                    <div class="col-md-4 nopad text-center">
                         <h4>{{trans('controlpanel.skin')}} 2</h4>

                        <label class="image-radio">
                            <img class="img-fluid" src="{{ url('img/cache/original/skin--2.png')}}"/>
                            <input type="radio" name="theme_skin"  {{ $selected_skin === "2" ? "checked=true" : "" }} value="2" />
                            <i class="icon-checkmark hidden"></i>
                        </label>
                    </div>
                    <div class="col-md-4  nopad text-center">
                         <h4>{{trans('controlpanel.skin')}} 3</h4>
                        <label class="image-radio">
                            <img class="img-fluid" src="{{ url('img/cache/original/skin--3.png')}}" />
                            <input type="radio" name="theme_skin"  {{ $selected_skin === "3" ? "checked=true" : "" }} value="3" />
                            <i class="icon-checkmark hidden"></i>
                        </label>
                    </div>
                    <div class="col-md-4  nopad text-center">
                         <h4>{{trans('controlpanel.skin')}} 4</h4>
                        <label class="image-radio">
                            <img class="img-fluid" src="{{ url('img/cache/original/skin--4.png')}}"/>
                            <input type="radio" name="theme_skin"  {{ $selected_skin === "4" ? "checked=true" : "" }} value="4" />
                            <i class="icon-checkmark hidden"></i>
                        </label>
                    </div>
                    <div class="col-md-4  nopad text-center">
                         <h4>{{trans('controlpanel.skin')}} 5</h4>
                        <label class="image-radio">
                            <img class="img-fluid" src="{{ url('img/cache/original/skin--5.png')}}" />
                            <input type="radio" name="theme_skin"  {{ $selected_skin === "5" ? "checked=true" : "" }} value="5" />
                            <i class="icon-checkmark hidden"></i>
                        </label>
                    </div>
                    <div class="col-md-4  nopad text-center">
                         <h4>{{trans('controlpanel.skin')}} 6</h4>
                        <label class="image-radio">
                            <img class="img-fluid" src="{{ url('img/cache/original/skin--6.png')}}" />
                            <input type="radio" name="theme_skin"  {{ $selected_skin === "6" ? "checked=true" : "" }} value="6" />
                            <i class="icon-checkmark hidden"></i>
                        </label>
                    </div>
                </div>


<!-- 
             <div class="required row form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                <label class="col-form-label col-lg-2">Choose Skin</label>
                <div class="col-lg-12">
                    <input type="form-check" name="theme_name" class="form-control" data-popup="tooltip" title="" placeholder="Company name" data-original-title="Company name." value="theme_name">
                </div>
            </div> -->
           
            
            <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>
           
{!! Form::close() !!}

              
                
            </div>    
        </div>
    </div> 




        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('controlpanel.design')}} : {{trans('controlpanel.font_options')}}
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
               {!! Form::model($options,['url' => '/admin/control-panel/design/font-size', 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
                <h2>{{trans('controlpanel.font_size')}}</h2>
                <div class="row mb-3">
                      <div class="d-block">
                          <button class="btn btn-success" type="button" id="up">+</button>
                          <button id="font-size" class="btn btn-success" type="button"> </button>
                          <input type="hidden" name="theme_font_size" id="font-size-final"> </input>
                          <button class="btn btn-success" type="button" id="down">-</button>
                      </div>
                  
                </div>



            
            <button class="btn bg-dark" type="submit">{{trans('controlpanel.save')}}</button>
           
                {!! Form::close() !!}

              
                
            </div>    
        </div>
    </div> 



</div>
@stop

@section('styles')@parent
<style type="text/css">
.image-radio {
    cursor: pointer;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border: 1px solid #0000;
    margin-bottom: 0;
    outline: 0;
    padding: 10px;
}
.image-radio input[type="radio"] {
    display: none;
}
.image-radio-checked {
        /*border-color: #4caf50;*/
}
.image-radio i {
position: absolute;
    color: #fff;
    background-color: #4caf50;
    padding: 10px;
    top: 25px;
    right: 25px;
        border-radius: 180%;

}
.image-radio-checked i {
  display: block !important;
}
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">



$.fn.removeClassStartingWith = function (filter) {
    $(this).removeClass(function (index, className) {
        return (className.match(new RegExp("\\S*" + filter + "\\S*", 'g')) || []).join(' ')
    });
    return this;
};


   $(document).ready(function(){
    // add/remove checked class
    $(".image-radio").each(function(){
        if($(this).find('input[type="radio"]').first().attr("checked")){
            $(this).addClass('image-radio-checked');
        }else{
            $(this).removeClass('image-radio-checked');
        }
    });

    // sync the input state
    $(".image-radio").on("click", function(e){
        $(".image-radio").removeClass('image-radio-checked');
        $(this).addClass('image-radio-checked');
        var $radio = $(this).find('input[type="radio"]');
        $radio.prop("checked",!$radio.prop("checked"));
        $('body').removeClassStartingWith('theme_skin_');
        $('body').addClass('theme_skin_'+$radio.val());
        e.preventDefault();
    });
});


// When + or - buttons are clicked the font size of the h1 is increased/decreased by 2
// The max is set to 50px for this demo, the min is set by min font in the user's style sheet

function getSize() {
  size = $( "body" ).css( "font-size" );
  size = parseInt(size, 10);
  $( "#font-size" ).text(  size  );
  $( "#font-size-final" ).val(  size  );
}

//get inital font size
getSize();

$( "#up" ).on( "click", function() {

  // parse font size, if less than 50 increase font size
  if ((size + 2) <= 20) {
    $( "body" ).css( "font-size", "+=2" );
    $( "#font-size" ).text(  size += 2 );
    $( "#font-size-final" ).val(  size );
  }
});

$( "#down" ).on( "click", function() {
  if ((size - 2) >= 12) {
    $( "body" ).css( "font-size", "-=2" );
    $( "#font-size" ).text(  size -= 2  );
    $( "#font-size-final" ).val(  size  );
  }
});

</script>
@stop
