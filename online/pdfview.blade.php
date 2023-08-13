<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panek Global Invoice</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">--}}
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

//Check quotation or invioce.
if ($format=="quotation"){

 $heading = "Official Quotation";
 $invoice_no = "";
}
elseif ($format == "invoice"){
 $heading = "Official Invoice";
 $invoice_no = "Invoice Number: ".$invoice->invoice_id;
}
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
         <strong>{{$invoice->client->name}}</strong><br/>
         <div>{!! $invoice->client->address !!}</div>
         {{$invoice->client->email}}<br/>
         {{$invoice->client->phone}}
     </td>
     <td align ="right">
         {{$invoice_no}}<br>
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
     </td>
 </tr>
 <tr>
     <td colspan="2">
         <p>&nbsp;</p>
         <h3>{{$heading}}</h3>
         <p><strong>{{$invoice->title}}</strong></p>

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

             @if (isset ($invoice->products))
             @foreach($invoice->products as $product)
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
                     <td >{{++$i}}</td>
                     <td> {{$service->service}}</td>
                     <td> {{$service->unit}}</td>
                     <td> {{$service->qty}}</td>
                     <td align="right"> {{"N".$formatter->format($service->price)}}</td>
                     <td align="right"> {{"N".$formatter->format($service->discount) ." | (".$discount ."%)"}}</td>
                     <td align="right"> {{"N".$formatter->format($amount)}}</td>
                 </tr>

             @endforeach
             @endif

             @if($invoice->vat>0)
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
                     <td align="right"><strong> {{"N".$formatter->format($invoice->vat)}}</strong></td>
                 </tr>
             @endif
             <tr class="no-border">
                 <td class="no-border"></td>
                 <td class="no-border"></td>
                 <td class="no-border"></td>
                 <td class="no-border"></td>
                 <td class="no-border"></td>
                 <td align="right"><b>Total</b></td>
                 <td align="right"><strong> {{"N".$formatter->format($sub+$invoice->vat)}}</strong></td>
             </tr>

         </table>
     </td>

 </tr>
 <tr>
     <td colspan="2">
         <p>&nbsp;</p>
         <strong>{{Ucfirst($spellout->format($sub+$invoice->vat))." Naira Only"}}</strong>
     </td>

 </tr>
 <tr>
     <td colspan="2" class="spacer2">
         <p>&nbsp;</p>
         <table class="table" class="no-border">
             <tr>
                 <td width="40%">
                     <?php
                     //convert logo to data uri
                     $image = 'img/sign.jpg';
                     $type = pathinfo($image, PATHINFO_EXTENSION);
                     $data = file_get_contents($image);
                     $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
                     ?>
                     <img src="{{$dataUri}}"><br/>
                     EKELE P. OGBONNA<br/>
                     <b>Managing Director</b></td>

                 </td>
                 <td width="20%">

                 </td>
                 <td width="40%">
                    <p> &nbsp;</p>
                     <?php
                        if ($format == "invoice"){
                            echo "__________________________________<br>
                                Customer's Signature";
                        }
                     ?>
                 </td>

             </tr>
         </table>


 </tr>

</table>

</body>
</html>
