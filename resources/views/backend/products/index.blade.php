@extends('layouts.backend.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Products Management</h2>
        </div>
        <div class="pull-right pt-3 pb-5">
            <a class="btn btn-success" href="#"> Create New Product</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th>Category</th>
     <th>Description</th>
     <th>price</th>
     <th>Language</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($products as $key => $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->language }}</td>
        <td>
            <a class="btn btn-primary" href="#">Edit</a>
            <a class="btn btn-danger" href="#">Delete</a>
            <!-- {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!} -->
        </td>
    </tr>
    @endforeach
</table>


{!! $products->render() !!}


@endsection