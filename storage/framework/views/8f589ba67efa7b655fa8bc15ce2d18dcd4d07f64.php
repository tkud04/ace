<?php $__env->startSection('title',"Transaction Successful"); ?>

<?php $__env->startSection('content'); ?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">Return Policy</h2>
        <p></p>
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="inner-ad">
            <figure><img class="img-responsive" src="<?php echo e($ad); ?>" width="1170" height="100" alt=""></figure>
          </div>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb  dashed-border">
            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
            <li class="active">Return Policy</li>
          </ol>
        </div>
        <div class="col-sm-12">
		  <h4 class="sub-title text-primary text-uppercase">Your payment was successful!</h4>
			   <p>Fetching your orders.. <a href="<?php echo e(url('orders')); ?>">Click here</a> if you are not redirected in 5 seconds.</p><br>

        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<?php
$uu = url('orders');
?>
<script>
setTimeout(() => {
	window.location = "<?php echo e($uu); ?>";
},5000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/cps.blade.php ENDPATH**/ ?>