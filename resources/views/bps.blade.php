@extends('layout')

@section('title',"Order Placed")

@section('content')
<script>
let cidcontents = [];
</script>
<?php
$uu = url('confirm-payment')."?oid=".$o['reference'];
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
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Order Placed Successfully</h3>

<b>You've placed your order!</b><br>

<p>Confirming your order.. <a href="{{$uu}}">Click here</a> if you are not redirected within 10 seconds.</p>

@stop


@section('scripts')
<script>
fbq('track', 'Purchase', {
	currency: "NGN",
	contents: cidcontents,
    content_type: 'product',
	value: "{{$amount}}"
	});

setTimeout(() => {
	window.location = "{{$uu}}";
},15000);
</script>
@stop