@extends('layouts.auth')

@section('content')

<div class="row">
    <div class="col-lg-5 offset-lg-4">
        <div class="card mb-0">
            <div class="card-body">
            
      <div class="text-center mb-3">
               
                <h5 class="mb-0">Payment Status</h5>
                                <!-- <span class="d-block text-muted">All fields are required</span> -->
                </div>
                 <div class="text-center mb-3">
                <p>Payment Completed</p>
              </div>

                  </div>
        </div>
    </div>
</div>

@endsection

@section('topscripts')
@parent

@endsection

@section('scripts')
@parent
 

  
@endsection
