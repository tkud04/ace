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
if("{{$pop}}" == "add-to-cart-status"){
	let x1 = "{{url('shop')}}",x2 = "{{url('checkout')}}";
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
  icon: '{{$icon}}',
  title: '{{$title}}',
  text: '{{$signal[$pop]}}',
});
}
</script>
	