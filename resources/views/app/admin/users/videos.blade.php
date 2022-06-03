@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')

<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
            {{ trans('ewallet.add_videos') }}
        </h4>

    </div>
    <div class="card-body">
        <!-- @include('utils.errors.list') -->
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('admin/postvideos')}}" onsubmit="return checkForm(this);">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            
            <div class="form-group">
              <div class="row">
                
                <label class="col-sm-3">{{trans('users.title')}}</label>
                <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="" />
                </div>
              </div>
            </div>  
                 <div class="form-group">
                <div class="row">
                    <div class="col-sm-3" >
                         <label class="form-label ">{{trans('packages.add_video')}}</label>
                    </div>
                    <div class="col-sm-9" >
                         <input type="text" name="videos" placeholder="add vimeo url . example : https://vimeo.com/63892510" class="form-control name_list" />
                                   
                             
                        </div>
                    </div>
                </div>

           
           
            <div class="form-group">
                
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" name="add_video" id="add_video" class="btn btn-sm btn-success">{{trans('users.add')}}</button>
                </div>
            </div>
            
        </form>
    </div>
    



    </div>

      @if(count($result) > 0)

    <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">{{trans('packages.latest_videos')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
         <div class="table-responsive">
           <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th>{{trans('packages.no')}}</th>
                                                    <th>{{trans('packages.title')}}</th>
                                                    <th>{{trans('packages.view')}}</th>
                                                    <th>{{trans('packages.created')}} </th>
                                                    <th>{{trans('packages.actions')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($result as $key=>$video)
                                          

                                                <tr >

                                                    <td>{{$key+1}}</td>
                                                    <td>{{$video['title']}}</td>
                                                    <td>{!! $video['url'] !!}</td>
                                                   

                                                     <td>{{ date('d M Y',strtotime($video['created']))}}</td>
                                                     <td>
                                                     <div class="list-icons">
                                                  <div class="list-icons-item dropdown">
                                                  <a href="#" class="list-icons-item" data-toggle="dropdown"><i 
                                                  class="icon-menu7"></i></a>
                                                  <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                                  style="position: absolute; will-change: transform;top: 0px;left:
                                                  0px;transform: translate3d(-164px, 16px, 0px);">
                                                    
                                                  <a href="{{url('admin/editvideo/'.$video['id'])}}" class="dropdown-item"><i 
                                                  class="fa fa-pencil" aria-hidden="true" style="color:green"></i>
                                                  {{trans('packages.edit')}}</a><div class="dropdown-divider"></div><br>
                                               
                                                   <a  data-id="{{$video['id']}}" href="{{url('admin/videodelete')}}"  class="dropdown-item videodelete" > <i class="fa fa-trash "></i> {{trans('packages.delete')}}  </a>
                                                   
                        
                                                
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                             

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>
                                    </div>
                                    

                                  </div>
                                  @endif





                      
@endsection
{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">

function checkForm(form)
{
 
  form.add_video.disabled = true;
  return true;
}

  $(document).on('click', '.videodelete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title:"Are you sure you want to delete the video? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                 url:CLOUDMLMSOFTWARE.siteUrl + '/admin/videodelete',

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
    
@stop
