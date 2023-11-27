<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Service\CommentService;
use App\Service\PostService;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    protected $commentService;

    public function __construct(PostService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function index(){
        $comments = Comment::all();
        return view('admin.comments.index',['comments'=>$comments]) ;
    }

    public function create(){
        return view('home');
    }

    public function insert(CreateCommentRequest $request){
        // dd($request->all());
        $comment = Comment::create($request->validated());
        if($comment){
            //return redirect()->route('index.posts');
            return redirect('/home')->with([
                'success' => 'create success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'create fail'
        ]);
    }

    public function edit(Comment $comment){
        return view('admin.comments.edit',['comment'=>$comment]);
    }

    public function update(Comment $comment,CreateCommentRequest $request){
        $check = $comment->update($request->validated());
        if($check){
            return redirect('/comments')->with([
                'success' => 'update success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'update fail'
        ]);
    }

    public function delete(Comment $comment){
    
        $check = $comment->delete();
        if($check){
            return redirect()->back()->with([
                'success' => 'delete success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'delete fail'
        ]);
    }

    public function store(CreateCommentRequest $request){
        // $post = Post::create($request->all());
        // return $post;
        try {
            $comment = $this->commentService->create($request->validated());
        if($comment){
            return response()->json([
                'data' => new CommentResource($comment),
                'message' => 'create success',
                'code' => 200
            ]);
        }
        return response()->json([
            'message' => 'create fail',
            'code' => 400
        ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'create fail',
                'code' => 400
            ]);
        }
        
    }
}


