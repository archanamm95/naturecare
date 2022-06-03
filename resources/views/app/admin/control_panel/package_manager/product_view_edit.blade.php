@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-xs') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
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
              {{trans('controlpanel.product_edit')}}
            </h5>
             <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>
        <div class="card-body bordered">
                         

  <fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">
                   {{trans('controlpanel.product_details')}}
    </legend>
    <div class="row">
        <div class="col-sm-9">
             
               {!! Form::model($options,['url' => '/admin/control-panel/product-manager/edit/'.$package->id, 'method' => 'PATCH','class'=>'form-vertical optionsform ','data-parsley-validate'=>'true','role'=>'form','enctype'=>'multipart/form-data'] )!!}
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                

                    

                        

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">Product Name</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="name" value="{{$package->name}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">SKU</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="sku" value="{{$package->sku}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">BV</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="bv" value="{{$package->bv}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">Retail Price</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="category_id" value="{{$package->category_id}}">
                                </div>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">Member Price</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="price" value="{{$package->price}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">Add Stock</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="quantity" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">Image</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input id="input" name="image" type="file"  multiple class="file-loading" data-parsley-group="block-0" accept="image/jpg, image/jpeg, image/png">
                                </div>
                            </div>
                        </div>  


                   <!--      <div class="form-group row">
                            <label class="col-form-label col-lg-6 text-right">{{trans('controlpanel.daily_commission_limit')}}</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="daily_limit" value="{{$package->daily_limit}}">
                                </div>
                            </div>
                        </div>  -->

       



                    </div>
                    


            
                </div>

            </fieldset>
                <div class="text-center">
                   <button class="btn bg-dark Content-center" type="submit">{{trans('controlpanel.save')}}</button>
                </div>
{!! Form::close() !!}


        </div>
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
    $('#pack_id').val(pack_id);
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/packageimageUpload',
            data: new FormData($("#package_image_form")[0]), 
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
          
            },
            success: function(response) {
                $('#logoiconpreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/logo/' + response.filename + ')');
                setTimeout(function() {}, 2000);
                location.reload();
            },
        });
        return false;
    });
</script>
</script>
@stop
