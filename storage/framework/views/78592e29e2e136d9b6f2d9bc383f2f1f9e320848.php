<?php
 $totals = $order['totals'];
 $items = $order['items'];
 $itemCount = $totals['items'];
 $uu = "http://admin.aceluxurystore.com/edit-order?r=".$order['reference'];
 $tu = "http://admin.aceluxurystore.com/track?o=".$order['reference'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Your order #<?php echo e($order['reference']); ?> is on its way</h3>

Hello <?php echo e($u['name']); ?>,<br> You just placed an order on our website. See the details below:<br><br>
Reference #: <b><?php echo e($order['reference']); ?></b><br>
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
<h5 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Next steps</h5>
<p style="color:red;"><b>NOTE:</b> We only accept <b>CASH</b> on delivery.</p><br>
<p>Please inspect your order upon arrival to your destination. Once satisfied kindly make your payment to the dispatcher. </p><br>
<p style="color:red;"><b>NOTE:</b> This order is currently marked as <b>PENDING</b>. We will only process orders whose payment have been cleared in our accounts and confirmed.<br><br>Orders are delivered within 48 hours in Lagos.<br><br>Orders outside Lagos are delivered between 3 – 7 days.</p><br><br>

<a href="<?php echo e($tu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px; margin-right: 10px;">Track your order</a>
<br><br>

<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/emails/anon-new-order-bank.blade.php ENDPATH**/ ?>