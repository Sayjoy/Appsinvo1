
<li><a class="nav-link text-white" href="{{ url('/service/create') }}">Create Invoice</a></li>
<!--<li><a class="nav-link text-white" href="{{ url('/product/create') }}">New Product</a></li>-->
<li><a class="nav-link text-white" href="{{ url('/invoice') }}">Invoices</a></li>
<li><a class="nav-link text-white" href="{{ url('/admin') }}">Admins</a></li>
<li><a class="nav-link text-white" href="{{ url('/admin/create') }}">New Admin</a></li>
<li><a class="nav-link text-white" href="{{ url('/client') }}">Clients</a></li>
<li><a class="nav-link text-white" href="{{ url('/client/create') }}">New Client</a></li>

<li>{!! Form::open(['url' =>'invoice']) !!}
        <input type="submit" role="link" name="clear" value="Clear Cart" class="btn-link nav-link text-white">
    {!! Form::close() !!}
</li>
<li><a class="nav-link text-white" href="{{ url('/cart') }}">Cart</a></li>
