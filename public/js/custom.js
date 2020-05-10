$(document).ready(function() {
    "use strict";
    $(window).load(function() {
        $("#status").delay(350).fadeOut(),
        $("#preloader").delay(350).fadeOut("slow");
		
		
        $("#bname-other").hide();
		
		/**
		getCart()
		.then(res => {
			console.log("getCart(): ",res);
		})
		.catch(err =>{
			console.log("err: ",err);
		});
		**/
    }),
    $(".colors-panel").styleSwitcher({
        useCookie: !0
    }),
    $("#switcher").on("click", function() {
        jQuery(this).hasClass("hide-panel") ? (jQuery(".switcher-container").css({
            left: 0
        }),
        jQuery("#switcher").removeClass("hide-panel").addClass("show-panel")) : jQuery(this).hasClass("show-panel") && (jQuery(".switcher-container").css({
            left: "-50px"
        }),
        jQuery("#switcher").removeClass("show-panel").addClass("hide-panel"))
    }),
    $(".dropdown").on("mouseover", function() {
        $(this).find(".dropdown-menu").first().stop(!0, !0).delay(200).slideDown()
    }),
    $(".dropdown").on("mouseout", function() {
        $(this).find(".dropdown-menu").first().stop(!0, !0).delay(100).slideUp()
    }),
    $("html").niceScroll({
        styler: "fb",
        zindex: "9998"
    }),
    $("#banner").slick({
        centerMode: !1,
        autoplay: !0,
        infinite: !0,
        arrows: !0,
        dots: !0,
        fade: !0,
        slidesToShow: 1,
        centerPadding: "0px",
        responsive: [{
            breakpoint: 1e3,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: !0,
                arrows: !1
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: !0,
                arrows: !1,
                dots: !0
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: !0,
                arrows: !1,
                dots: !1
            }
        }]
    }),
    $("#best-deals").slick({
        centerMode: !1,
        slidesToShow: 4,
        autoplay: !1,
        arrows: !0,
        dots: !1,
        centerPadding: "5px",
        cssEase: "ease-in-out",
        responsive: [{
            breakpoint: 1e3,
            settings: {
                slidesToShow: 3,
                autoplay: !0,
                slidesToScroll: 1,
                infinite: !0,
                arrows: !1
            }
        }, {
            breakpoint: 768,
            settings: {
                autoplay: !0,
                infinite: !0,
                arrows: !1,
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 480,
            settings: {
                arrows: !1,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    }),
    $("#brands").slick({
        centerMode: !1,
        autoplay: !0,
        infinite: !0,
        speed: 300,
        dots: !1,
        arrows: !1,
        slidesToShow: 5,
        slidesToScroll: 5,
        cssEase: "ease-in-out",
        responsive: [{
            breakpoint: 1e3,
            settings: {
                centerMode: !1,
                centerPadding: "5px",
                slidesToShow: 3,
                slidesToScroll: 3
            }
        }, {
            breakpoint: 768,
            settings: {
                centerMode: !1,
                centerPadding: "5px",
                slidesToShow: 2
            }
        }, {
            breakpoint: 480,
            settings: {
                centerMode: !1,
                slidesToShow: 1
            }
        }]
    }),
    $(".flip").on("click", function() {
        $(this).find(".card").toggleClass("flipped")
    }),
    $('select[name="colorpicker-bootstrap3-form"]').simplecolorpicker({
        theme: "ionicons"
    }),
    $("#list").on("click", function(e) {
        e.preventDefault(),
        $("#products .product-item-container").addClass("list-group-item-list")
    }),
    $("#grid").on("click", function(e) {
        e.preventDefault(),
        $("#products .product-item-container").removeClass("list-group-item-list").addClass("grid-group-item")
    }),
    $("#carousel").carousel({
        pause: !0,
        interval: !1
    }),
    $("#new-items").tab().tabCollapse().tab().tabCollapse(),
    $("#men .product-item-container").slice(0, 8).show(),
    $("#men .load-more a").on("click", function(e) {
        e.preventDefault(),
        $("#men .product-item-container:hidden").slice(0, 4).show(),
        0 == $("#men .product-item-container:hidden").length && ($("#men .load-less").show(),
        $("#men .load-more").hide())
    }),
    $("#men .load-less a").on("click", function(e) {
        e.preventDefault();
        var o = $("#men .product-item-container").length;
        $("#men .product-item-container").slice(8, o).hide(),
        $("#men .load-less").hide(),
        $("#men .load-more").show()
    }),
    $("#women .product-item-container").slice(0, 8).show(),
    $("#women .load-more a").on("click", function(e) {
        e.preventDefault(),
        $("#women .product-item-container:hidden").slice(0, 4).show(),
        0 == $("#women .product-item-container:hidden").length && ($("#women .load-less").show(),
        $("#women .load-more").hide())
    }),
    $("#women .load-less a").on("click", function(e) {
        e.preventDefault();
        var o = $("#women .product-item-container").length;
        $("#women .product-item-container").slice(8, o).hide(),
        $("#women .load-less").hide(),
        $("#women .load-more").show()
    }),
    $("#children .product-item-container").slice(0, 8).show(),
    $("#children .load-more a").on("click", function(e) {
        e.preventDefault(),
        $("#children .product-item-container:hidden").slice(0, 4).show(),
        0 == $("#children .product-item-container:hidden").length && ($("#children .load-less").show(),
        $("#children .load-more").hide())
    }),
    $("#children .load-less a").on("click", function(e) {
        e.preventDefault();
        var o = $("#children .product-item-container").length;
        $("#children .product-item-container").slice(8, o).hide(),
        $("#children .load-less").hide(),
        $("#children .load-more").show()
    }),
    $("#accessories .product-item-container").slice(0, 8).show(),
    $("#accessories .load-more a").on("click", function(e) {
        e.preventDefault(),
        $("#accessories .product-item-container:hidden").slice(0, 4).show(),
        0 == $("#accessories .product-item-container:hidden").length && ($("#accessories .load-less").show(),
        $("#accessories .load-more").hide())
    }),
    $("#accessories .load-less a").on("click", function(e) {
        e.preventDefault();
        var o = $("#accessories .product-item-container").length;
        $("#accessories .product-item-container").slice(8, o).hide(),
        $("#accessories .load-less").hide(),
        $("#accessories .load-more").show()
    }),
    $("#comment-body").characterCounter({
        counterCssClass: "help-block"
    }),
    $(".nudge a").on("mouseover", function() {
        $(this).animate({
            paddingLeft: "10px"
        }, 400)
    }),
    $(".nudge a").on("mouseout", function() {
        $(this).animate({
            paddingLeft: 0
        }, 400)
    }),
    $(".menu-nudge a").on("mouseover", function() {
        $(this).animate({
            paddingLeft: "20px"
        }, 400)
    }),
    $(".menu-nudge a").on("mouseout", function() {
        $(this).animate({
            paddingLeft: "10px"
        }, 400)
    }),
    $(".inner-zoom").zoom(),
    $("#price-slider").slider(),
    $(".qty-btngroup").each(function() {
        var e = $(this)
          , o = e.children('input[type="text"]')
          , n = o.val();
        e.children(".plus").on("click", function() {
            o.val(++n)
        }),
        e.children(".minus").on("click", function() {
            0 != n && o.val(--n)
        })
    }),
    $(".selectpicker").selectpicker({
        style: "btn-select",
        size: 6
    });
    var e = new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: !0,
        live: !0,
        callback: function() {}
    });
    e.init(),
    (new WOW).init();
    var o;
    o = document.getElementById("particles"),
    "undefined" != typeof o && null !== o && particleground(document.getElementById("particles"), {
        dotColor: "#ededed",
        lineColor: "#ededed"
    }),
    $("#countdown-one").countdown({
        date: "30 June 2016 09:00:00",
        format: "on"
    }),
    $("#countdown-two").countdown({
        date: "20 June 2016 04:00:00",
        format: "on"
    }),
    $("#countdown-three").countdown({
        date: "19 June 2016 01:30:00",
        format: "on"
    }),
    $("#countdown-four").countdown({
        date: "16 June 2016 01:30:00",
        format: "on"
    }),
    $("#countdown-five").countdown({
        date: "19 June 2016 01:30:00",
        format: "on"
    }),
    $("#countdown-six").countdown({
        date: "24 June 2016 03:30:00",
        format: "on"
    }),
    $("#countdown-soon").countdown({
        date: "19 June 2016 01:30:00",
        format: "on"
    }),
    $("#countdown-end").countdown({
        date: "1 March 2015 01:00:00",
        format: "on"
    }),
    $("#countdown-end-two").countdown({
        date: "1 March 2015 01:00:00",
        format: "on"
    }),
    $("#comment-body").characterCounter({
        counterCssClass: "help-block"
    }),
	 $("#add-to-cart-btn").on("click", function(e) {
        e.preventDefault();
       let qty = $($(this).attr('data-qty')).val();
	   console.log("qty: ",qty);
	   
	  
    }),
	$("#add-to-cart-btn-2").on("click", function(e) {
        e.preventDefault();
       let qty = $("#qty").val();
	   console.log("qty: ",qty);
	   
    })
});

//populateQV({sku:'{{$sku}}',description:'{{$description}}',amount:'{{$amount}}',oldAmount:'{{$amount + 1000}}',inStock:'{{ucwords($in_stock)}}',imgg:'{{$imggs[0]}}'})
				
function populateQV(dt){
	console.log("skju",dt.sku);
        $("#quickviewboxLabel").html(dt.sku);
        $("#quickviewboxDescription").html(dt.description);
        $("#quickviewboxAmount").html(dt.amount);
        $("#quickviewboxInStock").html(dt.inStock);
        $("#quickviewboxOldAmount").html(dt.oldAmount);
        $("#quickviewboxImg").attr("src",dt.imgg);
}


function payBank(){
	console.log("pay to bank account");
	setPaymentAction("cod");
}

function payCard(){
	 mc['notes'] = $('#notes').val();
	$('#nd').val(JSON.stringify(mc));
	console.log($('#nd').val());
	setPaymentAction("card");
}

function setPaymentAction(type){
	let paymentURL = "";
	
	if(type == "cod"){
		paymentURL = $("#bank-action").val();  
   }
   else if(type == "card"){
		paymentURL = $("#card-action").val();  
   }
   
   //alert(paymentURL);
   $('#checkout-form').attr('action',paymentURL);
   $('#checkout-form').submit();
}

function bomb(dt,url){

	//create request
	const req = new Request(url,{method: 'POST', headers: {'Content-Type': 'application/json'}, body: dt});
	//console.log(req);
	
	
	//fetch request
	fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error:", message: "Network error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to send message: " + error);			
	   })
	   .then(res => {
		   console.log(res);
		   let ev = true;
			
		   if(res.status == "ok"){
			   if(res.message === "finished"){
			      alert("All messages have been sent. To send more messages you need to delete the old leads and select new ones");
				  ev = false;
				  $("#stop-btn").hide();
		          $("#send-btn").fadeIn();
			    }
				else{
				  let ug = res.ug;
		          let bdg = $('#bdg-' + ug);
			      $('#rmk-' + ug).html("Message Sent!");			  
			      bdg.removeClass(bdg.attr("data-badge"));
			      bdg.addClass("badge-success");
                  bdg.html("sent");				  
				}
		   }
		   else if(res.status == "error"){
			   if(res.message == "Network error"){
				     alert("An unknown network error has occured. Please refresh the app or try again later");
                     ev = false;					 
			   }
			   else{
			   let ug = res.ug;
		       let bdg = $('#bdg-' + ug);
			   $('#rmk-' + ug).html("Failed to send message: " + res.message);
			   bdg.removeClass(bdg.attr("data-badge"));
			   bdg.addClass("badge-danger");
			   bdg.html("failed");
			   }
		   }
		   
		   if(ev === true){
		      setTimeout(function(){
		       bomb(dt,url);
		      },5000);
		    }
		   
	   }).catch(error => {
		    alert("Failed to send message: " + error);			
	   });
}

function selectBank(){
       let bname = $("#bname").val();
	   if(bname == "other"){
		   $('#bname-other').fadeIn();
	   }
	   else{
		   $('#bname-other').hide();
	   }
}

function printElem(html)
{
    let mywindow = window.open('', 'PRINT');
    let content = `
<html><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>${document.title}</title>
<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!-- Ionicons font -->
<link href="css/ionicons.min.css" rel="stylesheet">
<!-- Bootstrap styles-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--custom styles-->
<link href="css/custom.css" rel="stylesheet" />
<link href="css/custom-pink.css" rel="stylesheet"/>
<link href="css/custom-turquoise.css" rel="stylesheet" />
<link href="css/custom-purple.css" rel="stylesheet" />
<link href="css/custom-orange.css" rel="stylesheet" />
<link href="css/custom-blue.css" rel="stylesheet" />
<link href="css/custom-green.css" rel="stylesheet" />
<link href="css/custom-red.css" rel="stylesheet" />
<link href="css/custom-gold.css" rel="stylesheet" id="style">
<!--tooltiop-->
<link href="css/hint.css" rel="stylesheet">
<!-- animation -->
<link href="css/animate.css" rel="stylesheet" />
<!--select-->
<link href="css/bootstrap-select.min.css" rel="stylesheet">
<!--color picker-->
<link href="css/jquery.simplecolorpicker.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<!-- favicon -->

<link rel="icon" type="image/png" href="images/favicon.png" sizes="16x16">

<!--jQuery--> 
<script src="js/jquery.min.js"></script> 
<!--SweetAlert--> 
<script src="lib/sweet-alert/all.js"></script>
</head><body>
${html}
</body></html>
	`;
    
	mywindow.document.write(content);
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    //mywindow.print();
    //mywindow.close();

    return true;
}

function supportsLocalStorage(){
	try{
	  return 'localStorage' in window && window['localStorage'] !== null;
	}
	catch(e){
		return false;
	}
}

const generateRandomString = (length) => {
	let chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	let ret = '';
	
	for(let i = length; i > 0; --i){
		ret += chars[Math.floor(Math.random() * chars.length)];
	}
	return ret;
}


function addToCart(dt)
{
	if(!dt.fromWishlist) dt.fromWishlist = "no";
    
	if(!dt.qty){
		dt.qty = $('#qty').val();
	}
  let cu = `add-to-cart?sku=${dt.sku}&from_wishlist=${dt.fromWishlist}&qty=${dt.qty}&gid=${gid}`;
  console.log("cu: ",cu);
  window.location = cu;
}

function removeFromCart(dt)
{
  let ru = `remove-from-cart?sku=${dt.sku}&gid=${gid}`;
  console.log("ru: ",ru);
  window.location = ru;
}

function addToWishlist(dt)
{
  let wu = `add-to-wishlist?sku=${dt.sku}&gid=${gid}`;
  console.log("wu: ",wu);
  window.location = wu;
}

function removeFromWishlist(dt)
{
  let wu = `remove-from-wishlist?sku=${dt.sku}&gid=${gid}`;
  window.location = wu;
}

function addToCompare(dt)
{
  let cu = `add-to-compare?sku=${dt.sku}&gid=${gid}`;
  window.location = cu;
}

function removeFromCompare(dt)
{
  let wu = `remove-from-compare?sku=${dt.sku}&gid=${gid}`;
  window.location = wu;
}

const getCart = () => {
	let cart = null;
	
    try{
		let c = localStorage.getItem('cart');
		if(c){
			cart = JSON.parse(c);
			console.log("cart: ",cart);
		}
		else{
			cart = [];
		}
	}
	
	catch(err){
		console.log("err in getCart(): ",err);
		cart = [];
	}
	
	return cart;
}

const setCartData = (cart) => {
	document.querySelector('#cart-badge').innerHTML = cart.length;
			let cartMenu = document.querySelector('#cart-menu');
			let htt = cartMenu.innerHTML;
			
			for(let j = 0; j < cart.length; j++){
				let cc = cart[j];
				htt += `
                  <li><div class="lnt-cart-products text-success"><i class="ion-android-checkmark-circle icon"></i> {{$item['sku']}} <b>x{{$qty}}</b><span class="lnt-cart-total">&#8358;{{number_format($itemAmount * $qty, 2)}}</span> </div></li>
				 `; 
				 
			}
			htt += `<li class="lnt-cart-actions text-center"> <a class="btn btn-default btn-lg hvr-underline-from-center-default" href="{{url('cart')}}">View cart</a> <a class="btn btn-primary hvr-underline-from-center-primary" href="{{url('checkout')}}">Checkout</a> </li>`;
			cartMenu.innerHTML = htt;
}

const setCookie = (k,v) => {
	var d = new Date;
            d.setTime(d.getTime() + 24 * 60 * 60 * 60 * 1e3);
            var e = "; expires=" + d.toGMTString();
	 document.cookie = k + "=" + v + e;
}

const getCookie = (a) => {
	for (var b = a + "=", c = document.cookie.split(";"), d = 0; d < c.length; d++) {
            for (var e = c[d]; " " == e.charAt(0); )
                e = e.substring(1, e.length);
            if (0 == e.indexOf(b))
                return e.substring(b.length, e.length)
        }
        return null;
}

const getParameterByName = (name, url) => {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

const syncData = (dt) => {
    let url = "sync-data";
	//create request
	const req = new Request(url,{method: "POST",body: dt});
	console.log("dt: ",dt);
	
	
	//fetch request
	return fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error:", message: "Network error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to send message: " + error);			
	   })
	   .then(res => {
		   console.log("syncData returned: ",res);
		   
	   }).catch(error => {
		    alert("Failed to call getProducts: " + error);			
	   });
}

const searchToCart = (s) => {
	 let qty = $(`#search-qty-${s}`).val();
	   //console.log("qty: ",qty);
	   addToCart({sku: s,qty: qty});
}