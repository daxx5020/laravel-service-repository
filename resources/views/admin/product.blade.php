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
        
         <a href=" {{route('admin.home')}} "> <button type="submit" class="btn btn-primary">View Product</button> </a>
        <br> <br>
        @if(isset($prod)) 
        <h2>Edit Product</h2>
        @else
        <h2>Add Product</h2>
        @endif
            <form method="POST" action="{{ isset($prod) ? route('updateproduct', $prod->id) : route('storeproduct') }}" enctype="multipart/form-data">
                @csrf
        
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $prod->name ?? '') }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"> {{ old('description', $prod->description ?? '') }} </textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', $prod->price ?? '') }}">
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(isset($prod) && $prod->category_id == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="form-group mt-5">
                    <label for="image">Product Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
        
                <button type="submit" class="btn btn-primary mt-3">
                    @if(isset($prod))
                    Edit Product
                    @else
                    Add product
                    @endif
                </button>
                <br><br>
            </form>
        </div>
    </div>
</div>
@endsection
