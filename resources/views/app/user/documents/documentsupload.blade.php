


@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
  img.card-image.img-fluid {
    height: 200px;
    width: 296px;
}
.container {
  position: relative;
  width: 100%;
  max-width: 400px;
}

.container img {
  width: 100%;
  height: auto;
}

.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  color: transparent;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
  background: transparent;
}

.container .btn:hover {
  background-color: black;
  color: white
}
</style>
@endsection @section('main')
<!-- Basic datatable -->
    <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"> {{$title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
      <div class="card-body">
        <div class="row">
          @foreach($downloads as $key=> $request)
          <div class="col-md-4 mb-4">
            {{$request->file_title}}
            <div class="container">
              <!-- <a href="{{url('user/download-image/'.$request->thumnail)}}"  name="requestid"> -->
                <!-- <img src="{{ url('uploads/documents/'.$request->thumnail) }}"  class="card-image img-fluid" alt="product"/> -->
              <!-- </a> -->
              <a href="{{url('user/view/'.$request->name)}}"  name="requestid">
            
              
                <img src="{{ url('uploads/documents/'.$request->thumnail) }}"  class="card-image img-fluid" alt="product"/>
            
              </a>
              <!-- <a href="{{url('user/download/'.$request->name)}}" class="btn" type="button" ><i class="fa fa-download"></i></a> -->
            </div>
          </div>
          @endforeach
        </div>
         {!! $downloads->render() !!}
      </div>
    </div>
<!-- 
 <table class="table table-invoice">

                                      <thead>

                                           <tr>

                                             <th>{{trans('download.no')}}</th>

                                             <th>{{trans('download.file_title')}}</th>

                                             <th>{{trans('download.name')}}</th>

                                             <th>{{trans('download.download')}}</th>

                                             <th>{{trans('download.created_at')}}</th>   

                                          </tr>

                                      </thead>

                                      <tbody>

                                       @foreach($downloads as $key=> $request)

                                        <tr>

                                          <td>{{$key +1 }}</td>

                                          <td>{{$request->file_title}}</td>

                                          <td>{{$request->name}}</td>

                                          <td><a class="btn btn-success" href="{{url('user/download/'.$request->name)}}"  name="requestid">{{trans('download.download')}}</a></td>

                                          <td>{{$request->created_at}}</td>

                                        </tr>

                                        @endforeach  

                                        @if(!count($downloads))

                                        <tr><td>{{trans('download.no_data')}}</td></tr>

                                          @endif

                                        </tbody>

                                                             

                            </table> -->

                          <!-- {!! $downloads->render() !!} -->



                        
  <!-- </div> -->
                  
@stop 