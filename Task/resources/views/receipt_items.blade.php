@extends('welcome')

@section('title', 'Purchase Details')

@section('content')

<div class="container mt-4">
    <h1>Sales Products</h1>

    @if($items->count() > 0)
        <div class="list-group mt-4">
            @foreach($items as $item)
                <a href="#" class="list-group-item list-group-item-action">
                    {{ $item->product_name }} - Count: {{ $item->quantity }} - Barcode: {{ $item->barcode }} - Product: {{ $item->name }} - Price: {{ $item->price }}
                </a>
            @endforeach
        </div>
        <div class="mt-4">
            {{$items->links()}}
        </div>
    @else
        <p class="mt-4">There are no products for this sale.</p>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Cancel</a>
</div>

@endsection
