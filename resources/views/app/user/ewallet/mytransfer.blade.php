
@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('wallet.fund_transfer')}}</h5>
      <!--   <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div>
        <div class="table-responsive">
         <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                   

                                                    <th> {{trans('ewallet.usernmae')}}</th>

                                                    <th>{{trans('wallet.amount')}}</th>

                                                    <th>{{trans('wallet.description')}}</th>

                                                    <th>{{trans('wallet.date')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($data as $refs)
                                             
                                                <tr >

                                                   

                                                    <td>{{$refs->fromuser}}</td>
                                                    @if($refs->total_amount < 0)
                                                     <td style="color: red">{{currency(round($refs->total_amount,2))}}</td>
                                                     @else

                                                    <td style="color: green">{{currency(round($refs->total_amount,2))}}</td>
                                                    @endif

                                                    <td>{{Ucfirst(str_replace('_',' ',$refs->payment_type))}}</td>
                                                     <td>{{$refs->created_at}}</td>
                                                    <!--  <td>{{ date('d M Y',strtotime($refs->created_at))}}</td> -->

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>
                                    </div>





                           

  </div>
                  
@stop
 

