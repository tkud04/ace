@extends('layout')

@section('title',"Transaction Successful")

@section('content')
<?php
$uu = url('confirm-payment')."?oid=".$o['reference'];
$amount = 0;
if(isset($o)) $amount = $o['amount'];
?>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Transaction successful</h3>

<b>Your payment was successful!</b><br>

<p>Fetching your orders.. <a href="{{$uu}}">Click here</a> if you are not redirected within 10 seconds.</p>

@stop


@section('scripts')
<script>
fbq('track', 'Purchase', {currency: "NGN", value: "{{$amount}}"});

setTimeout(() => {
	window.location = "{{$uu}}";
},15000);
</script>
@stop