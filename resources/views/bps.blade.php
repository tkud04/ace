@extends('layout')

@section('title',"Order Placed")

@section('content')
<?php
$uu = url('confirm-payment')."?oid=".$o['reference'];
$amount = 0;
if(isset($o)) $amount = $o['amount'];
?>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Order Placed Successfully</h3>

<b>You've placed your order!</b><br>

<p>Confirming your order.. <a href="{{$uu}}">Click here</a> if you are not redirected within 10 seconds.</p>

@stop


@section('scripts')
<script>
fbq('track', 'Purchase', {currency: "NGN", value: "{{$amount}}"});

setTimeout(() => {
	window.location = "{{$uu}}";
},15000);
</script>
@stop