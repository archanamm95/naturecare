@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
{{-- Content --}}
@section('main')
<div class="card card-flat" >
    <div class="card-heading">
    <!-- <h4 class="card-title">Payout Notification Settings </h4>  -->
        <div class="heading-elements"></div>
    </div>
    <div class="card-body"> 
        <table id="data-table" class="table table-striped ">        
            <thead>
                <tr role="row">                                                       
                <th>{{trans('payout.name')}}</th>                                                  
                <th>{{trans('payout.action')}}</th>             
                </tr>
            </thead>
        <tbody>    
        @foreach($settings as $key=>$item)
            <tr  role="row">             
                <td>{{trans('payout.payout')}}</td>
                <td>
                @if($item->payout_notification==0)
                  <form class="myform">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/><input type="checkbox" data-toggle="toggle" data-id="{{$item->id}}" value="yes">
                    </form>
                    @elseif($item->payout_notification==1)
                   <form class="myform">
                    <input type="checkbox" data-toggle="toggle" data-id="{{$item->id}}" value="no" checked></form>
                    </td>                                
                @endif
            </tr>
        @endforeach  
        </tbody>       
        </table>
    </div> 
</div> 
@endsection @section('overscripts') @parent
@endsection @section('scripts') @parent
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script > 
    $(document).ready(function(){
        $('.myform :checkbox').change(function() {
            var decision = $(this).val();
            var id =  $(this).data('id');
            if (this.checked) {
                alert("Are you sure want to active?");
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
                $.ajax({
                        url: "{{URL::to('admin/payout_access_settings')}}",
                        type: "post", 
                        data: {decision: decision, id: id },         
                }) 
            }
            else{
                alert("Are you sure want to deactive?");
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
                $.ajax({
                        url: "{{URL::to('admin/payout_access_settings')}}",
                        type: "post",
                        data: {decision: decision, id: id },      
                }) 
            }
        });
    });
</script> 
@endsection