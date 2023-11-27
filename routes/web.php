<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Requests\Post\CreatePostRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/123', function () {
//     return Redirect::to( '/home');


// });

Route::group(['prefix' => '/home'], function() {
    Route::get('', [PostController::class,'home'])->name('home');
    Route::get('/tin_tuc', [PostController::class,'tin_tuc'])->name('tin_tuc.posts');
    Route::get('/the_thao', [PostController::class,'the_thao'])->name('the_thao.posts');
    Route::get('/cong_nghe', [PostController::class,'cong_nghe'])->name('cong_nghe.posts');
});

Route::post('/logout', [PostController::class,'logout'])->name('logout');

Route::group(['prefix' => '/posts'], function() {
    Route::post('', [PostController::class,'store']);
    Route::get('', [PostController::class,'index'])->name('index.posts');
    
    Route::get('create', [PostController::class,'create'])->name('create.posts');
    Route::post('insert', [PostController::class,'insert'])->name('insert.posts');
    Route::get('/{post}', [PostController::class,'show'])->name('show.posts');
    Route::get('edit/{post}', [PostController::class,'edit'])->name('edit.posts');
    Route::post('update/{post}', [PostController::class,'update'])->name('update.posts');
    Route::get('delete/{post}', [PostController::class,'delete'])->name('delete.posts');
});


Route::middleware(['auth', 'checkUserRole:admin'])->group(function () {
    Route::group(['prefix' => '/admin'], function() {
    
        Route::get('', [PostController::class,'admin'])->name('admin');
        
        // Route::group(['prefix' => '/posts'], function() {
        //     Route::post('', [PostController::class,'store']);
        //     Route::get('', [PostController::class,'index'])->name('index.posts');
        //     Route::get('create', [PostController::class,'create'])->name('create.posts');
        //     Route::post('insert', [PostController::class,'insert'])->name('insert.posts');
        //     Route::get('/{post}', [PostController::class,'show'])->name('show.posts');
        //     Route::get('edit/{post}', [PostController::class,'edit'])->name('edit.posts');
        //     Route::post('update/{post}', [PostController::class,'update'])->name('update.posts');
        //     Route::get('delete/{post}', [PostController::class,'delete'])->name('delete.posts');
        // });
        
    });
});

Route::group(['prefix' => '/users'], function() {
    Route::post('', [UserController::class,'store']);
    Route::get('', [UserController::class,'index'])->name('index.users');
    Route::get('create', [UserController::class,'create'])->name('create.users');
    Route::post('insert', [UserController::class,'insert'])->name('insert.users');
    Route::get('/{user}', [UserController::class,'show'])->name('show.users');
    Route::get('edit/{user}', [UserController::class,'edit'])->name('edit.users');
    Route::post('update/{user}', [UserController::class,'update'])->name('update.users');
    Route::get('delete/{user}', [UserController::class,'delete'])->name('delete.users');
});

Route::group(['prefix' => '/comments'], function() {
    Route::post('', [CommentController::class,'store']);
    Route::get('', [CommentController::class,'index'])->name('index.comments');
    Route::get('create', [CommentController::class,'create'])->name('create.comments');
    Route::post('insert', [CommentController::class,'insert'])->name('insert.comments');
    Route::get('/{comment}', [CommentController::class,'show'])->name('show.comments');
    Route::get('edit/{comment}', [CommentController::class,'edit'])->name('edit.comments');
    Route::post('update/{comment}', [CommentController::class,'update'])->name('update.comments');
    Route::get('delete/{comment}', [CommentController::class,'delete'])->name('delete.comments');
});

Route::group(['prefix' => '/categories'], function() {
    Route::post('', [CategoryController::class,'store']);
    Route::get('', [CategoryController::class,'index'])->name('index.categories');
    Route::get('create', [CategoryController::class,'create'])->name('create.categories');
    Route::post('insert', [CategoryController::class,'insert'])->name('insert.categories');
    Route::get('/{category}', [CategoryController::class,'show'])->name('show.categories');
    Route::get('edit/{category}', [CategoryController::class,'edit'])->name('edit.categories');
    Route::post('update/{category}', [CategoryController::class,'update'])->name('update.categories');
    Route::get('delete/{category}', [CategoryController::class,'delete'])->name('delete.categories');
});

Route::get('form-login',[AuthController::class,'formLogin'])->name('form_login');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('form-register',[AuthController::class,'formRegister'])->name('form_register');
Route::post('register',[AuthController::class,'register'])->name('register');

Route::group(['prefix' => '/posts'], function() {
    Route::post('', [PostController::class,'store']);
    Route::get('', [PostController::class,'index'])->name('index.posts');
    
    // Route::post('insert', [PostController::class,'insert'])->name('insert.posts');
    // Route::get('/{post}', [PostController::class,'show'])->name('show.posts');
    // Route::get('edit/{post}', [PostController::class,'edit'])->name('edit.posts');
    // Route::post('update/{post}', [PostController::class,'update'])->name('update.posts');
    // Route::get('delete/{post}', [PostController::class,'delete'])->name('delete.posts');

});


// Route::get('/index',[UserController::class.'index'])
Route::get(
    '/index',
    [UserController::class, 'index']
)->name('profile');