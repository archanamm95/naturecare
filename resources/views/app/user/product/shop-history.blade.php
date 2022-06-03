

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

          <th>Order ID</th>
          <th> {{trans('products.total_amount')}}</th>
          <th>Seller</th>
          <th> {{trans('products.saled_date')}}</th>         
          <th> {{trans('products.paid_by')}}</th>
          <th> {{trans('download.invoice')}}</th>
          <th> {{trans('ewallet.track_order')}}</th>
          <th>{{trans('Products')}}</th>
          <th>{{trans('all.count')}}</th>

          <th>{{trans('all.amount')}}</th>
         
        </thead>


        <tbody>
          @foreach($report as $key=>$item)
           <tr>

             <td> {{ $item['invoice']}}</td>
             <td> MYR {{$sum}}</td>
             <td>{{ $item['seller']}}</td>
             <td>{{$item['date']}}</td>
             <td> {{ $item['pay_by'] }}</td>
             <td>
              <a href="{{config('app.site_url')}}/index.php?route=account/order/info&order_id={{$item['invoice']}}" target="_blank">
                <svg class="feather"><use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use></svg></a>
            </td>
            <td>
              @if($item['tracking_id'] == "not_found" || $item['tracking_id'] == NULL)
                  Progressing 
              @else
                 
                      <button class="btn btn-primary" onclick="linkTrack('{{$item['tracking_id']}}')">TRACK</button>
                  
              @endif
             </td>
             <td>
                @foreach($item['product'] as $products)
                    {{$products}}<br>             
                @endforeach
            </td>
             <td>
                @foreach($item['count'] as $count)
                    {{$count}}<br>
                @endforeach
            </td>
             <td>
                @foreach($item['price'] as $price)
                    MYR {{$price}}<br>
                @endforeach
            </td>
    
           </tr>
            <div class="modal fade" id="myModal{{$key}}" role="dialog" tabindex="-1" value=" ">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                      <embed src="{{{URL::to('user/get-document/'.$item['invoice']) }}} " style="width: 100%;"  allowfullscreen type="application/pdf">
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
 
 