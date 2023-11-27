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
            <h1>F5</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link " aria-current="page" href="/home">Trang Chủ </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/tin_tuc">Tin Tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/the_thao">Thể Thao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/cong_nghe">Công Nghệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/form-register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/form-login">Login</a>
                </li>

            </ul>
        </div>
    </nav>
    <h2 class="col d-flex justify-content-center">Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="col mb-9">
            <div class="col d-flex justify-content-center">
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                </div>
            </div>

            <div class="col d-flex justify-content-center">
                <div class="form-outline mb-4">
                    <labe class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
            </div>
        
        </div>

        
        <!-- <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button> -->
        <!-- <a href="{{ route('form_register') }}" class="btn btn-primary">Register</a> -->
        <div class="col d-flex justify-content-center">
            <button type="submit" class=" btn btn-primary ">Log in</button>
        </div>

        <!-- Register buttons -->
        <div class="text-center">
        <p>Bạn chưa có tài khoản? <a href="{{ route('form_register') }}">Register</a></p>
            
        </div>
    </form>
</body>

</html>