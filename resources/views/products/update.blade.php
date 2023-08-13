@extends('layouts.admin')

@section('content')

    {!! Form::open(['url' =>'updateproduct',]) !!}



    @for ($i=0; $i<sizeof ($nodes); $i++)
        <h4>{{ucwords (implode(' > ', $ancestors[$i]->toArray()))}}</h4>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Part No</label>
                <input type="text" name="part_no[]" value="{{$nodes[$i]->part_no}}" class="form-control">
                <input type="hidden" name="id[]" value="{{$nodes[$i]->id}}">
                <label>Name</label>
                <input type="text" name="name[]"  value="{{$nodes[$i]->name}}"class="form-control">

            </div>

            <div class="form-group col-md-2">
                <label>Price</label>
                <input type="text" name="price[]" value="{{$nodes[$i]->price}}"  class="form-control">
                <label>Unit</label>
                <input type="text" name="unit[]" value="{{$nodes[$i]->unit}}" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label>Description</label>
                <textarea name="description[]"  value="{{$nodes[$i]->description}}" class="form-control"></textarea>
            </div>
        </div>

    @endfor
    <div class="row">
        <div class="col-md-4"><input type="submit" name="edit_data" value="Edit Products" class="btn btn-primary"></div>
    </div>
    {!! Form::close() !!}

@endsection