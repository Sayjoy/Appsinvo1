@extends('layouts.admin')

@section('content')
    <h3>Edit Invoice {{$invoice->invoice_id}}</h3>
    <p class="help-block">
        {!! Form::model($invoice, ['method' => 'DELETE', 'action' => ['InvoicesController@destroy', $invoice->id]]) !!}
        {!! Form::submit ('Delete Invoice',['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
    </p>

    {!! Form::model($invoice, ['method' => 'PATCH', 'action' => ['InvoicesController@update', $invoice->id]]) !!}

    <div class="row">

        <div class="col-md-8" id="dynamicInput">

            <div class="row">
                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{$invoice->title}}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Select a Client</label>
                    <select class="form-control" name="client">
                        {{--Get al clients in option--}}
                       @foreach ($clients as $client)
                            <option value="{{$client->id}}"
                                    @if ($invoice->client_id == $client->id)
                                    selected
                                    @endif
                            >{{$client->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Due Date</label>
                    <input class="date form-control" name="due_date" type="text" value="{{$invoice->due_date}}">
                </div>
                <div class="col-md-4 checkbox">
                    <label>Add VAT
                        <input name="vat" type="checkbox" value="1"
                               @if ($invoice->vat>0)
                               checked
                                @endif
                        >
                    </label>
                </div>
            </div>
            <div>&nbsp;</div>

            <?php $i=1; ?>

            @foreach($services as $service)
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Item {{$i++}}</label>
                    <input type="text" class="form-control" id="s{{$i}}" name="service[]" value="{{$service->service}}">
                    <input type="hidden" name="service_id[]" value="{{$service->id}}">
                </div>
                <div class="form-group col-md-2">
                    <label>Qty</label>
                    <input type="text" class="form-control" name="qty[]" id="qty{{$i}}" onchange="check_value(this)" onclick="minusPrice(this)" value="{{$service->qty}}">
                </div>
                <div class="form-group col-md-4">
                    <label>Price (N)</label>
                    <input type="text" class="form-control" name="price[]" id="p{{$i}}" onchange="qtyFirst(this); numberFormat(this); addPrice(this)" onclick="minusPrice(this)" value="{{$service->price}}">
                </div>
                <div class="form-group col-md-2">
                    <br/>
                    <input type="button" class="btn btn-danger" name="clear" id="c{{$i}}" value="Clear Row" onclick="clearRow(this)">
                </div>
            </div>
            @endforeach


        </div>


    </div>

    <div>&nbsp;</div>

    <div class="row">
        <div class="col-md-4">
            <input type="button" value="Add Item" class="btn btn-info" onClick="addInput('dynamicInput');">
        </div>
    </div>

    <div class="row">
        <hr>
    </div>
    <div class="row">
        <!--<div class="col-md-4">
            <label>
                Total
            </label>
            <input type="text" name="total" class="form-control" readonly>
        </div>-->
        <div class="form-group col-md-2">
            <label>
                Discount
            </label>
            <input type="text" name="discount" class="form-control" onchange="confirm_type(this)" value="{{$invoice->discount}}">
        </div>
        <div class="col-md-4">
            <div class="radio">
                <label>
                    <input type="radio" value="0" name="d_type"
                    @if ($invoice->d_type ==0)
                        checked
                            @endif
                    >
                    Percentage <span class="help-block">0-100%</span>
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" value="1" name="d_type"
                           @if ($invoice->d_type ==1)
                           checked
                           @endif
                    >
                    Actual value
                </label>
            </div>

        </div>
    </div>
    <div class="row">
        <hr>
    </div>


    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}

        </div>
    </div>
    {!! Form::close() !!}

<script type="text/javascript">
        //http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
        var counter = 1;
        var limit = 10;
        var d=0;
        function addInput(divName){
            if (counter == limit)  {
                alert("You have reached the limit of adding " + counter + " inputs");
            }
            else {
                var newdiv = document.createElement('tr');

                newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";

                newdiv.innerHTML = '<div class="row"><div class="form-group col-md-6"><label>New Item' + (counter) +'</label><input type="text" class="form-control" name="service[]"></div> <div class="form-group col-md-2"> <label>Qty</label> <input type="text" id="qty'+counter+'"  class="form-control" name="qty[]" onchange="check_value(this)"  onclick="minusPrice(this)"> </div><div class="form-group col-md-4"><label>Price (N)</label> <input type="text" class="form-control" name="price[]" id="p'+counter+'" onchange="qtyFirst(this); numberFormat(this); addPrice(this)" onclick="minusPrice(this)"><input type="hidden" name="service_id[]" value=""></div></div>';
                document.getElementById(divName).appendChild(newdiv);
                counter++;
            }
        }

        function check_value(field){
            var num = field.value;
            num = num.replace( /,/g, "" )
            if (isNaN(num)){
                alert ('A number must be in the price field '+field.value);
                field.value ="";
                return false
            }
            else
            {
                field.value = num
                return num
            }

        }

        function numberFormat(field){
            var num
            if (num = check_value(field)){
                num = CurrencyFormatted(num)
                //num = CommaFormatted(num)
                field.value = num
            }
        }

        function CurrencyFormatted(amount) {
            //https://css-tricks.com/snippets/javascript/format-currency/
            var i = parseFloat(amount);
            if(isNaN(i)) { i = 0.00; }
            var minus = '';
            if(i < 0) { minus = '-'; }
            i = Math.abs(i);
            i = parseInt((i + .005) * 100);
            i = i / 100;
            s = new String(i);
            if(s.indexOf('.') < 0) { s += '.00'; }
            if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
            s = minus + s;
            return s;
        }

        function CommaFormatted(amount) {
            //https://css-tricks.com/snippets/javascript/comma-values-in-numbers/
            var delimiter = ","; // replace comma if desired
            var a = amount.split('.',2)
            var d = a[1];
            var i = parseInt(a[0]);
            if(isNaN(i)) { return ''; }
            var minus = '';
            if(i < 0) { minus = '-'; }
            i = Math.abs(i);
            var n = new String(i);
            var a = [];
            while(n.length > 3) {
                var nn = n.substr(n.length-3);
                a.unshift(nn);
                n = n.substr(0,n.length-3);
            }
            if(n.length > 0) { a.unshift(n); }
            n = a.join(delimiter);
            if(d.length < 1) { amount = n; }
            else { amount = n + '.' + d; }
            amount = minus + amount;
            return amount;
        }

        function confirm_type (field)
        {
            //var radio = document.forms[0].elements["d_type"]
            var radio = document.getElementsByName("d_type");
            for (var i = 0; i < radio.length;  i++)
            {
                if (radio[i].checked)
                {
                    if (radio[i].value ==0){
                        var num
                        if (num = check_value(field)){
                            if (num > 100){
                                alert ('Enter Percentage value between 0 and 100 or select Actual value to enter actual discount amount')
                                field.value = ""
                            }
                            else if (num < 0){
                                alert ('Enter Percentage value between 0 and 100 or select Actual value to enter actual discount amount')
                                field.value = ""
                            }
                        }
                    }
                    else {
                        numberFormat(field)
                    }
                }

            }

        }

        function addPrice (field){
            var a = document.getElementsByName("total");
            var total = check_value(a[0])
            var id = field.id
            var no = id.replace( /^\D+/g, '');
            var qty = "qty"+no
            q = document.getElementById(qty)
            var prod = check_value(field)*check_value(q)
            if (total =="")
                total = 0
            total = parseInt (total) + prod
            total = CurrencyFormatted(total)
            total = CommaFormatted(total)
            d++
            a[0].value = total
        }

        function minusPrice (field){
            if (d>0){
                if (field.value !=""){
                    var a = document.getElementsByName("total");
                    var total = check_value(a[0])
                    if (total !=""){
                        var id = field.id
                        var no = id.replace( /^\D+/g, '');
                        var qty = "qty"+no
                        var q = document.getElementById(qty)
                        var price = "p"+no
                        var p = document.getElementById(price)
                        var prod = check_value(p)*check_value(q)
                        total = parseInt (total) - prod
                        q.value = ""
                        p.value = ""
                        total = CurrencyFormatted(total)
                        total = CommaFormatted(total)
                        d = 0;
                        a[0].value = total
                    }
                }
            }
        }

        function qtyFirst (field){
            var id = field.id
            var no = id.replace( /^\D+/g, '');
            var qty = "qty"+no
            var q = document.getElementById(qty)
            if (q.value==""){
                alert ("Fill quantity first");
                field.value = ""
            }
        }

        function clearRow (field){
            var id = field.id
            var no = id.replace( /^\D+/g, '');

            var s = "s"+no
            var service= document.getElementById(s)
            service.value = "";

            var qty = "qty"+no
            var q = document.getElementById(qty)
            q.value =""

            var price = "p"+no
            var p = document.getElementById(price)
            p.value = ""
        }




</script>
@endsection