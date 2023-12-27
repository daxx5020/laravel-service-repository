<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
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
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
        
        <!-- Include Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    </div>
</div>


<script type="text/javascript">
    $(function() {

        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.home') }}",
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'category.name',
                    name: 'category.name',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>

<script>
    $(document).on('click', '.delete', function(event) {
        var productid = $(this).attr('id');
        var rowElement = $(this).closest('tr');

        var isConfirmed = confirm("Are you sure you want to delete this category?");

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
@endsection
