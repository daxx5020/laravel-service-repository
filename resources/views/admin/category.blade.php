<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    
    @if(isset($cate)) 
    <h2>Edit Category</h2>
    @else
    <h2>Add Category</h2>
    @endif
    <form method="POST" action="{{ isset($cate) ? route('updatecategory', $cate->id) : route('storecategory') }}">
        @csrf

        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $cate->name ?? '') }}">
        </div>

        <div class="form-group">
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

        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
    <br>
 <a href="{{route('viewcategory')}}">   <button type="submit" class="btn btn-primary">View Category</button> </a>
</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
