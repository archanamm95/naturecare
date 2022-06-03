

@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
  .rect {
    width: 300px;
    height: 50px;
    display: block;
    border: 1px solid #C4A400;
    /*background: #FFEF34;*/
    text-align: left;
    margin: 5px;
    padding: 5px;
    font-size: 20px;
    line-height: 40px;
    color: black;
}
.clickable {
    cursor: pointer;
}
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="card card-flat border-top-success">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{$title}}</h5>
       <!--  <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div> -->
    </div>
        
     
     <div class="table-responsive">
        <table class="table table-stripped" id="table-shop_history">
        <thead>

          <th>Full Name</th>
          <!-- <th>Username</th> -->
          <th>Email</th>
          <!-- <th>Monthly maintaine</th> -->
          <th> User Type</th>
          <th> Address</th>
          <!-- <th> Gender</th> -->
          <th>Phone</th>
          <th>IC Number</th>         
         
        </thead>

        <tbody>
          @foreach($data as $key=>$item)
           <tr>

             <td>{{$item->name}} {{$item->lastname}}</td>
             <!-- <td>{{ $item->username}}</td> -->
             <td> {{ $item->email}}</td>
             <!-- <td> {{ $item->status}}</td> -->
             <td> {{ $item->user_type}}</td>
             <td> {{ $item->address1 }}</td>
             <!-- <td> {{ $item->gender }}</td> -->
             <td> {{ $item->mobile }}</td>
             <td> @if($item->passport == '') No IC Number @else {{ $item->passport }} @endif</td>
           </tr>
           @endforeach
        </tbody>
      </table>
   </div>  
</div>
                  
@stop
 @section('scripts') @parent
 <script src="//www.tracking.my/track-button.js"></script>
<script>
  function linkTrack(num) {
    TrackButton.track({
      tracking_no: num
    });
  }
</script>
<script type="text/javascript">
     $(document).ready(function () {
            oTable = $('#table-shop_history').DataTable()
          });
</script>
@endsection
 
 