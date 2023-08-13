@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>{{$client->name}}</h3>
            <h4>{{$client->email}}</h4>
            <p>{{$client->phone}}</p>
            <p>{{$client->address}}</p>
            <p>
                {!! Form::open(['method'=>'DELETE',
                                'route'=>['client.destroy', $client->id]
                                ]) !!}
                <input type="hidden" name="_method" value="DELETE">
                {!! Form::submit('Delete Client', ['class'=>'btn btn-danger confirm', 'data-confirm' => 'Are you sure you want to delete? All related invoices, receipts and waybills will be deleted']) !!}

                {!! Form::close() !!}

            </p>
        </div>
    </div>

   <div class="row">
       <div class="col-md-8"><h3>List of Invoices by {{$client->name}}</h3></div>
       <div class="col-md-4">
           <div class="row form-group">
               {!! Form::open(['url' =>'search']) !!}
               <div class="col-md-8">
                      {!! Form::text('query', 'What are you looking for?',['class'=>'form-control']) !!}
               </div>
               <div class="col-md-4">
                      {!! Form::submit('Search', ['class'=>'btn btn-sm btn-primary']) !!}
               </div>
           {!! Form::close() !!}
           </div>
       </div>
   </div>
   <div>

   </div>
    <table class="table">
        <tr>
            <th>#</th>
            <th>Invoice </th>
            <th>Created by</th>
            <th>Date Created</th>
            <th>Due date</th>
            <th>Payment Status</th>
            <th>Edit</th>
        </tr>

        @for ($i=0;$i<sizeof($invoices);$i++)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$invoices[$i]->title}}<br/>
                    <a href="{{ action('InvoicesController@show',[$invoices[$i]->id]) }}">{{$invoices[$i]->invoice_id}}</a></td>
                <td>{{$created_by[$i]->name}}</td>
                <td>{{$invoices[$i]->created_at}}</td>
                <td>{{$invoices[$i]->due_date}}</td>
                @if ($invoices[$i]->paid>0)
                    <td>Paid Fully</td>
                @elseif($invoices[$i]->paid<0)
                    <td><a href="receipt/create/{{$invoices[$i]->id}}" class="btn btn-info btn-sm">Complete Payment</a></td>
                @else
                    <td><a href="receipt/create/{{$invoices[$i]->id}}" class="btn btn-primary btn-sm">Make Payment</a></td>
                @endif
                <td>
                    <a href="invoice/{{$invoices[$i]->id}}/edit" class="btn btn-info btn-sm">Edit</a>
                </td>
            </tr>
        @endfor
        <tr><td colspan="8">

            </td>
        </tr>
    </table>

    <script type="text/javascript" src="{{asset ('js/jquery-3.4.1.min.js')}}"></script>
    <script>
        /*window.onload = function()
        {
            if (window.jQuery)
            {
                alert('jQuery is loaded');
            }
            else
            {
                alert('jQuery is not loaded');
            }
        }*/

        $('.confirm').on('click', function (e) {
            if (confirm($(this).data('confirm'))) {
                return true;
            }
            else {
                return false;
            }
        });

    </script>
@endsection