@extends('layout.admin')

@section('content')
    <h1>Menu Items</h1>
    <a href="{{ route('admin.menu-item.index') }}">View Items</a>

    <h1>Categories</h1>
    <a href="{{ route('admin.category.index') }}">View Categories</a>
@endsection