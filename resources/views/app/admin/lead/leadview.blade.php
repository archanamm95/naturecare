@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

@section('styles')
@parent

@endsection

{{-- Content --}}

@section('main')

<div class="card panel-flat" >
               <div class="card-heading">
                <p>
                  <h5 class="card-title" style="margin-left: 28px;">{{trans('ticket_config.lead')}}</h5>
                </p>
                </div>                 

               <div class="card-body"> 
                      

                    <div class="table-responsive">
                        <table class="table table-hover" id="lead">

                              <thead>

                                                    <th>{{trans('ticket_config.no')}}</th>
  
                                                    <th>{{trans('ticket_config.username')}}</th>

                                                    <th>{{trans('ticket_config.name')}}</th>

                                                    <th>{{trans('ticket_config.email')}}</th>

                                                    <th>{{trans('ticket_config.mobile')}}</th>

                                                    <th>{{trans('ticket_config.created_at')}}</th>

                                                    <th>{{trans('ticket_config.status')}}</th>  

                                                   

                                                    <th>{{trans('ticket_config.actions')}}</th>  
       

                               </thead>

                               <tbody>
                       
                               </tbody>    

                         </table>              
                    </div>

                </div>

</div>                  



            

@endsection
@section('scripts')
    @parent
<script>

</script>
@stop







                           



                  



                            



                                                

                                                        

                                    

                              