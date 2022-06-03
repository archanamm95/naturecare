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
            <h5 class="mb-0 font-weight-light">{{trans('settings.blacklist_manager')}}</h5>
            <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
        </div>

        <div class="card-body bordered">
            <div class="mb-3">
                <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">{{trans('settings.blacklist_manager')}}</legend>
                    <form id="update-system-settings" data-parsley-validate="true" method="post" action="{{url('admin/control-panel/blacklist-manager')}}">
                        {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{trans('settings.enter_username')}} </label>
                        <div class="col-lg-3">
                            <input class="form-control" id="key-word" name="key-word" placeholder="Search Member" type="text"/>
                            <input id="key_user_hidden" name="key_user_hidden" type="hidden" required="true" />                          
                        </div>
                    </div>
                     <div class="form-group row">
                         <button class="btn bg-dark" type="submit">{{trans('settings.block_user')}}</button>
                    </div>
                    </form>
                </fieldset> 
            </div>    
        </div>
    </div> 
</div>

<div id="settings-page">
    <div class="card card-white">
        <div class="card-header pb-1 pt-1 bg-dark" style="">
            <h5 class="mb-0 font-weight-light">
                {{trans('settings.list_of_blacklisted_user')}}
            </h5>
        </div>
        <div class="card-body bordered">
            <div class="mb-3">
                <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold"> {{trans('settings.list_of_blacklisted_user')}}</legend>
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>
                                {{trans('settings.no')}}.
                            </th>
                            <th>
                                 {{trans('settings.blacklisted_username')}}
                            </th>
                            <th>
                                {{ trans('autoresponse.action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($blacklists as $key=>$blacklist)
                        <tr>
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                {{$blacklist->username}}
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{url('admin/control-panel/blocklist/delete/'.$blacklist->id)}}">
                                    <i class="icon-trash" aria-hidden="true"></i>

                                </a>
                            </td>
                        </tr>
                        @endforeach 
                        @if(!count($blacklists))
                        <tr>
                            <td>
                                {{ trans('ticket_config.no_data')}}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                </fieldset> 
            </div>    
        </div>
    </div> 
</div>
@stop

@section('styles')@parent
<style type="text/css">
.parsley-errors-list.filled {
    position: absolute;
    top: 40px;
}
</style>
@endsection


