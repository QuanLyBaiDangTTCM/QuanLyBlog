<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Service\PostService;
use Error;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Storage


class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function home()
    {

        $categories = Category::all();
        $users = User::all();
        $posts = Post::with('comments')->get()->sortByDesc('id');
        
        $user = Auth::user();
        //dd($user);
        
            return view('home.home', [
                'posts' => $posts, 
                'categories' => $categories]);
        // }else{
        //     return view('home.home', [
        //         'posts' => $posts, 
        //         'categories' => $categories, 
        //         'user_role' => $user->role]);
        // }
        

       
        // return view('home.home',['posts'=> PostResource::collection($posts)->toArray()]);
    }

    public function tin_tuc()
    {
        $categoryId = 1; // Thay giá trị này bằng category_id bạn muốn hiển thị

        $posts = Post::where('category_id', $categoryId)
            ->orderByDesc('id')
            ->get();

        return view('home.home', ['posts' => $posts]);
    }

    public function the_thao()
    {
        $categoryId = 3; // Thay giá trị này bằng category_id bạn muốn hiển thị

        $posts = Post::where('category_id', $categoryId)
            ->orderByDesc('id')
            ->get();

        return view('home.home', ['posts' => $posts]);
    }

    public function cong_nghe()
    {
        $categoryId = 2; // Thay giá trị này bằng category_id bạn muốn hiển thị

        $posts = Post::where('category_id', $categoryId)
            ->orderByDesc('id')
            ->get();

        return view('home.home', ['posts' => $posts]);
    }

    public function logout(){
        Auth::logout(); // Đăng xuất người dùng

        return redirect('/form-login'); 
    }
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function create()
    {
        return view('admin.posts.create');
    }
    public function insert(CreatePostRequest $request)
    {
        try {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/images';
            $file->move($path, $fileName);

            $post = Post::create($this->preparePostInsertParam($fileName));
            if ($post) {
                //return redirect()->route('index.posts');
                return redirect('/posts')->with([
                    'success' => 'create success'
                ]);
            }
        } catch (Error $exception) {
            return redirect()->back()->with([
                'fail' => 'create fail'
            ]);
        }
    }

    public function admin()
    {

        return view('admin.admin_index');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        try {
            $fileName = '';
            // Check if a new image file is provided
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $path = public_path('images');
                $file->move($path, $fileName);

                // Delete the old image if it exists
                if (!empty($post->image)) {
                    $oldImagePath = public_path('images') . '/' . $post->image;
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                // Update post data with the new image URL
                $post->update($this->preparePostInsertParam($fileName, $post));
            } else {

                // If no new image is provided, update other post data without changing the image URL
                $post->update($request->validated());
            }

            return redirect('/posts')->with([
                'success' => 'update success'
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with([
                'fail' => 'update fail'
            ]);
        }
    }

    public function delete(Post $post)
    {

        $check = $post->delete();
        if ($check) {
            return redirect()->back()->with([
                'success' => 'delete success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'delete fail'
        ]);
    }
    public function store(CreatePostRequest $request)
    {
        // $post = Post::create($request->all());
        // return $post;
        try {
            $post = $this->postService->create($request->validated());
            if ($post) {
                return response()->json([
                    'data' => new PostResource($post),
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

    public function comment()
    {
        // todo
    }

    private function preparePostInsertParam($fileName, $post = null): array
    {
        return [
            'title' => request()->get('title'),
            'description' => request()->get('description'),
            'author' => request()->get('author'),
            'category_id' => request()->get('category_id'),
            'image' => $fileName ? 'images/' . $fileName : ($post ? $post->image : '')
        ];
    }
}
