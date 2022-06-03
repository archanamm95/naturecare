@extends('layouts.auth')
@section('content')

 <div class="content">
  <div class="container">
    <div class="row">
    <div class="col-lg-8 offset-lg-2">
        <!-- Invoice template -->
        <div class="card">
          <div class="card-header bg-transparent ">
            <div class="col-lg-12 text-right">
             <!--  <button type="button" class="btn btn-light btn-sm" id="savepdf"><i class="icon-file-check mr-2"></i> Save</button> -->
              <div class="print text-right" >
              <button type="button" class="btn btn-light btn-sm ml-3" onclick="printDiv('print-content')"><i class="icon-printer mr-2"></i> {{trans('products.print')}}</button>
            </div>
            </div>
          </div>
          <div class="card-body">
             <div class="row w-100">
               <div class="col-lg-12 text-center"> 
                <h2 class="card-title">INVOICE</h2>
                <div>Issued by Nature Care International Sdn Bhd</div>
               </div>
             </div>

            <div class="row w-100">
              <div class="col-lg-6"> 
               <img src="{{ url('img/cache/original/'.$logo_light)}}" alt="{{ config('app.name', 'Cloud MLM Software') }}" class="rounded-circle" style="height:100px;width:89px;margin-left:8px;margin-top: 15px;">
              
            </div>
            
                <div class="col-lg-6 text-right">
                <div class="mb-4">
                  <div class="text-sm-right">
                    <h4 class="text-primary mb-2 mt-md-2">{{trans('products.invoice')}}: #{{$invoice->invoice_id}}</h4>
                    <h4 class="text-primary mb-2 mt-md-2">Date: {{$date}}</h4>
              <!--       <ul class="list list-unstyled mb-0">
                      <li>{{trans('products.date')}}: <span class="font-weight-semibold">20/08/2021</span></li>
                      <li>{{trans('products.due_date')}}: <span class="font-weight-semibold">20/08/2021</span></li>
                    </ul> -->
                  </div>
                </div>
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

                   {{ $company_address->company_name }}
               </div>
                  <ul class="list list-unstyled mb-0">
                    <li>
                    {!!$company_address->company_address!!} 
                    {{trans('products.phone_number')}}: 888-555-2311
                    </li>
                    
                    <li><a href="#">naturecaremalaysia@gmail.com</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-6 text-right">
                <div class="mb-4 mb-md-2">
                <span class="text-muted">{{trans('products.invoice_to')}}:{{$invoice->fname}} {{$invoice->lname}}</span>
                <ul class="list list-unstyled mb-0">
                  <li><span class="font-weight-semibold">{{$invoice->address}}</span></li>
                  <li><a href="#">{{$invoice->email}}</a></li>
                </ul>
              </div>
              </div>

            </div>
          </div>

          <div class="table-responsive">
              <table class="table table-lg">
                  <thead>
                      <tr>
                      
                        <th>Item</th>
                        <th>{{trans('products.unit_price')}}</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                      </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $items)

                      <tr>
                         <td>
                            <h6 class="mb-0">{{$items->name}}</h6>
                         </td>
                          <td>{{$items->price}}</td> 
                          <td>{{$items->quantity}}</td>
                          <td>{{$items->total_price}}</td>

                      </tr>
                            @endforeach
                        <tr>
                                <td></td>
                                <td></td>
                                <td><b>GRAND TOTAL</b></td>
                                <td><b>{{$Grand_total}}</b></td>

                         </tr>
                      
             
                  </tbody>
             
              </table>
          </div>

      </div>

          <div class="card-footer">
            <span class="text-muted">{{trans('products.thank_you_for_using')}} Nature Care  </span>
          </div>
        </div>
      </div>
    </div>

        <!-- /invoice template -->


        <!-- Editable invoice -->
 
        <!-- /editable invoice -->

      </div>
    </div>
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