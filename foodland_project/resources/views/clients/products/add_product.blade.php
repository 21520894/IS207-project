@extends('clients.layout')
@section('content')

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
    <form action="{{ route('products.store') }}" method = "post" >
    @csrf
        <div style = "display:flex;
        flex-direction: column;
        width:400px;
        item-: 10px
        ">
        <input type="text" placeholder = "Name" name = "Name">
        <input type="text" placeholder = "Price" name = "Price">
        <select name="CategoryID" id="type_food">
            @foreach($categories as $category)
            <option value = "{{$category->CategoryID}}">{{$category->Title}}</option>
            @endforeach
        </select>
        <input type="text" placeholder = "describe" name = "Description">
    <input type="submit" value="submit">
    </div>

    </form>

@endsection
