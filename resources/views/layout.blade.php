
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="facebook-domain-verification" content="l1zv5af26nl57l9wu9nf2w4kihldv3" />
<meta name="facebook-domain-verification" content="l1zv5af26nl57l9wu9nf2w4kihldv3" />
<meta property="og:description" content="Buy the most glamorous earrings, bracelets, brooches and more from Ace Luxury Store.">
<meta property="og:image" content="{{asset('images/logoo.png')}}">
<meta property="og:url" content="{{url('/')}}">
<meta property="og:type" content="website">
@yield('metas')
<title>@yield('title') | Ace Luxury Store - Online Luxury Fashion Accessories Store in Lagos, Nigeria</title>
<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!-- Ionicons font -->
<link href="{{asset('css/ionicons.min.css')}}" rel="stylesheet">
<!-- Font icons -->
<link rel="stylesheet" href="{{asset('icon-fonts/font-awesome/css/font-awesome.min.css')}}"/><!-- Fontawesome icons css -->
<!-- Bootstrap styles-->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<!--custom styles-->
<link href="{{asset('css/custom.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-pink.css')}}" rel="stylesheet"/>
<link href="{{asset('css/custom-turquoise.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-purple.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-orange.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-blue.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-green.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-red.css')}}" rel="stylesheet" />
<link href="{{asset('css/custom-gold.css')}}" rel="stylesheet" id="style">
<!--tooltiop-->
<link href="{{asset('css/hint.css')}}" rel="stylesheet">
<!-- animation -->
<link href="{{asset('css/animate.css')}}" rel="stylesheet" />
<!--select-->
<link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
<!--color picker-->
<link href="{{asset('css/jquery.simplecolorpicker.css')}}" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<!-- favicon -->

<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" sizes="16x16">

<style type="text/css">
.overlay-effect {
 width: 100%;
 height: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
  z-index: 1000;
  left: 0;
  right: 0;
  opacity: 1;
  transition: .5s ease;
  background-color: rgba(0, 0, 0, 0.7);
  overflow:hidden;
}

#banner {
	
}

</style>
@yield('styles')

<!-- DO NOT EDIT!! start of plugins -->
@foreach($plugins as $p)
  {!! $p['value'] !!}
@endforeach
<!-- DO NOT EDIT!! end of plugins -->

<!--jQuery--> 
<script src="{{asset('js/jquery.min.js')}}"></script> 
<!--SweetAlert--> 
<link href="{{asset('lib/sweet-alert/sweetalert2.css')}}" rel="stylesheet">
<script src="{{asset('lib/sweet-alert/sweetalert2.js')}}"></script>
<!--wow animation--> 
<script src="{{asset('js/wow.min.js')}}"></script> 
<!--Bootstrap js--> 
<script src="{{asset('js/bootstrap.min.js')}}"></script> 
<!--pagination js--> 
<script src="{{asset('js/pagination.js')}}"></script>
<!--custom js--> 
<script src="{{asset('js/custom.js').'?ver='.rand(99,9999)}}"></script> 

</head>
<body>

<!--start of loader-->
<div id="preloader">
  <div id="status"></div>
</div>
<!--end of loader-->

<!--start of top sec-->
<div class="top-sec">
  <nav class="navbar navbar-static-top line-navbar-one">
    <div class="container">
      <div class="navbar-header"> 
        <!-- Top navbar button -->
        <button type="button" class="navbar-toggle collapsed ion-android-menu" data-toggle="collapse" data-target="#line-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <!--<span class="fa fa-ellipsis-v"></span>--> </button>
        <!-- Cart button --> 
        <a class="lno-cart" href="#"> <span class="glyphicon glyphicon-shopping-cart"></span> <span class="cart-item-quantity"></span> </a> 
        <!-- left navbar button -->
        <button class="lno-btn-toggle"> <span class="fa fa-bars"></span> </button>
      </div>
      <div class="row">
	   <script>
		   let gid = getCookie("gid");

		  if(gid){
			  console.log("gid is set");		  
		  }
		  else{
			  console.log("gid is not set");
			  gid = generateRandomString(20);
			  setCookie("gid",gid);
		  }
		  
		  //let ggid = getParameterByName("gid");
		  console.log("gid: ",getCookie('gid'));
		  
         /**		 
		 if(!ggid){
			  let uu = new URL(window.location.href);
			  uu.searchParams.append("gid",gid);
			   window.location =  uu;
		  }
		 **/
	</script>
	  <?php
	  
	  if(is_null($user))
	  {
		$welcomeText = "Welcome to our online store!";
	  }
	  else
	  {
		 $welcomeText = "Welcome back, ".$user->fname."!";
	  }
	  ?>
        <div class="col-sm-4 welcome-msg wmsg hidden-xs">{{$welcomeText}}</div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="col-sm-8 collapse navbar-collapse navbar-right" id="line-navbar-collapse-1">
          <ul class="nav navbar-nav top-menu">
		   <?php
			$cc = (isset($cart)) ? count($cart) : 0;
		   ?>
            <li class="dropdown lnt-shopping-cart visible-lg visible-md"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="ion-bag bag-icn"></span> <span class="cart-item-quantity badge cart-badge" id="cart-badge">{{$cc}}</span> </a>
              <ul role="menu" class="dropdown-menu" id="cart-menu">
                <?php
				for($a = 0; $a < $cc; $a++)
				{
					$item = $cart[$a]['product'];
					$qty = $cart[$a]['qty'];
					$itemAmount = $item['pd']['amount'];
				?>
                <li>
                  <div class="lnt-cart-products text-success"><i class="ion-android-checkmark-circle icon"></i> {{$item['sku']}} <b>x{{$qty}}</b><span class="lnt-cart-total">&#8358;{{number_format($itemAmount * $qty, 2)}}</span> </div>
                </li>
               <?php
			   }
			   ?>
                <li class="lnt-cart-actions text-center"> <a class="btn btn-default btn-lg hvr-underline-from-center-default" href="{{url('cart')}}">View cart</a> <a class="btn btn-primary hvr-underline-from-center-primary" href="{{url('checkout')}}">Checkout</a> </li>
              </ul>
            </li>
			 <li><a href="{{url('orders')}}">Orders</a></li>
           @if(is_null($user))
            <li><a class="login" href="javascript:void(0)" data-toggle="modal" data-target="#login-box"> my account</a></li>
		   @else
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
		   @endif
		
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More <span class="ion-android-arrow-dropdown"></span></a>
			   
              <ul class="dropdown-menu" role="menu">
			  <li><a href="{{url('reviews')}}">Reviews</a></li>
                <li> <a href="javascript:void(0)">NGN <span class="ion-checkmark"></span></a></li>
                <li> <a href="javascript:void(0)"><img width="16" height="12" alt="" src="images/ng.png"> <span class="ion-checkmark"></span></a></li>
              </ul>
            </li>
			
			@if(!is_null($user))
			<li><a href="{{url('signout')}}">Sign out</a></li>
			@endif
          </ul>
          <form class="navbar-form navbar-left lno-search-form visible-xs" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-xs btn-search"><span class="fa fa-search"></span></button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <div class="line-navbar-left">
    <p class="lnl-nav-title">Categories</p>
    <ul class="lnl-nav">
      <!-- The list will be automatically cloned from mega menu via jQuery -->
    </ul>
  </div>
</div>
<!--end of top sec--> 

<!--start of content wrap (This is necessary for the menu effect)-->
<div class="content-wrap" data-effect="lnl-push"> 
  
  <!--start of header-->
  <header>
    <div class="container">
      <div class="row"> <!--start of logo-->
        
        <!--end of logo--> <!--start of features-->
        <div class="col-sm-12 col-md-5 col-lg-5 feature hidden-xs">
          <div class="row">
            <div class="col-sm-12 feature-box ion-chatbubble-working">
              <dl  class="text-primary text-capitalize">
                <dt>Online Support</dt>
                <dd class="text-muted">24/7 if you need any help</dd>
              </dl>
            </div>
          </div>		  
        </div>
		<div class="col-sm-12 col-md-2 col-lg-2 ">
		   <a href="{{url('/')}}" class="navbar-brand"></a>
		</div>
		<div class="col-sm-12 col-md-5 col-lg-5 feature hidden-xs">
          <div class="row pull-right">
			<div class="col-sm-12 feature-box ion-lock-combination">
              <dl  class="text-primary text-capitalize">
                <dt>Secure Payment</dt>
                <dd class="text-muted">We don't store your details</dd>
              </dl>
            </div>
          </div>
        </div>
        <!--end of features--> 
      </div>
    </div>
  </header>
  <!--end of header--> 
  <?php
 
  $special = ['hot' => "rings", 'popular' => "earrings", 'trending' => "bracelets"];
  ?>
  <!-- strat of navigation -->
  <nav class="navbar navbar-default navbar-static-top line-navbar-two">
    <div class="container"> 
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="line-navbar-collapse-2">
        <ul class="nav navbar-nav lnt-nav-mega">
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="fa fa-dot-circle-o"></span> Categories <span class="ion-android-arrow-dropdown"></span> </a>
            <div class="dropdown-menu" role="menu">
              <div class="lnt-dropdown-mega-menu"> 
                <!-- List of categories -->
                <ul class="lnt-category list-unstyled">
				<?php
				 $i = 0;
				 if(is_array($c) && count($c) > 0)
				 {
				 foreach($c as $cc)
				 {
					 $ccu = url('shop')."?category=".$cc['category'];
					 #$ccu = "javascript:void(0)";
					 $catt = ucwords($cc['category']);
					 #$catt = "Category";
					 $cl = ($i == 0) ? ' class="active"' : '';
					 ++$i;
					 $spp = "";
					 
					 if($cc['special'] == "hot" || $cc['special'] == "special" || $cc['special'] == "trending")
					 {
						 if($cc['special'] == "hot") $spp = '<span class="label label-danger">Hot</span></a>';
						 if($cc['special'] == "special") $spp = '<span class="label label-info">Popular</span></a>';
						 if($cc['special'] == "trending") $spp = '<span class="label label-primary">Trending</span></a>';
					 }
					 
				?>
                  <li{{$cl}}><a href="{{$ccu}}">{{$catt}} {!!$spp!!}</a></li>
				<?php
				 }
				 }
				 else 
				 {
				?>
				<li>Categories</li>
				<?php
				 }
				?>
                </ul>
                <!-- Subcategory and carousel wrap -->
                <div class="lnt-subcategroy-carousel-wrap container-fluid">
				<?php
				 $i = 0;
				 foreach($c as $key => $value)
				 {
					 $dl = ($i == 0) ? ' class="active"' : '';
					 ++$i;
			    ?>
                  <div id="{{$key}}"{{$dl}}> 
                    <!-- Sub categories list-->
                    <div class="lnt-subcategory col-sm-8 col-md-8">
                      <h3 class="lnt-category-name text-info text-uppercase">{{$key}}</h3>
					 
                      <section class="col-sm-12">
					  	
                      </section>
                     
                    </div>
                    <!-- Carousel -->
                    <div class="col-sm-4 col-md-4">
                      <div id="carousel-category-home" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-category-home" data-slide-to="0" class=""></li>
                          <li data-target="#carousel-category-home" data-slide-to="1" class="active"></li>
                          <li data-target="#carousel-category-home" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                          <div class="item active"><img src="{{asset('images/nav-img-1.jpg')}}" width="296" height="400" alt="Slide image"/></div>
                          <div class="item"> <img src="{{asset('images/nav-img-1.jpg')}}" width="296" height="400" alt="Slide image"/> </div>
                          <div class="item"> <img src="{{asset('images/nav-img-1.jpg')}}" width="296" height="400" alt="Slide image"/> </div>
                        </div>
                      </div>
                    </div>
                  </div>
				  <?php
				   }
				   $nau = url('shop')."?type=new-arrivals";
				   $bsu = url('shop')."?type=best-sellers";
				  ?>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <ul class="nav navbar-nav main-nav">
		 <?php
		   $cccc = [
	    ['name' => "earrings",'url' => url('shop')."?category=earrings"],
	    ['name' => "brooches",'url' => url('shop')."?category=brooches"],
	    ['name' => "rings",'url' => url('shop')."?category=rings"]
	    ];
		 ?>
          <li class="active"><a href="{{url('/')}}" class="ion-ios-home"> HOME</a></li>
          <li><a href="{{$nau}}">NEW ARRIVALS</a></li>
		  @foreach($cccc as $xc)
          <li><a href="{{$xc['url']}}">{{strtoupper($xc['name'])}}</a></li>
		  @endforeach
          <li><a href="{{url('contact')}}">CONTACT</a></li>
        </ul>
        <ul class="nav navbar-nav visible-xs">
          <li><a href="{{url('/')}}">Home</a></li>
        </ul>
        <form class="navbar-form navbar-right lnt-search-form" action="{{url('search')}}" role="search">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-btn lnt-search-category">
                <button type="button" class="btn btn-default dropdown-toggle selected-category-btn" data-toggle="dropdown" aria-expanded="false"> <span class="selected-category-text">All </span> <span class="ion-android-arrow-dropdown"></span> </button>
                <ul class="dropdown-menu " role="menu">
				@foreach($c as $key => $value)
                  <li><a href="#">{{ucwords($key)}}</a></li>
				@endforeach         
                </ul>
              </div>
              <input type="text" class="form-control lnt-search-input" name="q" aria-label="Search" placeholder="Find Your Product">
            </div>
          </div>
          <div class="lnt-search-suggestion">
            
          </div>
          <button type="submit" class="btn btn-xs btn-search"><span class="ion-android-search"></span></button>
        </form>
      </div>
    </div>
  </nav>
  <!-- end of navigation --> 
  
   <!--------- Cookie consent-------------->
        	<?php //@include('cookie-consent') ?>
        
        <!--------- Session notifications-------------->
        	<?php
               $pop = ""; $val = "";
               
               if(isset($signals))
               {
                  foreach($signals['okays'] as $key => $value)
                  {
                    if(session()->has($key))
                    {
                  	$pop = $key; $val = session()->get($key);
                    }
                 }
              }
              
             ?> 

                 @if($pop != "" && $val != "")
                   @include('session-status',['pop' => $pop, 'val' => $val])
                 @endif
        	<!--------- Input errors -------------->
                    @if (isset($errors) && count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif 
  
  
 @yield('content')
 

    
  </div>
  <!--end of middle sec--> 
  
  <!--start of btm sec-->
  <div class="btm-sec">
    <footer>
      <div class="footer-top wow fadeIn" data-wow-offset="10" data-wow-duration="2s">
        <div class="container">
          <div class="row">
            <div class="col-xs-8 col-sm-9">
              <h4><i class="ion-android-phone-portrait icon text-info"></i><span class="text-uppercase text-primary">Ace Luxury Store - Exquisite Fashion For You</span></h4>
            </div>
            <div class="col-xs-4 col-sm-3"> <a href="javascript:void(0)" class="btn btn-default btn-block hvr-underline-from-center-default pull-right">Shop now</a> </div>
          </div>
        </div>
      </div>
      <div class="footer-middle wow fadeIn" data-wow-offset="40" data-wow-duration="2s">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <h5 class="text-info text-uppercase">useful pages</h5>
              <ul class="list-unstyled nudge">
                <li><a href="{{url('about')}}">About us</a> </li>
                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a> </li>
                <li><a href="{{url('returns')}}">Return Policy</a> </li>
                <li><a href="{{url('faq')}}">FAQ</a> </li>
                <li><a href="{{url('contact')}}">Contact us</a> </li>
              </ul>
              <hr class="hidden-md hidden-lg hidden-sm">
            </div>
            <div class="col-md-3 col-sm-6">
              <h5 class="text-info text-uppercase">Categories</h5>
              <ul class="list-unstyled nudge">
			  <?php
			  foreach($c as $cc){
				   $ccu = url('shop')."?category=".$cc['category'];
					 #$ccu = "javascript:void(0)";
					 $catt = ucwords($cc['category']);
					 #$catt = "Category";
			  ?>
                <li><a href="{{$ccu}}">{{$catt}}</a> </li>
			  <?php
			  }
			  ?>
              </ul>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="text-info text-uppercase">Get the news</h5>
                  <p class="text-muted">Subscribe for updates on our latest arrivals</p>
                  <form action="{{url('subscribe')}}" method="post" id="newsletter">
					  {!! csrf_field() !!}
                    <div>
                      <input type="text" name="email" id="newsletter-mail" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" autocomplete="off">
                      <button type="submit" title="Subscribe" class="btn btn-primary pull-right"><span>Subscribe</span></button>
                    </div>
                  </form>
                  <hr>
                </div>
                <div class="col-sm-12">
                  <h5 class="text-info text-uppercase">Stay in touch</h5>
                  <ul class="list-inline social clearfix">
                    <li class="col-sm-6 facebook"><a href="https://www.facebook.com/aceluxurystore"> <span><i class="ion-social-facebook"></i></span>
                      <p>160</p>
                      </a></li>
                    <li class="col-sm-6 googleplus"><a href="https://www.instagram.com/aceluxurystore"> <span><i class=" ion-social-instagram"></i></span>
                      <p>1597</p>
                      </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-btm wow fadeIn" data-wow-offset="50" data-wow-duration="2s">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <p class="pull-left">&copy; {{date("Y")}} Allrights reserved <a class="external" href="{{url('/')}}">Ace Luxury Store</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
	<div class="whatsapp-btn">
	  <a href="javascript:void(0)" data-toggle="modal" data-target="#whatsapp-box" class="btn btn-sm btn-primary">Need help? <b>Chat with us</b></a>
	  <a href="javascript:void(0)" data-toggle="modal" data-target="#whatsapp-box">
	    <span><i class="ion-social-whatsapp"></i></span>
	  </a>
	</div>
  </div>
  <!--end of btm sec--> 
  
  <!--start of login box-->
  <div class="modal fade" id="login-box" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-primary text-uppercase" id="loginboxLabel" >login your account</h4>
        </div>
        <div class="modal-body">
          <ul class="list-inline row">
            <li class="col-sm-6"> <a href="#" class="btn btn-block btn-facebook  " ><i class="ion-social-facebook"></i></a> </li>
            <li class="col-sm-6"> <a href="#" class="btn btn-block btn-google" ><i class="ion-social-google"></i></a></li>
          </ul>
          <hr>
          <form method="post" id="login-form" action="{{url('login')}}" accept-charset="UTF-8">
		   {!! csrf_field() !!}
		   <input type="hidden" id="href" value="">
		   <script>
		     document.querySelector('#href').value = document.location.href;
		   </script>
            <div class=" form-group">
              <label class="control-label" for="login-name">Email address or phone number</label>
              <input type="text" class="form-control" value="" name="id" id="login-name" required>
            </div>
            <div class="form-group">
              <label class="control-label text-uppercase" for="login-password">Your password</label>
              <input type="password" class="form-control" value="" name="pass" id="login-password" required>
            </div>
            <div class="checkbox">
              <input type="checkbox" id="logincheckbox" value="option1" name="remember">
              <label for="logincheckbox"> Remember me </label>
            </div>
            <button class="btn btn-block btn-primary hvr-underline-from-center-primary" id="login-submit" type="submit">login</button>
          </form>
        </div>
        <div class="modal-footer">
          <p class="text-center"><small>Forget your password? <a href="#">We can help!</a></small></p>
        </div>
      </div>
    </div>
  </div>
  <!--end of login box--> 

  <!--start of whatsapp box-->
  <div class="whatsapp-box modal fade" id="whatsapp-box" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="tw">&times;</span></button>
          <h4 class="modal-title tw text-uppercase" id="loginboxLabel" >start a conversation</h4>
		  <h6 class="tw">Click one any of numbers listed beow to chat on Whatsapp:</h6>
        </div>
        <div class="modal-body">
          <ul class="list-inline row">
            <li class="col-sm-12"> <a href="https://wa.me/2348097039692" target="_blank" class="btn btn-block " ><i class="ion-social-whatsapp"></i> Customer Support</a> </li>
          </ul>
        </div>
        <div class="modal-footer">
          <p class="text-center"><small>The team usually reply in a few minutes</small></p>
        </div>
      </div>
    </div>
  </div>
  <!--end of whatsapp box--> 
  
  <!-- hidden toggle for cart success box -->
  <a href="javascript:void(0)" data-toggle="modal" id="csb-toggle" data-target="#cart-successful-box"></a>
  
  <!--start of cart successful box-->
  <div class="modal fade" id="cart-successful-box" tabindex="-1" role="dialog" aria-labelledby="cartSuccessfulLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="tw">&times;</span></button>
          <h4 class="modal-title tw text-uppercase" id="cartSuccessfulLabel" >start a conversation</h4>
		  <h6 class="tw">Added to cart!</h6>
        </div>
        <div class="modal-body">
          <ul class="list-inline row">
            <li class="col-sm-12"> <a href="https://wa.me/2348097039692" target="_blank" class="btn btn-block " ><i class="ion-social-whatsapp"></i> Customer Support</a> </li>
          </ul>
        </div>
        <div class="modal-footer">
          <p class="text-center"><small>The team usually reply in a few minutes</small></p>
        </div>
      </div>
    </div>
  </div>
  <!--end of cart successful box--> 
  
  <!--start of quick view box-->
  <div class="modal fade" id="quick-view-box" tabindex="-1" role="dialog" aria-labelledby="quickviewboxLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-primary text-uppercase" id="quickviewboxLabel">product sku</h4>
        </div>
        <div class="modal-body product-details">
          <div class="row">
            <div class="col-sm-7"> <img id="quickviewboxImg" class="img-responsive" src="{{asset('images/p-details-z-1.jpg')}}" width="700" height="700"  alt=""/> </div>
            <div class="col-sm-5 sub-info">
              <div class="product-review">
                <p><span class="text-info"><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i><i class="ion-android-star-outline"></i></span> <span class="pull-right"><small>8 Reviews</small></span> </p>
              </div>
			    
				
              <div class="product-description">
                <h5 class="text-primary text-uppercase">Quick Overview</h5>
                <p id="quickviewboxDescription"> Product description goes here</p>
              </div>
              <div class="product-availability in-stock">
                <p>Availability: <span class="text-info" id="quickviewboxInStock"></span></p>
              </div>
              <div class="product-price clearfix"> <span class="pull-left btn btn-primary"><strong>&#8358;<span id="quickviewboxAmount">0.00</span></strong></span> </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <ul class="soc pull-left">
            <li><a class="soc-twitter" href="#"></a></li>
            <li><a class="soc-facebook" href="#"></a></li>
            <li><a class="soc-whatsapp soc-icon-last" href="#"></a></li>
          </ul>
          <button class="btn btn-default hvr-underline-from-center-default">full details</button>
          <button type="button" class="btn btn-primary hvr-underline-from-center-primary" >add to cart</button>
        </div>
      </div>
    </div>
  </div>
  <!--end of quick view box--> 
  
    <!--start of checkout box-->
  <div class="checkout-modal modal fade" id="checkout-modal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="tw">&times;</span></button>
          <h4 class="modal-title tw text-uppercase" id="checkoutModalLabel" >start a conversation</h4>
		  <h6 class="tw">Click one any of numbers listed beow to chat on Whatsapp:</h6>
        </div>
        <div class="modal-body">
          <a href="javascript:void(0)" onclick="payCard(); return false;" class="btn btn-block btn-primary" ><i class="ion-card"></i> Continue to make payment</a> 
        </div>
        <div class="modal-footer">
          <p class="text-center" style="color: red; font-weight: bold; font-size: 1.1em;"><small>NOTE: Kindly note your referrence number in case of any unforeseen issues with this transaction</small></p>
        </div>
      </div>
    </div>
  </div>
  <!--end of checkout box--> 
  
</div>
<!--end of content wrap--> 

<!--Start of go to top--> 
<a href="#0" class="cd-top"></a> 
<!--end of go to top--> 

<!--start of js--> 

@yield('scripts')

<!--style switcher--> 
<script src="{{asset('js/style-switcher.js')}}"></script> 
<!--switches--> 
<script src="{{asset('js/switches.js')}}"></script> 
<!--slick carousel--> 
<script src="{{asset('js/slick.js')}}"></script> 
<!--navigation js--> 
<script src="{{asset('js/jquery.highlight.js')}}"></script> 
<script src="{{asset('js/jquery.touchSwipe.min.js')}}"></script> 
<!--<script src="js/line.js"></script>--> 
<!--scrollbar js--> 
<script src="{{asset('js/nicescroll.js')}}"></script> 
<script src="{{asset('js/jquery.nicescroll.plus.js')}}"></script> 
<!--countdown counter--> 
<script src="{{asset('js/countdown.js')}}"></script> 
<!--color picker--> 
<script src="{{asset('js/jquery.simplecolorpicker.js')}}"></script> 
<!--image zoom--> 
<script src="{{asset('js/jquery.zoom.js')}}"></script> 
<!--go to top--> 
<script src="{{asset('js/to-top.js')}}"></script> 
<!--product items counter--> 
<script src="{{asset('js/jquery.charactercounter.js')}}"></script> 
<!--select--> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
<!--price range slider--> 
<script src="{{asset('js/bootstrap-slider.js')}}"></script> 
<!--animated particles--> 
<script src="{{asset('js/jquery.particleground.js')}}"></script> 
<!--masonry--> 
<script src="{{asset('js/salvattore.js')}}"></script> 
<!--tab collapse--> 
<script src="{{asset('js/bootstrap-tabcollapse.js')}}"></script> 


<!--end of js-->
</body>
</html>
