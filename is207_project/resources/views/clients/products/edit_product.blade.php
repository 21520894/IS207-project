@extends('clients.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update',$product->ProductID) }}" method = "post" >
    @csrf
    @method('PUT')
        <div style = "display:flex;
        flex-direction: column;
        width:400px;
        item-: 10px
        ">
        <input type="text" placeholder = "Name" name = "Name" value = "{{$product -> Name}}">
        <input type="text" placeholder = "Price" name = "Price" value = "{{$product -> Price}}">
        <select name="CategoryID" id="type_food" value = "{{$product->category->Title}}">
            @foreach($categories as $category)
            <option value = "{{$category->CategoryID}}">{{$category->Title}}</option>
            @endforeach
        </select>
        <!-- <input type="text" placeholder = "dị ứng" name = "allergen"> -->
        <input type="text" placeholder = "describe" name = "Description" value = "{{$product -> Description}}">
    <input type="submit" value="submit">
    </div>

    </form>
@endsection
