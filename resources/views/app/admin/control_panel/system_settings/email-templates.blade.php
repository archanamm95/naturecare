@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent

<style type="text/css">
a {
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
}
/*.form-group.note-group-select-from-files {
    visibility: hidden;
}*/
.card-header.note-toolbar .dropdown-menu.note-check a i {
    display: block;
}
.note-icon-menu-check:before {
    display: none;
}
</style>
@endsection





        {{-- Content --}}
        @section('main')
 @include('flash::message')
<!-- Basic datatable -->
<div>
    <div class="card card-white" id="single-compose" >
        <form class="mailcomposeform">
            <!-- Mail toolbar -->
            <div class="card-toolbar card-toolbar-inbox">
                <div class="">
                    <div class="" id="inbox-toolbar-toggle-single" style="margin-left: 18px;"><br>
                        <div class="btn-group " id="save-template" style="display: none;">
                            <button class="save_template btn bg-blue" title="save"><i class="fa fa-floppy-o"></i>  Save Template </button>
                        </div>
                        <div class="btn-group" id="delete-template" style="display: none;">
                            <button class="delete_template btn bg-danger " title="delete"><i class="fa fa-trash"></i>  Delete Template </button>
                        </div>
                          <div class="btn-group">
                              <button class="edit_template btn bg-blue" title="edit"><i class="fa fa-pencil position-left"></i>  Edit Template </button>
                          </div>
                          <div class="btn-group " id="add-template">
                              <button class="add_template btn bg-blue" title="add"><i class="fa fa-plus position-left"></i>  Add Template </button>
                          </div>
                    </div>
                </div>
            </div>
            <!-- /mail toolbar -->
            <div class="mail-details-write"  >
                <table class="table">
                    <tbody>
                        <tr>
                            <td> Template Name :</td>
                            <td>
                                <input type="text" name="template_name" id="template_name" value="Template" class="form-control " style="border: 3px solid #ddd;"  >
                            </td>
                        </tr>
                        <tr style="display: none;" id="template_name_edit"> 
                            <td> Template Name :</td>
                              
                            <td>
                                <input type="text" name="template_name_edit" id="template_new_edit" value="Template" class="form-control " style="border: 3px solid #ddd;"  readonly="">
                            </td>
                        </tr>
                      
                        <tr class="description" >
                            <td> {{trans('menu.description')}}:</td>
                            <td>
                                <input type="text" name="description" id="description" class="form-control " style="border: 3px solid #ddd;"  placeholder="Enter a small description about template" required="">
                            </td>
                        </tr>
                        <tr class="admin"></tr>
                    </tbody>
                </table>
            </div>
            <div class="mail-details-write" id="select-template" style="display: none;">
                <table class="table">
                    <tbody>
                        <tr>
                            <td> Select Templates :</td>
                            <td>
                                <select class="form-control template_type" name="template_type" id="template_type" required>
                                    <option value="">Choose Template</option>
                                    @foreach($template_data as $value)
                                    <option  value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Mail container -->
            <div class="mail-container-write">
                <div class="mailcomposer" > 
                
                </div>
            </div>
            <!-- /mail container -->
        </form>
    </div>
   <div class="card card-default">
    <div class="card-heading"><h4 style="    margin-left: 18px;">{{trans('menu.saved_templates')}}</h4>
      <div  class="table-responsive">
        <table class="table table-invoice">
            <thead>
                <tr>
                    <th>{{trans('ticket_config.no')}}</th>
                    <th>{{trans('ticket_config.title')}}</th>
                    <th>{{trans('ticket_config.description')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temp_data as $key=> $data)
                <tr>
                    <td>{{$key +1 }}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->description}}</td>    
                </tr>
                @endforeach
            </tbody>
        </table>
            {!!$temp_data->render()!!}
      </div>
    </div>
  </div>
</div>
@stop
{{-- Scripts --}}
@section('scripts')
    @parent

<script type="text/javascript">
$('.mailcomposer').summernote({
shortcuts: false,
toolbar: [
['style', ['bold', 'italic', 'underline', 'clear']],
['fontname', ['fontname']],
['color', ['color']],
['fontsize', ['fontsize']],
['para', ['ul', 'ol', 'paragraph']],
['insert', ['picture', 'video', 'link','codeview', 'hr']],
['misc', ['fullscreen', 'code', 'undo', 'redo']]
],
dialogsInBody: false,
disableDragAndDrop: true
});
$('document').ready(function(){
    $(".mailcomposer").summernote();
    $(".edit_template").click(function(){
      $(".description").hide();
      $('#select-template').show();
      $('#template_name').hide();
      $('#template_name_edit').show();
       $('#add-template').hide();
      
    });
    $("select.template_type").change(function(){
        var selectedTemplate = $(this).children("option:selected").val();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/template-edit/'+selectedTemplate,
            dataType: 'json',
            async: true,
            type: 'get',
            processData: false,
            contentType: false,
              success: function(response) {
                if(response.users==2){
                  $(".admin").hide();

                  var receiver = 'User'
                }
                else{
                  $(".admin").show();

                  var receiver = 'Admin'

                }


            
                  
                  
                  $('.description').show();
                  $('#save-template').show();
                  $('#delete-template').show();
                  $(".mailcomposer").summernote('code',response.template_body);
                  $("#template_name").val(response.template_title);
                  $("#template_new_edit").val(response.template_title);
               
                  $("#description").val(response.description);
                  
              },
        });
    });
    $(".save_template").click(function(e){
        e.preventDefault();
        var data = $(".mailcomposer").summernote('code');
        var touser = $('#to').val(); 
        console.log(touser);
        var selectedTemplate = $( "#template_type option:selected" ).val();
        var selectedTemplatetitle = $( "#template_name").val();
        var description = $('#description').val(); 
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              url: CLOUDMLMSOFTWARE.siteUrl + '/admin/template-save',
              dataType: 'json',
              async: false,
              type: 'post',
              data: {
                        'note_id': data,
                        'id': selectedTemplate,
                        'title':selectedTemplatetitle,
                        'description':description,
                    },
             
                success: function(response) {
                          swal("Content Updated Successfully!");
                          window.location.reload();
                },
          });
    }); 

    $(".delete_template").click(function(e){
        e.preventDefault();
        var data = $(".mailcomposer").summernote('code');
        
        var selectedTemplate = $( "#template_type option:selected" ).val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        $.ajax({
              url: CLOUDMLMSOFTWARE.siteUrl + '/admin/template-delete',
              dataType: 'json',
              async: false,
              type: 'post',
              data: {
                        'note_id': data,
                        'id': selectedTemplate
                    },
             
                success: function(response) {
                          swal("Template deleted Successfully!");
                          window.location.reload();
                },
          });
    });
    $(".add_template").click(function(e){
        e.preventDefault();
        var data = $(".mailcomposer").summernote('code'); 
        var selectedTemplatetitle = $( "#template_name").val();
        var users = $('#to_user').val(); 
        var description = $('#description').val(); 
        console.log(selectedTemplatetitle);

        if(selectedTemplatetitle == "Template"){
          swal("Can not add a template with without editing the title name");
          return false;
        }
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              url: CLOUDMLMSOFTWARE.siteUrl + '/admin/template-add',
              dataType: 'json',
              async: false,
              type: 'post',
              data: {
                        'note_id': data,
                        'title'  : selectedTemplatetitle,
                        'description': description
                    },
             
                success: function(response) {
                  console.log(response.data);
                  if(response.data =='success'){
                          swal("Template added Successfully!");
                          window.location.reload();
                        }
                  else
                          swal("Template Title Is Already Taken!");

                },
          });
    });
});

</script>

@stop
