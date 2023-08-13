@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-6">

            <h4>Billed To</h4>
            <div>
                <strong>{{$waybill->invoice->client->name}}</strong><br/>
                <strong>Emial:</strong>{{$waybill->invoice->client->email}}<br/>
                <strong>Phone Number:</strong>{{$waybill->invoice->client->phone}}<br/>
                <strong>Address</strong>
                <div>{!! $waybill->invoice->client->address !!}</div>
            </div>

        </div>
        <div class="col-md-6"> <h4> Waybill {{$waybill->waybill_no}} </h4>
            <a href="{{ route('pdfview3',['id'=>$waybill->id, 'download'=>'pdf']) }}">Download PDF</a>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Invoiced Qty</th>
                <th>Waybill Qty</th>
                <th>Total Delivered</th>
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
                        <td> {{$product->pivot->qty}}</td>
                        <td>
                            @if(empty ($wb_p))
                                0
                            @else
                              {{$wb_p->pivot->qty}}
                            @endif
                        </td>
                        <td> {{$delivered["products"][$product->id]}}</td>
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
                    <td> {{$service->qty}}</td>
                    <td> @if(empty ($wb_s))
                            0
                        @else
                            {{$wb_s->pivot->qty}}
                        @endif</td>
                    <td> {{$delivered["services"][$service->id]}}</td>
                </tr>

            @endforeach
            @endisset
        </table>
    </div>
@endsection