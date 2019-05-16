@extends('layout.admin')

@section('content')
    <h1>Menu Categories</h1>
    <div>
        <a class="btn btn-success" href="{{ route('admin.category.create') }}"><i class="fa fa-plus"></i> Create New Category</a>
    </div>
    <br>
    <table class="table col-md-12">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.category.edit', $category->id) }}"><i class="fa fa-pencil-alt"></i> Edit</a>
                    {!! Form::open(['route' => ['admin.category.destroy', $category->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection