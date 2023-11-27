<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
@if(Session::has('success'))
{{Session::get('success')}}
@endif

@if(Session::has('fail')){
{{Session::get('fail')}}
}
@endif
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
                    <a class="nav-link " href="/comments">Quản Lý Đánh Giá</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/categories">Quản lý Thư Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>
    <h2>Create Category</h2>
    <form action="{{ route('insert.categories') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category">Name</label>
            <input type="text" class="form-control" name="category_name" aria-describedby="emailHelp" placeholder="Enter category">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>