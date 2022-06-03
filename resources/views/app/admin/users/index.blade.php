@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{trans('tree.users')}}</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="table table-responsive">
    <table class="table datatable-basic table-striped table-hover" id="users-list-table">
                            <thead>
                                <tr>
                                    <th>
                                       {{ trans("users.no") }}
                                    </th>
                                    <th>
                                       {{ trans("users.name") }}
                                    </th>
                                    <th>
                                       {{ trans("users.username") }}
                                    </th>
                                    <th>
                                       {{ trans("users.sponsor") }}
                                    </th>
                                    <th>
                                       {{ trans("users.email") }}
                                    </th>
                                    <th>
                                       {{ trans("users.status") }}
                                    </th>
                                    <th>
                                       {{ trans("admin.created_at") }}
                                    </th>
                                    <th>
                                       {{ trans("admin.actions") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script>
   

</script>
@stop




            