

@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
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
         <table class="table table-stripped">
        <thead>
          <th>{{trans('products.product')}} </th>
          <!-- <th>{{trans('all.total_count')}}</th> -->
    <!--       <th>{{trans('all.converted')}} RP</th> -->
          <th>{{trans('all.ship_out')}}</th>
          <th> BV</th>
          <th> {{trans('products.total_amount')}}</th>
          <th> {{trans('products.paid_by')}}</th>
          <th> {{trans('products.shipping_country')}}</th>
          <th> {{trans('download.view')}}</th>
          <th> {{trans('download.download')}}</th>
          <th> {{trans('ewallet.track_order')}}</th>
          <th> {{trans('products.purchase_date')}}</th>         
         
        </thead>

        <tbody>
          @foreach($data as $key=>$item)
           <tr>
             <td> {{ $item->package}}</td>
             <!-- <td> {{ $item->count}}</td> -->
             <?php 
                  
                  $product_count = 0;
                  $rp_count = 0;
                  $rp_sum = 0;
                  if($item->count >= 50)
                    $product_count =  $package_data[2]->product_count;
                  elseif ($item->count <=50 && $item->count >= 25)
                    $product_count =  $package_data[1]->product_count;
                  else
                    $product_count =  $package_data[0]->product_count;
                  
                    $rp_count      =  $item->count - $product_count;
                    $rp_sum        =  $rp_count * 120;


             ?>
             <!-- <td> {{$rp_count}} * 120 = {{ $rp_sum}}</td> -->
             <td> {{ $product_count}}</td>
             <td> {{ $item->total_bv}}</td>
             <td> {{currency(round($item->total_amount,2))}} </td>
             <td> {{ ucfirst(str_replace('_',' ',$item->pay_by)) }}</td>
             <td> {{$item->shipping_country }}</td>
             @if($item->pay_by != 'register_point')
             <td>
                <button class="Idpass btn-success" data-toggle="modal" data-target="#myModal" data-id="{{$item['id']}}">View</button>

             <td><a class="btn btn-success" href="{{url('user/download_invoice/'.$item->id)}}"  name="requestid">{{trans('download.download')}}</a></td>
             @else
             <td>-</td>
             <td>-</td>
             @endif
             <td>
              @if($item->order_status == "" || $item->order_status == "null")
                  Progressing
              @else
                  @if($item->order_status == "self_pickup")
                    {{ucwords(str_replace('_',' ',($item->order_status)))}}
                  @else
                      <button class="btn btn-primary" onclick="linkTrack('{{$item->order_status}}')">TRACK</button>
                  @endif
              @endif
              </td>
             <td>{{$item->created_at}}</td>
           <!--   <td> {{ Date('d M Y',strtotime($item->created_at))}}</td>  -->           
           </tr>

 @endforeach


 </tbody>
 </table>

</div>
<div id="myModal" class="modal fade" role="dialog">
 <div class="modal-dialog">

    <!-- Modal content-->
 <div class="modal-content">
  <div class="modal-header">
  <h4 class="modal-title">View Products</h4>
  </div>
      <div class="modal-body">
         <input type="hidden" name="eventId" id="eventId"/>
          <!--   <span id="idHolder"></span> -->
              <table class="table datatable-basic table-striped table-hover" id="products_table">
               <thead>
                  <tr>
                        <th>Item</th>
                        <th>{{trans('products.unit_price')}}</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                  </tr>
                </thead>            
           </table>
      
      </div>
   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="closemodal">Close</button>
      </div>
    </div>

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

$(document).on("click", ".Idpass", function () {
     var eventId = $(this).data('id');

     // $('#idHolder').html( eventId );
 $.ajax({
    url: CLOUDMLMSOFTWARE.siteUrl+"/user/viewproducts/" + eventId,
        dataType: "json",
        type: "get",
        success: function(data) {
       
          $('#products_table tr').not(':first').remove();
            var html = '';
            for(var i = 0; i < data.length; i++){
                console.log(data[i]);
                html += '<tr>'+
                          
                            '<td>' + data[i].name + '</td>' +
                            '<td>' + data[i].price + '</td>' +
                            '<td>' + data[i].quantity + '</td>' +
                            '<td>' + data[i].total_price + '</td>' +
                            
                        '</tr>';
                }   
            $('#products_table tr').first().after(html);

      },
        error: function() {
        alert("An error has occured!");
  }
});
});


</script>
@endsection

 
 