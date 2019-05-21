@extends('layout.master')

@section('body')
    <div class="container-fluid">
        @include('web.includes.navbar')
        <div class="row">
            @yield('content')
        </div>
    </div>
@endsection