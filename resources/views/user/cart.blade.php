@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container mt-5">

            <a href="{{ route('home') }}"> <button class="btn btn-primary"> View products</button> </a>
            <br><br>
            <h2>Cart Details</h2>
    
            @if ($cartItems->isEmpty())
                <p>Your cart is empty.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
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
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td> {{ $item->product->price * $item->quantity }} </td>
                                <td> <a href="{{ route('removecart', $item->id) }}"> <button class="btn btn-danger">Remove
                                            from cart</button> </a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
                <p>Total: {{ $total }}</p>
                @if (!$cartItems->isEmpty())
                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </form>
                @endif
    
            @endif
        </div>
    
        <!-- Include Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
