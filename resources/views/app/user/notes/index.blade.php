@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
{{-- Content --}}
@section('main')
<!-- Notes grid -->
<div class="alert alert-info text-semibold">
    {{trans('profile.notes')}}Your Notes
    <br/>
    <small class="d-block">
         {{trans('profile.notes')}}Notes you've added will be displayed here. <br/>
         {{trans('profile.notes')}}You can delete or create new note in this page
    </small>
</div>
<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('profile.create_a_note')}} 
                    
                </h6>
                
            </div>
            <div class="card-body">
                 <form action="#" class="usernotesform" data-parsley-validate="">
                    <div class="form-group">
                        <input class="form-control mb-15" cols="1" id="title" name="title" placeholder=" {{trans('profile.note_title')}}" required="" type="text"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-15" cols="1" id="description" name="description" placeholder=" {{trans('profile.note_content')}}" required="" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        
                        <div class="btn-group flex-wrap" id="note-color" data-toggle="buttons">
					    <label class="btn btn-primary btn-xs">
					      <input type="radio" name="color" value="bg-primary" checked>  {{trans('profile.primary')}} </label>
					    <label class="btn btn-success btn-xs">
					      <input type="radio" name="color" value="bg-success"> {{trans('profile.success')}}</label>
					    <label class="btn btn-info btn-xs">
					      <input type="radio" name="color" value="bg-info"> {{trans('profile.info')}}</label>
					    <label class="btn btn-warning btn-xs">
					      <input type="radio" name="color" value="bg-warning"> {{trans('profile.warning')}}</label>
					    <label class="btn btn-danger btn-xs">
					      <input type="radio" name="color" value="bg-danger"> {{trans('profile.danger')}}</label>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <button class="submit-user-note btn btn-primary btn-labeled btn-labeled-right" type="button">
                                {{trans('profile.save_note')}} 
                                <b>
                                    <i class="icon-circle-right2">
                                    </i>
                                </b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row mt-3">

    <div class="col-sm-12">
    <div class="notes">

    	@if (!$notes->isEmpty())
    	

        @foreach($notes->chunk(4) as $notesgroup)
       <div class="row">
            @foreach($notesgroup as $note)



            <div class="each-note col-sm-3">
                <div class="card {{$note->color}}">
                    <div class="card-body">
                        
                                <h6 class="text-semibold">
                                    {{ strlen($note->title) > 15 ? substr($note->title,0,15)."..." : $note->title }} -
                                    <i class="text-xs">
                                        {{$note->created_at->diffForHumans()}}
                                    </i>
                                </h6>
                                <p>
                                {{ strlen($note->description) > 25 ? substr($note->description,0,25)."..." : $note->title }}
                                </p>

                    </div>
                    <div class="card-footer d-flex justify-content-between {{$note->color}} ">
                      <button class="btn  btn-link btn-xs heading-text text-default btn-delete-note" data-id="{{$note->id}}" type="button">
                               
                                <i class="icon-trash text-size-small position-right">
                                </i>
                            </button>
                        
                            <button class="btn  btn-link btn-xs heading-text text-default float-right" data-target="#view-{{$note->id}}" data-toggle="modal" type="button">
                                 {{trans('profile.view_full_note')}}
                               
                            </button>
                    </div>
                </div>


                 <!-- Danger modal -->
                <div id="view-{{$note->id}}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header  {{$note->color}}">
                                <h6 class="modal-title">
                                    {{$note->created_at->diffForHumans()}}                                   
                                </h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <h4 class="font-weight-semibold">
                                     {{$note->title}}
                                </h4>
                                <h6>
                                    {{$note->description}}
                                </h6>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal"> {{trans('profile.close')}}</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /default modal -->


                <div class="modal fade" id="">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header {{$note->color}}">
                                <button class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                                <h6 class="modal-title">
                                </h6>
                            </div>
                            <div class="modal-body">
                                <h6 class="text-bold">
                                </h6>
                                <p>
                                </p>
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-link" data-dismiss="modal" type="button">
                                    {{trans('profile.close')}} 
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach

		{{ $notes->links() }}

		@else
		<div class="row">
		<div class="alert alert-info no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only"> {{trans('profile.close')}}</span></button>
		<span class="text-semibold"></span>  {{trans('profile.you_havent_created_any_notes_yet')}}!.
		</div>

		</div>
		
		@endif
    </div>
    </div>
</div>


@endsection

@section('styles')
@parent
<style type="text/css">

</style>
@endsection

@section('scripts')
<script type="text/javascript">
     $('.submit-user-note').click(function () {
        $('.usernotesform').submit();
    });
    $(".usernotesform").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $('.usernotesform').parsley().validate();
    if ($('.usernotesform').parsley().isValid()) {
        var block = $(this).parent().parent().parent().parent();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/user/postusernote',
            data: new FormData($('.usernotesform')[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function beforeSend() {
                $(block).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function success(response) {
                $(block).unblock();
                $('.usernotesform').find("input[type=text], textarea").val("");
                new PNotify({
                    text: 'Note Added',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
                if ($('#notes').length) {
                    $newNote = '<div class="each-note col-sm-4"><div class="panel ' + response.color + '"><div class="panel-body"><div class="media"><div class="media-left"><i class=" icon-file-text3 text-warning-400 no-edge-top mt-5"></i></div><div class="media-body"><h6 class="media-heading text-semibold">' + response.title + ' - <i class="text-xs">' + response.date + '</i></h6>' + response.description + '</div></div></div><div class="panel-footer ' + response.color + ' panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a><div class="heading-elements"><button class="btn  btn-link btn-xs heading-text text-default btn-delete-note" data-id="' + response.id + ' " type="button"><i class="icon-trash text-size-small position-right"></i></button></div></div></div></div>';
                    $('#notes>.row:first-child').append($newNote);
                }
            }
        });
    } else {
        console.log('not valid');
    }
});

</script>
<script type="text/javascript">
$(document).ready(function() {
    if ($(".btn-delete-note").length) {
        $('.notes').on('click', '.btn-delete-note', function(e) {
            var id = $(this).data('id');
            var this_context = $(this);
            // confirm('Are you sure you want to delete the note?','confirmation','yes','no');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this note!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                //console.log(id);
                $.ajax({
                    url: CLOUDMLMSOFTWARE.siteUrl + '/user/destroy-note',
                    data: {
                        'note_id': id
                    },
                    dataType: 'json',
                    async: true,
                    type: 'post',
                    beforeSend: function() {
                        this_context.closest('.each-note')
                    },
                    success: function(response) {
                        this_context.closest('.each-note').remove();
                        swal('Deleted!');
                        setTimeout(function() {}, 2000);
                    },
                    error: function(response) {
                        swal('Something went wrong!');
                    }
                });
            });
        });
    }
});
</script>
@endsection
