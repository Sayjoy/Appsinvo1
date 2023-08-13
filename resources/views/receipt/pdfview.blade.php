<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panek Global</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!-- <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet"> -->

</head>
<?php
$formatter = new NumberFormatter('en-US', NumberFormatter::DECIMAL);
$formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,2);
$spellout = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$vat = 0;

//convert logo to data uri
$image = 'img/logo3.png';
$type = pathinfo($image, PATHINFO_EXTENSION);
$data = file_get_contents($image);
$dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

<body>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
        <td colspan="2" align="center"><img src="{{$dataUri}}"></td>
    </tr>
    <tr class="spacer2">
        <td>
            <p>&nbsp;</p>
            <strong>Bill To</strong><br/>
            <strong>{{$receipt->invoice->client->name}}</strong><br/>
            <div>{!! $receipt->invoice->client->address !!}</div>
            {{$receipt->invoice->client->email}}<br/>
            {{$receipt->invoice->client->phone}}
        </td>
        <td align ="right">
            {{$receipt->receipt_id}}<br>
            <?php
            $date = date_create($receipt->created_at);
            $created = date_format($date,"F j, Y");
            $created = "17 Jan 2023";
            ?>
            {{$created}}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>&nbsp;</p>
            <h3>Receipt</h3>
            <p><strong>{{$receipt->invoice->title}}</strong></p>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="table table-bordered">
                <tr>
                    <td><strong>#</strong></td>
                    <td><strong>Item</strong></td>
                    <td><strong>Unit</strong></td>
                    <td><strong>Qty</strong></td>
                    <td align="right"><strong>Price</strong></td>
                    <td align="right"><strong>Discount</strong></td>
                    <td align="right"><strong>Amount</strong></td>
                </tr>

                <?php $i=0; $sub=0; $vat = 0; ?>

                @foreach($receipt->invoice->products as $product)
                    <?php
                    $amount = ($product->price - $product->pivot->discount)*$product->pivot->qty;
                    $sub += $amount;
                    $product->pivot->price > 0?$discount= number_format ($product->pivot->discount*100/$product->pivot->price,2)
                        :$discount = 0;
                    ?>

                    @if ($product->pivot->useas == "title")
                        <tr>
                            <td colspan="7"><strong>{{$product->name}}</strong></td>
                        </tr>
                    @else

                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$product->part_no}} {{$product->name}} {{$product->description}}</td>
                            <td>{{$product->unit}}</td>
                            <td> {{$product->pivot->qty}}</td>
                            <td align="right"> {{"N".$formatter->format($product->price)}}</td>
                            <td align="right"> {{"N".$formatter->format($product->pivot->discount) ." | (".$discount ."%)"}}</td>
                            <td align="right"> {{"N".$formatter->format($amount)}}</td>
                        </tr>

                    @endif

                @endforeach


                @foreach($receipt->invoice->services as $service)
                    <?php
                    $amount = ($service->price - $service->discount)*$service->qty;
                    $sub += $amount;
                    $service->price > 0 ? $discount= number_format ($service->discount*100/$service->price,2)
                        :$discount = 0;
                    ?>
                    <tr>
                        <td >{{++$i}}</td>
                        <td> {{$service->service}}</td>
                        <td> {{$service->unit}}</td>
                        <td> {{$service->qty}}</td>
                        <td align="right"> {{"N".$formatter->format($service->price)}}</td>
                        <td align="right"> {{"N".$formatter->format($service->discount) ." | (".$discount ."%)"}}</td>
                        <td align="right"> {{"N".$formatter->format($amount)}}</td>
                    </tr>

                @endforeach


                @if($receipt->invoice->vat>0)
                    <tr>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td align="right"><strong>Sub Total</strong></td>
                        <td align="right"><strong> {{"N".$formatter->format($sub)}}</strong></td>
                    </tr>
                    <tr>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td class="no-border"></td>
                        <td align="right"><strong> 7.5% VAT</strong></td>
                        <td align="right"><strong> {{"N".$formatter->format($receipt->invoice->vat)}}</strong></td>
                    </tr>
                @endif
                <tr class="no-border">
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td align="right"><b>Total</b></td>
                    <td align="right"><strong> {{"N".$formatter->format($sub+$receipt->invoice->vat)}}</strong></td>
                </tr>

                <tr>
                    <td colspan="4">Amount Paid: <b>{{"N".$formatter->format($receipt->paid)}}</b></td>
                    <td colspan="2" align="right">Payment to date</td>
                    <td align="right">
                        <?php
                        $part =  $receipt->invoice->amount - $receipt->balance;
                        ?>
                        <b> {{"N".$formatter->format($part)}} </b>
                    </td>
                </tr>

                <tr>

                    <td colspan="6" align="right">Balance Due (VAT Exclusive)</td>
                    <td align="right"><b>{{"N".$formatter->format($receipt->balance)}}</b></td>
                </tr>
                <tr class="spacer">
                    <td colspan="7" align="center">
                        <strong>{{Ucfirst($spellout->format($receipt->paid))." Naira Only"}}</strong>
                    </td>
                </tr>

            </table>
        </td>

    </tr>

</table>

</body>
</html>

