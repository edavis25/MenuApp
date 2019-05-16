@extends('layout.master')

@section('content')
    @foreach($menu_items as $item)
        <form action="{{ route('web.cart.add', $item->id) }}" method="POST">
        <input type="hidden" value="{{ csrf_token() }}" name="_token" />
        <h1>{{ $item->name }}</h1>
        <p>{{ $item->description }}</p>

        @foreach($item->addonGroups as $group)
            <h3>{{ $group->name }}</h3>
            @foreach($group->addons as $addon)
                @if ($group->exclusive)
                    <input type="radio" name="addons[{{ $group->id }}][]" value="{{ $addon->id }}" />
                    {{ $addon->name }}
                    @if ($addon->price)
                        (+{{ $addon->formattedPrice() }})
                    @endif
                @else
                    <input type="checkbox" name="addons[{{ $group->id }}][]" value="{{ $addon->id }}" />
                    {{ $addon->name }}
                    @if ($addon->price)
                        (+{{ $addon->formattedPrice() }})
                    @endif
                @endif
            @endforeach
        @endforeach
        <hr>
        <input type="submit" />
        <a href="{{ route('web.cart.show') }}">View Cart</a>
        </form>
    @endforeach
@endsection