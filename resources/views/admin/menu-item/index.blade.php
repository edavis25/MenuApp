@extends('layout.admin')

@section('content')
    <h1>Menu Items</h1>
    <div>
        <a class="btn btn-success" href="{{ route('admin.menu-item.create') }}"><i class="fa fa-plus"></i> Create Menu Item</a>
    </div>
    <br>
    <table class="table col-md-12">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>{{-- Empty for action buttons --}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu_items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->formattedPrice() }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('admin.menu-item.edit', $item->id) }}"><i class="fa fa-pencil-alt"></i></a>
                        {!! Form::open(['route' => ['admin.menu-item.destroy', $item->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection