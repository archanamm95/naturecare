<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    
    <style>

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 12px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial  !important, sans-serif ;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 12px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
    }
/*    tr:nth-child(even) {background: #CCC}
    tr:nth-child(odd) {background: #FFF}*/
   body, table, th, td  {
  /*background: url('https://source.unsplash.com/twukN12EN7c/1920x1080') no-repeat center center fixed;*/
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
    </style>
</head>

<body>
    <div class="invoice-box" style="border: 0px  black !important;">

       

        <table cellpadding="0" cellspacing="0" style="border: 0px  black !important;">
            <tr class="top"  style="width: 117% !important;border: 0px  black !important;">
                <td style="border: 0px ">     <img src="{{ url('img/cache/original/'.$logo_light)}}" style="width: 80px;border: 0px  black !important;"></td>

                <td  style="border: 0px  black !important;" colspan="5">
                    <table style="border: 0px  black !important;">
                        <tr style="border: 0px  black !important;">
                        <!--     <td class="title" style="border: 0px  black !important;">
                                 <img src="{{ url('img/cache/original/'.$logo_light)}}" style="width: 170px;border: 0px  black !important;">
                            </td> -->
                            <td style="border: 0px  black !important;font-size: 18px; text-align: right;">
                                <br>
                                Invoice No: {{$invoice->invoice_id}}<br>
                                Created: {{date('Y-m-d',strtotime($invoice->created_at))}}
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>
            <tr>
                <td colspan="5" style="border: 0px ">
                
                   <h1 class="card-title " style="text-align: center;font-size: x-large;font-weight: bold;"><u>NATURE CARE PURCHASE INVOICE</u></h1>
                </td>
            </tr>
            
            <tr class="information" style="border: 0px  black !important;font-size: 18px;">
                <td colspan="5" style="border: 0px  black !important;">
                    <table style="border: 0px  black !important;">
                        <tr style="border: 0px  black !important;">
                            <td style="border: 0px  black !important;">
                              
                                 {!!$company_address->company_address !!}<br>
                            </td>
                            
                            <td style="border: 0px  black !important;">
                               <b> {{$invoice->fname}} {{$invoice->lname}}</b>
                               <p>{{$invoice->email}}<br>
                               {{$invoice->address}}<br>
                               {{$invoice->city}}<br>
                               {{$invoice->state}}, {{$invoice->country}}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading" style="border: 0px  black !important;">
                <td style="border: 0px  black !important;">
                    Payment Details
                </td>
                <td style="border: 0px  black !important;">
                    
                </td>
                <td style="border: 0px  black !important;">
                    
                </td>
                <td style="border: 0px  black !important;">
                    
                </td>
                
                <td style="border: 0px  black !important;">
                    Total: MYR {{$Grand_total}}
                </td>
            </tr>
            
            <tr class="details" style="border: 0px  black !important;">
                <td style="border: 0px  black !important;">
                
                </td> 
                <td style="border: 0px  black !important;">
                
                </td> 
                <td style="border: 0px  black !important;">
                
                </td> 
                
                <td style="border: 0px  black !important;">
                
                </td>
                
                <td style="border: 0px  black !important;">
              
                </td>
            </tr>
            <tr>
                <td style="border: 0px  black !important;">
                
                </td> 
                <td style="border: 0px  black !important;">
                
                </td> 
                <td style="border: 0px  black !important;">
                
                </td> 
                <td style="border: 0px  black !important;">
                
                </td> 
            </tr>
         
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
        </table>
                  <div class="card-body">
        
          </div>
    </div>
</body>
</html>
