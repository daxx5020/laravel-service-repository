<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
<a href="{{route('storecategory')}}">    <button class="btn btn-primary"> Add Category</button> </a>
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

<script>
    function delete(){
        alert("are you sure want to delete this product");
    }
</script>