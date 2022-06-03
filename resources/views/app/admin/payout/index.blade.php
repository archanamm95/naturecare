@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
<style type="text/css">
    .btn {
        font-size: 11px;
    }

</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


@endsection
{{-- Content --}}
@section('main')
@include('flash::message')
@include('utils.errors.list')

<div class="panel panel-flat" >
    <div class="panel-heading">                       
        <!-- <h3 class="panel-title">Pending Payout</h3><br>  -->
        <a class="btn btn-info payout"> Complete Payout </a><br>
    </div>
    <div class="panel-body"> 
        <div class="table-responsive">
            <table  class="table table-striped " id="table-payout">
                <thead>
                    <tr role="row">
                        <th> <label style="width: 18px;height: 18px;border: 2px solid #607D8B;border-radius: 2px"><span class="test">✔</span></label></th>
                        <th>{{ trans('payout.username') }} </th>
                        <th>{{ trans('payout.name') }} </th>
                        <th>{{ trans('report.email') }} </th>
                        <!-- <th >{{ trans('payout.user_balance') }}</th> -->
                        <th >{{ trans('payout.payment_mode')}}</th>
                        <th >{{trans('payout.bank_account_details')}}</th>
                        <th >{{trans('payout.amount')}}</th>
                        <th >{{trans('payout.date')}}</th>
                    </tr>
                </thead>
                <tbody>    
                    @foreach($vocherrquest as $request)
                    <tr class="gradeC " role="row">
                        <td class="data" infos= "{{$request}}"> </td>
                        <td class="sorting_1">{{$request->username}}</td>
                        <td class="sorting_1">{{$request->name}} {{$request->lastname}}</td>
                        <td>{{$request->email}}</td>
                        <!-- <td>{{$request->balance}}</td> -->
                        <td>{{$request->payment_mode}}</td>
                        <td> 
                            @if($request->account_number == 0)
                                <span>No bank details Uploaded</span>
                            @else                                
                                {{trans('register.account_number')}}:<strong> {{$request->account_number}}</strong><br>
                                {{trans('register.account_holder_name')}}:<strong>{{$request->account_holder_name}}</strong><br>
                                Swift:<strong>{{$request->swift}}</strong><br>
                                Bank Code:<strong>{{$request->bank_code}}</strong><br> 
                                Branch Address:<strong>{{$request->branch_address}}</strong><br>
                              
                            @endif                                
                            </div>
                        </td>
                        <td>{{currency($request->amount)}}</td>
                        <td>{{$request->created_at}}</td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection @section('scripts') @parent

<script  src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script  src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

<script>



$(document).ready(function () {
    $(".test").hide();
    let example = $('#table-payout').DataTable({
        columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        lengthMenu: [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, "All"]],
        order: [
            [1, 'asc']
        ],
        dom: "<'row'<'col-sm-6'l><'col-sm-6'fr>>" +
                "<'row'<'col-sm-12't>>" +
                "<'row'<'col-sm-2'i><'col-sm-5'<'pull-left'p>><'col-sm-5'<'pull-right'B>> >",
        language: {
            paginate: {
                next: '<i class="glyphicon glyphicon-chevron-right">',
                previous: '<i class="glyphicon glyphicon-chevron-left">',
            }
        },
        buttons: [
            {
                extend: 'pdfHtml5',
                pageSize:'A3',
                orientation:'landscape',
                title: 'Payout Data',
                text:'<span class="fa fa-print"> PDF</span>',
                className: 'btn  btn-xs  btn-primary paginate_button ',
                messageTop: function() {
                    return '\r\n\r\n Start Date:' +start_date +
                           '\r\n\r\n End Date:' +end_date +
                           '\r\n \r\n';
                },
                customize: function ( doc ) {
                  doc.content[1].table.widths = "*";
                  doc.content.splice( 1, 0, {
                    margin: [ 0, 0, 0, 12 ],
                    alignment: 'left',
                  });
                }        
            },
            {"extend": 'csv',
                "title": "Payout Pending List",
                "text": '<span class="fa fa-file-excel-o"> CSV</span>',
                "className": 'btn  btn-xs  btn-primary paginate_button  '
            },
            {"extend": 'excel',
                "title": "Payout Pending List",
                "text": '<span class="fa fa-file-excel-o"> EXCEL</span>',
                "className": 'btn  btn-xs  btn-primary paginate_button '
            },
        ]
    });
    example.on("click", "th.select-checkbox", function () {
        if ($("th.select-checkbox").hasClass("selected")) {
            example.rows({page: 'current'}).deselect();
            $("th.select-checkbox").removeClass("selected");
        } else {
            example.rows({page: 'current'}).select();
            $("th.select-checkbox").addClass("selected");
        }
    }).on("select deselect", function () {
        ("Some selection or deselection going on")
        if (example.rows({
            selected: true
        }).count() !== example.rows({page: 'current'}).count()) {
            $("th.select-checkbox").removeClass("selected");
            $(".test").hide();
        } else {
            $("th.select-checkbox").addClass("selected");
            $(".test").show();

        }
    });

    $(".payout").click(function (e) {
        e.preventDefault();
        // swal({
        //     title: "Please wait...do not close this window or click the Back button on your browser",
        //     text: "Please wait",
        //     type: "info",
        //     showConfirmButton: false,
        //     allowOutsideClick: false
        // });
        var data = [];
        $('#table-payout').find("tr.selected").each(function (index, td) {
            data.push($(this).find('td').eq(0).attr('infos'));
        });
        if (data == '') {
            swal({title: "Invalid", text: "Please Select Request", type: "error"}
                
                );
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + "/admin/payoutconfirm",
            dataType: "json",
            type: "POST",
            data: {
                data
            }
        }).done(function (response) {
            console.log(response.status);
            if (response.status) {
                swal({title: "Success", text: "Payout Successfully released!", type: "success"},
                   function(){ 
                       location.reload();
                   }
                );
            } else {
                swal({title: "Failed", text: "Something went wrong!", type: "error"},
                   function(){ 
                       location.reload();
                   }
                );
            }
        })
    });
});
</script>
@endsection

