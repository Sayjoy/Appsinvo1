@extends('layouts.admin')

@section('content')
<h1>Create Product</h1>

<div class="row">

   <div class="col-md-12" id="dynamicInput">

       <div class="row" id="dynamicProduct">

           <div class="col-md-12" id="parent0">

               <div>
                 {!! Form::open(['url' =>'product', 'id'=>'form0']) !!}
                    <div class="col-md-4 form-group">
                           <h4>Choose a Category</h4>
                           <label>Start Here</label>
                           <select class="form-control" onchange="populateChild(this)">
                               {{--Display all parents--}}
                               <option selected>Select a Category/Product</option>
                               @foreach ($root as $r)
                                   <option value="{{$r->id}}">{{$r->name}}</option>
                               @endforeach
                           </select>
                       </div>

                       <div class="form-group col-md-8 well">
                           <h4 align="center">Or Add 1 Product to {{$node->name}}</h4>
                           <div class="row">
                               <div class="form-group col-md-4">
                                   <label>Part No</label>
                                   <input type="text" name="part_no" class="form-control">
                                   <label>Name</label>
                                   <input type="text" name="name" class="form-control">
                                   <input type="hidden" name="parent" value="{{$node->id}}">
                               </div>

                               <div class="form-group col-md-2">
                                   <label>Price</label>
                                   <input type="text" name="price" class="form-control">
                                   <label>Unit</label>
                                   <input type="text" name="unit" class="form-control">
                               </div>

                               <div class="form-group col-md-4">
                                   <label>Description</label>
                                   <textarea name="description" class="form-control"></textarea>
                               </div>

                               <div class="form-group col-md-2">
                                   <br/>
                                   <input type="submit" name="add_one" class="btn btn-primary">
                               </div>

                           </div>

                           <div class="row">
                               <hr/>
                               <div class="col-md-4"><h4>Or Add Many items to {{$node->name}}</h4></div>
                               <div class="form-group col-md-2">
                                   <label>How Many?</label>
                                   <input type="text" name="qty" class="form-control">
                               </div>
                               <div class="form-group col-md-2">
                                   <br/>
                                   <input type="submit" name="add_many" class="btn btn-primary">
                               </div>
                           </div>
                       </div>
                   {!! Form::close() !!}

               </div>

           </div>

       </div>

   </div>

</div>

<!--Javascript
<div id="dynamicInput">
    Entry 1<br><input type="text" name="myInputs[]">
</div>

-->
<script type="text/javascript" src="{{asset ('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">
    //http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
    var counter = 1;
    var limit = 100;
    var d=0;
    function addInput(divName){
        if (counter == limit)  {
            alert("You have reached the limit of adding " + counter + " inputs");
        }
        else {
            var newdiv = document.createElement('div');

            newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";

            newdiv.innerHTML = '<div class="row"><div class="form-group col-md-6"><label>Item' + (counter + 1) +'</label><input type="text" class="form-control" name="service[]"></div> <div class="form-group col-md-2"> <label>Qty</label> <input type="text" id="qty'+counter+'"  class="form-control" name="qty[]" onchange="check_value(this)"  onclick="minusPrice(this)"> </div><div class="form-group col-md-4"><label>Price (N)</label> <input type="text" class="form-control" name="price[]" id="p'+counter+'" onchange="qtyFirst(this); numberFormat(this); addPrice(this)" onclick="minusPrice(this)"></div></div>';
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
            num = CommaFormatted(num)
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

    //jquery for adding products
    function populateChild(field){
        div_id = field.parentNode.parentNode.parentNode.parentNode.id;
        parent_id = field.value;
       //Remove all next Siblings
        child = document.getElementById(div_id);
        while( (child = child.nextSibling) != null )
        {
            child.innerHTML ="";
        }
            //document.getElementById(div_id).nextSibling.innerHTML ="";
            //$('#' + div_id).next().empty();
            //csrfVar = $('meta[name="csrf-token"]').attr('content');
            //url: "/getchild/" + parent_id +"/"+csrfVar,
            csrfVar = $('#form0').find('input[name="_token"]').val();
            $.ajax({
                url: "{{url ('getchild/')}}",
                method: 'GET',
                data: {
                    id: parent_id,
                    csrfVar: csrfVar,
                },
                success: function (data) {
                    document.getElementById(div_id).insertAdjacentHTML("afterend",data.html);

                },
                error: function (jqxhr, textStatus, errorThrown) {
                    alert("Error: " + textStatus + " : " + errorThrown);
                }
            });
    }


</script>
@endsection
