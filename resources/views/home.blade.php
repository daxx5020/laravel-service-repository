@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-3">
                <a href="{{ route('cart') }}"> <button class="btn btn-primary">Cart</button></a>
                <a href="{{ route('orders') }}"> <button class="btn btn-primary">Orders</button></a>
                <br><br>

                <h2>All Products</h2>
                <br>

                <div class="form-group mb-3">
                    <select class="form-control" id="parent_id" name="parent_id" onchange="getProductsByCategory(this.value)">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="initial-products">
                    <!-- Display all products initially -->
                    @foreach ($products as $product)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description ?? 'No description available' }}</p>
                                <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>

                                <div class="mt-2 mb-3">
                                    <input type="number" class="count" name="quantity" id="quantity" value="1"
                                        min="1" max="100">
                                </div>
                                <button class="btn btn-success" onclick="addToCart({{ $product->id }})">Add to
                                    cart</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="filtered-products" style="display: none;">
                    <!-- Dynamic update will be displayed here -->
                </div>

            </div>

            <!-- Include Bootstrap JS and Popper.js -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

            <script>
                function getProductsByCategory(categoryId) {
                    $.ajax({
                        url: '{{ route('filterproduct') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(data) {
                            $('#initial-products').hide();
                            $('#filtered-products').empty();

                            if (categoryId) {
                                if (data.length > 0) {
                                    data.forEach(function(product) {
                                        var productHtml = '<div class="card">';
                                        productHtml += '<div class="card-body">';
                                        productHtml += '<h5 class="card-title">' + product.name + '</h5>';
                                        productHtml += '<p class="card-text">' + (product.description ||
                                            'No description available') + '</p>';
                                        productHtml += '<p class="card-text"><strong>Price:</strong> ' + product
                                            .price + '</p>';
                                        productHtml += '<button class="btn btn-success" onclick="addToCart(' +
                                            product.id + ')" >Add to cart</button>';
                                        productHtml += '</div></div>';

                                        $('#filtered-products').append(productHtml);
                                    });

                                    $('#filtered-products').show();
                                } else {
                                    $('#filtered-products').html(
                                        '<p>No products available for the selected category.</p>');
                                }
                            } else {
                                $('#initial-products').show();
                            }
                        },
                        error: function(error) {
                            console.log('Error:', error);
                        }
                    });
                }
            </script>


            <script>
                function addToCart(productId) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var quantityinput = document.getElementById('quantity');
                    var quantity = quantityinput.value;

                    $.ajax({
                        url: '{{ route('addtocart') }}',
                        type: 'POST',
                        data: {
                            product_id: productId,
                            quantity: quantity,
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(data) {
                            alert(data.message);

                        },
                        error: function(error) {
                            console.log('Error:', error);
                        }
                    });
                }
            </script>
        </div>
    </div>
    </div>
    </div>
@endsection
