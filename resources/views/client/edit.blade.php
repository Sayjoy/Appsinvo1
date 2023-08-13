@extends('layouts.admin')

@section('content')
    <h1>Edit Client</h1>
    {{--{!! Form::model($client,['method'=>'DELETE','action' => ['ClientsController@destroy', $client->id]]) !!}
    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
    {!! Form::close() !!}--}}
    {!! Form::model($client,['method'=>'PATCH', 'action' => ['ClientsController@update', $client->id]]) !!}
    <div class="row">
        <div class="form-group col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null,['class'=>'form-control']) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null,['class'=>'form-control']) !!}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6{{ $errors->has('phone') ? ' has-error' : '' }}">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', null, ['class'=>'form-control']) !!}

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6{{ $errors->has('address') ? ' has-error' : '' }}">
            {!! Form::label('address', 'Address') !!}
            {!! Form::textarea('address',null, ['class'=>'form-control']) !!}

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
        </div>

    </div>
    {!! Form::close() !!}


@endsection