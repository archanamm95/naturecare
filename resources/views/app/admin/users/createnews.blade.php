@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: 
@endsection {{-- Content --}}@section('styles') @parent
<style type="text/css">
  .dropdown-item{
    height: 17px;
  }
.card-header.note-toolbar .dropdown-menu.note-check a i {
    display: block;
}
.note-icon-menu-check:before {
    display: none;
}
</style>

@endsection
@section('main')
@include('flash::message') 
@include('utils.errors.list')

  <div class="card card-flat" style="overflow: auto;">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('ticket_config.create_news')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    
        <div class="card-body">

   <form action="{{url('admin/postnews')}}"  enctype="multipart/form-data"  method="post" onsubmit="return checkForm(this);">
   
        {{ csrf_field() }}
          <div class="row">
           
                <label class="col-sm-4" for="post_name" >
                   {{trans('ticket_config.name')}}:
                    <span class="symbol required">
                        </span>
                  
                </label>
                <div class="col-sm-4">
                    <input class="form-control" name="post_name" id="post_name"  type="text" required="true">
           
                </div>
   
            </div>
                  <br>
             <div class="row">
                  
            <label class="col-sm-4" for="post_name" >
                  Short Text:
                    <span class="symbol required">
                        </span>
                  
                </label>
                <div class="col-sm-4">
                    <input class="form-control" name="shorttext" id="shorttext"  type="text" required="true">
                 
                </div>
              </div>
   
  

               <br>
   
        <div class="row">
              <label class="col-sm-4" for="content">
                   {{trans('ticket_config.content')}}:
                    <span class="symbol required">
                        </span>
                </label>
        </div>
          <div class="row">
        <textarea name="summernoteInput" class="summernote"></textarea>
    </div>
                            <div class="row">                            
                            <div class="col-sm-12">                            
                                <div class="form-group">
                                        <label class="col-form-label">Thumpnail(png,jpg,jpeg Files Only): </label>
                                        <input type="file" data-fouc accept=".png,.jpg,.jpeg" name="thump" class="file-input" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary" data-remove-class="btn btn-light" >
                                </div>
                            </div>
                        </div>
        <br>
        <button type="submit" class="btn btn-info" name="add_news" id="add_news">{{trans('ticket_config.submit')}}</button>
       
    </form>
 
           
        </div>
    </div>

     @if(count($news) > 0)

    <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{trans('ticket_config.latest_news')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
         <div class="table-responsive" style="height: 182px;">
           <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th>{{trans('ticket_config.no')}}.</th>
                                                    <th>{{trans('ticket_config.title')}}</th>
                                                    <th>{{trans('ticket_config.created_at')}} </th>
                                                    <th>{{trans('ticket_config.actions')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($news as $key=>$item)

                                                <tr >

                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->title}}</td>
                                                   

                                                     <td>{{ date('d M Y',strtotime($item->created_at))}}</td>
                                                     <td>
                                                     <div class="list-icons">
                                                  <div class="list-icons-item dropdown">
                                                  <a href="#" class="list-icons-item" data-toggle="dropdown"><i 
                                                  class="icon-menu7"></i></a>
                                                  <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                                  style="position: absolute; will-change: transform;top: 0px;left:
                                                  0px;transform: translate3d(-164px, 16px, 0px);">
                                                  <a href="{{url('admin/viewnews/'.$item->id)}}" class="dropdown-item"  ><i class="fa fa-eye"></i>{{trans('ticket_config.view')}}</a>
                                                  <div class="dropdown-divider"></div><br>
                                                    
                                                  <a href="{{url('admin/editnews/'.$item->id)}}" class="dropdown-item"><i 
                                                  class="fa fa-pencil" aria-hidden="true" style="color:green"></i>
                                                  {{trans('ticket_config.edit')}}</a><div class="dropdown-divider"></div><br>
                                               
                                                   <a  data-id="{{$item->id}}" href="{{url('admin/newsdelete')}}"  class="dropdown-item newsdelete" > <i class="fa fa-trash "></i> {{trans('ticket_config.delete')}}  </a>
                                                   
                        
                                                
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                             

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>
                                    </div>
                                     {!! $news->render() !!}

                                  </div>
                                  @endif





@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

  function checkForm(form)
{
 
  form.add_news.disabled = true;
  return true;
}


   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>
<script type="text/javascript">
  $(document).on('click', '.newsdelete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title:"Are you sure you want to delete the news? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                 url:CLOUDMLMSOFTWARE.siteUrl + '/admin/deletenews',

                 type: "post",
                 
                 data: {id: id },
                 success: function (data) {           
                swal("Good job!", "Successfully deleted!", "success");
                location.reload();
               


                    }
                 
      }) 

          
    });
});
</script>


@endsection
