@extends('layout.master')

@section('body')

    @include('admin.includes.navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-secondary">
                <div class="row">
                    @include('admin.includes.sidebar')
                </div>
            </div>
            <div class="col-10 bg-light">
                @include('admin.includes.errors')
                @yield('content')
            </div>
        </div>
    </div>
@endsection