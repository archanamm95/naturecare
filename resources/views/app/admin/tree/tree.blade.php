@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('meta_keywords') @parent
<meta name="root-id" content="{{$root}}" /> @endsection @section('styles') @parent @endsection {{-- Content --}} @section('main')
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h6 class="card-title d-flex">
            {{trans('tree.tree_genealogy')}}
        </h6>
         <div class="header-elements d-xl-none">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="tree-guide-bar col-sm-12">
                <div class="badge  bar bar-member ">{{trans('tree.member')}}</div>
                <div class="badge  bar bar-dealer ">{{trans('tree.dealer')}}</div>
                <div class="badge  bar bar-sharepartner">{{trans('tree.Share Partner')}}</div>
            </div>
        </div>
        <div class="overflow">
            <div id="jstree-ajax" class="treemapholder jstree jstree-4 jstree-default" role="tree">
            </div>
        </div>
    </div>
</div>
@endsection