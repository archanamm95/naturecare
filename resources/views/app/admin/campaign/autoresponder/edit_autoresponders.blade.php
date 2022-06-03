@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-xs') 

@section('styles')
@parent
@endsection

@section('sidebar')
@parent

@include('app.admin.campaign.sidebar')
<!-- /secondary sidebar -->
@endsection




{{-- Content --}}
@section('main')


<form class="form" action="{{ url('admin/campaign/autoresponders/editautoresponder')}}" method="POST">
        {!!  csrf_field() !!}
        <input type="hidden" name="id" value="{{$autoresponse->id}}" >
   <div class="card card-flat">
                           <div class="card-header header-elements-inline">
                                <h5 class="card-title">{{trans('campaign.edit_responder')}}<a class="header-elements-toggle"></a></h5>
                                <div class="text-right d-lg-none w-100">
                    <a class="sidebar-mobile-secondary-toggle"><i class="icon-more"></i></a> 
                </div>
                                <div class="header-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

        <div class="form-group">
            <label class="col-lg-4 col-form-label">{{trans('campaign.subject')}}:</label>
                <div class="col-lg-12">
                    <input type="text" name="subject" class="form-control" required="" value="{{$autoresponse->subject}}" >
                </div>
        </div>  

         <div class="form-group">
            <label class="col-lg-4 col-form-label">{{trans('campaign.email_content')}}</label>
                <div class="col-lg-12">
                	
                <textarea name="summernoteInput" class="summernote"></textarea>
   
                   
                                                       
                    </textarea>
                </div>
        </div>  
         <div class="form-group">
            <label class="col-lg-4 col-form-label"></label>
            <div class="col-lg-12">

                <select name="date" id=date selected="selected" class="form-control" 
data-parsley-required-message="" data-parsley-group="block-0">

                    <option >{{$autoresponse->date}}</option>
                        @for ($i = 1; $i <= 31; $i++) :
                            <option value="{{$i}}"> {{$i}}</option>
                        @endfor
                </select>
            
                
                   
                </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 col-form-label"></label>
            <button type="submit" class="btn btn-primary">{{trans('campaign.insert')}} <i class="icon-arrow-right14 position-right"></i></button>
        </div>
                                
    </div>  
    </form> 


























@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
</script>

<script type="text/javascript"> 

    $(document).ready(function() {
            //initialize summernote
            $('.summernote').summernote();
            //assign the variable passed from controller to a JavaScript variable.
            var content = {!! json_encode($autoresponse->content) !!};
            //set the content to summernote using `code` attribute.
            $('.summernote').summernote('code', content);
        });
</script>
@stop
