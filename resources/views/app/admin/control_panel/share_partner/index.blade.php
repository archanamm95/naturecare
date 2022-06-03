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
                Share Partner
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
     <div class="card-body bordered">
          <form id="binaryform" class="form-horizontal" action="{{url('admin/control-panel/update-sharepackage')}}" method="post"  name="form-wizard">
                    {{csrf_field()}}    
                    <table class="table table-borderless">
                      <thead>
                      <tr>
                        <th><b>Product</b></th>
                        <th><b>Quantity</b></th>
                      </tr>
                      </thead>
                      @foreach($product as $key =>$product)
                      <tbody>
                        <tr>
                          <td><label for="name" class="col-sm-6 control-label">{{$product->Products}}</label></td>
                          <td><input type="number" class="form-control col-sm-6 control-label" id="quantity[{{$product->id}}]"  name="quantity[{{$product->id}}]" value="{{$product->quantity}}"></td>
                        </tr>
                        <tr>
                         @endforeach
                        <tr>
                          <td colspan="3">
                           <button style="margin-left: 570px;" class="btn btn-success" type="submit"> {{trans('controlpanel.save')}}</button>
                           </td>
                        </tr>
                       <!--  <tr colspan="3"><td></td><button class="btn bg-dark" type="submit" > {{trans('controlpanel.save')}}</button></td></tr> -->

                      </tbody>
                    </table>
           
                    
                  </form>
</div>
</div>
 

</div>
@stop

@section('styles')@parent

@endsection
@section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
   form.add_camp.disabled = true;
  
   return true;
 }

</script>
@stop