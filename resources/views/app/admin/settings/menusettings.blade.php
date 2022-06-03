@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title')  @parent
@stop


@section('styles')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

{{-- Content --}}
@section('main')


@include('flash::message')

<div class="card card-flat" >
                        <div class="card-header header-elements-inline">
                            
                            <h4 class="card-title">Menu Settings </h4> 
                        </div>
                        <div class="card-body"> 




    <table id="data-table" class="table table-striped ">
                                    
                                    <thead>
                                        <tr role="row">
                                          
                                                                                       
                                            <th>Menu Name</th>                                           
                                            
                                           <th>Status</th> 
                                            
                                        </tr>
                                    </thead>
                                    <tbody>    
                                    @foreach($menu_name as $request)
                                        <tr class="gradeC " role="row">
                                            
                                           
                                            
                                            <td>{{$request->menu_name}}</td>
                                            @if($request->status=="no")
                                           <td><form class="myform">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> <input type="form-check"    data-toggle="toggle" data-id="{{$request->id}}" value="yes" ></form></td>
                           @else

                                  <td><form class="myform">
                     <input type="form-check"    data-toggle="toggle" data-id="{{$request->id}}" value="no" checked></form></td>
                                           
                                                                                                                         
                                        </tr>
                                        @endif
                                    @endforeach  



                                    </tbody>
                                   
                                </table>


                             

                       
                </div>
            </div>
  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>




    <script type="text/javascript"> 






 $(document).ready(function(){

  


$('.myform :form-check').change(function() {

         var decision = $(this).val();

         var id =  $(this).data('id');

   if (this.checked) {
 
alert("Are you sure want to active?");

 $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
       $.ajax({
                 url: "{{URL::to('admin/optionsettings')}}",
                 type: "post",
                 
                 data: {decision: decision, id: id },
                 
      }) 


      }
else{
     
     alert("Are you sure want to deactive?");
     
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
       $.ajax({
                 url: "{{URL::to('admin/optionsettings')}}",
                 type: "post",
                 
                 data: {decision: decision, id: id },
                 
      }) 
}
  });

});









     
    
       
    </script>
    
@stop


@section('scripts') @parent
<script>
        $(document).ready(function() {
            App.init();           
        });
       

        
    </script>
    @endsection