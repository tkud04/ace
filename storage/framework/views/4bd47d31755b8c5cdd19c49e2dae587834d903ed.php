<?php $__env->startSection('title',$product['sku']); ?>

<?php $__env->startSection('content'); ?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase"><?php echo e($product['sku']); ?></h2>
        <p>View more information about this product.</p>
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="inner-ad">
            <figure><img class="img-responsive" src="images/inner-ad.jpg" width="1170" height="100" alt=""></figure>
          </div>
        </div>
        <div class="col-sm-12 equal-height-container">
          <div class="row">
            <div class="col-sm-4 col-md-3  sub-data-left sub-equal">
              <section>
                <h5 class="sub-title text-info text-uppercase">Categories</h5>
                <ul class="list-group nudge">
				<?php
				  $i = 0;
				 foreach($cc as $key => $value)
				 {
					 $style = $i == 0 ? 'style="padding-left: 0px;"' : '';
					 $uu = url('shop')."?category=".$key;
				?>
                  <li class="list-group-item"><a href="<?php echo e($uu); ?>"<?php echo e($style); ?>><?php echo e($value); ?></a></li>
				<?php
				 }
				?>
                  
                </ul>
              </section>        
              <section> <img width="820" height="703" alt="" src="images/banner4.jpg" class="img-responsive"> </section>
              <section class="col-sm-12 tags">
                <h5 class="sub-title text-info text-uppercase">popular tags</h5>
                <a href="#">travel</a> <a href="#">blog</a> <a href="#">lifestyle</a> <a href="#">feature</a> <a href="#">mountain</a> <a href="#">design</a> <a href="#">restaurant</a> <a href="#">journey</a> <a href="#">classic</a> <a href="#">sunset</a> </section>
            </div>
            <div class="col-sm-8 col-md-9  main-sec">
              <div class="row">
                <div class="col-sm-12">
                  <ol class="breadcrumb  dashed-border">
                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo e(url('shop')); ?>">Shop</a></li>
                    <li class="active"><?php echo e($product['sku']); ?></li>
                  </ol>
                </div>
                <!--start of product details-->
                <?php
				   $sku = $product['sku'];
			   $uu = url('product')."?sku=".$sku;
			   $cu = url('add-to-cart')."?sku=".$sku;
			   $wu = url('add-to-wishlist')."?sku=".$sku;
			   $ccu = url('add-to-compare')."?sku=".$sku;
			   $pd = $product['pd'];
			   $description = $pd['description'];
			   $in_stock = $pd['in_stock'];
			   $amount = $pd['amount'];
				  $imggs = $product['imggs'];
				?>
                <div class="col-sm-12 product-details">
                  <div class="row">
                    <div class="col-sm-6">
                      <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
						   <?php
						   for($k = 0; $k < count($imggs); $k++)
						   {
							   $class = $k == 0 ? "item active" : "item";
						   ?>
                           <div class="<?php echo e($class); ?>"><span class="inner-zoom" style="position: relative; overflow: hidden;"><img class="img-responsive" src="<?php echo e($imggs[$k]); ?>" width="700" height="700" alt=""><img src="<?php echo e($imggs[$k]); ?>" class="zoomImg" style="position: absolute; top: -270.367px; left: -6.04768px; opacity: 0; width: 700px; height: 700px; border: none; max-width: none; max-height: none;"></span></div>
					       <?php
						   }
						   ?>
                        </div>
                        <div class="carousel-link clearfix">
						  <?php for($j = 0; $j < count($imggs); $j++): ?>
                          <div data-target="#carousel" data-slide-to="<?php echo e($j); ?>" class="thumb"><img src="<?php echo e($imggs[$j]); ?>" alt="<?php echo e($sku); ?>"></div>
                          <?php endfor; ?>					  
						</div>
                      </div>
                    </div>
                    <div class="col-sm-6 sub-info">
                      <div class="product-name">
                        <h5 class="text-primary text-uppercase"><?php echo e($sku); ?></h5>
                      </div>
                      <div class="product-review">
                        <p><a href="#"><small>Be the first to review this product</small></a></p>
                      </div>
                      <div class="product-description">
                        <h5 class="text-primary text-uppercase">Quick Overview</h5>
                        <p> <?php echo e($description); ?></p>
                      </div>
                      <div class="product-availability in-stock">
                        <p>Availability: <span class="text-info"><?php echo e($in_stock); ?></span></p>
                      </div>
                      <div class="product-price clearfix"> <span class="pull-left btn btn-primary"><strong>&#8358;<?php echo e(number_format($amount, 2)); ?></strong></span> <span class="pull-left btn btn-link"><del>&#8358;<?php echo e(number_format($amount + 1000, 2)); ?></del></span> </div>
                     
                      <div class="product-quantity">
                        <h5 class="text-primary text-uppercase">select quantity</h5>
                        <div class="qty-btngroup clearfix pull-left">
                          <button type="button" class="minus">-</button>
                          <input type="text" value="1">
                          <button type="button" class="plus">+</button>
                        </div>
                        <a href="#" class="btn btn-primary pull-left hvr-underline-from-center-primary">Add To Cart</a> </div>
                    </div>
                  </div>
                  <hr>
                </div>
                
                <!--end of product deatils--> 
                
                <!--start of product data-->
                <div class="col-sm-12 accordion">
                  <div role="tabpanel"> 
                    
                    <!-- Nav tabs -->
                    
                    <ul id="product-tabs" class="nav nav-tabs text-uppercase" role="tablist">
                      <li role="presentation" class="active"><a href="#descreption" aria-controls="descreption" role="tab" data-toggle="tab">Descreption</a></li>
                      <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
                      <li role="presentation"><a href="#tags" aria-controls="tags" role="tab" data-toggle="tab">Add your review</a></li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class=" tab-pane product-pane fade in active clearfix" id="descreption">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ante. Mauris eleifend, quam a vulputate dictum, massa quam dapibus leo, eget vulputate orci purus ut lorem. In fringilla mi in ligula. Pellentesque aliquam quam vel dolor. Nunc adipiscing. Sed quam odio, tempus ac, aliquam molestie, varius ac, tellus. Vestibulum ut nulla aliquam risus rutrum interdum.</p>
                        <p> Pellentesque lorem. Curabitur sit amet erat quis risus feugiat viverra. Pellentesque augue justo, sagittis et, lacinia at, venenatis non, arcu. Nunc nec libero. In cursus dictum risus. Etiam tristique nisl a
                          
                          Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which has since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. </p>
                      </div>
                      <div role="tabpanel" class=" tab-pane product-pane fade in clearfix" id="reviews">
                        <div class="single-review clearfix">
                          <h5 class="text-primary">Aliquam lorem ante <small class=" text-info"><strong>20 minutes ago, 2015</strong></small> </h5>
                          <p><span class="reviews-ratings text-info"><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></p>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                          <hr>
                        </div>
                        <div class="single-review clearfix">
                          <h5 class="text-primary">Client Review <small class=" text-info"><strong>February 18, 2015</strong></small> </h5>
                          <p><span class="reviews-ratings text-info"><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></p>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit nisl in adipiscin</p>
                          <hr>
                        </div>
                        <div class="single-review clearfix">
                          <h5 class="text-primary">Client Review <small class=" text-info"><strong>February 21, 2015</strong></small> </h5>
                          <p><span class="reviews-ratings text-info"><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></p>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit nisl in adipiscin</p>
                          <hr>
                        </div>
                        <div class="single-review clearfix">
                          <h5 class="text-primary">Client Review <small class=" text-info"><strong>March 17, 2015</strong></small> </h5>
                          <p><span class="reviews-ratings text-info"><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></p>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit nisl in adipiscin</p>
                          <hr>
                        </div>
                        <div class="single-review clearfix">
                          <h5 class="text-primary">Client Review <small class=" text-info"><strong>March 17, 2015</strong></small> </h5>
                          <p><span class="reviews-ratings text-info"><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></p>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit nisl in adipiscin</p>
                        </div>
                      </div>
                      <div role="tabpanel" class=" tab-pane product-pane fade in clearfix" id="tags">
                        <form role="form">
                          <fieldset>
                            <h5 class="sub-title text-primary text-uppercase">price</h5>
                            <div class="form-group">
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio1" value="option1" name="radioInline1">
                                <label class="control-label" for="inlineRadio5"> 1 Star</label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio2" value="option2" name="radioInline1">
                                <label class="control-label" for="inlineRadio2"> 2 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio3" value="option3" name="radioInline1">
                                <label class="control-label" for="inlineRadio3"> 3 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio4" value="option4" name="radioInline1">
                                <label class="control-label" for="inlineRadio4"> 4 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio5" value="option5" name="radioInline1">
                                <label class="control-label" for="inlineRadio5"> 5 Stars </label>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                            <h5 class="sub-title text-primary text-uppercase">quality</h5>
                            <div class="form-group">
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio6" value="option6" name="radioInline2">
                                <label class="control-label" for="inlineRadio6"> 1 Star</label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio7" value="option7" name="radioInline2">
                                <label class="control-label" for="inlineRadio7"> 2 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio8" value="option8" name="radioInline2">
                                <label class="control-label" for="inlineRadio8"> 3 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio9" value="option9" name="radioInline2">
                                <label class="control-label" for="inlineRadio9"> 4 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio10" value="option10" name="radioInline2">
                                <label class="control-label" for="inlineRadio10"> 5 Stars </label>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                            <h5 class="sub-title text-primary text-uppercase">value</h5>
                            <div class="form-group">
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio11" value="option11" name="radioInline3">
                                <label class="control-label" for="inlineRadio11"> 1 Star</label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio12" value="option12" name="radioInline3">
                                <label class="control-label" for="inlineRadio12"> 2 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio13" value="option13" name="radioInline3">
                                <label class="control-label" for="inlineRadio13"> 3 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio14" value="option14" name="radioInline3">
                                <label class="control-label" for="inlineRadio14"> 4 Stars </label>
                              </div>
                              <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio15" value="option15" name="radioInline3">
                                <label class="control-label" for="inlineRadio15"> 5 Stars </label>
                              </div>
                            </div>
                          </fieldset>
                          <br>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label class="control-label" for="exampleInputName">Your Name <span class="req">*</span></label>
                                <input type="text" placeholder="" id="exampleInputName" class="form-control txt">
                              </div>
                              <div class="form-group">
                                <label class="control-label" for="exampleInputSummary">Summary <span class="req">*</span></label>
                                <input type="text" placeholder="" id="exampleInputSummary" class="form-control txt">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label" for="exampleInputReview">Review <span class="req">*</span></label>
                                <textarea placeholder="" rows="4" id="exampleInputReview" class="form-control"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="action">
                            <button class="btn btn-primary hvr-underline-from-center-primary">SUBMIT REVIEW</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <!--end of product data--> 
                
                <!--start of related products-->
                <div class="col-sm-12">
                  <div class="row"> 
                    <!--start of big title-->
                    <div class="col-sm-12">
                      <h5 class="sub-title text-primary text-uppercase">related products</h5>
                    </div>
                    <!--end of big title--> 
                    <!--start of product item container-->
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  product-item-container effect-wrap effect-animate">
                      <div class="product-main">
                        <div class="product-view">
                          <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240" alt=""> <img class="top-img" src="images/product-3.jpg" width="215" height="240" alt=""></a></figure>
                          <span class="label offer-label-left">big deal</span> <span class="label offer-label-right">10% sold</span> </div>
                        <div class="product-btns  effect-content-inner">
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                          <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                        </div>
                      </div>
                      <div class="product-info">
                        <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                      </div>
                      <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                      <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                    </div>
                    <!--end of product item container--> 
                    
                    <!--start of product item container-->
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  product-item-container effect-wrap effect-animate">
                      <div class="product-main">
                        <div class="product-view">
                          <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240" alt=""> <img class="top-img" src="images/product-1.jpg" width="215" height="240" alt=""></a></figure>
                          <span class="label offer-label-left">big deal</span> <span class="label offer-label-right">10% sold</span> </div>
                        <div class="product-btns  effect-content-inner">
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                          <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                        </div>
                      </div>
                      <div class="product-info">
                        <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                      </div>
                      <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                      <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                    </div>
                    <!--end of product item container--> 
                    
                    <!--start of product item container-->
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  product-item-container effect-wrap effect-animate">
                      <div class="product-main">
                        <div class="product-view">
                          <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240" alt=""> <img class="top-img" src="images/product-2.jpg" width="215" height="240" alt=""></a></figure>
                          <span class="label offer-label-left">big deal</span> <span class="label offer-label-right">10% sold</span> </div>
                        <div class="product-btns  effect-content-inner">
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                          <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                          <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                        </div>
                      </div>
                      <div class="product-info">
                        <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                      </div>
                      <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                      <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                    </div>
                    <!--end of product item container--> 
                    
                  </div>
                </div>
                <!--end of related products--> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/product.blade.php ENDPATH**/ ?>