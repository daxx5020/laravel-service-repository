<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }

        h1 {
            color: #007bff;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        .total-row {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Order Confirmation</h1>
        
        <p>Thank you for your order! Here are the details:</p>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $orderItem)
                    <tr>
                        <td>{{ $orderItem->product->name }}</td>
                        <td>₹{{ number_format($orderItem->price, 2) }}</td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>₹{{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="2"></td>
                    <td><strong>Total:</strong></td>
                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <p class="text-center">Thank you for shopping with us!</p>
    </div>
</body>
</html>
