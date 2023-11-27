<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<h2>Edit User </h2>
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
                    <a class="nav-link active" href="/users">Quản Lý Người Dùng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comments">Quản Lý Đánh Giá</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories">Quản lý Thư Mục</a>
                </li>
            </ul>
        </div>
    </nav>
    <form action="{{ route('update.users',$user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{$user->password}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" class="form-control" name="role" placeholder="Enter role" value="{{$user->role}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>