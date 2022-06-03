@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
    img.card-image.img-fluid {
    height: 200px;
    width: 296px;
}
</style>
@endsection @section('main')
@include('flash::message') 
@include('utils.errors.list')

  


    @if(count($news) > 0)

    <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">Latest News</h4>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

      <div class="card-body">
        <div class="row">
          @foreach($news as $key=> $item)
          <div class="col-lg-4 mb-4">
            <h5>{{$item->title}}</h5>
            <h6>{{$item->sub_text}}</h6>
            <a href="{{url('user/viewnews/'.$item->id)}}" name="requestid">
              <img src="{{ url('uploads/documents/'.$item->thumnail) }}"  class="card-image img-fluid" alt="product"/>
            </a>
          </div>
          @endforeach
        </div>
           {!! $news->render() !!}
      </div>
    </div>

<!--          <div class="table-responsive">
           <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th>Sl.no</th>
                                                    <th>Title</th>
                                                    <th>Actions</th>
                                                    <th>Created </th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($news as $key=>$item)

                                                <tr >

                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td><a href="{{url('user/viewnews/'.$item->id)}}" class="btn btn-info"  ><i class="fa fa-eye"></i>View </td>

                                                     <td>{{ date('d M Y',strtotime($item->created_at))}}</td>

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>
                                    </div>
                                     {!! $news->render() !!} -->

                                  @endif


@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>


@endsection
