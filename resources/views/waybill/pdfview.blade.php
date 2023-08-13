<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PanekGlobal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
{{--<link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">--}}
<style>
    .spacer {
        margin-top: 10px;
    }
    .spacer2 {
        margin-top: 40px;
    }
    .no-border {
        border: none!important;
    }

</style>
</head>
<?php
$formatter = new NumberFormatter('en-US', NumberFormatter::DECIMAL);
$formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,2);
$spellout = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
$vat = 0;

//convert logo to data uri
$image = 'img/panek_invoice.jpg';
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
        <strong>{{$waybill->invoice->client->name}}</strong><br/>
        <div>{!! $waybill->invoice->client->address !!}</div>
        {{$waybill->invoice->client->email}}<br/>
        {{$waybill->invoice->client->phone}}
        <p>
            <strong>Vehicle No.</strong>_______________________________
        </p>
    </td>
    <td align ="right">
        <strong>Waybil no:</strong> {{$waybill->waybill_no}}<br>
        <strong>LPO No: </strong>{{$waybill->invoice->po}}<br>
        <?php
        $date = date_create($waybill->created_at);
        $created = date_format($date,"F j, Y");
        ?>
        <strong>Created:</strong> {{$created}}<br>

    </td>
</tr>
<tr>
    <td colspan="2">
        <p>&nbsp;</p>

        <h3>Waybill for {{$waybill->invoice->title}}</h3>

    </td>
</tr>
<tr>
    <td colspan="2">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th align="center">Invoiced Qty</th>
                    <th align="center">Waybill Qty</th>
                    <th align="center">Total Delivered</th>
                </tr>

                <?php $i=0;?>
                @isset ($waybill->invoice->products)
                    @foreach($waybill->invoice->products as $product)
                        <?php
                        $wb_p =  $waybill->products->where ('id', $product->id)->first();
                        ?>
                        @if ($product->pivot->useas == "title")
                            <tr>
                                <td colspan="5"><strong>{{$product->name}}</strong></td>
                            </tr>
                        @else

                            <tr>
                                <td>{{++$i}}</td>
                                <td> {{$product->name}}
                                    <p>{{$product->description}}</p>
                                </td>
                                <td align="center"> {{$product->pivot->qty}}</td>
                                <td align="center">
                                    @if(empty ($wb_p))
                                        0
                                    @else
                                        {{$wb_p->pivot->qty}}
                                    @endif
                                </td>
                                <td align="center"> {{$delivered["products"][$product->id]}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endisset

                @isset ($waybill->invoice->services)
                    @foreach($waybill->invoice->services as $service)
                        <?php
                        $wb_s =  $waybill->services->where ('id', $service->id)->first();
                        ?>
                        <tr>
                            <td>{{++$i}}</td>
                            <td> {{$service->service}}</td>
                            <td align="center"> {{$service->qty}}</td>
                            <td align="center"> @if(empty ($wb_s))
                                    0
                                @else
                                    {{$wb_s->pivot->qty}}
                                @endif</td>
                            <td align="center"> {{$delivered["services"][$service->id]}}</td>
                        </tr>

                    @endforeach
                @endisset
            </table>
        <p>&nbsp;</p><p>&nbsp;</p>

    </td>

</tr>
<tr>
    <td>
        <table>
            <tr>
                <td>
                    <p>
                        <strong>Goods received in good condition by:</strong>
                    </p>
                    <p>
                        Name: _____________________________________
                    </p>
                    <p>
                        Sign: _____________________________________
                    </p>
                    <p>
                        Date: _____________________________________
                    </p>
                </td>

                <td width="40">
                </td>

                <td>
                    <p>
                        <strong>Goods delivered in good condition by:</strong>
                    </p>
                    <p>
                        Name: _____________________________________
                    </p>
                    <p>
                        Sign: _____________________________________
                    </p>
                    <p>
                        Date: _____________________________________
                    </p>
                </td>
            </tr>
        </table>

    </td>
</tr>

</table>

</body>
</html>