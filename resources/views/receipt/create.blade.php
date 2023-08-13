@extends('layouts.admin')

@section('content')
    <h1>Payment Reciept for {{$invoice->invoice_id}}</h1>
    <?php
    $formatter = new NumberFormatter('en-US', NumberFormatter::DECIMAL);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS,2);
    $spellout = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);

    ?>
    <div class="well">
        <h4>Payment History</h4>

        <?php
        $paid = 0;
        /*$date = date_create($invoice->due_date);
        $due_date = date_format($date,"F j, Y");
        */

        ?>
        @if ($receipts->isEmpty())
            No Previous Payment
        @else
            @for ($i=0; $i<sizeof($receipts); $i++)
                <?php
                    $date = date_create($receipts[$i]->created_at);
                    $created = date_format($date,"F j, Y");
                    $paid += $receipts[$i]->paid;
                ?>

                <div>Paid {{"N".$formatter->format($receipts[$i]->paid)}} on {{$created}}, approved by {{$admin[$i]}}, due balance: {{"N".$formatter->format($receipts[$i]->balance)}}</div>

            @endfor
        @endif

    </div>

    {!! Form::open(['url' =>'receipt']) !!}
    <div class="row">
        <div class="col-md-4">
            <?php $balance = $invoice->amount - $paid; ?>
            Amount Due: <strong>{{"N".$formatter->format($balance)}}</strong>
            <p>
            <div class="checkbox">
                <label>
                    <input name="fullPayment" type="checkbox" id="fullPayment" value="1" onclick="togglePayment({{$balance}})">Make Full Payment
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}"><input type="hidden" name="balance" value="{{$balance}}">
                </label>
            </div>
            <div class="form-group">
                <label> Or Part Payment N</label>
                <input type="text" name="partPayment" class="form-control" id="partPayment" onclick="togglePayment({{$balance}})" onchange="check_value(this,{{$balance}})">
            </div>
            <div class="form-group">
                {!! Form::submit('Approve Payment', ['class'=>'btn btn-primary']) !!}
            </div>
            </p>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    {!! Form::close() !!}

    <script type="text/javascript">

        function togglePayment(balance)
        {
            if (document.getElementById("fullPayment").checked)
            {
                var partPayment = document.getElementById("partPayment")
                partPayment.value =balance;
                partPayment.readOnly = true;
            }

            else
            {
                var partPayment = document.getElementById("partPayment")
                partPayment.readOnly = false;
            }
        }

        function check_value(field, balance){
            if (isNaN(field.value)){
                alert ('A number must be in the price field '+field.value);
                field.value =""
            }
            else if(field.value > balance){
                alert ('Amount '+field.value+' is greater than balance')
                field.value = balance
            }

        }
    </script>
@endsection