<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>SaburiIlori Invoice</title>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>

        .invoice-box{
            max-width:800px;
            margin:auto;
            padding:30px;
            border:1px solid #eee;
            box-shadow:0 0 10px rgba(0, 0, 0, .15);

        }

        .invoice-box table{
            width:100%;
            line-height:inherit;
            text-align:left;
        }

        .invoice-box table td{
            padding:5px;
            vertical-align:top;
        }

        .invoice-box table tr td:nth-child(2){
            text-align:right;
        }

        .invoice-box table tr.top table td{
            padding-bottom:20px;
        }

        .invoice-box table tr.top table td.title{
            font-size:45px;
            line-height:45px;
            color:#333;
        }

        .invoice-box table tr.information table td{
            padding-bottom:40px;
        }

        .invoice-box table tr.heading td{
            background:#eee;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }

        .invoice-box table tr.details td{
            padding-bottom:20px;
        }

        .invoice-box table tr.item td{
            border-bottom:1px solid #eee;
        }

        .invoice-box table tr.item.last td{
            border-bottom:none;
        }

        .invoice-box table tr.total td:nth-child(2){
            border-top:2px solid #eee;
            font-weight:bold;
        }

        .invoice-box table.inv tr td:nth-child(2){
            text-align:left;
            border-top:none;
            font-weight:none;
        }

        .inv {
            text-align:left !important;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td{
                width:100%;
                display:block;
                text-align:center;
            }

            .invoice-box table tr.information table td{
                width:100%;
                display:block;
                text-align:center;
            }
        }
        .spacer {
            margin-top: 10px;
        }
        .spacer2 {
            margin-top: 40px;
        }
        /*  font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
            */
    </style>
</head>
<?php
$formatter = new NumberFormatter('en-US', NumberFormatter::DECIMAL);
$formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,2);
$spellout = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$vat = 0;
?>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-xs-6" style="text-align:left;">
                                        <?php
                                        //convert logo to data uri
                                        $image = 'img/logo.png';
                                        $type = pathinfo($image, PATHINFO_EXTENSION);
                                        $data = file_get_contents($image);
                                        $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        ?>
                                        <img src="{{$dataUri}}">
                                    </div>
                                    <div class="col-xs-6" style="text-align:right;">
                                        Invoice: {{$invoice->invoice_id}}<br>
                                        <?php
                                        $date = date_create($invoice->created_at);
                                        $created = date_format($date,"F j, Y");

                                        $date_d = date_create($invoice->due_date);
                                        $due_date = date_format($date_d,"F j, Y");
                                        ?>
                                        Created: {{$created}}<br>
                                        @if ($date_d > $date)
                                            Due: {{$due_date}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6" style="text-align:left;">
                                           522, Ikorodu Road,<br>
                                            Ketu, Lagos
                                        <div class="spacer">
                                            admin@appsolutn.com<br>
                                            08031377829
                                        </div>

                                    </div>
                                    <div class="col-xs-6 spacer" style="text-align:right;">
                                        <strong>Bill To</strong><br/>
                                        <strong>{{$client->name}}</strong><br/>
                                        <div>{!! $client->address !!}</div>
                                        {{$client->email}}<br/>
                                        {{$client->phone}}<br/>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>&nbsp;</p>
                    <p><strong>{{$invoice->title}}</strong></p>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="inv">
                        <tr class="heading">
                            <td>#</td>
                            <td>Item</td>
                            <td>Fee</td>
                            <td>Qty</td>
                            <td>Amount</td>
                        </tr>
                        <?php $i=0; $sub=0;?>
                        @foreach($services as $service)
                            <?php
                            $amount = $service->price*$service->qty;
                            $sub += $amount;
                            ?>
                            <tr>
                                <td>{{++$i}}</td>
                                <td> {{$service->service}}</td>
                                <td> {{"N".$formatter->format($service->price)}}</td>
                                <td> {{$service->qty}}</td>
                                <td> {{"N".$formatter->format($amount)}}</td>
                            </tr>

                        @endforeach
                        @if($invoice->vat>0)
                            <?php
                            $vat = $sub*0.05;
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right">Sub Total</td>
                                <td><strong> {{"N".$formatter->format($sub)}}</strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right">5% VAT</td>
                                <td><strong> {{"N".$formatter->format($vat)}}</strong></td>
                            </tr>
                        @endif
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right">Sub Total</td>
                            <td><strong> {{"N".$formatter->format($sub+$vat)}}</strong></td>
                        </tr>

                        @if ($invoice->discount>0)
                            <?php
                            $stotal = $sub+$vat;
                            if ($invoice->d_type==0){
                                $discount = ($invoice->discount/100)*$stotal;
                            }
                            else {
                                $discount = $invoice->discount;
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right">Discount</td>
                                <td><strong> {{"N".$formatter->format($discount)}}</strong></td>
                            </tr>

                        @endif

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><strong>Grand Total</strong></td>
                            <td><strong> {{"N".$formatter->format($invoice->amount)}}</strong></td>
                        </tr>

                        <tr class="spacer">
                            <td colspan="5" align="center">
                                <strong>{{Ucfirst($spellout->format($invoice->amount))." Naira Only"}}</strong>
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>

            <tr>
                <td colspan="2">

                    <div class="row spacer2">
                        <div class="col-xs-6" style="text-align:left;">
                            <?php
                            //convert logo to data uri
                            $image = 'img/sign.jpg';
                            $type = pathinfo($image, PATHINFO_EXTENSION);
                            $data = file_get_contents($image);
                            $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            ?>
                            <img src="{{$dataUri}}"><br/>
                            Alagbe Micheal Sayo,<br/>
                            <b>Project Manager</b>

                        </div>
                        <div class="col-xs-6">
                            <b>Payment Advice:</b> <br/>
                            Alagbe Micheal Sayo,<br/>
                            GTB, 0048296903

                        </div>

                    </div>
                </td>
            </tr>

        </table>
    </div>
</body>
</html>