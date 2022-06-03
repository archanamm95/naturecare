@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
{{-- Content --}}
@section('main')
<!-- Notes grid -->
<div class="alert alert-info text-semibold">
    Your Notes
    <br/>
    <small class="d-block">
        Notes you've added will be displayed here. <br/>
        You can delete or create new note in this page
    </small>
</div>
<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('wallet.create_a_note') }}
                    
                </h6>
                
            </div>
             <div class="card-body">
                <form action="#" class="notesform" data-parsley-validate="">
                    <div class="form-group">
                        <input class="form-control mb-15" cols="1" id="title" name="title" placeholder="Note title" required="" type="text"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-15" cols="1" id="description" name="description" placeholder="Note content" required="" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                     
                        <div class="btn-group flex-wrap " id="note-color" data-toggle="buttons">
					    <label class="btn btn-primary btn-xs">
					      <input type="radio" name="color" value="bg-primary" checked> primary </label>
					    <label class="btn btn-success btn-xs">
					      <input type="radio" name="color" value="bg-success">Success</label>
					    <label class="btn btn-info btn-xs">
					      <input type="radio" name="color" value="bg-info">Info</label>
					    <label class="btn btn-warning btn-xs">
					      <input type="radio" name="color" value="bg-warning">Warning</label>
					    <label class="btn btn-danger btn-xs">
					      <input type="radio" name="color" value="bg-danger">Danger</label>
						</div>
                    </div>
              
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <button class="submit-note btn btn-primary btn-labeled btn-labeled-right" type="button">
                                {{trans('wallet.save_note') }}
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
                                View full note
                                <i class="icon-arrow-right14 position-right">
                                </i>
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
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
          >
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
                                    Close
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
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold"></span> You haven't created any notes yet!.
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
 
</script>
@endsection
