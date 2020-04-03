@extends('layout')

@section('title',"FAQ")

@section('content')
  <!--start of middle sec-->
  <div class="middle-sec wow fadeIn" data-wow-offset="10" data-wow-duration="2s">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">frequently asked questions</h2>
        <p>find an answer to commonly asked questions.</p>
      </div>
    </div>
    <section class="container equal-height-container">
      <div class="row"> 
        <!--start of inner add-->
        <div class="col-sm-12">
          <div class="inner-ad"> <img width="1170" height="100" alt="" src="{{$ad}}" class="img-responsive"> </div>
        </div>
        <!--end of inner add-->
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12">
              <ol class="breadcrumb  dashed-border">
                <li><a href="#">Home</a></li>
                <li class="active">Frequently Asked Questions</li>
              </ol>
            </div>
			<?php
			$placeOrders = <<<EOT
<ul>
<li>Look through our lovely selection of fashion jewellery</li>
<li>Add items to your cart</li>
<li>When done adding items to cart, click on your shopping cart to view all items selected</li>
<li>Proceed to check out</li>
<li>Register as a new customer or login as a member</li>
<li>Select mode of payment</li>
<li>select delivery option</li>
<li>Confirm your order.</li>
<li>This will generate a code</li>
<li>Make payment using this code</li>
<li>Once payment is received, you will get an email confirming your order and delivery details</li></ul>
EOT;
			
			  $set1 = [
			    'Do you have a physical shop I can visit?' => "Ace Luxury Stores is an online store so we don't have a physical storefront. <br><br>If you need to speak with us please feel free to give us a call, chat up on Whatsapp or better yet fill out the form on our Contact page.",
			    'Do you offer same-day deliveries?' => "We currently do not offer same-day deliveries. Kindly contact us via phone or Whatsapp for special cases.",
			    'Can I order online and pickup at my own convenience?' => "You can order online and pickup whenever you are ready. Please give us a call to arrange this.",
			    'Do you make deliveries to P.O boxes?' => "We currently do not make deliveries to P.O boxes. A valid shipping address will get your goods to you faster.",
			    'Do you make deliveries on weekends?' => "We are open 7 days and do pack, prepare and ship orders over the weekend; however your package will not go out until Monday.",
			    'How do I place orders?' => "Browse through our amazing items and add to your cart. When done, click on your shopping cart to view selected items and proceed to checkout.<br><br>Register as a new customer or login as a member, select your preferred mode of payment and confirm your order. From this point you will be guided on how to make payment and your delivery details!",
			    'What are the payment modes available?' => "We currently accept secure online payment via <b>PayStack</b> or <b>bank transfer</b>",
			    'Do you take phone orders?' => "Yes, we are always here to help. Please call us with your order.",
			    'How often do you restock your items?' => "Most items that were very successful will usually be restocked right away.<br><br> For restock requests, please give us an email with the item number and we can give you a restocking date if any."			    
			  ];
			  
			  $set2 = [
			    'How much are the delivery fees?' => "We currently charge a flat fee of &#8358;1000.00",
			    'How long will it take to deliver my order?' => "Orders are delivered within 48hours in Lagos.<br><br>Orders outside Lagos are delivered between 4 – 7 days.",
			    'How do I return an item?' => "Unless you received a defective item, <b>ALL sales are final.</b><br><br>Please inspect your items before the dispatch person leaves and if defective, return immediately.<br><br>Please call us or chat us up on Whatsapp on defective items for a refund or exchange.",
			    'I have other questions' => "Please call us or chat us up on Whatsapp for any issues or complaints. We are always here to help."
			  ];
			?>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-12 main-sec faqs">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <h4 class="sub-title text-primary text-uppercase">shopping &amp; payment</h4>
                        </div>
						<?php
						foreach($set1 as $key => $value)
						{
						?>
                        <!--start of flip box-->
                        
                        <div class="col-sm-4 flip-box">
                          <div class="flip">
                            <div class="card">
                              <div class="face front">
                                <div class="well well-sm inner">
                                  <div class="icon"> <i class="ion-help-circled"></i></div>
                                  <h5>{{$key}}</h5>
                                </div>
                              </div>
                              <div class="face back">
                                <div class="well well-sm inner"> {!! $value !!}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--end of flip box--> 
                        <?php
						}
						?>
                       
                        
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <h4 class="sub-title text-primary text-uppercase">shipping &amp; delivery</h4>
                        </div>
                        
                        <?php
						foreach($set2 as $key => $value)
						{
						?>
                        <!--start of flip box-->
                        
                        <div class="col-sm-4 flip-box">
                          <div class="flip">
                            <div class="card">
                              <div class="face front">
                                <div class="well well-sm inner">
                                  <div class="icon"> <i class="ion-help-circled"></i></div>
                                  <h5>{{$key}}</h5>
                                </div>
                              </div>
                              <div class="face back">
                                <div class="well well-sm inner"> {!! $value !!}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--end of flip box--> 
                        <?php
						}
						?>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
@stop