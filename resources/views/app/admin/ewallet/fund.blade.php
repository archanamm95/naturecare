@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') @include('flash::message') @include('utils.errors.list')
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title">
            {{ trans('ewallet.credit_fund') }}
        </h4>
    </div>
    <div class="card-body">
        <form action="{{url('admin/credit-fund')}}" class="smart-wizard form" method="post" onsubmit="return checkForm(this);">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-2 col-form-label" for="username">
                    {{trans('ewallet.search_username')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control autocompleteusers" id="username" name="autocompleteusers" type="text" placeholder=" {{trans('ewallet.search_username')}}" required="">
                    <input class="form-control key_user_hidden" name="username" type="hidden" >
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-form-label" for="amount">
                    {{trans('ewallet.amount')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control" id="amount" name="amount" type="number" min="0" placeholder=" {{trans('ewallet.enter_amount')}}" required="">
                    </input>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label" for="note">
                     {{trans('ewallet.note')}}
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <textarea name="note" id="note" class="form-control" required="" ></textarea>
                </div>
            </div>
                <div class="form-group" style="float: left; margin-right: 0px;">
            <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info" id="add_amount" name="add_amount" tabindex="4" type="submit" value="credit">
                            {{trans('ewallet.credit_amount')}}
                        </button>
                    </div>
 <div class="col-md-6">
                           <button class="btn btn-danger" id="debit_amount" name="debit_amount" tabindex="4" type="submit" value="debit">
                            {{trans('ewallet.debit_amount')}}
                        </button>
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h4 class="card-title"> {{trans('wallet.latest_fund_transfer')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
         <div class="table-responsive">
         <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th> {{trans('ewallet.no')}}.</th>
                                                    <th>{{trans('wallet.username')}}</th>

                                                    <th>{{trans('wallet.amount')}}</th>


                                                    <th>{{trans('wallet.date')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($data as $key=>$item)

                                                <tr >

                                                    <td>{{$key+1}}</td>

                                                    <td>{{$item->username}}</td>

                                                    <td>{{currency(round($item->payable_amount,2))}}</td>

                                                    <td>{{$item->created_at}}</td>

                                                    <!--  <td>{{ date('d M Y',strtotime($item->created_at))}}</td> -->

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>
                                    </div>





                            {!! $data->render() !!}

  </div>
@endsection @section('scripts') @parent
<script type="text/javascript">
    function checkForm(form)
 {
  
    
   return true;
 }

</script>
@stop