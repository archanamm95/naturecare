<?php 

    $merchant_id = $merchant_id;
    $secretkey = $secretkey;
    $amount = $joiningfee;
    $order_id = $orderidd;

if(isset($_POST['detail']) && isset($amount) && isset($order_id) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['phone']))
{
    
    $hashed_string = hash_hmac('sha256', $secretkey.urldecode($_POST['detail']).urldecode($amount).urldecode($order_id), $secretkey);
   
    ?>
    <html>
    <head>
    </head>
    <body onload="document.order.submit()">
        <form name="order" method="post" action="https://sandbox.senangpay.my/payment/<?php echo $merchant_id; ?>">
            <input type="hidden" name="detail" value="<?php echo $_POST['detail']; ?>">
            <input type="hidden" name="amount" value="{{$amount}}">
            <input type="hidden" name="order_id" value="{{$order_id}}">
            <input type="hidden" name="name" value="<?php echo $_POST['firstname']; ?>">
            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
            <input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
            <input type="hidden" name="hash" value="<?php echo $hashed_string; ?>">
            <input type="hidden" name="username" value="user">
        </form>
    </body>
    </html>
    <?php
}
