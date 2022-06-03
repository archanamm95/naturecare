@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')

<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">  {{trans("users.income_details")}}</h5>
        <div class="heading-elements">
           <!--  <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul> -->
        </div>
    </div>
  </div>

      @include('app.admin.users.userinfo')
  <div class="card card-body">
  
        <div class="table-responsive">
         <table class="table ">
            <thead>
                <th> {{trans("users.no")}}</th>
                <th> {{trans("users.from")}}</th>
                <th>{{trans("users.payment_type")}}</th>
                <th>{{trans("users.amount")}}</th>
                <th>{{trans("users.date")}}</th>
            </thead>

            <tbody>
                @foreach($income as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->username }}</td>
                    <td>{{  ucfirst(str_replace('_',' ',$value->payment_type)) }}</td>
                    <td>{{currency(round($value->payable_amount))}}</td>
                    <td>{{ $value->created_at }}</td>
                </tr>
                @endforeach
           

       @if(count($income)==0)
        <tr>
       <td class="text-center" colspan="8"> {{trans('report.no_data_found')}}</td>
     </tr>  
        @endif
 </tbody>
             
         </table>
         </div>


 
</div>

 @stop

{{-- Scripts --}}
@section('scripts')
    @parent

@stop
