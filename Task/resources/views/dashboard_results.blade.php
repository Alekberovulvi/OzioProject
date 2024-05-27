@extends('welcome')

@section('title', 'Filter Results')

@section('content')

<div class="container mt-4">
    <h1>Filter Results</h1>

    <div class="mt-4">
        <h2>Shopping Customers</h2>
        @if($nonReturnedSales->count() > 0)
            <div class="list-group">
                @foreach($nonReturnedSales as $customer) 
                    @if($customer->user)
                        <a href="{{ route('dashboard.customer.details', $customer->user->id) }}" class="list-group-item list-group-item-action">
                            {{ $customer->user->name }} - Phone: {{ $customer->user->user_phone }} - Card No: {{ $customer->cardno }}
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="mt-4">
                {{ $nonReturnedSales->appends(['start_date' => session('start_date'), 'end_date' => session('end_date'), 'store_code' => session('store_code')])->links() }}
            </div>
        @else
            <p class="mt-4">There are no customers shopping in this date range.</p>
        @endif
    </div>

    <div class="mt-4">
        <h2>Non-Shopping Customers</h2>
        @if($returnedSales->count() > 0)
            <div class="list-group">
                @foreach($returnedSales as $customer)
                    @if($customer->user)
                        <a href="{{ route('dashboard.customer.details', $customer->user->id) }}" class="list-group-item list-group-item-action">
                            {{ $customer->user->name }} - Card No: {{ $customer->cardno }}
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="mt-4">
                {{ $returnedSales->appends(['start_date' => session('start_date'), 'end_date' => session('end_date'), 'store_code' => session('store_code')])->links() }}
            </div>
        @else
            <p class="mt-4">There are no customers who have not made a purchase in this date range.</p>
        @endif
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Cancel</a>
</div>

@endsection
