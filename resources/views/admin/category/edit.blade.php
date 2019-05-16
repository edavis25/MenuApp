<?php
/**
 * @var App\Category|null $category
 */
?>
@extends('layout.admin')

@section('content')

    @if(isset($category->id))
        {!! Form::model($category, ['route' => ['admin.category.update', $category->id ], 'method' => 'PUT', 'class' => 'col-md-6']) !!}
        <h1>Editing: {{ $category->name }}</h1>
    @else
        {!! Form::open(['route' => 'admin.category.store', 'method' => 'POST', 'class' => 'col-md-6']) !!}
        <h1>Create new Category</h1>
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
        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success">{!! isset($category->id) ? '<i class="fa fa-save"></i> Update' : '<i class="fa fa-plus"></i> Create' !!}</button>
    </div>

    {!! Form::close() !!}

@endsection