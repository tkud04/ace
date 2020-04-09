<?php
$nl = "";
foreach($errors->all() as $error){
   if($error == "The g-recaptcha-response field is required."){
		$nl .= "You must fill the captcha to continue".PHP_EOL;
   }
   elseif($error == "The selected sz is invalid." || $error == "The sz field is required."){
		$nl .= "You must select a size to continue".PHP_EOL;
   }
   else{
		$nl .= $error.PHP_EOL;
   }
}
?>
 
<script>

Swal.fire({
  position: 'top',
  type: 'error',
  title: `<?php echo e($nl); ?>`,
  text: "",
  showConfirmButton: false,
  timer: 10000
});
</script>
	<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/input-errors.blade.php ENDPATH**/ ?>