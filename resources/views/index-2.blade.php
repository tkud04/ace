@extends('layout')

@section('title',"Welcome")

@section('content')
 
 @include('banner')
  
  <!--start of middle sec-->
  <div class="middle-se"> 
    
    <!--start of wide ad-->
    <section class="container">
      <div class="row">
        <div class="col-sm-12 wide-ad">
          <figure class="effect-layla"> <img class="img-responsive hidden-xs" src="images/wide-ad-img.gif" width="1920" height="275" alt=""/>
          <img class="img-responsive visible-xs" src="images/wide-ad-img-small.png" width="1920" height="275" alt=""/>
            <figcaption>
              <h2>Enjoy our <span>free shipping</span> for any order</h2>
              <p>Maecenas nec odio et ante tincidunt tempus</p>
              <a href="#">View more</a> </figcaption>
          </figure>
        </div>
      </div>
    </section>
    <!--end of wide ad--> 
	<br><br>
	    <!--start of ad-boxes-->
    <section class="container">
      <div class="row">
	  <?php
	  $cc = [
	         ['name' => "<span>watches</span>",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
	         ['name' => "<span>ear</span>rings",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
	         ['name' => "<span>brace</span>lets",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
	         ['name' => "<span>anklets</span>",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
	         ['name' => "<span>brooches</span>",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
	         ['name' => "<span>neck</span>laces",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
	         ['name' => "<span>rings</span>",'copy' => "Maecenas nec odio et ante tincidunt tempus",'url' => "#"],
			];
	  $ccBackgrounds = ["images/ad-box-1.jpg","images/ad-box-2.jpg","images/ad-box-3.jpg"];
	    shuffle($cc);
		
		for($i = 0; $i < 3; $i++)
		{
			$ccc = $cc[$i];
			$cu = url($ccc['url']);
	  ?>
       
        <div class="col-sm-12 col-md-4 ad-box-outer">
          <div class="small-ad">
            <figure class="effect-layla"><img class="img-responsive" src="{{$ccBackgrounds[$i]}}" width="370" height="200" alt=""/>
              <figcaption>
                <h3>{!! $ccc['name'] !!}</h3>
                <p>{{ $ccc['copy'] }}</p>
                <span class="start-price hvr-underline-from-center-primary"><a class="text-white" href="{{$cu}}">shop now</a> </span></figcaption>
            </figure>
          </div>
        </div>
		<?php
		}
		?>
      </div>
    </section>
    <!--end of ad-boxes--> 
    <!--start of new arrivals-->
    <section class="container">
      <div class="row"> 
        <!--start of big title-->
        
        <div class="col-sm-12 big-title text-uppercase text-center">
          <h3 class="text-primary">new arrivals</h3>
          <small>be the first to get them</small>
          <p><span class="ion-android-star-outline"></span></p>
        </div>
        <!--end of big title-->
        <div class="col-sm-12">
          <div id="products" class="row">
		  <?php
		   foreach($na as $n)
		   {
			   $sku = $n['sku'];
			   $uu = url('product')."?sku=".$sku;
			   $cu = url('add-to-cart')."?sku=".$sku."&qty=1";
			   $wu = url('add-to-wishlist')."?sku=".$sku;
			   $ccu = url('add-to-compare')."?sku=".$sku;
			   $pd = $n['pd'];
			   $description = $pd['description'];
			   $in_stock = $pd['in_stock'];
			   $amount = $pd['amount'];
			   $imggs = $n['imggs'];
			    
		  ?>
		    <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="{{$uu}}"><img class="btm-img" src="{{$imggs[0]}}" width="215" height="240"  alt=""/> <img class="top-img" src="{{$imggs[1]}}" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="{{$cu}}" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="{{$wu}}" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="{{$ccu}}" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon">
		   <a data-toggle="modal" data-target="#quick-view-box" onclick="populateQV('{{$sku}}','{{$description}}','{{$amount}}','{{$amount + 1000}}','{{ucwords($in_stock)}}','{{$imggs[0]}}')" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a>
							  </p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="{{$uu}}">{{$sku}}</a></h3>
                            <p class="group inner list-group-item-text">{{$description}}</p>
                            <div class="product-price"><span class="real-price text-info"><strong>&#8358;{{number_format($amount,2)}}</strong></span> <span class="old-price">&#8358;{{number_format($amount + 1000,2)}}</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container-->
			<?php
			}
			?>
		  </div>
        </div>
      </div>
    </section>
    <!--end of new arrivals--> 

    <!--start of brands-->
    <section class="container" data-speed="6">
      <div class="row"> 
        <!--start of big title-->
        <div class="col-sm-12 big-title text-uppercase text-center">
          <h3 class="text-primary">our brands</h3>
          <small>Maecenas nec odio et ante tincidunt tempus</small>
          <p><span class="ion-android-star-outline"></span></p>
        </div>
        <!--end of big title-->
        <div id="brands" class="col-sm-12 opacity-eff wow fadeIn" data-wow-offset="10" data-wow-duration="2s">
          <div><a  href="#">
            <figure><img  src="images/brand-1.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-2.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-3.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-4.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-5.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-1.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-2.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-3.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-4.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
          <div><a  href="#">
            <figure><img src="images/brand-5.jpg" width="200" height="100" alt=""/></figure>
            </a></div>
        </div>
      </div>
    </section>
    <!--end of brands--> 
    
    <!--start of parallax subscribtion-->
    <div id="parallax" class="" data-speed="4">
      <section class="container">
        <div class="row">
          <div class="subscribe col-sm-12">
            <h3><span>lookbook sunglasses</span> <small>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus</small> </h3>
            <div class="subscribe-icn"> <a class="btn btn-primary hvr-underline-from-center-primary" href="#">Discover Now</a> </div>
          </div>
        </div>
      </section>
    </div>
    
    <!--end of parallax subscribtion--> 
    
    <!--start of best selling-->
    <section class="container" data-speed="2">
      <div class="row"> 
        <!--start of big title-->
        <div class="col-sm-12 big-title text-uppercase text-center">
          <h3 class="text-primary">best selling</h3>
          <small>Maecenas nec odio et ante tincidunt tempus</small>
          <p><span class="ion-android-star-outline"></span></p>
        </div>
        <!--end of big title-->
        <div class="col-sm-12">
          <ul class="row list-inline best-selling wow fadeIn" data-wow-offset="10" data-wow-duration="2s">
            <li class="col-sm-6 col-md-4">
              <div>
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <figure><img class="img-responsive" src="images/s-1.jpg" width="200" height="230" alt=""/></figure>
                  </div>
                  <div class="col-sm-6 col-md-8">
                    <h3 class="product-name"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <div class="product-price"> <span class="real-price text-info"><strong>$600</strong></span> <span class="old-price"><del>$790</del></span> </div>
                    <div class="product-evaluate text-info"><span><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></div>
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-6 col-md-4">
              <div>
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <figure><img class="img-responsive" src="images/s-2.jpg" width="200" height="230" alt=""/></figure>
                  </div>
                  <div class="col-sm-6 col-md-8">
                    <h3 class="product-name"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <div class="product-price"> <span class="real-price text-info"><strong>$600</strong></span> <span class="old-price"><del>$790</del></span> </div>
                    <div class="product-evaluate text-info"><span><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span> </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-6 col-md-4">
              <div>
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <figure><img class="img-responsive" src="images/s-3.jpg" width="200" height="230" alt=""/></figure>
                  </div>
                  <div class="col-sm-6 col-md-8">
                    <h3 class="product-name"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <div class="product-price"> <span class="real-price text-info"><strong>$600</strong></span> <span class="old-price"><del>$790</del></span> </div>
                    <div class="product-evaluate text-info"><span><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></div>
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-6 col-md-4">
              <div>
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <figure><img class="img-responsive" src="images/s-4.jpg" width="200" height="230" alt=""/></figure>
                  </div>
                  <div class="col-sm-6 col-md-8">
                    <h3 class="product-name"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <div class="product-price"> <span class="real-price text-info"><strong>$600</strong></span> <span class="old-price"><del>$790</del></span> </div>
                    <div class="product-evaluate text-info"><span><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span></div>
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-6 col-md-4">
              <div>
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <figure><img class="img-responsive" src="images/s-5.jpg" width="200" height="230" alt=""/></figure>
                  </div>
                  <div class="col-sm-6 col-md-8">
                    <h3 class="product-name"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <div class="product-price"> <span class="real-price text-info"><strong>$600</strong></span> <span class="old-price"><del>$790</del></span> </div>
                    <div class="product-evaluate text-info"><span><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span> </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-6 col-md-4">
              <div>
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <figure><img class="img-responsive" src="images/s-6.jpg" width="200" height="230" alt=""/></figure>
                  </div>
                  <div class="col-sm-6 col-md-8">
                    <h3 class="product-name"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <div class="product-price"> <span class="real-price text-info"><strong>$600</strong></span> <span class="old-price"><del>$790</del></span> </div>
                    <div class="product-evaluate text-info"><span><i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star"></i> <i class="ion-android-star-half"></i></span> </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <!--end of best selling--> 
	
	
	<!--start of latest from the blog-->
    
    <section class="container">
      <div class="row"> 
        <!--start of big title-->
        <div class="col-sm-12 big-title text-uppercase text-center">
          <h3 class="text-primary">from the blog</h3>
          <small>Maecenas nec odio et ante tincidunt tempus</small>
          <p><span class="ion-android-star-outline"></span></p>
        </div>
        <!--end of big title-->
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <div class="thumbnail">
                <figure><a href="post-details.html"><img class="img-responsive" src="images/general-3.jpg" width="1024" height="683"  alt=""/></a></figure>
                <div class="caption">
                  <h4 class="text-uppercase"><a href="post-details.html">Aenean imperdiet. Etiam ultricies nisi vel</a></h4>
                  <div class="blog-info">
                    <p class="text-muted"><span>By <a href="#">WebyZona</a> / In: <a href="#">Fashion</a> / <a href="#">3 Comments</a></span></p>
                  </div>
                  <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet</p>
                  <hr>
                  <a href="post-details.html" class="btn btn-primary hvr-underline-from-center-primary">read more</a> </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="thumbnail">
                <figure><a href="post-details.html"><img class="img-responsive" src="images/blog-img-2.jpg" width="800" height="532"  alt=""/></a></figure>
                <div class="caption">
                  <h4 class="text-uppercase"><a href="post-details.html">Donec pede justo, fringilla vel aliquet nec</a></h4>
                  <div class="blog-info">
                    <p class="text-muted"><span>By <a href="#">WebyZona</a> / In: <a href="#">Fashion</a> / <a href="#">3 Comments</a></span></p>
                  </div>
                  <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet</p>
                  <hr>
                  <a href="post-details.html" class="btn btn-primary hvr-underline-from-center-primary">read more</a> </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="thumbnail">
                <figure><a href="post-details.html"><img class="img-responsive" src="images/blog-img-3.jpg" width="1024" height="683"  alt=""/></a></figure>
                <div class="caption">
                  <h4 class="text-uppercase"><a href="post-details.html">Aenean leo ligula porttitor eu consequat vitae</a></h4>
                  <div class="blog-info">
                    <p class="text-muted"><span>By <a href="#">WebyZona</a> / In: <a href="#">Fashion</a> / <a href="#">3 Comments</a></span></p>
                  </div>
                  <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet</p>
                  <hr>
                  <a href="post-details.html" class="btn btn-primary hvr-underline-from-center-primary">read more</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!--end of blatest from the blogs--> 
    
@stop