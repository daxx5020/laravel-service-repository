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
                <a href="{{ route('storecategory') }}"> <button class="btn btn-primary"> Add Category</button> </a>
                <a href="{{ route('admin.home') }}"> <button class="btn btn-primary"> View Products</button> </a>
                <br>
                <br>
                <h2>Category List</h2>
                <table class="table mt-2">
                    {{ $dataTable->table() }}
                </table>
            </div>

            @push('scripts')
                {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
            @endpush

            <!-- Include Bootstrap JS and Popper.js -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script>
                $(document).on('click', '.delete', function(event) {
                    event.preventDefault();
                    var categoryid = $(this).attr('id');
                    var rowElement = $(this).closest('tr');

                    var isConfirmed = confirm("Are you sure you want to delete this category?");

                    if (isConfirmed) {
                        $.ajax({
                            url: "/admin/deletecategory/" + categoryid,
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
                    console.log("Edit button clicked");
            
                    var categoryid = $(this).attr('id');
                    window.location.href = "/admin/editcategory/" + categoryid;
                });
            </script>
            </body>

            </html>
        </div>
    </div>
@endsection
