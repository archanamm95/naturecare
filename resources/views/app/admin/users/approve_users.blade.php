@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
td {
    white-space: nowrap;
}
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Approve Users</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table " id="approveusers-table" >
            <thead>
                <tr>
                    <th>
                        {{ trans("users.no") }}
                    </th>
            
                    <th>
                        {{ trans("users.username") }}
                    </th>
                                     
                    
                    <th>
                        {{ trans("users.email") }}
                    </th>
                            
                                    
                    <th>
                        Action
                    </th>                  
                </tr>
            </thead>
       

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

            