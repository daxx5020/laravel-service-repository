@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <a href="{{ route('home') }}" class="btn btn-primary">View products</a>
    <br><br>
    <h2>Cart Details</h2>

    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td style="width: 200px;" >
                            <img src="{{ asset($item->product->image) }}" class=" w-50" alt="Product Image"></td>
                        <td>{{ $item->product->name }}</td>
                        <td>₹{{ $item->product->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ $item->product->price * $item->quantity }}</td>
                        <td>
                            <a href="{{ route('removecart', $item->id) }}" class="btn btn-danger">Remove from cart</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

       
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total</h5>
                        <p class="card-text">Subtotal: ₹{{ $total }}</p>
                        @if (!$cartItems->isEmpty())
                            <form action="{{ route('checkout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Checkout</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
    @endif
</div>
@endsection
