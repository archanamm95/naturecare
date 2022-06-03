



@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{$title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat border-top-success">
            <div class="panel-heading">
                <h6 class="panel-title" style="color:#111111 "> Leads</h6>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-invoice">
          <thead>
            <tr>
              <th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>
                        <th>count</th>                        
                    </tr>
                </thead>
              <tbody>
                     
                @foreach($top_recruiters as $key=> $report)
                <tr>
                  <td>{{$key +1 }}</td>                    
                        <td>{{$report->username}}</td>
                        <td>{{$report->count}}</td>
              </tr>
                  @endforeach   
        </tbody>
          </table>
                </div>
            </div>
        </div>
    </div>
</div>    
                       
  </div>
                  
@stop 
 


                                                

                                                        

                                    

                              