@extends('front_end.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
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
            <th>ID</th>
            <th>Name</th>
            <th>Group</th>
            <th>Price</th>
            <th>Status</th>
            <th>Describe</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->ProductID }}</td>
            <td>{{ $product->Name }}</td>
            <td>{{ $product->category-> Title }}</td>
            <td>{{ $product->Price }}</td>
            <td>{{ $product->ProductStatus }}</td>
            <td>{{ $product->Description }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->ProductID) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->ProductID) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->ProductID) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>


@endsection
