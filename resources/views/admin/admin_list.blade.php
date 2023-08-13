@extends('layouts.admin')

@section('content')
<h1> Invoice Manager Administrator </h1>

<table class="table table-stripped">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php $i=0 ?>
    @foreach($admin as $ad)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$ad->name}}</td>
            <td>{{$ad->email}}</td>
            <td>
                {!! Form::model($ad,['method'=>'DELETE','action' => ['AdminController@destroy', $ad->id]]) !!}
                    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
    @endforeach
</table>

@endsection