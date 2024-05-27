@extends('welcome')

@section('title', $user->name . ' - Shopping History')

@section('content')

<div class="container mt-4">
    <h1>{{ $user->name }} - Transaction History</h1>

    @if($userSaleshistory->count() > 0)
        <div class="list-group mt-4">
            @foreach($userSaleshistory as $receipt)
                <a href="{{ route('dashboard.receipt.items', $receipt->id) }}" class="list-group-item list-group-item-action">
                    Sale ID: {{ $receipt->id }} - Store: {{ $receipt->store->name }} - Date: {{ $receipt->sale_date }}
                </a>
            @endforeach
        </div>
        <div class="mt-4">
            {{$userSaleshistory->links()}}
        </div>
    @else
        <p class="mt-4">No purchase history.</p>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Cancel</a>
</div>

@endsection
