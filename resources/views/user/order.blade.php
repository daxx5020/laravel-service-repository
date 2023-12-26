@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
<!-- resources/views/orders/index.blade.php -->

<div class="container mt-3">
    <a href="{{route('home')}}"> <button class="btn btn-primary" >Home</button> </a>
    <br> <br>
    <h2>Order Details</h2>

    @if ($orders->isEmpty())
        <p>No orders available.</p>
    @else
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    Orders
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td>{{ $orderItem->product->name }}</td>
                                <td>{{ $orderItem->product->price }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>{{ $orderItem->price * $orderItem->quantity }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
