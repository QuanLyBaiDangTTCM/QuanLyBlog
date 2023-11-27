<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginAdminRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function formLogin()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if($user->role == 'user'){
                return redirect('/home');
            }elseif($user->role == 'admin'){
                return redirect('/posts');
            }
        }
        return redirect()->back()->with([
            'fail' => 'login fail'
        ]);
        
    }

    

    public function formRegister(){
        return view('register');
    }

    public function register(RegisterRequest $request){
        $userParams = [
            'name' => request()->get('name'),
            'password'=> bcrypt(request()->get('password')),
            'email'=> request()->get('email'),
            'role'=> request()->get('role','user')
        ];
        $user = User::create($userParams);
        if($user){
            return redirect('/form-login');
        }
        return redirect()->back()->with([
            'fail' => 'register fail'
        ]);
    }
}
