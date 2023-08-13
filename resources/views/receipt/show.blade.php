@extends('layouts.admin')

@section('content')

    <?php
    $formatter = new NumberFormatter('en-US', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,2);
    $spellout = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);

    ?>
    <div class="row">
        <div class="col-md-6">

            <h4>Billed To</h4>
            <div>
                <strong>{{$receipt->invoice->client->name}}</strong><br/>
                <strong>Emial:</strong>{{$receipt->invoice->client->email}}<br/>
                <strong>Phone Number:</strong>{{$receipt->invoice->client->phone}}<br/>
                <strong>Address</strong>
                <div>{!! $receipt->invoice->client->address !!}</div>
            </div>

        </div>
        <div class="col-md-6"> <h4> Receipt {{$receipt->receipt_id}} </h4>
            <a href="{{ route('pdfview2',['id'=>$receipt->id, 'download'=>'pdf']) }}">Download PDF</a>
        </div>
    </div>

    <div class="row">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Discount</th>
            </tr>

            <?php $i=0; $sub=0; $vat = 0;?>
            @if (isset ($receipt->invoice->products))
            @foreach($receipt->invoice->products as $product)
                <?php
                $amount = ($product->pivot->price - $product->pivot->discount)*$product->pivot->qty;
                $sub += $amount;
                $product->pivot->price > 0?$discount= number_format ($product->pivot->discount*100/$product->pivot->price,2)
                    :$discount = 0;
                ?>

                    @if ($product->pivot->useas == "title")
                        <tr>
                            <td colspan="6"><strong>{{$product->name}}</strong></td>
                        </tr>
                    @else

                <tr>
                    <td>{{++$i}}</td>
                    <td> {{$product->name}}
                        <p>{{$product->description}}</p>
                    </td>
                    <td align="right"> {{"N".$formatter->format($product->pivot->price)}}</td>
                    <td align="center"> {{$product->pivot->qty}}</td>
                    <td> {{$product->unit}}</td>
                    <td> {{"N".$formatter->format($product->pivot->discount) ." | (".$discount ."%)"}}</td>
                    <td align="right"> {{"N".$formatter->format($amount)}}</td>
                </tr>

                    @endif

            @endforeach
            @endif

            @if (isset ($receipt->invoice->services))
            @foreach($receipt->invoice->services as $service)
                <?php
                $amount = ($service->price - $service->discount)*$service->qty;
                $sub += $amount;
                $service->price > 0 ? $discount= number_format ($service->discount*100/$service->price,2)
                    :$discount = 0;
                ?>
                <tr>
                    <td>{{++$i}}</td>
                    <td> {{$service->service}}</td>
                    <td align="right"> {{"N".$formatter->format($service->price)}}</td>
                    <td align="center"> {{$service->qty}}</td>
                    <td> {{$service->unit}}</td>
                    <td> {{"N".$formatter->format($service->discount) ." | (".$discount ."%)"}}</td>
                    <td align="right"> {{"N".$formatter->format($amount)}}</td>
                </tr>

            @endforeach
            @endif
            @if($receipt->invoice->vat>0)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right" colspan="2">Sub Total</td>
                    <td align="right"><strong> {{"N".$formatter->format($sub)}}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right" colspan="2">7.5% VAT</td>
                    <td align="right"><strong> {{"N".$formatter->format($receipt->invoice->vat)}}</strong></td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right" colspan="2"><b>Total</b></td>
                <td align="right"><strong> {{"N".$formatter->format($sub+$receipt->invoice->vat)}}</strong></td>
            </tr>

            <tr>
                <td colspan="4">Amount Paid: <b>{{"N".$formatter->format($receipt->paid)}}</b></td>
                <td colspan="2" align="right">Payment to date</td>
                <td align="right">
                    <?php
                    $part =  $receipt->invoice->amount - $receipt->balance;
                    ?>
                    <b> {{"N ".$formatter->format($part)}} </b>
                </td>
            </tr>

            <tr>

                <td colspan="6" align="right">Balance Due (VAT Exclusive)</td>
                <td align="right"><b>{{"N ".$formatter->format($receipt->balance)}}</b></td>
            </tr>
            <tr class="spacer">
                <td colspan="7" align="center">
                    <strong>{{Ucfirst($spellout->format($receipt->paid))." Naira Only"}}</strong>
                </td>
            </tr>
        </table>
    </div>
@endsection