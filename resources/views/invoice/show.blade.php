@extends('layouts.admin')

@section('content')

    <?php
    $formatter = new NumberFormatter('en-US', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,2);
    $spellout = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);

    ?>
<div class="container">
    <div class="row mt-5">
       <div class="col-md-6">
           <h4>Bill To </h4>
           <div>
                <strong>{{$invoice->client->name}}</strong><br/>
                <strong>Emial:</strong>{{$invoice->client->email}}<br/>
                <strong>Phone Number:</strong>{{$invoice->client->phone}}<br/>
                <strong>Address</strong>
                <div>{!! $invoice->client->address !!}</div>
           </div>

       </div>
       <div class="col-md-6">
                <h4> Invoice {{$invoice->invoice_id}}
                    @if ($invoice->po)
                        / PO {{$invoice->po}}
                    @endif
                </h4>

            {!! Form::open(['url' =>'getinvoice']) !!}
                <div class="input-group col-md-8" role="toolbar">
                    <span class="input-group-text">PO Number</span>
                    <input type="text" name="po" class="form-control" value="{{$invoice->po}}" aria-describedby="sizing-addon2">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="set">Set</button>
                    </span>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="checkpo"
                       @if ($invoice->usepo >0)
                               checked
                       @endif
                       value="1" class="form-check-input">
                    <label class="form-check-label" for="exampleCheck1">Use PO Number as invoice title</label>
                    <input type="hidden" name="id" value="{{$invoice->id}}">
                </div>

                <p class="mt-3">
                    {{--<a href="{{ route('pdfview',['id'=>$invoice->id, 'download'=>'pdf', 'type'=>'invoice']) }}">Download Invoice</a>--}}
                    {!! Form::submit('Download as Invoice', ['class'=>'btn btn-primary', 'name'=>'download']) !!}
                    <a href="{{ route('pdfview',['id'=>$invoice->id, 'download'=>'pdf', 'type'=>'quotation']) }}"
                       class="btn btn-warning">Download as Quotation</a>
                </p>
            {!! Form::close() !!}

            <p> <a href="{{ action('WaybillController@create',[$invoice->id])}}" class="btn btn-danger">Generate waybill</a>
                <a href="{{$invoice->id}}/edit" class="btn btn-info">Edit Invoice</a>
            </p>

        </div>
    </div>

    <div class="row">
        <p><strong>{{$invoice->title}}</strong></p>
    </div>

    <div class="row">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Item</th>
                <th align="right">Price</th>
                <th>Qty</th>
                <th>Unit</th>
                <th align="right">Discount</th>
                <th align="right">Amount</th>
            </tr>

            <?php $i=0; $sub=0; $vat = 0;?>
            @if (isset ($invoice->products))
                @foreach($invoice->products as $product)
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
                            <td> {{$product->pivot->qty}}</td>
                            <td> {{$product->unit}}</td>
                            <td align="right"> {{"N".$formatter->format($product->pivot->discount) ." | (".$discount ."%)"}}</td>
                            <td align="right"> {{"N".$formatter->format($amount)}}</td>
                        </tr>
                    @endif

                @endforeach
            @endif

            @if (isset ($invoice->services))
                @foreach($invoice->services as $service)
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
                        <td> {{$service->qty}}</td>
                        <td> {{$service->unit}}</td>
                        <td align="right"> {{"N".$formatter->format($service->discount) ." | (".$discount ."%)"}}</td>
                        <td align="right"> {{"N".$formatter->format($amount)}}</td>
                    </tr>

                @endforeach
            @endif
            @if($invoice->vat>0)
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
                    <td align="right"><strong> {{"N".$formatter->format($invoice->vat)}}</strong></td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right" colspan="2"><b>Total</b></td>
                <td align="right"><strong> {{"N".$formatter->format($sub+$invoice->vat)}}</strong></td>
            </tr>

            <tr class="spacer">
                <td colspan="7" align="center">
                    <strong>{{Ucfirst($spellout->format($sub+$invoice->vat))." Naira Only"}}</strong>
                </td>
            </tr>
        </table>
    </div>
    <div class="well">
        <h4>Payment History</h4>
        @if ($invoice->receipts->isEmpty())
            No Previous Payment
        @else
            @foreach ($invoice->receipts as $receipt)
                <?php
                $date = date_create($receipt->created_at);
                $created = date_format($date,"F j, Y");
                ?>
                <div class="row">
                <div class="col-md-8">Paid {{"N ".number_format ($receipt->paid)}} on {{$created}}, approved by {{$receipt->admin->name}}, Due balance: {{"N ".number_format ($receipt->balance)}}</div>
                <div class="col-md-4">
                    <a href="../receipt/{{$receipt->id}}">Get Receipt {{$receipt->receipt_id}}</a>
                </div>
                    </div>
            @endforeach
        @endif

    </div>

    <div class="well">
        <h4>Waybill History</h4>
        @if ($invoice->waybills->isEmpty())
            No Previous Waybill
        @else
            <?php
                $invoice_qty =  $invoice->products()->wherePivot('invoice_id', $invoice->id)->sum('qty') + $invoice->services()->sum('qty');
                $waybill_qty = 0;
            ?>

            <table class="table">
            @foreach ($invoice->waybills as $waybill)
                    <?php
                        $waybill_qty += $waybill->products()->wherePivot ('invoice_id', $invoice->id)->sum('qty')
                                        + $waybill->services()->wherePivot ('invoice_id', $invoice->id)->sum('service_waybill.qty');
                    ?>
                    <tr>
                        <td>
                            <a href="{{url ('/waybill/'.$waybill->id)}}">{{$waybill->waybill_no}}</a> issued by {{$waybill->admin->name}} on {{$waybill->created_at}}
                        </td>
                        <td>
                            <a href="{{url('deletewaybill', [$waybill])}}">Delete</a>
                        </td>
                    </tr>
            @endforeach
            </table>
            <?php $q = $invoice_qty - $waybill_qty; ?>
            @if ($q>0)
                    <p><strong>
                           {{$q}} item(s) have not been delivered.
                        </strong>
                    </p>
                @else
                    <p><strong>
                           All items have been delivered.
                        </strong>
                    </p>
                @endif
        @endif
    </div>
</div>
@endsection
