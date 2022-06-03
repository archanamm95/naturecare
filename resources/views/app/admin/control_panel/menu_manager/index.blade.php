@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')


@parent

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="/menu-builder/bootstrap-iconpicker.min.css">


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



ul#myEditor {
    border: 0;
}

.list-group-item .btn {
    height: inherit;
    padding: 0px 5px 0px 5px;
    line-height: initial;
}

li.list-group-item>div {width: 100%;padding: 10px;display: block;clear: both;background: #ffff;border: 1px solid #ddd;}

.btn-group, .btn-group-vertical {
    display: block;
    float: right;
}

.list-group-item:nth-child(odd) {
    background: #f9f9f9;
    /* border: 1px solid #ddd; */
}
.list-group-item:nth-child(even) {
    background:#f6fbff;
    
}

.list-group-item {
    padding: 0px;
    display: block;
}

li.list-group-item>ul {
    clear: both;
    width: auto;
    /* margin-left: 17px; */
    /* margin-bottom: 10px; */
    background: #fff;
}

li.list-group-item>ul>li {
    margin-left: 15px;
    margin-bottom: 10px;
}


span.sortableListsOpener {
    background: #e6e6e6a1;
    color: #324148;
    box-shadow: none;
    border: 1px solid #ddd;
    border-radius: 50px;
    width: 30px;
    height: 30px!important;
    line-height: 30px!important;
}

.list-group-item {
    margin-bottom: 10px;
    /* border: 1px solid #ddd; */
}


</style>

@endsection
@section('sidebar')
@parent
<!-- Secondary sidebar -->
@include('app.admin.control_panel.sidebar')
<!-- /secondary sidebar -->
@endsection


        {{-- Content --}}
        @section('main')
<div id="settings-page">

        <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                Menu manager : Manage Menu items
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">



<div class="container">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="float-left">Menu</h5>
                            <div class="float-right">
                                <button id="btnReload" type="button" class="btn btn-outline-secondary">
                                    <i class="fa fa-play"></i> Load Data</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul id="myEditor" class="sortableLists list-group">
                            </ul>
                        </div>
                    </div>
                    <p>Click the Output button to execute the function <code>getString();</code></p>
                    <div class="card">
                    <div class="card-header">JSON Output
                    <div class="float-right">
                    <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Output</button>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="form-group">

                    </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Edit item</div>
                        <div class="card-body">
                            <form id="frmEdit" class="form-horizontal">
                                <div class="form-group">
                                    <label for="text">Text</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                        <div class="input-group-append">
                                            <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="icon" class="item-menu">
                                </div>
                                <div class="form-group">
                                    <label for="href">URL</label>

                               
                                  <!--   <select name="href" id="href">

                                    @foreach ($routes as $route) 
                                        @if($route->methods[0] === "GET")

                                          <option value="{{ $route->uri }};">
                                            {{ $route->uri }};
                                        </option>
                                            
                                        @endif                                                                    
                                    @endforeach
                                
                                    </select> -->

                                    <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                                </div>
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Self</option>
                                        <option value="_blank">Blank</option>
                                        <option value="_top">Top</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Tooltip</label>
                                    <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                    
                </div>
            </div>
           

</div>
















                
            <!-- 
             <div class="required row form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                <label class="col-form-label col-lg-2">Choose Skin</label>
                <div class="col-lg-12">
                    <input type="form-check" name="theme_name" class="form-control" data-popup="tooltip" title="" placeholder="Company name" data-original-title="Company name." value="theme_name">
                </div>
            </div> -->
           
{!! Form::model($options,['url' => '/admin/control-panel/menu-manager', 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
            <textarea id="out" class="form-control" cols="50" rows="10" name="primary_menu_items"></textarea>
            <button class="btn bg-dark" type="submit">Save</button>
           
{!! Form::close() !!}

              
                
            </div>    
        </div>
    </div> 


</div>
@stop

{{-- Scripts --}}
@section('scripts')
    @parent


        <script type="text/javascript" src="/menu-builder/jquery-menu-editor.min.js"></script>
        <script type="text/javascript" src="/menu-builder/fontawesome5-3-1.min.js"></script>
        <script type="text/javascript" src="/menu-builder/bootstrap-iconpicker.min.js"></script>

        <script>
            jQuery(document).ready(function () {
                /* =============== DEMO =============== */
                // menu items
                var arrayjson = {!!$primary_menu_items_json!!} ;

                // [{"href":"http://home.com","icon":"fas fa-home","text":"Home", "target": "_top", "title": "My Home"},{"icon":"fas fa-chart-bar","text":"Opcion2"},{"icon":"fas fa-bell","text":"Opcion3"},{"icon":"fas fa-crop","text":"Opcion4"},{"icon":"fas fa-flask","text":"Opcion5"},{"icon":"fas fa-map-marker","text":"Opcion6"},{"icon":"fas fa-search","text":"Opcion7","children":[{"icon":"fas fa-plug","text":"Opcion7-1","children":[{"icon":"fas fa-filter","text":"Opcion7-1-1"}]}]}];
                // icon picker options
                var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
                // sortable list options
                var sortableListOptions = {
                    placeholderCss: {'background-color': "#cccccc"}
                };

                var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));
                // $('#btnReload').on('click', function () {
                editor.setData(arrayjson);
                var str = editor.getString();
                $("#out").text(str);
                // });

                $('#btnOutput').on('click', function () {
                    var str = editor.getString();
                    $("#out").text(str);
                });

                $("#btnUpdate").click(function(){
                    editor.update();
                    var str = editor.getString();
                    $("#out").text(str);
                });

                $('#btnAdd').click(function(){
                    editor.add();
                    var str = editor.getString();
                    $("#out").text(str);
                });
                /* ====================================== */

                /** PAGE ELEMENTS **/
                // $('[data-toggle="tooltip"]').tooltip();
                // $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
                //     $('#btnStars').html(data.stargazers_count);
                //     $('#btnForks').html(data.forks_count);
                // });
            });
        </script>



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



</script>
@stop
