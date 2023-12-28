@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container mt-3">

            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
            <a href="{{route('product')}}"> <button class="btn btn-primary" >Add Products</button> </a>
            <a href="{{route('viewcategory')}}"> <button class="btn btn-primary" >View Category</button> </a>
            <br> <br>
            <h2>Product List</h2>
            <table class="table">
                {{ $dataTable->table() }}
            </table>
        </div>
        @push('scripts')
                {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
            @endpush
        <!-- Include Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    </div>
</div>

<script>
    $(document).on('click', '.delete', function(event) {
        var productid = $(this).attr('id');
        var rowElement = $(this).closest('tr');

        var isConfirmed = confirm("Are you sure you want to delete this product?");
        if (isConfirmed) {
            $.ajax({
                url: "/admin/deleteproduct/" + productid,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Ajax request successful:", data);
                    rowElement.remove();
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request error:", xhr, status, error);
                }
            });
        }
    });
</script>

<script>
    $(document).on('click', '.edit', function(event) {
        event.preventDefault();

        var productid = $(this).attr('id');

        window.location.href = "/admin/editproduct/" + productid;
    });
</script>
@endsection
