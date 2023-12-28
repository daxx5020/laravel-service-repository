@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container mt-5">

            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            
            @if(isset($cate)) 
            <h2>Edit Category</h2>
            @else
            <h2>Add Category</h2>
            @endif
            <form method="POST" action="{{ isset($cate) ? route('updatecategory', $cate->id) : route('storecategory') }}">
                @csrf
        
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cate->name ?? '') }}">
                    @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                </div>
        
                <div class="form-group mt-3">
                    <label for="parent_id">Parent Category:</label> 
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">Select Parent Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if(isset($cate) && $cate->parent_id == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
        
                </div>
        
                <button type="submit" class="btn btn-primary mt-4">
                    @if(isset($cate))
                    Edit category
                    @else
                    Add Category
                    @endif
                </button>
            </form>
            <br>
         <a href="{{route('viewcategory')}}">   <button type="submit" class="btn btn-primary">View Category</button> </a>
        </div>
    </div>
</div>
@endsection
