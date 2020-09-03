@extends('layout')

@section('title',"Transaction Successful")


@section('content')
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">Transaction Successful!</h2>
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12">
              <div class="inner-ad">
                <figure>
                  <figure><img class="img-responsive" src="{{$ad}}" width="1170" height="100" alt=""></figure>
                </figure>
              </div>
            </div>
            <div class="col-sm-12">
              <ol class="breadcrumb dashed-border row">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Orders</li>
              </ol>
            </div>
            <!--start of columns-->
            <div class="col-sm-12">
               <h4 class="sub-title text-primary text-uppercase">Your payment was successful!</h4>
			   <p>Fetching your orders.. <a href="{{url('orders')}}">Click here</a> if you are not redirected in 5 seconds.</p>
            </div>
            <!--start of columns--> 
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
@stop


@section('scripts')
<script>
setTimeout(() => {
	window.location = "orders";
},5000);
</script>
@stop