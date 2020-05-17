<?php
 $totals = $order['totals'];
 $items = $totals['items'];
 $uu = url('track')."?o=".$order['reference'];
?>
<img src="http://www.aceluxurystore.com/images/logo.png" width="100" height="100"/>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Payment Confirmed</h3>
Hello, your payment has been confirmed! Here are your order and delivery details:<br><br>
Reference #: <b>{{$order['reference']}}</b><br>
Items: <b>{{$items}}</b><br>
Total: <b>&#8358;{{number_format($order['amount'],2)}}</b><br>
Delivery status: <a href="{{$uu}}" target="_blank">Track your order</a><br><br>

