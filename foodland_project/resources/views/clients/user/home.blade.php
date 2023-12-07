@extends('layouts/clients')
@section('content')
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    @include('clients/blocks/slider')
    @include('clients/user/menu')
    @if(\Illuminate\Support\Facades\Auth::check())
        @include('clients/user/order')
    @endif
    @include('clients/blocks/promotion')
    @include('clients/blocks/about')
    @include('clients/blocks/consult')
@endsection
