@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
<style type="text/css">
    
.packagestyle{

  width:100px!important;
  height:100px!important;
  margin:0px auto!important;
  background-size: cover!important;

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
              {{trans('packages.edit_package')}}
            </h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
                         

  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">
                    {{trans('packages.product_details')}}
    </legend>
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group row">
              <label class="col-form-label col-lg-6 text-right"></label>  
               <div class="col-lg-6">
               <div class="input-group">         
                 <div class="media-left">
               <div class="avatar">
                <div class="avatarin ajxloaderouter ">
                     <div class="rounded-circle packagestyle" id="pack_image_preview" style="background-image:url({{url('products/'.$product->image)}})">
                     </div> 
            
                   <div class="profileuploadwrapper">
                     <form id="package_image_form" method="post" name="package_image_form">
                       <input type="hidden" name="pack_id" id="pack_id">
                          {!! Form::file('file', ['class' => 'inputfile profilepic','id'=>'package_image']) !!}
                          {!! Form::hidden('type', 'product_image') !!}
                          {!! Form::hidden('user_id', Auth::user()->id) !!}
                          {!! csrf_field() !!}
                       <label for="package_image" onclick="DeleteCategory({{$product->id}})">
                         <i class="icon-file-plus position-left" style="color: red;">
                         </i>
                        <span>
                        </span>
                       </label>
                     </form>
                   </div>
                </div>
              </div>
              </div>
            </div>
        </div>
       </div>
             
               {!! Form::model($options,['url' => '/admin/control-panel/product-edit-post/', 'method' => 'POST','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
            <input type="hidden" name="id" value="{{$product->id}}"/>
                

                    

                        

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{ trans('packages.product_name') }}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="name" value="{{$product->name}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{ trans('packages.description') }}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="description" value="{{$product->description}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{ trans('packages.category') }}</label>
                            <div class="col-lg-6">
                              <select class="form-control chosen-select" name="category" id="category" required="">
                            <option value="">{{trans('packages.select_category')}}</option>
                            @foreach($category as $cat)
                            @if($cat->id == $product->category_id)
                            <option value="{{$cat->id}}" selected="">{{$cat->category_name}}</option>
                            @else
                            <option value="{{$cat->id}}" >{{$cat->category_name}}</option>
                            @endif
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{ trans('packages.quantity') }} </label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                   <input type="number" class="form-control" id="quantity" placeholder="{{trans('packages.enter_quantity')}}" name="quantity"  required min="1" value="{{$product->quantity}}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{ trans('packages.price') }}</label>
                            <div class="col-lg-6">
                            <input type="number" class="form-control" id="price" placeholder="{{trans('packages.enter_price')}}" name="price" min =0 required value="{{$product->price}}">
                                </div>
                            </div> 

                            <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{ trans('packages.status') }}</label>
                            <div class="col-lg-6">
                               <select class="form-control chosen-select" name="status" id="status" required="true">

                            @if($product->status == 'yes')
                                        <option value="yes" selected="">{{trans('packages.yes')}}</option>
                                        <option value="no">{{trans('packages.no')}}</option>
                                        @else
                                        <option value="yes" >{{trans('packages.yes')}}</option>
                                        <option value="no" selected="">{{trans('packages.no')}}</option>
                                        @endif
                            </select>
                                </div>
                            </div>

                        </div> 

       



                    </div>
                    


            
                </div>

            </fieldset>
                <div class="text-center">
                   <button class="btn bg-dark Content-center" type="submit">{{trans('packages.save')}}</button>
                </div>
{!! Form::close() !!}


        </div>
    
</div>
@stop

@section('styles')@parent
<style type="text/css">
</style>
@endsection

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
$("#package_image").change(function() {
    $("#package_image_form").submit();
});
function DeleteCategory(id) { 
localStorage.setItem("pack_id",id);
}

$("#package_image_form").submit(function(evt) {
  
    var pack_id=localStorage.getItem("pack_id");
    console.log(pack_id);
    $('#pack_id').val(pack_id);
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/productimageUpload',
            data: new FormData($("#package_image_form")[0]), 
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
          
            },
            success: function(response) {
                $('#logoiconpreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/products/' + response.filename + ')');
                setTimeout(function() {}, 2000);
                location.reload();
            },
        });
        return false;
    });
</script>
</script>
@stop
