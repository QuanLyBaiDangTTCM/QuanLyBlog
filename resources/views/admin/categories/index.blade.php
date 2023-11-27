<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <h1>Admin</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="/home">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Quản Lý Bài Đăng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users">Quản Lý Người Dùng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comments">Quản Lý Đánh Giá</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories">Quản Lý Thư Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/categories">Quản lý Thư Mục</a>
                </li>
            </ul>
        </div>
    </nav>

<a href="{{ route('create.categories') }}">Create Category</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id </th>
      <th scope="col">Category</th>
      <th scope="col">Action </th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
  @foreach($categories as $category)
    
    <tr>
    
      <th scope="row">{{$category->id}}</th>
      <td>{{$category->category_name}}</td>
      <td><a class="btn btn-primary" href="{{ route('edit.categories', $category->id) }}">Edit</a></td>
      <td><a class="btn btn-danger" onclick="return confirm('Ban co muon xoa')" href="{{ route('delete.categories', $category->id) }}">Delete</a></td>
     
    </tr>
  @endforeach
    
  </tbody>
</table>
</body>
</html>
