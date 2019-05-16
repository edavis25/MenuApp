@extends('layout.master')

@section('content')
    @if (! count($items))
        <h2>No items in your cart</h2>
    @endif
    @foreach ($items as $item)
        <h2>{{ $item->item()->name }}</h2>
        <p>Addons:</p>
        @foreach($item->addonGroups() as $group)
            <strong>{{ $group->name }}</strong>
            <ul>
            @foreach ($item->addonsByGroupId($group->id) as $addon)
                <li>
                    {{ $addon->name }}
                    @if ($addon->price)
                        (+ {{ $addon->formattedPrice() }})
                    @endif
                </li>
            @endforeach
            </ul>
        @endforeach
    @endforeach

{{--    @foreach ($items as $item)--}}
{{--        <h2>{{ $item['item']->name }}</h2>--}}
{{--        <p>Addons:</p>--}}
{{--        @foreach ($item['addons'] as $addon)--}}
{{--            <strong>{{ $addon['group']->name }}</strong>--}}
{{--            <ul>--}}
{{--                @foreach ($addon['items'] as $item)--}}
{{--                    <li>--}}
{{--                        {{ $item->name }}--}}
{{--                        @if ($item->price)--}}
{{--                            +{{ $item->formattedPrice() }}--}}
{{--                        @endif--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        @endforeach--}}
{{--    @endforeach--}}
@endsection