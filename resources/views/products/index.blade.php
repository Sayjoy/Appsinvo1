@extends('layouts.admin')
@section('header')
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
@endsection
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
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {!! $message !!}
        </div>
    @endif

   <div class="row">
       <div class="col-md-8"><h3>Products Details</h3></div>
       <div class="col-md-4">
           <div class="row form-group">
               {!! Form::open(['url' =>'search']) !!}
               <div class="col-md-8">
                      {!! Form::text('query', 'What are you looking for?',['class'=>'form-control']) !!}
               </div>
               <div class="col-md-4">
                      {!! Form::submit('Search', ['class'=>'btn btn-sm btn-primary']) !!}
               </div>`
           {!! Form::close() !!}
           </div>
       </div>
   </div>



   {!! Form::open(['url' =>'editproduct']) !!}
    <div class="row alert-info">

    </div>
    <p>&nbsp;</p>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-8">
            <ul data-role="treeview">
                {!! $tree !!}
            </ul>
        </div>

    </div>


   <div class="row">
       <div class="col-md-1">
       </div>
       <div class="col-md-2">
           <input type="submit" value="Add to Cart" name="addcart" class="button primary">
       </div>
        <div class="col-md-2">
            <input type="submit" value="Edit Selected" name="edit" class="button secondary">
        </div>
       <div class="col-md-2">
           <input type="submit" name="delete" value="Delete Selected" id="delete" class="btn btn-danger">
       </div>
   </div>
   {!! Form::close() !!}




   @endsection
@section('js')
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script type="text/javascript">
        function checkParent(field, id){
            var ch = field.value;
            if (Number(ch)>0){
                document.getElementById(id).checked = true;
            }
        }

        $(function() {
            $("#delete").click(function(){
                return confirm("Child nodes of deleted product will be added to siblings.")

            });
        });


    </script>
@endsection