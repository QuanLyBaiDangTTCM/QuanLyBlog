<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use App\Service\PostService;
use App\Service\UserService;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $userService;

    public function __construct(PostService $userService)
    {
        $this->userService = $userService;
    }
    public function index(){
        $users = User::all();
        return view('admin.users.index_user',['users'=>$users]) ;
    }

    public function create(){
        return view('admin.users.create');
    }

    public function insert(CreateUserRequest $request){
        //dd($request);\
        $userParams = [
            'name' => request()->get('name'),
            'password'=> bcrypt(request()->get('password')),
            'email'=> request()->get('email'),
            'role'=> request()->get('role')
        ];
            
        $user = User::create($userParams);
        if($user){
            //return redirect()->route('index.posts');
            return redirect('/users')->with([
                'success' => 'create success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'create fail'
        ]);
    }

    public function edit(User $user){
        return view('admin.users.edit',['user'=>$user]);
    }

    public function update(User $user,CreateUserRequest $request){
        $check = $user->update($request->validated());
        if($check){
            return redirect('/user')->with([
                'success' => 'update success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'update fail'
        ]);
    }

    public function delete(User $user){
    
        $check = $user->delete();
        if($check){
            return redirect()->back()->with([
                'success' => 'delete success'
            ]);
        }
        return redirect()->back()->with([
            'fail' => 'delete fail'
        ]);
    }

    public function store(CreateUserRequest $request){
        // $post = Post::create($request->all());
        // return $post;
        try {
            $user = $this->userService->create($request->validated());
        if($user){
            return response()->json([
                'data' => new UserResource($user),
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


