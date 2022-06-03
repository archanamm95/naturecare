    <div class="card imagebg1 fillheight">
            <div class="card-heading">
               
            </div>
            <div class="card-body">

<div class="alert alert-primary bg-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <div class="text-center py-2">
                            <h4 class="font-weight-semibold  mb-1">{{trans('dashboard.counter_widget')}}</h4>
                            <span class="text-muted d-block">

                                {{trans('dashboard.we_can_customize_this_counter_for_your_dashboard_for_daily')}}, {{trans('dashboard.weekly')}}, {{trans('dashboard.or_specific_hours_bonuses_and_awards')}}. {{trans('dashboard.isnt_it_nice')}}? 
                            </span>
                        </div>
                    </div>


                <div class="text-center mb-3 py-2">
                            <h4 class="font-weight-semibold mb-1">{{trans('dashboard.demo')}}</h4>
                            <span class="text-muted d-block">{{trans('dashboard.this_is_a_demo_version_of_cloud_mlm_software_which_will_be_reset_everyday')}}. {{trans('dashboard.next_reset_will_be_in')}} :</span>

                            
                        </div>


                <div class="running_clock" id="running_clock">
                    


                   
                    <h3 class="resetwarn">
                    </h3>
                    <div class="row">
                        <div class="col-sm-12 align-middle">
                            <div class="clock">
                            </div>

                            @section('styles')@parent
                            <style type="text/css">
                            .clock{
                            zoom: 0.9;
                            -moz-transform: scale(0.9);
                            max-width: 490px;
                            margin: 0px auto;
                            }
                            </style>
                            @endsection
                            @section('scripts')@parent
                            <script type="text/javascript">

                            var now=new Date();
                            var closing=new Date(now.getFullYear(),now.getMonth(),now.getDate(),24);//Set this to 10:00pm on the present day

                             var diff = (closing.getTime()/1000) - (now.getTime()/1000);


                            // var diff=closing-now;//Time difference in milliseconds

                            var clock = $('.clock').FlipClock(diff, {
                                clockFace: 'HourlyCounter',
                                countdown: true,
                                showSeconds: true
                            });
                            </script>
                            @endsection
                        </div>
                    </div>

                    

                   
                </div>
                 

            </div>
        </div>