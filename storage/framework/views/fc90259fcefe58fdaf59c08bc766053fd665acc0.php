

<?php $__env->startSection('title',"Reviews"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">customer reviews</h2>
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12">
              <div class="inner-ad">
                <figure>
                  <figure><img class="img-responsive" src="<?php echo e($ad); ?>" width="1170" height="100" alt=""></figure>
                </figure>
              </div>
            </div>
            <div class="col-sm-12">
              <ol class="breadcrumb dashed-border row">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="active">customer reviews</li>
              </ol>
            </div>
            <!--start of columns-->
            <div class="col-sm-12">
              <div class="row extra-btm-padding">
                <div class="table-responsive m-t-40 wow fadeInUp">
                	   <table class="table ace-table">
				   <thead>
                     <tr>
                     <th>Customer</th>
                     <th>Rating</th>
                     <th>Details</th>
                     <th>Comment</th>
                     <tr>
				   </thead>
				   <tbody>
				    <?php
					 if(count($reviews) > 0)
					  {
						  foreach($reviews as $r)
						  {
							  $o = $r['order'];
							  $items = $o['order']['items'];
						    $name = explode(" ",$o['name']);
				    ?>	
				     <tr>
				      <td>
					   <p><?php echo e($name[0]); ?> from <?php echo e(ucwords($o['state'])); ?></p>
					   <p>Order reference: <?php echo e($o['reference']); ?></p>
					   <?php
						 foreach($items as $i)
						 {
							   $product = $i['product'];
							   $sku = $product['sku'];
							   $name = $product['name'];
							   $pu = url('product')."?sku=".$product['sku'];
							   $img = $product['imggs'][0];
							 
							 $qty = $i['qty'];
						 ?>
						 
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="80" width="80" style="margin-bottom: 5px;"/>
							   <?php echo e($name); ?>

						 </a> (x<?php echo e($qty); ?>)<br>
						 <?php
						 }
						?>
					  </td>
				      <td>
					    <?php
							   for($i = 0; $i < $r['rating']; $i++)
							   {
								  
							 ?>
                             <a href="javascript:void(0)" class="ion-star large-text"></a>   
							 <?php
							   }
							 ?>
					  </td>
				      <td>
					   <p>Order came as advertised: <b><?php echo e(strtoupper($r['caa'])); ?></b></p>
					   <p>Order delivery was on time: <b><?php echo e(strtoupper($r['daa'])); ?></b></p>
					  </td>
				      <td><b><?php echo e(strtoupper($r['comment'])); ?></b></td>
				     </tr>
					  <?php
						  }
					  }
                    ?>	
				   </tbody>
				   </table>
				</div>
              </div>
            
            </div>
            <!--start of columns--> 
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- DataTables js -->
       <script src="lib/datatables/js/datatables.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="lib/datatables/js/datatables-init.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/reviews.blade.php ENDPATH**/ ?>