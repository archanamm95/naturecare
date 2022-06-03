@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.user.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

 
<div class="card card-flat">
     <div class="card-header header-elements-inline">
        <h5 class="card-title">
            {{trans('kb.all_articles')}}
        </h5>
         <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table datatable-basic table-striped table-hover editable-table" data-search="false" id="kb-article-table-user">
                        <thead>
                            <tr>
                                <th>
                                    {{trans('kb.article_title')}}
                                </th>
                                <th>
                                    {{trans('kb.publish_time')}}
                                </th>                                
                                <th>
                                    {{trans('kb.actions')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
