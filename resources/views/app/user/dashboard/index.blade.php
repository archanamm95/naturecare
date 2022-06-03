@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop  
@section('styles')
@parent

@endsection
{{-- Content --}} @section('main')

 
<div class="row">
    <div class="col-md-12">
        
            <div class="card-body text-right metric_user">
            <div class="dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i
                                class="icon-cog3 "></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">choose  the month : </div> 
                            <!-- <button data-range="today"
                                class="dropdown-item btn range">{{trans('dashboard.today')}}</button>  -->
                            @foreach(array_reverse($month) as $key=>$data)
                            <button data-range="{{$key+1}}"
                                class="dropdown-item btn range">{{$data}}</button>
                            <!-- <button data-range="2"
                                class="dropdown-item btn range"></button>
                            <button data-range="3"
                                class="dropdown-item btn range"></button> -->
                            @endforeach
                        </div>
    </div>
</div>

    
    </div>
</div>
 
@if($user_type != 'Influencer' && $user_type != 'InfluencerManager')

 @if($tobeDealer_saleCount < $settings_data->monthly_count)

<div class="alert alert-primary bg-white alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            Please make minimum  4 Sale in this last 3 month to avoid Downgrading current position.
                        </div>
@endif
@endif
<!--RECORDS WIDGET START-->
    @include('app.user.layouts.records')
<!--RECORDS WIDGET END-->


@endsection


@section('scripts')
@parent
<script type="text/javascript">

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();  
});

</script>
<script type="text/javascript">

$(window).on('load', function() {
       $('#myModal').modal('show');
   });

    $('.rank').change(function(){
        var rank        = $(this).val();
        console.log(rank);
        var product     = document.getElementById("rank");
        var name        = product.options[product.selectedIndex].getAttribute('name');
        var dl          = product.options[product.selectedIndex].getAttribute('dl');
        var dr          = product.options[product.selectedIndex].getAttribute('dr');
        var drl         = product.options[product.selectedIndex].getAttribute('drl');
        var drr         = product.options[product.selectedIndex].getAttribute('drr');
        var pool_share  = product.options[product.selectedIndex].getAttribute('pool_share');
        if(rank == 5)
            var pool        = 'International';
        else
            var pool        = 'Leadership';
        $('.modal-title').html(name);
        $('.t_name').html(name)
        $('.t_dl').html(dl)
        $('.t_dr').html(dr)
        $('.t_drl').html(drl)
        $('.t_drr').html(drr)
        $('.count-span').html(pool_share)
        $('.pool-span').html(pool)
        $('#test').modal('show');
    });
</script>

@endsection
