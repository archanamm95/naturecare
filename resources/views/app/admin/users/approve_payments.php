@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Users</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <table class="table datatable-basic table-striped table-hover" id="users-table" >
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
                                       package
                                    </th>
                                    <th>
                                       {{ trans("users.email") }}
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
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop

            