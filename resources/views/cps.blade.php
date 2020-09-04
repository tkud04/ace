@extends('layout')

@section('title',"Transaction Successful")

@section('content')
<?php
$amount = 0;
if(isset($o)) $amount = $o['amount'];
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
fbq('track', 'Purchase', {currency: "NGN", value: "{{$amount}}"});

setTimeout(() => {
	window.location = "{{$uu}}";
},10000);
</script>
@stop