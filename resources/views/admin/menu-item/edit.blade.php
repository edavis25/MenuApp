<?php
/**
 * @var App\MenuItem|null $menu_item
 * @var App\Category[]    $categories
 */
?>
@extends('layout.admin')

@section('content')

@if(isset($menu_item->id))
    {!! Form::model($menu_item, ['route' => ['admin.menu-item.update', $menu_item->id ], 'method' => 'PUT', 'class' => 'col-md-6']) !!}
    <h1>Editing: {{ $menu_item->name }}</h1>
@else
    {!! Form::open(['route' => 'admin.menu-item.store', 'method' => 'POST', 'class' => 'col-md-6']) !!}
    <h1>Create new Menu Item</h1>
@endif
    <div class="form-group">
        <label>Name</label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>Description:</label>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>

    <div class="form-group">
        <label>Category:</label>
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>Price:</label>
        {!! Form::number('price', isset($menu_item->price) ? $menu_item->price / 100 : 0, ['class' => 'form-control', 'step' => '0.01']) !!}
    </div>

    <div class="form-group">
        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success">{!! isset($menu_item->id) ? '<i class="fa fa-save"></i> Update' : '<i class="fa fa-plus"></i> Create' !!}</button>
    </div>
    {!! Form::close() !!}

    <hr>

@if(isset($menu_item->id))
    <div class="container-fluid">
        <h2>Addon Groups</h2>
        @include('admin.includes.addon-group-form', ['menu_item' => $menu_item])

        @foreach($menu_item->addonGroups ?? [] as $group)
        <div class="card" style="width: 25rem;">
            <div class="card-header bg-dark">
                <h3 class="mb-0 d-inline text-white">{{ $group->name }}</h3>
                <div class="float-right">
                    @include('admin.includes.addon-group-form', ['addon_group' => $group, 'menu_item' => $menu_item])
                    {!! Form::open(['url' => route('admin.addon-group.destroy', $group->id), 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <div>
                    @include('admin.includes.addon-form', ['addon_group' => $group])
                </div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>{{-- Empty for action buttons --}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group->addons ?? [] as $addon)
                            <tr>
                                <td>{{ $addon->name }}</td>
                                <td>{{ $addon->price ? $addon->price / 100  : 0 }}</td>
                                <td>
                                    @include('admin.includes.addon-form', ['addon_group' => $group, 'addon' => $addon])
                                    {!! Form::open(['route' => ['admin.addon.destroy', $addon->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
