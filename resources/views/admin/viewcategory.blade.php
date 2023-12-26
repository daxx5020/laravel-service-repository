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
        <a href="{{route('storecategory')}}">    <button class="btn btn-primary"> Add Category</button> </a>
        <a href="{{route('admin.home')}}">    <button class="btn btn-primary"> View Products</button> </a>
        <br>
            <br>
            <h2>Category List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->parent_id)
                                    {{ $category->parent->name }}
                                @else
                                    Parent
                                @endif
                            </td>
                            <td>
                                <a href="{{route('deletecategory', $category->id)}}">  <button class="btn btn-danger" >Delete</button> </a>
                                <a href="{{route('editcategory', $category->id)}}"> <button class="btn btn-primary" >Edit</button>  </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Include Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        </body>
        </html>
    </div>
</div>
@endsection
