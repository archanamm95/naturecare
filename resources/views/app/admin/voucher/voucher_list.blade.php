@extends('app.admin.layouts.default') {{-- Web site Title --}} 
@section('title') {{{ $title }}} :: @parent 
@stop @section('styles') 
@parent 
   
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection {{-- Content --}} 
@section('main')

<div class="row">
<div class="col-sm-7">
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">{{trans('all.create_voucher')}}<a class="header-elements-toggle"></a></h6>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">


<form action="{{URL::to('admin/voucherlist')}}" class="form-vertical" method="post" onsubmit="return checkForm(this);">
<input name="_token" type="hidden" value="{{{ csrf_token() }}}"/>


                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">  {{trans('all.amount')}}: </label>
                                    <div class="col-lg-8">
                        <input autocomplete="off" class="form-control" name="amount" required="" type="text"/>
                                        
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-form-label col-lg-3">   {{trans('all.count')}}:  </label>
                                    <div class="col-lg-8">
                         <input autocomplete="off" class="form-control" name="count" required="" type="text"/>
                                            
                                    </div>
                                </div>


<div class="text-right">
<button type="submit" id="add_amount" name="add_amount" class="btn btn-primary">{{trans('all.create_new_voucher')}}<i class="icon-arrow-right14 position-right"></i></button>
</div>



             

</form>

    </div>

</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card card-flat">
<div class="card-header header-elements-inline">
<h5 class="card-title">{{trans('voucher.voucher_list')}}
</h5>
<div class="header-elements">
<ul class="icons-list">
                <li><a data-action="collapse"></a></li>                 
                </ul>
                </div>
</div>


<div class="table-responsive">
                <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">{{trans('voucher.delete_all')}}</button>
<table class="table" id="table-voucher">
   <thead>
                        <tr>
                            <th><input type="checkbox" class="styled" id="check_all"></th>
                            <th>
                                {{trans('all.no')}}
                            </th>
                            <th>
                                {{trans('all.voucher_code')}}
                            </th>
                            <th>
                                {{trans('all.total_amount')}}
                            </th>
                            <th>
                                {{trans('all.balance_amount')}}
                            </th>
                            <th>
                                {{trans('all.created_at')}}
                            </th>
                            <th>
                                {{trans('all.action')}}
                            </th>
                        </tr>
                    </thead>
<tbody>
                        @foreach($vhr as $key=>$request)
                        <tr>

                            <td><input type="checkbox" class="checkbox "   data-id="{{$request->id}}"></td>
                            <td>
                                {{ ($vhr->currentPage() - 1 ) * $vhr->perPage()  +$key +  1 }}
                            </td>
                            <td>
                                <input type="text" name="vcode" readonly="true" class="form-control selectall" value="{{$request->voucher_code}}"/>
                            </td>
                            <td>
                                {{ $request->total_amount }}
                            </td>
                            <td>
                                {{ $request->balance_amount }}
                            </td>
                            <td>
                                <!-- <span title="{{$request->created_at}}"> </span> -->
                                {{ date('d M Y H:i:s',strtotime($request->created_at))}}
                            </td>
                            <td>
                                <button class="btn btn-info" data-target="#modal_theme_success-{{$request->id}}" data-toggle="modal" type="button">
                                   <i class="icon-pencil"></i> {{trans('all.edit')}}
                                </button>


                                                              <!-- Danger modal -->
                <div id="modal_theme_success-{{$request->id}}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h6 class="modal-title">{{trans('all.update')}}</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                             

                                <div class="modal-body">

                            <form action="{{URL::to('admin/updatevoucher')}}" method="post">
                                <input name="_token" type="hidden" value="{{csrf_token() }}">
                                <input name="requestid" type="hidden" value="{{$request->id}}"/>



                               <input name="_token" type="hidden" value="{{csrf_token() }}">
                                                        <input name="requestid" type="hidden" value="{{$request->id}}"/>

                                 <div class="form-group row mt-2">
                                    <label class="col-form-label col-lg-2">   {{trans('all.amount')}}:  </label>
                                    <div class="col-lg-10">
                                 <input class="form-control" min="1" name="amount" type="number" value="{{$request->total_amount}}"/>
                                            
                                    </div>
                                </div>




                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-dismiss="modal">{{trans('voucher.close')}}</button>
                                    <button type="submit" class="btn bg-warning"> {{trans('all.update')}}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /default modal -->



                                <div class="modal fade" id="myModal{{$request->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close" data-dismiss="modal" type="button">
                                                    ×
                                                </button>
                                                <h4 class="modal-title">
                                                    {{trans('all.edit')}}
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                </p>
                                                <form action="" method="post">
                                                    
                                                            <div class="col-sm-12">
                                                                <div class="col-sm-4">
                                                                    {{trans('all.amount')}}
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-success" name="submit" type="submit">
                                                                {{trans('all.update')}}
                                                            </button>
                                                        </input>
                                                    </input>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                                                    {{trans('all.close')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-target="#modal_theme_danger-{{$request->id}}" data-toggle="modal" type="button">
                                    <i class="icon-bin"></i>
                                </button>


                                <!-- Danger modal -->
                <div id="modal_theme_danger-{{$request->id}}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h6 class="modal-title">{{trans('all.delete')}}</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                             


                            <form action="{{URL::to('admin/deleteconfirm')}}" method="post">
                                <input name="_token" type="hidden" value="{{csrf_token() }}">
                                <input name="requestid" type="hidden" value="{{$request->id}}"/>
                                <div class="modal-body">
                                    <h6 class="font-weight-semibold">{{trans('all.Are_You_Sure_You_Want_To_Delete')}}?</h6>
                                    <p>Voucher Code :{{$request->voucher_code}}</p>

                                    <hr>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-dismiss="modal">{{trans('voucher.close')}}</button>
                                    <button type="submit" class="btn bg-danger"> {{trans('all.delete')}}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /default modal -->



                               
                            </td>
                        </tr>
                        @endforeach  

                    </tbody>
</table>
            </div>
        </div>
        <div class="dataTables_paginate paging_simple_numbers" id="users-table_paginate">
                 {{$vhr->links()}}
             </div>
</div>

</div>


@endsection
{{-- Scripts --}}
@section('scripts')


<script type="text/javascript">

    function checkForm(form)
{
 
  form.add_amount.disabled = true;
  return true;
}



$(document).ready(function () {

    $('#check_all').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".checkbox").prop('checked',true);  

        } else {  
            $(".checkbox").prop('checked',false);  
        }  
    });

    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#check_all').prop('checked',true);
        }else{
                $('#check_all').prop('checked',false);
        }
    });

    $('.delete-all').on('click', function(e) {


        var idsArr = [];  
        $(".checkbox:checked").each(function() {  
            idsArr.push($(this).attr('data-id'));
        }); 
        if(idsArr.length <=0)  
            {  
            swal({
            title: "Please select atleast one record to delete!",
            type: "error",
            confirmButtonClass: "btn-error",
            confirmButtonText: "Ok!",
            showCancelButton: false,
             });

            }
        else{  

            if(confirm("Are you sure, you want to delete the selected vouchers?")){  

                var strIds = idsArr.join(","); 

                    $.ajax({
                        method: 'POST',
                        url: CLOUDMLMSOFTWARE.siteUrl+'/admin/voucher/delete_all',
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        dataType: 'json',
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                swal({
                                    title: data['message'],
                                    type: "success",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Ok!",
                                    showCancelButton: false,
                                     });
                                //alert(data['message']);
                            } else {
                                 swal({
                                    title: "Whoops Something went wrong!!!",
                                    type: "error",
                                    confirmButtonClass: "btn-error",
                                    confirmButtonText: "Ok!",
                                    showCancelButton: false,
                                     });
                                //alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }  
            }  
    });
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
        element.closest('form').submit();
        }
    });   
    
});


</script>

@endsection
