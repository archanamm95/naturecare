@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">My Order</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <table class="table datatable-basic table-striped table-hover" id="user-cart">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Order Date</th>
                                    <th>Total Price</th> 
                                    <th>Bank Slip</th>
                                   <th>Payment Status</th>
                                    <th>Action</th>                                
                                </tr>
                            </thead>
                               @foreach($cart as $key=> $user)
                            <tbody>
                                <tr>
                                <td>{{$user->invoice_id}} </td>   
                                <td>{{$user->created_at}}</td>
                                 <td>{{$user->total_amount}} </td>   
                                <td>{{$user->bank_slip}}</td>
                                 <td>{{$user->status}} </td>   
                                <td><a href="{{url('user/viewmore/'.$user->id)}}" class="btn btn-primary"> <i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                </tr>
                                    @endforeach  
                            </tbody>
                        </table>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script>
 $(document).ready(function() {
   $('#user-cart').DataTable();
} );
</script>
@stop