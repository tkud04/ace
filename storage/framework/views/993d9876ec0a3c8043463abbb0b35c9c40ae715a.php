  <?php
  $signal = $signals['okays'];
   $class = "warning";   
   $icon = "info";
   $title = "Success";
   if($val == "error"){
   	$signal = $signals['errors'];
   	$class = "danger";         
       $pop .= "-error";
	 $icon = "error";
   $title = "<strong>Oops...</strong>";
   } 
  ?>                
  
  <script>
if("<?php echo e($pop); ?>" == "add-to-cart-status"){
	let x1 = "<?php echo e(url('shop')); ?>",x2 = "<?php echo e(url('checkout')); ?>";
	Swal.fire({
  title: '<strong>Added to cart!</strong>',
  icon: 'info',
  html:
    '<em>What would you like to do next?</em>',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    "<a class='text-white ion-basket-outline' href="+x1+">Continue shopping</a>",
  confirmButtonAriaLabel: 'Continue shopping',
  cancelButtonText:
     "<a class='text-white ion-wallet' href="+x2+">Checkout</a>",
  cancelButtonAriaLabel: 'Checkout'
})
}
else{
Swal.fire({
  icon: '<?php echo e($icon); ?>',
  title: '<?php echo e($title); ?>',
  text: '<?php echo e($signal[$pop]); ?>',
});
}
</script>
	<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/session-status.blade.php ENDPATH**/ ?>