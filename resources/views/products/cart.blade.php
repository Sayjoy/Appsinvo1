@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['url' =>'invoice']) !!}
    <div class="row">
        <div class="col-md-4">
            <label>Title</label>
            <input type="text" name="title"
                   @if (isset ($invoice))
                           value="{{$invoice->title}}"
                   @elseif (session()->has('cartdata'))
                           value = "{{session()->get('cartdata')['title']}}"
                   @endif
                   class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label>Select a Client</label>
            <select class="form-control" name="client">
                {{--Get al  clients in option--}}
                @foreach ($clients as $client)
                    <option value="{{$client->id}}"
                            @if (isset ($invoice->client_id) && $invoice->client_id==$client->id)
                                selected
                            @elseif (session()->has('cartdata') && $client->id==session()->get('cartdata')['client'])
                                selected
                            @endif
                    >{{$client->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Due Date</label>
            <input class="date form-control" name="due_date"
                   @if (isset ($invoice))
                        value="{{$invoice->due_date}}"
                   @elseif (session()->has('cartdata'))
                        value = "{{session()->get('cartdata')['duedate']}}"
                   @endif
                   type="text">
        </div>
        <!--<div class="form-group col-md-3">
            <label>What to do with Headings</label>
            <select id="withparent" class="form-control">
                <option value="0">Do Nothing</option>
                <option value="1">Make Title(Remmove Price)</option>
                <option value="2">Remove from invoice</option>
            </select>
        </div>-->
    </div>

    @if(count($cart))

        <div id="cart">


        </div>
    @else
            <p>You have no items in the shopping cart</p>
    @endif

    <div> <br/>

    </div>
    {!! Form::close() !!}


<script type="text/javascript" src="{{asset ('/js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        showCart();
    });

    $("#withparent").change (function () {
        showCart();
    })
    function showCart(newvalue) {
        withparent = $("#withparent").children("option:selected").val()

       if (newvalue===undefined){
           newvalue = {"withparent":withparent}
        }
        else {
            newvalue.withparent = withparent;
        }

        newvalue = JSON.stringify(newvalue);

        $.ajax({
            url: "{{ url('/showcart/') }}",
            method: 'GET',
            data:{
              cartval: newvalue
            },
            success: function (data) {
                //document.getElementById(div_id).insertAdjacentHTML("afterend", data.html);
                $('#cart').html(data.html);
            },
            error: function (jqxhr, textStatus, errorThrown) {
                alert("Error: " + textStatus + " : " + errorThrown);
            }
        });

    }

    function changeQty(field) {
        var num = field.value;
        if (isNaN(num)){
            alert ('Please enter number in field');
            field.value =1;
            num = 1
        }

        var attr = field.parentNode;
        while (attr.tagName!="TR"){
            attr = attr.parentNode;
        }

        rowId = attr.id
        newvalue = {"rowId":rowId, "qty":num}

        showCart (newvalue)
    }

    function changePrice (field){
        var attr = field.parentNode;
        while (attr.tagName!="TR"){
            attr = attr.parentNode;
        }

        rowId = attr.id
        newvalue = {"rowId":rowId, "price":field.value}

        showCart (newvalue)
    }

    function changeName (field){
        var attr = field.parentNode;
        while (attr.tagName!="TR"){
            attr = attr.parentNode;
        }

        rowId = attr.id
        newvalue = {"rowId":rowId, "name":field.value}

        showCart (newvalue)
    }

    function removeItem (field){
        var attr = field.parentNode;
        while (attr.tagName!="TR"){
            attr = attr.parentNode;
        }

        rowId = attr.id
        newvalue = {"rowId":rowId, "rem":1}

        showCart (newvalue)
    }

    function removeTax (field){
        newvalue = {"tax":1}
        showCart (newvalue)
    }

    function addTax (field){
        newvalue = {"tax":2}
        showCart (newvalue)
    }

    function changeDiscount (field){
        if (isNaN(field.value)){
            alert ('Please enter number in field');
            field.value =0;
        }

        var attr = field.parentNode;
        while (attr.tagName!="TR"){
            attr = attr.parentNode;
        }

        rowId = attr.id
        price = document.getElementById("price"+rowId).value
        if (field.name =="discount1"){
            if (Number (field.value) > Number (price)){
                alert ("Discount value ("+field.value+") is more than item price ("+price+")")
                showCart()
            }
            else {
                discount = field.value*100/price
                newvalue = {"rowId":rowId, "discount":discount}
                showCart (newvalue)
            }
        }
        else if (field.name =="discount2"){
            if (Number(field.value) > 100){
                alert ("Discount value is more than 100%")
                showCart()
            }
            else {
                newvalue = {"rowId":rowId, "discount":field.value}
                showCart (newvalue)
            }
        }
    }
</script>
@endsection