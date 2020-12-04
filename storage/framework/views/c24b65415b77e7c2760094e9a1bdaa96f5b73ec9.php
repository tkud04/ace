

<?php $__env->startSection('title',"Orders"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
$legendText = count($orders) > 0 ? "enter your reference number below" : "sign in to view your orders OR enter your reference number below";
?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">your orders</h2>
		<?php if(isset($wext) && !is_null($wext)): ?>
        <h3 class="text-info">Your request has been received, you will be notified via email shortly if your payment has been cleared.</h3>
	    <?php endif; ?>
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
                <li class="active">your orders</li>
              </ol>
            </div>
			<div class="col-sm-12">
			      <form role="form" action="<?php echo e(url('anon-order')); ?>" method="get">
					
					  <fieldset class="col-md-12">
                        <legend><?php echo e($legendText); ?></legend>
                        
                        <!-- Name -->
                         <div class="row">
                          <div class="col-sm-12 form-group">
                            <label class="control-label" for="ref">Reference #</label>
                            <input type="text" id="ref" name="ref" placeholder="Enter your reference number" class="form-control">
						  </div>
						 
                         </div>
					 </fieldset>
					 
					 <div class="row" style="margin-bottom: 20px;">
					  <div class="col-sm-12">
					    <input type="submit" class="btn btn-primary" value="Submit">
					  </div>
					</div>
				  </form>
			    </div>
			<?php if(count($orders) > 0): ?>
				<br>
            <!--start of columns-->
            <div class="col-sm-12">
              <div class="row extra-btm-padding">
                <div class="table-responsive m-t-40 wow fadeInUp">
                	   <table class="table ace-table">
				   <thead>
                        <tr>
                                    <th>Date</th>
                                    <th>Reference #</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Courier</th>
                                    <th>Status</th>                                                                       
                                    <th>Actions</th>                                                                       
                                </tr>
                       </thead>
					<tbody>
					<?php
					  if(count($orders) > 0)
					  {
						 foreach($orders as $o)
						 {
							 $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
							 $vpu = url('confirm-payment')."?oid=".$o['reference'];
							 $tru = url('track')."?o=".$o['reference'];
							 $iu = url('receipt')."?r=".$o['reference'];
							 $type = $o['type']; $cr = $o['courier'];
							 $ttype = "";
							 
							 if($type == "card" || $type == "bank")
							 {
								$ttype = "Prepaid (".$type.")";
                                $ttClass = "primary";								
							 } 
							 else if($type == "pod")
							 {
								 $ttype = "Pay on Delivery";
								 $ttClass = "success";
							 } 

				    ?>
					 <tr>
					   <td><?php echo e($o['date']); ?></td>
					   <td><?php echo e($o['reference']); ?></td>
					    <td>
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
					   <td>&#8358;<?php echo e(number_format($o['amount'],2)); ?></td>		  
					   <td><span class="label label-<?php echo e($ttClass); ?>"><?php echo e(strtoupper($ttype)); ?></span></td>		  
					   <td><b><?php echo e($cr['name']); ?></b> (&#8358;<?php echo e(number_format($cr['price'],2)); ?>)</td>		  
					   <td><span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($o['status'])); ?></span></td>
					   <td>
					     <a class="btn btn-info" href="<?php echo e($iu); ?>" target="_blank">Receipt</a>
						 <a class="btn btn-primary" href="<?php echo e($tru); ?>">Track</a>					     						 
					   </td>
					 </tr>
					<?php
					 $v1 = ($type == "card" || $type == "bank") && $o['status'] == "unpaid";
					 $v2 = ($type == "pod" && $o['payment_type'] == "bank" && $o['status'] == "pod");
					 if($v1 || $v2)
					  {
				    ?>
					 <tr>
					   <td colspan="8">
					     <div class="row">
        <div class="col-sm-12 equal-height-container">
          <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3 sub-data-left sub-equal">
              <div id="sticky">
                <section>
                  <h5 class="sub-title text-info text-uppercase">confirm your payment</h5>
                  <p class="text-danger"><b>NOTE: </b>Make sure you include your reference number when making payment. </p>
                  <p class="text-danger"><b>NOTE: </b>Your order would only be processed AFTER your payment has been cleared from our end. </p>
                  <br>
				  <dl>
                    <dt>Steps to take</dt>
                    <dd style="color:#777;">Make your payment to our bank account as displayed on this page.</dd>
                    <dd style="color:#777;">Add your reference number <b><?php echo e($o['reference']); ?></b> when making a deposit or a transfer.</dd>
                    <dd style="color:#777;">After making payment, fill the form on the right and click Submit.</dd>
                    <dd style="color:#777;">Once your payment has been cleared your order will be processed.</dd>
                    <dd style="color:#777;">You have a maximum of 24 hours to confirm your payment or your order will be cancelled.</dd>
                   
                  </dl>
                </section>
              </div>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9 main-sec">
              <div class="row"> 

                <!--start of checkout-->
                <div class="col-sm-12" style="color: #000;">
                  <form role="form" method="post" action="<?php echo e(url('confirm-payment')); ?>">
				   <?php echo csrf_field(); ?>

				   <input type="hidden" name="o" value="<?php echo e($o['reference']); ?>"/>
                    <div class="row"> 
                      
                      <!-- START Order information -->
                      <fieldset class="col-md-6">
                        <legend>Order information</legend>
                        <div class="form-group">
                          <label class="control-label" for="first-name">Order date</label>
                           <h4 class="form-control-plaintext"><?php echo e($o['date']); ?></h4>
                        </div><br>
                        <div class="form-group">
                          <label class="control-label" for="last-name">details</label>
						  <?php
						  $totals = $o['totals'];
						   $items = $totals['items'];
						  ?>
                          <h4 class="form-control-plaintext"><?php echo e($items); ?> items<br><br>Total: <b>&#8358;<?php echo e(number_format($o['amount'],2)); ?></b></h4>
                        </div><br>
                        <div class="form-group">
                          <label class="control-label" for="mail">reference #<span class="req">*</span></label>
                          <h4 class="form-control-plaintext"><?php echo e($o['reference']); ?></h4>
                        </div><br>
						<div class="form-group">
                          <label class="control-label" for="mail">please make payment to:</label>
                          <h4 class="form-control-plaintext" style="color: #000;">Bank: <?php echo e(ucwords($bank['bname'])); ?><br><br>Account name: <?php echo e(ucwords($bank['acname'])); ?><br><br>Account number: <?php echo e($bank['acnum']); ?></h4>
                        </div>
                      </fieldset>
                      <!-- END Order information-->
					  <?php
					  $email = is_null($user) ? $anon['email'] : $user['email'];
					  $phone = is_null($user) ? $anon['phone'] : $user['phone'];
					  ?>
					  <!-- START Bank information -->
                      <fieldset class="col-md-6">
                        <legend>Bank information</legend>
                        <div class="form-group">
                          <label class="control-label" for="bname">bank <span class="req">*</span></label>
                          <select id="bname" name="bname" class="form-control" onchange="selectBank();" required>
						    <option value="none">Select bank</option>
							<?php
							 foreach($banks as $key => $value)
							 {
							?>
							 <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
							<?php
							 }
							?>
							<option value="other">Other</option>
						  </select>
                          <input type="text" id="bname-other" name="bname-other" class="form-control" value="" placeholder="Enter bank name">
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="acname">account name <span class="req">*</span></label>
                          <input type="text" class="form-control" name="acname" placeholder="Enter account name" required>
                        </div>
						<div class="form-group">
                          <label class="control-label" for="acnum">account number <span class="req">*</span></label>
                          <input type="number" class="form-control" name="acnum" placeholder="Enter account number" required>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="mail">email address <span class="req">*</span></label>
                          <input type="text" id="mail" name="email" class="form-control" value="<?php echo e($email); ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="phone">phone number <span class="req">*</span></label>
                          <input type="text" id="phone" name="phone" class="form-control" value="<?php echo e($phone); ?>" readonly>
                        </div>
                      </fieldset>
                      <!-- END Personal information--> 
					  <div class="col-sm-12">
					    <center>
                        <button class="btn btn-primary hvr-underline-from-center-primary " type="submit">submit</button>
                        </center>
						<br>
                        <br>
                      </div>
                    </div>
                  </form>
                </div>
                
                <!--end of checkout--> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
					   </td>
					 </tr>
					 
					<?php
					       }
						 }  
					  }
                    ?>						  
					</tbody>
				  </table>
				</div>
              </div>
            
            </div>
            <!--end of columns--> 
			<?php endif; ?>
			
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

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/orders.blade.php ENDPATH**/ ?>