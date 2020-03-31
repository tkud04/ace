$(document).ready(function() {
    "use strict";
    $(window).load(function() {
        $("#status").delay(350).fadeOut(),
        $("#preloader").delay(350).fadeOut("slow")
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
    })
});


function populateQV(sku,description,amount,oldAmount,inStock,img){
	console.log("skju",sku);
        $("#quickviewboxLabel").html(sku);
        $("#quickviewboxDescription").html(description);
        $("#quickviewboxAmount").html(amount);
        $("#quickviewboxInStock").html(inStock);
        $("#quickviewboxOldAmount").html(oldAmount);
        $("#quickviewboxImg").attr("src",img);
}

function addToCart(){
       let qty = $('#qty').val();
	   console.log("qty: ",qty);
	   
	   let cu = $('#cu').val();
	   cu += "&qty=" + qty;
	   console.log("cu: ",cu);
	   window.location = cu;
}

function payBank(){
	console.log("pay to bank account");
}

function payCard(){
	 mc['comment'] = $('#comment').val();
	$('#nd').val(JSON.stringify(mc));
	console.log($('#nd').val());
	//setPaymentAction("card");
}
