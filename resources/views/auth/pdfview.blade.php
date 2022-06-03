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
           <h1 class="card-title " style="text-align: center;font-size: x-large;font-weight: bold;"><u>NC Purchase Invoice</u></h1>

        <table cellpadding="0" cellspacing="0" style="border: 0px  black !important;">
            <tr class="top"  style="width: 117% !important;border: 0px  black !important;">
                <td colspan="5"  style="border: 0px  black !important;">
                    <table style="border: 0px  black !important;">
                        <tr style="border: 0px  black !important;">
                            <td class="title" style="border: 0px  black !important;">
                                 <img src="{{ url('img/cache/original/'.$logo_light)}}" style="width: 170px;border: 0px  black !important;">
                            </td>
                            <td style="border: 0px  black !important;font-size: 18px;">
                                <br>
                                Invoice #: {{$invoice_id}}<br>
                                Created: {{date('Y-m-d',strtotime($purchase_details->created_at))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information" style="border: 0px  black !important;font-size: 18px;">
                <td colspan="5" style="border: 0px  black !important;">
                    <table style="border: 0px  black !important;">
                        <tr style="border: 0px  black !important;">
                            <td style="border: 0px  black !important;">
                                 <b>{{$company_details->company_name}}.</b>
                                 {!!$company_details->company_address !!}<br>
                            </td>
                            
                            <td style="border: 0px  black !important;">
                               <b> {{$user_data->name}} {{$user_data->lastname}}.</b>
                               <p>{{$user_data->email}}<br>
                               {{$user_details->address1}}, {{$user_details->address2}}<br>
                               {{$user_details->zip}}<br>
                               {{$purchase_details->shipping_country_name}}, {{$purchase_details->shipping_state_name}}</p>
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
                    Total:
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
              MYR {{$purchase_details->total_amount}}
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
            <tr class="heading">
                <td>
                    #
                </td>
                
                <td>
                    Item
                </td>                 
                          
                <td>
                 Quantity
                </td>                
                <td>
                 Unit Price
                </td>                
                <td>
                  Total
                </td>
            </tr>
             <tbody >
                <tr>
                         <td class="no">1</td>
                     

                             <td>
                        <b>  {{$package_details->name}}</b><br>
                          <!-- {{$package_details->description}} -->
                          </td>
                        <td class="qty" >{{$purchase_details->count}}</td>
                        <td class="unit">MYR {{$package_details->price}}</td>
                        <td class="total" >MYR {{$purchase_details->total_amount}}</td>
                   
                      </tr>
                     

                  </tbody>               
        </table>
                  <div class="card-body">
            <div class="d-md-flex flex-md-wrap" style="margin-left: 311px;">
      

              <div class="">
                <h4 class="">Total Due</h4>
                  <table class='tablebordered' style="text-align: center">
                    <tbody>
                      <tr>
                        <th>Sub Total:</th>
                        <td class="">MYR {{$purchase_details->total_amount}}</td>
                      </tr>
                      <tr>
                        <th>Discount: </th>
                        <td> 0% </td>
                      </tr>
                       <tr>
                        <th>Tax:</th>
                        <td>MYR 0</td>
                      </tr>
                      <tr>
                        <th >Total:</th>
                        <td ><h5 class="font-weight-semibold">MYR {{$purchase_details->total_amount}}</h5></td>
                      </tr>
                    </tbody>
                  </table>

              </div>
            </div>
          </div>
    </div>
</body>
</html>
