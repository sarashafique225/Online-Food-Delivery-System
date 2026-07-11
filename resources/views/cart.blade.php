@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Your Food Basket</h2>
        <span class="badge bg-primary rounded-pill">{{ $cartItems->count() }} Items</span>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if($cartItems->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                    <p class="text-muted mb-0">Your basket is empty. Time to order some delicious food!</p>
                </div>
            @else
                @foreach($cartItems as $item)
                    <div class="card border-0 shadow-sm rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex">
                                <div class="bg-light rounded-3 p-3 me-3 text-primary">
                                    <i class="bi bi-shop fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $item->food_name }}</h5>
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-geo-alt"></i> {{ $item->restaurant_name }}
                                    </p>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock"></i> Added on: {{ $item->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-bold text-primary mb-2">Rs. {{ $item->price * $item->quantity }}</h5>
                                
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none small">
                                        <i class="bi bi-trash"></i> Cancel Item
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            
            <a href="{{ url('/restaurants') }}" class="btn btn-outline-primary rounded-pill mt-3">
                <i class="bi bi-arrow-left"></i> Add More Food
            </a>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Summary</h4>
                
                @php 
                    $subtotal = $cartItems->sum(fn($i) => $i->price * $i->quantity);
                    $delivery = $subtotal > 0 ? 150 : 0;
                @endphp

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-semibold">Rs. {{ $subtotal }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Delivery Fee</span>
                    <span class="fw-semibold">Rs. {{ $delivery }}</span>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5 text-primary">Rs. {{ $subtotal + $delivery }}</span>
                </div>

                @if($subtotal > 0)
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm">
                            Place Order Now 🚀
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection