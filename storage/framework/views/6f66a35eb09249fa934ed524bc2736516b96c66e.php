<?php
 $totals = $order['totals'];
 $items = $totals['items'];
 $uu = "http://admin.aceluxurystore.com/confirm-payment?o=".$order['reference'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Confirm payment for order <?php echo e($order['payment_code']); ?></h3>
Hello admin,<br> kindly confirm that payment for the below referenced order has been cleared:<br><br>
Reference #: <b><?php echo e($order['reference']); ?></b><br>
Customer: <b><?php echo e($user); ?></b><br>
Bank name: <b><?php echo e($bname); ?></b><br>
Account name: <b><?php echo e($acname); ?></b><br>
Account number: <b><?php echo e($acnum); ?></b><br>
Items: <b><?php echo e($items); ?></b><br>
Total: <b>&#8358;<?php echo e(number_format($order['amount'],2)); ?></b><br><br>
<h5 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Next steps</h5>

<p>If the payment has been cleared, please click the button below to confirm the order. Alternatively you can log in to the Admin Dashboard to confirm the order (go to Orders and click the Confirm button beside the order).</p><br>
<p style="color:red;"><b>NOTE:</b> If the payment has not been cleared, do not confirm the order.</p><br><br>

<a href="<?php echo e($uu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Confirm this order</a><br><br>

<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/emails/admin-confirm-payment.blade.php ENDPATH**/ ?>