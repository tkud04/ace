<?php
 $totals = $order['totals'];
 $items = $order['items'];
 $itemCount = $totals['items'];
 $uu = "http://admin.aceluxurystore.com/confirm-payment?o=".$order['reference'];
 $cr = $order['courier'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Bank payment request for order <?php echo e($order['reference']); ?>, paid via <?php echo e($order['type']); ?></h3>
Hello admin,<br> please be informed that a new bank payment request has been received. See the details below:<br><br>
Reference #: <b><?php echo e($order['reference']); ?></b><br>
Customer: <b><?php echo e($name); ?></b><br>
Customer contact: <b><?php echo e($phone); ?> | <?php echo e($user); ?></b><br>
<?php
foreach($items as $i)
{
	$product = $i['product'];
	$sku = $product['sku'];
	$name = $product['name'];
	$qty = $i['qty'];
	$pu = url('product')."?sku=".$product['sku'];
	$img = $product['imggs'][0];
	
?>

<a href="<?php echo e($pu); ?>" target="_blank">
  <img style="vertical-align: middle;border:0;line-height: 20px;" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="80" width="80" style="margin-bottom: 5px;"/>
	  <?php echo e($name); ?>

</a> (x<?php echo e($qty); ?>)<br>
<?php
}
?>
Total: <b>&#8358;<?php echo e(number_format($order['amount'],2)); ?></b><br><br>

<h6>Shipping Details</h6>
<p><b><?php echo e($cr['name']); ?></b> (&#8358;<?php echo e(number_format($cr['price'],2)); ?>)</p>
<p>Address: <?php echo e($shipping['address']); ?></p>
<p>City: <?php echo e($shipping['city']); ?></p>
<p>State: <?php echo e($shipping['state']); ?></p><br><br>


<h5 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Next steps</h5>

<p>If the payment has been cleared, please click the button below to confirm the order. Alternatively you can follow up the customer.</p><br>
<p style="color:red;"><b>NOTE:</b> If the payment has not been cleared, do not confirm the order.</p><br><br>

<a href="<?php echo e($uu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Confirm this order</a><br><br>

<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/emails/admin-bank-alert.blade.php ENDPATH**/ ?>