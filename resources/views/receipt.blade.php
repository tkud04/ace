@extends('layout')

@section('title',"Receipt")

@section('styles')
<style type="text/css">
  #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
@stop

@section('content')
<?php
$ru = url('receipt')."?r=".$order['reference']."&print=1";
?>
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <a id="printInvoicee" href="{{$ru}}" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="{{url('/')}}">
                            <img src="images/logoo.png" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="#">
                            Ace Luxury Stores
                            </a>
                        </h2>
                        <div>3 Oshikomaiya Close, Demurin Road, Ketu, Lagos</div>
                        <div>(+234 809 703 9692</div>
                        <div>info@aceluxurystores.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">RECEIPT</div>
                        <h2 class="to">{{$buyer['fname']." ".$buyer['lname']}}</h2>
                        <div class="address">{{$buyer['phone']}}</div>
                        <div class="email"><a href="mailto:{{$buyer['email']}}">{{$buyer['email']}}</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">{{strtoupper($order['status'])}}</h1>
                        <div class="date">Receipt generated on: {{$order['date']}}</div>
                        <div class="date">Reference #: {{$order['reference']}}</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">ITEM</th>
                            <th class="text-right">QTY</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php
					   if(isset($order['items'])){
						   $x = 0;
					   foreach($order['items'] as $i){
						   ++$x;
						   $product = $i['product'];
						   $pd = $product['pd'];
						   $pu = url('product')."?sku=".$product['sku'];
					   ?>
                        <tr>
                            <td class="no">{{$x}}</td>
                            <td class="text-left">
							   <h3><a target="_blank" href="{{$pu}}">{{$product['sku']}}</a></h3>
                            </td>
                            <td class="unit">{{$i['qty']}}</td>
                            <td class="total">&#8358;{{number_format($pd['amount'] * $i['qty'],2)}}</td>
                        </tr>
                       <?php
					   }
					   }
					   ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="1">SUBTOTAL</td>
                            <td>&#8358;{{number_format($totals['subtotal'],2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="1">DELIVERY</td>
                            <td>&#8358;{{number_format($totals['delivery'],2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="1">TOTAL</td>
                            <td>&#8358;{{number_format($totals['subtotal'] + $totals['delivery'],2)}}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">Your order will only be processed after payment is cleared.</div>
                </div>
            </main>
            <footer>
                This receipt was created automatically and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
@stop

@section('scripts')

<script>
 $('#printInvoice').click(function(){
            /**
			Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
			
			printElem($('.invoice')[0].outerHTML);
			**/
			
        });
</script>
@stop