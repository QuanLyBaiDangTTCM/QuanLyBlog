<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar navbar-dark bg-primary mb-4">
        <a class="navbar-brand" href="/home">
            <h1 style="font-family:Georgia, 'Times New Roman', Times, serif;">F5</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="/home">Trang Chủ </a>
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
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li class="nav-item">
                    <a class="nav-link" href="/form-login" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </li>
                
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/posts">Admin</a>
                </li> -->
                
                <li class="nav-item">
                    <a class="nav-link" href="/form-login">Login</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">
                
                <!-- Blog Post -->
                @foreach($posts as $post)

                @if($post->id > 0)

                <!-- Title -->
                <h1><a href="{{ route('show.posts', $post->id) }}">{{$post->title}}</a></h1>

                <!-- Author -->
                <p class="lead">
                <h6>By {{$post->author}}</h6>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <!-- <img class="img-responsive" src="http://placehold.it/900x300" alt=""> -->

                <img class="img-responsive" src="{{ asset($post->image) }}" alt="photo" style=" height: 300px">


                <hr>

                <!-- Post Content -->
                <!-- <p>{{$post->description}}</p> -->
                <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p> -->

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="{{route('insert.comments')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$post->id}}" name="post_id">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email" name="email">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <h4>Comments</h4>
                @foreach($post->comments as $comment)
                <div class="media border">

                    <div class="media-body">
                        <h6 class="media-heading">
                            {{$comment->comment}}
                        </h6>

                        <h5>{{$comment->email}}</h5>
                        <p>{{$comment->created_at}}</p>
                    </div>
                </div>
                @endforeach


                @endif

                @endforeach

            </div>


            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <!-- <div class="well">

                    <h4>Blog Categories</h4>
                     -->

                <!--<h1></h1> -->
                <!-- <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#"></a>
                                </li>
                                
                            </ul>
                        </div>
                        
                    </div>
                     -->
                <!-- /.row -->
                <!-- </div> -->

                <!-- Side Widget Well -->
                <!-- <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div> -->
                <div>

                </div>


            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
</body>

</html>