@extends('layout')

@section('title',"Cart")

@section('content')
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">My shopping cart</h2>
        <p>Why stop here? <a href="{{url('shop')}}">Continue shopping</a></p>
      </div>
    </div>
    <section class="container equal-height-container">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="inner-ad">
            <figure><img class="img-responsive" src="images/inner-ad.jpg" width="1170" height="100" alt=""></figure>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="row"> 
            
            <!--main sec start-->
            
            <div class="col-sm-8 col-md-9 main-sec shopping-cart">
              <div class="row">
                <div class="col-sm-12">
                  <ol class="breadcrumb  dashed-border">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class="active">Shopping cart</li>
                  </ol>
                </div>
                <div class="col-sm-12">
                  <ul class="item-list list-group">
				    <?php
					
					
				    for($a = 0; $a < count($cart); $a++)
				    {
					  $item = $cart[$a]['product'];
					  $uu = url('product')."?sku=".$item['sku'];
					  $qty = $cart[$a]['qty'];
					  $itemText = $qty == 1 ? "Item" : "Items";
					  $itemAmount = $item['pd']['amount'];
					  $itemDescription = $item['pd']['description'];
					  $imggs = $item['imggs'];
					  $ru = url('remove-from-cart').'?sku='.$item['sku'];
				    ?>
                    <li class="item list-group-item  clearfix">
                      <div class="item-information">
                        <div class="row">
                          <div class="item-image col-sm-2"> <img class="img-responsive" src="{{$imggs[0]}}" width="126" height="144" alt=""> </div>
                          <div class="item-body col-sm-8">
                            <h5 class="item-title text-primary text-uppercase text-primary text-uppercase"><a href="{{$uu}}">{{$item['sku']}}</a></h5>
                            <p class="item-description">{{$itemDescription}}</p>
                          </div>
                          <div class="item-price js-item-price col-sm-2 text-info text-center" data-price="11.99"> <strong>&#8358;{{number_format($itemAmount * $qty, 2)}}</strong> </div>
                        </div>
                      </div>
                      <div class="item-interactions">
                        <div class="row">
                          <div class="col-sm-2 item-quantity"> <a class="js-item-increase btn btn-primary hvr-underline-from-center-primary" title="Add another copy"></a> <a class="js-item-decrease decrease-disabled  btn btn-primary hvr-underline-from-center-primary" title="Remove a copy"></a> </div>
                          <div class="col-sm-8 text-info"><span data-quantity="{{$qty}}"> <strong>{{$qty}}</strong> {{$itemText}} </span></div>
                          <div class="col-sm-2 item-remove"><a href="{{$ru}}" class=" js-item-remove hint-top btn btn-primary " data-hint="Remove"></a> </div>
                        </div>
                      </div>
                    </li>
				   <?php
			       }
			      ?>
                  </ul>
                </div>
              </div>
            </div>
            
            <!--main sec end--> 
            
            <!--sub data start-->
            <div class="col-sm-4 col-md-3 sub-data-right sub-equal">
              <div class="row">
                <div id="sticky">
                  <section class="col-sm-12">
                    <h5 class="sub-title text-info text-uppercase">order summary</h5>
                    <ul class="list-group summary">
                      <li class="list-group-item text-uppercase"><strong>items:<span class="pull-right"> 4</span></strong></li>
                      <li class="list-group-item text-uppercase"><strong>subtotal:<span class="pull-right"> $8.99</span></strong></li>
                      <li class="list-group-item text-uppercase"><strong>shipping: <span class="pull-right">&#8358;1000.00</span></strong></li>
                    </ul>
                  </section>
                  <section class="col-sm-12">
                    <h5 class="sub-title text-info text-uppercase">total price</h5>
                    <div class=" summary sum js-total text-center"> <strong> $114.44</strong> </div>
                    <button class="btn btn-block btn-default hvr-underline-from-center-default">Checkout</button>
                  </section>
                </div>
              </div>
              <!--sub data end--> 
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
@stop