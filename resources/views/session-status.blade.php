  <?php
  $signal = $signals['okays'];
   $class = "warning";   
           
   if($val == "error"){
   	$signal = $signals['errors'];
   	$class = "danger";         
       $pop .= "-error";
   } 
  ?>                
  
  <script>
Swal.fire({
  position: 'top',
  type: '{{$class}}',
  title: '@if($val == "error")<strong>Whoops!</strong> @else Success! @endif',
  text: '{{$signal[$pop]}}',
  showConfirmButton: false,
  timer: 4500
});
</script>
	