@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: 
@endsection {{-- Content --}}
@section('main')
@include('flash::message') 
@include('utils.errors.list')

  


    @if(count($news) > 0)

    <div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">Latest News</h5>
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
                                                    <td><a href="{{url('admin/viewnews/'.$item->id)}}" class="btn btn-info"  ><i class="fa fa-eye"></i>View </td>

                                                     <td>{{ date('d M Y',strtotime($item->created_at))}}</td>

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

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>


@endsection
