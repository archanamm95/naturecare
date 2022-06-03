@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop
{{-- Content --}} @section('styles') @parent
<style type="text/css">
  @media (min-width: 769px) {
  .has-detached-left .container-detached {
    float: right;
    margin-left: -260px;
    width: 100%;
  }
  .has-detached-left .content-detached {
    margin-left: 280px;
  }
  .has-detached-left .sidebar-detached {
    float: left;
  }
  .has-detached-right .container-detached {
    float: left;
    margin-right: -260px;
    width: 100%;
  }
  .has-detached-right .content-detached {
    margin-right: 280px;
  }
  .has-detached-right .sidebar-detached {
    float: right;
  }
  .has-detached-right .sidebar-detached.affix {
    right: 20px;
  }
  .sidebar-detached-hidden .container-detached {
    float: none;
    margin: 0;
  }
  .sidebar-detached-hidden .content-detached {
    margin: 0;
  }
  .sidebar-detached-hidden .sidebar-detached {
    float: none;
  }
}
.sidebar-detached .navigation.nav > .active > .hidden-ul {
  display: block;
}
@media (max-width: 768px) {
  .sidebar-detached .navigation.nav > li > .hidden-ul {
    display: block;
  }
}
.sidebar-detached.affix {
  position: static;
}
@media (min-width: 769px) {
  .sidebar-detached {
    display: block;
    position: relative;
    margin-bottom: 20px;
  }
  .sidebar-detached > .sidebar-default {
    border: 1px solid #ddd;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  }
  .sidebar-detached > .sidebar {
    margin-bottom: 0;
    display: block;
    border-radius: 3px;
  }
  .sidebar-detached.affix {
    position: fixed;
    top: 20px;
    bottom: 20px;
    -webkit-transition: bottom ease-in-out 0.15s;
    -o-transition: bottom ease-in-out 0.15s;
    transition: bottom ease-in-out 0.15s;
  }
  .sidebar-detached.affix > .sidebar {
    max-height: 100%;
    overflow-y: auto;
  }
  .sidebar-detached.fixed-sidebar-space {
    bottom: 80px;
  }
  .navbar-bottom .sidebar-detached.fixed-sidebar-space {
    bottom: 86px;
  }
  .navbar-bottom-lg .sidebar-detached.fixed-sidebar-space {
    bottom: 90px;
  }
  .navbar-bottom-sm .sidebar-detached.fixed-sidebar-space {
    bottom: 84px;
  }
  .navbar-bottom-xs .sidebar-detached.fixed-sidebar-space {
    bottom: 82px;
  }
  .navbar-fixed .sidebar-detached {
    top: 86px;
  }
  .navbar-fixed-lg .sidebar-detached {
    top: 90px;
  }
  .navbar-fixed-sm .sidebar-detached {
    top: 84px;
  }
  .navbar-fixed-xs .sidebar-detached {
    top: 82px;
  }
}
.sidebar-separate .sidebar-content {
  padding-bottom: 0;
}
.sidebar-separate .sidebar-content .panel:last-child,
.sidebar-separate .sidebar-content .sidebar-category:last-child {
  margin-bottom: 0;
}
@media (min-width: 769px) {
  .sidebar-separate {
    background-color: transparent;
  }
  .sidebar-separate .sidebar-category {
    background-color: #263238;
    border-radius: 3px;
    margin-bottom: 20px;
  }
  .sidebar-separate.sidebar-default {
    background-color: transparent;
    border: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
  }
  .sidebar-separate.sidebar-default .sidebar-category {
    background-color: #fff;
    border: 1px solid #ddd;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  }
}
</style>
@endsection
{{-- Content --}}
@section('main')
@section('page_class') has-detached-right @endsection
@include('utils.errors.list')


<!-- Detached content -->
<div class="container-detached">
  <div class="content-detached">

    <!-- Grid -->
    @if(count($product) != 0)

    <div class="row">
      @foreach($product as $items)
      <div class="col-lg-4 col-sm-6">
        <div class="card">
          <div class="card-body" style="min-height:400px">
            <div class="thumb thumb-fixed">
              <a href="{{ url('products/'.$items->image) }}" data-popup="lightbox">
                <img src="{{ url('products/'.$items->image) }}" alt="">
                <!-- <span class="zoom-image"><i class="icon-plus2"></i></span> -->
              </a>
              <div class="image">
                <img src="/uploads/documents/{{$items->image}}" class="img-fluid" height="100" width="100%">
              </div>
            </div>
          </div>
          <div class="card-body card-body-accent text-center" style="min-height:200px">
            <h6 class="text-semibold no-margin"><a href="#" class="text-default"> {{$items->name}}</a></h6>

            <!-- <ul class="list-inline list-inline-separate mb-10"> -->
              <!-- <li><a href="#" class="text-muted">{{$items->description}}</a></li> -->
            <!-- </ul> -->
            <h3 class="no-margin text-semibold">MYR {{$items->price}}</h3>
            <form class="form-horizontal" action="{{url('user/add_to_cart')}}" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="product_id" value="{{$items->id}}">

              <button type="submit" value="{{$items->id}}" class="btn bg-teal-400 mt-15"><i
                  class="icon-cart-add position-left"></i> <span class="hidden-xs hidden-sm hidden-md">Add To
                  Cart</span></button><br><br>
            </form>
          </div>
        </div>
      </div>
      @endforeach

      @else
      <div class="product-layout col-lg-9 col-md-9 col-sm-9 col-xs-9 text-center">
        <span class="hidden-xs hidden-sm hidden-md">
          <p>{{trans('products.no_products_found_matching_the_search_criteria')}}</p>
        </span>
      </div>
      @endif

    </div>


    <!-- /grid -->




  </div>
</div>
<div class="sidebar-detached">
  <div class="sidebar-default sidebar-separate">
    <div class="sidebar-content">

      <!-- Categories -->
      <div class="sidebar-category">
        <div class="category-title">
          
          <div class="dropdown btn btn-warning">
            <i class="icon-cart-add mr-2" data-toggle="dropdown" title="cart">({{$cart_count}})</i>
            <div class="dropdown-menu dropdown-style" x-placement="bottom-start">
              @if($cart_amount >0)
              <div class="table-resposive">
              <table class="table table-hover" id="cart">
                <thead>
                  <tr>
                    <th></th>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.quantity')}}</th>
                    <th>{{trans('admin.price')}}</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $key => $value)

                  <tr>
                    <th>
                     <!--  <img src="{{url('img/cache/original/'.$value->image)}}" alt="product" width="30" height="30"
                        width="30" /> -->
                        <img src="/uploads/documents/{{$value->image}}" alt="product" width="30" height="30"
                        width="30" />
                    </th>
                    <th>{{$value->name}}</th>

                    <th> {{$value->cart_quantity}}</th>
                    <th><?php echo ($value->price * $value->cart_quantity);     
                          $total = 0;
                        $total = $total + ($value->cart_quantity * $value->price );?></th>


                    <th> <a href="{{url('user/deletecart/'.$value->id)}}"><i title="Remove"
                          class="fa fa-times-circle-o"></i>
                        <div class="dropdown-divider"></div>
                      </a></th>
                  </tr>
                  @endforeach
                </tbody>
              </table></div>
              <div class="dropdown-divider"></div>
              <div class="row">
                <div class="col-sm-4 col-md-offset-1">
                  <a href="{{url('user/viewcart')}}" class="addtocart btn btn-info" title="view cart"><strong><i
                        class="fa fa-shopping-cart"></i>{{trans('admin.view_cart')}}</strong></a>
                </div>
                <div class="col-sm-4 col-md-offset-2">
                  <a href="{{url('user/shippingaddress')}}" class="addtocart btn btn-info" title="Checkout"><strong><i
                        class="fa fa-plane"></i>{{trans('admin.check_out')}}</strong></a>
                </div>
              </div>

              @else
              <div class="cart" style="padding:10px;text-align:center">
                <span class="hidden-xs hidden-sm hidden-md">
                  <p>{{trans('admin.your_cart_is_empty')}}</p>
                </span>
              </div>
              @endif

            </div>
          </div>
        </div>
      </div>






    </div>
  </div>
</div>
<!-- /detached content -->


<div class="card-body d-none hide">

  <div class="row">

    <div class="col-sm-4">
      <div class="input-group col-md-2  col-md-offset-10">
        <div class="dropdown btn btn-warning">
          <i class="icon-cart-add mr-2" data-toggle="dropdown" title="cart">({{$cart_count}})</i>
          <div class="dropdown-menu dropdown-style" x-placement="bottom-start">
            @if($cart_amount >0)
            <table class="table table-hover" id="cart">
              <thead>
                <tr>
                  <th></th>
                  <th>{{trans('admin.name')}}</th>
                  <th>{{trans('admin.quantity')}}</th>
                  <th>{{trans('admin.price')}}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $key => $value)

                <tr>
                  <th>
                    <img src="{{url('img/cache/original/'.$value->image)}}" alt="product" width="30" height="30"
                      width="30" />
                  </th>
                  <th>{{$value->name}}</th>

                  <th> {{$value->cart_quantity}}</th>
                  <th><?php echo ($value->price * $value->cart_quantity);     
                          $total = 0;
                        $total = $total + ($value->cart_quantity * $value->price );?></th>


                  <th> <a href="{{url('user/deletecart/'.$value->id)}}"><i title="Remove"
                        class="fa fa-times-circle-o"></i>
                      <div class="dropdown-divider"></div>
                    </a></th>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="dropdown-divider"></div>
            <div class="row">
              <div class="col-sm-4 col-md-offset-1">
                <a href="{{url('user/viewcart')}}" class="addtocart btn btn-info" title="view cart"><strong><i
                      class="fa fa-shopping-cart"></i>{{trans('admin.view_cart')}}</strong></a>
              </div>
              <div class="col-sm-4 col-md-offset-2">
                <a href="{{url('user/shippingaddress')}}" class="addtocart btn btn-info" title="Checkout"><strong><i
                      class="fa fa-plane"></i>{{trans('admin.check_out')}}</strong></a>
              </div>
            </div>

            @else
            <div class="cart">
              <span class="hidden-xs hidden-sm hidden-md">
                <p>{{trans('admin.your_cart_is_empty')}}</p>
              </span>
            </div>
            @endif

          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      s<div class="input-group col-md-6 col-md-offset-6" class="searched">
        <input type="text" class="form-control" name="search" id="search" placeholder="Search" value="{{$products_id}}">
        <span class="input-group-btn">
          <a href="#" id="searchbutton"><button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>
            </button></a>
        </span>
      </div>

    </div>

  </div>

  <br>

  <div class="row">

    @if(count($product) != 0)
    <div class="product-layout col-lg-10 col-md-10 col-sm-10 col-xs-10">
      <div class="row">
        @foreach($product as $items)


        <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-6">

          <div class="card">

            <div class="card-body">

              <div class="card-img-actions">





                <a href="{{ url('img/cache/original/'.$items->image) }}" data-popup="lightbox">
                  <img src="{{ url('img/cache/original/'.$items->image) }}" class="card-img-new" alt="product" />
                  <span class="card-img-actions-overlay card-img">
                    <i class="icon-plus3 icon-2x"></i>
                  </span>
                </a>


              </div>

            </div>

            <div class="card-body bg-light text-center">
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-0">
                  {{$items->name}}
                </h6>

              </div>

              <h3 class="mb-0 font-weight-semibold">${{$items->price}}</h3><br>

              <form class="form-horizontal" action="{{url('user/add_to_cart')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="product_id" value="{{$items->id}}">

                <button type="submit" value="{{$items->id}}" class="btn btn-info"><i class="icon-cart-add mr-2"></i>
                  <span class="hidden-xs hidden-sm hidden-md">Add To Cart</span></button><br><br>

              </form>

            </div>

          </div>

        </div>


        @endforeach

      </div>
    </div>
    @else
    <div class="product-layout col-lg-9 col-md-9 col-sm-9 col-xs-9" align="center">
      <span class="hidden-xs hidden-sm hidden-md">
        <p>{{trans('products.no_products_found_matching_the_search_criteria')}}</p>
      </span>
    </div>
    @endif
    <div class="product-layout col-lg-2 col-md-2 col-sm-2 col-xs-2">

      <div class="card ">

        <div class="card-body border-0 p-0">
          <ul class="nav nav-sidebar mb-2">
            <li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
              <div class="my nav-link">{{trans('products.category')}}</div>
              <ul class="nav nav-group-sub">
                <li class="nav-item"><a href="{{url('user/onlinestore')}}"
                    class="nav-link">{{trans('products.all')}}</a></li>
                @foreach($category as $items)

                <li class="nav-item"><a href="{{url('user/onlinestores/').'/'.$items->id.'/'.$items->category_name}}"
                    class="nav-link">{{$items->category_name}}</a></li>

                @endforeach
              </ul>

            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>


</div>




@endsection

@section('scripts') @parent


<script>
  // $(document).ready(function () {
  //   App.init();
  // });
</script>



<script type="text/javascript">
  $("#searchbutton").click(function () {

    var selectedValue = $("#search").val();


    var url = "{{url('user/onlinestore/')}}" + "/" + selectedValue;
    window.open(url, '_self');

  });
</script>

<script type="text/javascript">
  $(document).on('click', '.button1', function (e) {
    e.preventDefault();
    var id = $(this).val();
    console.log()
    swal({
        title: "Are you sure!",
        type: "error",
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes!",
        showCancelButton: true,
      },
      function () {
        $.ajax({
          url: "{{URL::to('user/add_to_cart')}}",
          type: "post",

          data: {
            id: id
          },
          success: function (data) {
            swal("Good job!", "Successfully Released!", "success");
            $("#formtopost").submit();





          }
        });
      });
  });
</script>

@endsection