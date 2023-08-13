@extends('layouts.admin')

@section('content')

 <h4>Add Products to {{$parent->name}}</h4>
    {!! Form::open(['url' =>'product']) !!}
    <input type="hidden" name="parent" value="{{$parent->id}}">
    @for ($i=0; $i<$qty; $i++)
       <strong>Item {{$i+1}}</strong><hr>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Part No</label>
                <input type="text" name="part_no[]" class="form-control">
                <label>Name</label>
                <input type="text" name="name[]" class="form-control">

            </div>

            <div class="form-group col-md-2">
                <label>Price</label>
                <input type="text" name="price[]" class="form-control">
                <label>Unit</label>
                <input type="text" name="unit[]" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label>Description</label>
                <textarea name="description[]" class="form-control"></textarea>
            </div>

        </div>

    @endfor
    <div class="row">
        <div class="col-md-4"><input type="submit" name="many_data" value="Add Products" class="btn btn-primary"></div>
    </div>
    {!! Form::close() !!}

@endsection