@extends('layout')

@section('title',"Transaction Successful")

@section('content')
<?php
$amount = 0;
if(isset($o)) $amount = $o['amount'];
$items = $o['items'];

foreach($items as $i)
{
	$product = $i['product'];
	$sku = $product['sku'];
	$name = $product['name'];
	$qty = $i['qty'];
	$img = $product['imggs'][0];
?>
<script>
let cidcontents = [];
cidcontents.push({
      id: "{{$sku}}",
      quantity: "{{$qty}}"
    });
</script>
<?php
}
?>

<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Transaction successful</h3>

<b>Your payment was successful!</b><br>

<p>Fetching your orders.. <a href="{{url('orders')}}">Click here</a> if you are not redirected within 10 seconds.</p>

@stop


@section('scripts')
<?php
$uu = url('orders');
?>
<script>
fbq('track', 'Purchase', {
	currency: "NGN",
	contents: cidcontents,
    content_type: 'product',
	value: "{{$amount}}"
	});


setTimeout(() => {
	window.location = "{{$uu}}";
},10000);
</script>
@stop