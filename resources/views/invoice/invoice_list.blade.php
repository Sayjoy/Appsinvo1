@extends('layouts.admin')

@section('content')
   <div class="row mt-5">
       <div class="col-md-8"><h1>List of Invoices</h1></div>
       <div class="col-md-4">
           {!! Form::open(['url' =>'search']) !!}
           <div class="input-group">
                      {!! Form::text('query','',['class'=>'form-control', 'placeholder'=>'What are you looking for?']) !!}
                      {!! Form::submit('Search', ['class'=>'btn btn-sm btn-primary']) !!}
           </div>
           {!! Form::close() !!}
       </div>
   </div>
   <div>

   </div>
   {!! Form::open(['url' =>'invoice']) !!}
    <table class="table">
        <tr>
            <th><input type="checkbox" name="control" id="select_all"></th>
            <th>#</th>
            <th>Invoice </th>
            <th>Client</th>
            <th>Created by</th>
            <th>Date Created</th>
            <th>Due date</th>
            <th>Payment Status</th>
            <th>Edit</th>
        </tr>
        <?php
            $r = $invoices->perPage() * ($invoices->currentPage()-1);
        ?>
        @for ($i=0;$i<sizeof($invoices);$i++)
            <tr>
                <td><input type="checkbox" name="invoice[]" class="checkbox" value="{{$invoices[$i]->id}}"></td>
                <td> {{++$r}}</td>
                <td>{{$invoices[$i]->title}}<br/>
                    <a href="{{ action('InvoicesController@show',[$invoices[$i]->id]) }}">{{$invoices[$i]->invoice_id}}</a></td>
                <td>{{$clients[$i]->name}}</td>
                <td>{{$created_by[$i]->name}}</td>
                <td>{{$invoices[$i]->created_at}}</td>
                <td>{{$invoices[$i]->due_date}}</td>
                @if ($invoices[$i]->paid>0)
                    <td>Paid Fully ({{number_format($invoices[$i]->amount)}})</td>
                @elseif($invoices[$i]->paid<0)
                    <td><a href="receipt/create/{{$invoices[$i]->id}}" class="btn btn-info btn-sm">Balance Required ({{number_format($invoices[$i]->receipts->last()->balance)}})</a></td>
                @else
                    <td><a href="receipt/create/{{$invoices[$i]->id}}" class="btn btn-primary btn-sm">No Payment ({{number_format($invoices[$i]->amount)}})</a></td>
                @endif
                <td>
                    <a href="invoice/{{$invoices[$i]->id}}/edit" class="btn btn-info btn-sm">Edit</a>
                </td>
            </tr>
        @endfor
        <tr><td colspan="5">
               {{$invoices->links()}}
            </td>
            <td>
                <input type="submit" name="delete" value="Delete" id="delete" class="btn btn-danger">
            </td>
        </tr>
    </table>
   {!! Form::close() !!}
   <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
   <script type="text/javascript">
       //select all checkboxes
       $("#select_all").change(function(){  //"select all" change
           var status = this.checked; // "select all" checked status
           $('.checkbox').each(function(){ //iterate all listed checkbox items
               this.checked = status; //change ".checkbox" checked status
           });
       });

       $('.checkbox').change(function(){ //".checkbox" change
           //uncheck "select all", if one of the listed checkbox item is unchecked
           if(this.checked == false){ //if this item is unchecked
               $("#select_all")[0].checked = false; //change "select all" checked status to false
           }

           //check "select all" if all checkbox items are checked
           if ($('.checkbox:checked').length == $('.checkbox').length ){
               $("#select_all")[0].checked = true; //change "select all" checked status to true
           }
       });

       $(function() {
           $("#delete").click(function(){
               return confirm("Receipt(s) Related to the selected invoice(s) will be deleted")

           });
       });
   </script>
@endsection
