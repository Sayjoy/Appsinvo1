@extends('layouts.admin')

@section('content')
    <h1> Invoice Manager Clients </h1>

    <table class="table table-stripped">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
        </tr>
        <?php $i=0 ?>
        @foreach($clients as $client)
            <tr>
                <td>{{++$i}}</td>
                <td><a href="{{ action('ClientsController@show',[$client->id]) }}">{{$client->name}}</a></td>
                <td> <a href="{{ action('ClientsController@edit',[$client->id]) }}">{{$client->email}}</a></td>
                <td>{{$client->phone}}</td>
                <td>{!! $client->address !!}</td>
        @endforeach
    </table>

@endsection