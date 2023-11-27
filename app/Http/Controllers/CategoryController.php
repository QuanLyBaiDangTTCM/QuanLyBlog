<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use App\Service\PostService;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $categoryService;

    public function __construct(PostService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index',['categories'=>$categories]) ;
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function insert(CreateCategoryRequest $request){
        //dd($request->validated());
        $category = Category::create($request->validated());
        if($category){
            //return redirect()->route('index.posts');
            return redirect('/categories')->with([
                'success' => 'create success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'create fail'
        ]);
    }

    public function edit(Category $category){
        return view('admin.categories.edit',['category'=>$category]);
    }

    public function update(Category $category,CreateCategoryRequest $request){
        $check = $category->update($request->validated());
        if($check){
            return redirect('/categories')->with([
                'success' => 'update success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'update fail'
        ]);
    }

    public function delete(Category $category){
    
        $check = $category->delete();
        if($check){
            return redirect()->back()->with([
                'success' => 'delete success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'delete fail'
        ]);
    }

    public function store(CreateCategoryRequest $request){
        // $post = Post::create($request->all());
        // return $post;
        try {
            $category = $this->categoryService->create($request->validated());
        if($category){
            return response()->json([
                'data' => new CategoryResource($category),
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


