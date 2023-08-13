@extends('layouts.admin')

@section('content')

{!! Form::open(['url' =>'waybill', 'id' => 'waybill_form']) !!}


<div class="row">
    <div class="col-md-8">
        <h4> Create Waybill {{$delivered["waybill"]+1}}</h4>
    <table class="table">
        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
        <tr>
            <th>#</th>
            <th>Item</th>
            <th>Invoiced Qty</th>
            <th>Delivered Qty</th>
            <th width="100">Available</th>
            <th></th>
        </tr>

        <?php $i=0; $sub=0; $vat = 0;?>
        @isset ($products)
        @foreach($products as $product)

            <?php
                $available =$product->pivot->qty - $delivered["products"][$product->id];
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
                    <td> {{$delivered["products"][$product->id]}}</td>
                    <td>  <input type="text" class="form-control" name="qty[]"
                                 @if ($available<1)
                                         readonly
                                 @endif
                                 value="{{$available}}" onchange="check_value(this,{{$available}})">
                        <input type="hidden" name="product_id[]" value="{{$product->id}}"></td>
                </tr>

            @endif

        @endforeach
        @endisset

        @isset ($services)
        @foreach($services as $service)
            <?php
            $available = $service->qty - $delivered["services"][$service->id];
            ?>

            <tr>
                <td>{{++$i}}</td>
                <td> {{$service->service}}                
                    <div id="r{{$service->id}}"></div>
                </td>
                <td> {{$service->qty}}</td>
                <td> {{$delivered["services"][$service->id]}}</td>
                <td>  <input type="text" class="form-control" size="1" name="qty2[]" value="{{$available}}"
                         id="qty{{$service->id}}" onchange="check_value(this,{{$available}})">
                    <input type="hidden" name="service_id[]" value="{{$service->id}}"></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" 
                        data-target="#modal{{$service->id}}" id="btn{{$service->id}}">
                       Add Serial No
                      </button>
                </td>

            </tr>
            
            <!-- Modal -->
<div class="modal fade" id="modal{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Serial numbers for {{$service->service}}</h5>
          <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <div id="r2{{$service->id}}" class="text-success"></div>
            <!--<div>
                <h2>Use a value range</h2>
                <p>

                </p>
            </div>-->
            <div id="t{{$service->id}}" class="row">
        
            </div>
            
            <script type="text/javascript">
                no = "<?php echo"$service->id"?>";
                var qty = "qty"+no
                var q = document.getElementById(qty)
                var tr = "";
                for (var i=0; i<q.value; i++){
                    tr += "<div class='col-md-1 mb-2'>"+eval(i+1)+"</div><div class='col-md-11 mb-2'><input type='text' class='form-control' name='item"+ no + i + "'></div>"
                }
                tr +="<div class='col-md-1 mb-2'></div><div class='col-md-11 mb-2'><button type=button onclick='post_serial_no(" + no + ", " + q.value + ")' class='btn btn-primary'>Add Serial No.</button></div>"
                document.getElementById("t"+no).innerHTML = tr
            </script>
                                                                    
        </div>

        <div class="modal-footer">
            <!--
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
          -->
        </div>
      </div>
    </div>
  </div>
 <!--End Modal -->

        @endforeach
        @endisset
        <tr>
            <td></td>
            <td colspan="5">
                <input type="submit" value="Generate" class="btn btn-primary">
            </td>

    </table>

    </div>
</div>
{{ Form::close() }}


<script type="text/javascript">
    function check_value(field, cap){
        var num = field.value;
        num = num.replace( /,/g, "" )
        if (isNaN(num)){
            alert ('A number must be in the price field '+field.value);
            field.value ="";
            return false
        }
        else
        {
            if (num> Number(cap)){
                alert ('Required quantity higher than available quantity');
                field.value = cap;
            }

        }
    }

    function post_serial_no(no, q){
        var serial_no = []
        for (i=0; i<q; i++){
            var $input = $( "input[name=item"+no+i+"]" ).val();
            if ($input.trim().length!==0){
                serial_no.push($input)
            }
        }
        var data ={}
        data['serial_nos'] = serial_no;
        data['service_id'] = no;
        s_data = JSON.stringify(data);

        $.ajax({
            url: "{{ url('/post_serial_no/') }}",
            method: 'GET',
            data:{
              serial_data: s_data
            },
            success: function (data) {
                //alert (data.html)
                $('#r'+no).html(data.html);
                $('#r2'+no).html(data.html);
                $("#modal"+no).modal("dispose");
            },
            error: function (jqxhr, textStatus, errorThrown) {
                alert("Error: " + textStatus + " : " + errorThrown);
            }
        });
    }

</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection