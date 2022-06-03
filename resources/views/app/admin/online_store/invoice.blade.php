@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop  {{-- Content --}} @section('main') 
@section('styles') 
@parent 
<style type="text/css">

</style>
  
 
  
  
@endsection
{{-- Content --}}
@section('main')
    
@include('flash::message')

@include('utils.errors.list')


 <div class="content">

        <!-- Invoice template -->
        <div class="card">
          <div class="card-header bg-transparent header-elements-inline">
            <h6 class="card-title">{{trans('products.store_purchase_invoice')}}</h6>
            <div class="header-elements">
             <!--  <button type="button" class="btn btn-light btn-sm" id="savepdf"><i class="icon-file-check mr-2"></i> Save</button> -->
              <div class="print" >
              <button type="button" class="btn btn-light btn-sm ml-3" onclick="printDiv('print-content')"><i class="icon-printer mr-2"></i> {{trans('products.print')}}</button>
            </div>
                    </div>
          </div>
             <div id="print-content" >
  <div class="print_id" >
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-4">
                  <div class="comp_name">
                 {{$company_name}}
               </div>
                  <ul class="list list-unstyled mb-0">
                    <li>{{$company_address}}</li>
                    <li>(602) 519-0450</li>
                    <li><a href="#">{{$email_address}}</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-4">
                  <div class="text-sm-right">
                    <h4 class="text-primary mb-2 mt-md-2">{{trans('products.invoice')}}: {{$invoice}}</h4>
                    <ul class="list list-unstyled mb-0">
                      <li>{{trans('products.date')}}: <span class="font-weight-semibold">{{$date}}</span></li>
                      <li>{{trans('products.due_date')}}: <span class="font-weight-semibold">{{$date}}</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-md-flex flex-md-wrap">
              <div class="mb-4 mb-md-2">
                <span class="text-muted">{{trans('products.invoice_to')}}:{{$fname}} {{$lname}}</span>
                <ul class="list list-unstyled mb-0">
                  <!-- <li><h5 class="my-2">{{$fname}} {{$lname}}</h5></li> -->
                  <li><span class="font-weight-semibold">{{$address}}</span></li>
                 
                  <li><a href="#">{{$email}}</a></li>
                </ul>
              </div>

              <div class="mb-2 ml-auto">
                <span class="text-muted">{{trans('products.payment_details')}}:</span>
                <div class="d-flex flex-wrap wmin-md-400">
                  <ul class="list list-unstyled mb-0">
                    <li><h5 class="my-2">{{trans('products.total_due')}}:</h5></li>
                  <!--   <li>Bank name:</li>
                    <li>Country:</li>
                    <li>City:</li>
                    <li>Address:</li>
                    <li>IBAN:</li>
                    <li>SWIFT code:</li> -->
                  </ul>

                  <ul class="list list-unstyled text-right mb-0 ml-auto">
                    <li><h5 class="font-weight-semibold my-2">{{currency($total_amount)}}</h5></li>
                   <!--  <li><span class="font-weight-semibold">Profit Bank Europe</span></li>
                    <li>United Kingdom</li>
                    <li>London E1 8BF</li>
                    <li>3 Goodman Street</li>
                    <li><span class="font-weight-semibold">KFH37784028476740</span></li>
                    <li><span class="font-weight-semibold">BPT4E</span></li> -->
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
              <table class="table table-lg">
                  <thead>
                      <tr>
                        <th>#</th>
                          <th>{{trans('products.description')}}</th>
                          <th>{{trans('products.quantity')}}</th>
                          <th>{{trans('products.unit_price')}}</th>
                          <th>{{trans('products.total')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $key=>$items)
                      <tr>
                         <td class="no">{{$key+1}}</td>
                     

                             <td>
                            <h6 class="mb-0">{{$items->name}}</h6>
                            <span class="text-muted">{{$items->description}}</span>
                          </td>
                        <td class="qty">{{$items->count}}</td>
                        <td class="unit">{{currency($items->price)}}</td>
                        <td class="total">{{currency(($items->price * $items->count)) }}</td>
                      </tr>
                           @endforeach
                     
                
                  </tbody>
              </table>
          </div>

          <div class="card-body">
            <div class="d-md-flex flex-md-wrap">
              <div class="pt-2 mb-3">
                <h6 class="mb-3">{{trans('products.authorized_persons')}}</h6>
              <!--   <div class="mb-3">
                  <img src="../../../../global_assets/images/signature.png" width="150" alt="">
                </div> -->

                <ul class="list-unstyled text-muted">
                  <li>{{$admin_user[0]->name}} {{$admin_user[0]->lastname}}</li>
                  <li>{{$admin_user[0]->address1}}</li>
                  <li>{{$admin_user[0]->city}}</li>
                  <li>{{$admin_user[0]->mobile}}</li>
                </ul>
              </div>

              <div class="pt-2 mb-4 wmin-md-400 ml-auto">
                <h6 class="mb-4" style="margin-left: 18px;
">{{trans('products.total_due')}}</h6>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>{{trans('products.subtotal')}}:</th>
                        <td class="text-right">{{currency($total_amount)}}</td>
                      </tr>
                      <tr>
                        <th>{{trans('products.tax')}}: <span class="font-weight-normal">(0%)</span></th>
                        <td class="text-right">0.00</td>
                      </tr>
                      <tr>
                        <th>{{trans('products.total')}}:</th>
                        <td class="text-right text-primary"><h5 class="font-weight-semibold">{{currency($total_amount)}}</h5></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="text-right mt-3">
                 <!--  <button type="button" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-paperplane"></i></b> {{trans('products.send_invoice')}}</button> -->
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <span class="text-muted">{{trans('products.thank_you_for_using')}} {{$company_name}}. {{trans('products.this_invoice_can_be_paid_via_paypal')}}, {{trans('products.bank_transfer')}}, {{trans('products.skrill_or_pioneer')}}. {{trans('products.payment_is_due_within_30_days_from_the_date_of delivery')}}.{{trans('products.late_payment_is_possible')}}, {{trans('products.but_with_a_fee_of_10%_per_month')}}. {{trans('products.company_registered_office')}}: {{$company_address}}. {{trans('products.phone_number')}}: 888-555-2311</span>
          </div>
        </div>
      </div>
    </div>

        <!-- /invoice template -->


        <!-- Editable invoice -->
 
        <!-- /editable invoice -->

      </div>
            
@endsection
@section('scripts') @parent
<script src="js/jquery.min.js"></script>

<!-- jsPDF library -->
<script src="js/jsPDF/dist/jspdf.min.js"></script>

<!-- Start JS Validation -->

<!-- End JS Validation -->
<script type="text/javascript">
function printDiv(print) {
     var printContents = document.getElementById(print).innerHTML;
     var originalContents = document.body.innerHTML;
     
     document.body.innerHTML = printContents;

     window.print();
        
     document.body.innerHTML = originalContents;
}
    
  </script>


<script>
function myFunction() {
  window.print();
}
</script>

<script type="text/javascript">
  var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#savepdf').click(function () {
    doc.fromHTML($('#print-content').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('invoice.pdf');
});

</script>



@endsection