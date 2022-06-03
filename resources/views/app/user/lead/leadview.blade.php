



@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat">
    <div class="card-heading">
        <!-- <h5 class="card-title">{{$title}}</h5> -->
       
    </div>
     <div class="table-responsive">   
     <table class="table table-hover">
      <thead>
        <th>{{trans('lead.sl_no')}}</th>
        <th>{{trans('lead.name')}}</th>
        <th>{{trans('lead.email')}}</th>
        <th>{{trans('lead.mobile')}}</th>
        <th>{{trans('lead.created_at')}}</th>
        <th>{{trans('lead.status')}}</th>  
        <th>{{trans('lead.action')}}</th> 
      </thead>
      <tbody> 
        @foreach($data as $key=>$value)
        <tr>
          <td> {{$key +1 }}</td>
          <td> {{$value->name}}</td> 
          <td>{{$value->email}}</td>
          <td>{{$value->mobile}}</td>
          <td>{{  date('Y-m-d',strtotime($value->created_at))}}</td>
          <td>@if($value->status == 0) {{trans('lead.pending')}}  @else  {{trans('lead.completed')}} @endif</td>
          <td>
              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$value->id}}"><i class="icon-trash" aria-hidden="true"></i></a>

                <div id="myModal2{{$value->id}}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h6 class="modal-title">{{trans('all.delete_lead')}} </h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                             


                            <form action="{{URL::to('user/delete_lead')}}" method="post">
                                <input name="_token" type="hidden" value="{{csrf_token() }}">
                                <input name="requestid" type="hidden" value="{{$value->id}}"/>
                                <div class="modal-body">
                                    <h6 class="font-weight-semibold">{{trans('all.Are_You_Sure_You_Want_To_Delete_')}}?</h6>
                                    <p>{{trans('lead.name')}} :{{$value->name}}</p>
                                    <p>{{trans('lead.email')}} :{{$value->email}}</p>

                                    <hr>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-dismiss="modal">{{trans('lead.close')}}</button>
                                    <button type="submit" class="btn bg-danger"> {{trans('all.delete')}}</button>
                                </div>

                            </form>
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
                  
@stop 
 


                                                

                                                        

                                    

                              