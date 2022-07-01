<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//posts routes


Route::middleware('auth')->group(function(){

    Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');
    
    Route::get('posts/view', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');

    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');

    Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

    Route::delete('/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

    Route::patch('/posts/{post}/update', [App\Http\Controllers\PostController::class, 'create'])->name('post.update');
});

//admin routes

Route::middleware(['role:admin', 'auth'])->group(function(){
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('/posts', [App\Http\Controllers\PostController::class, 'AdminIndex'])->name('post.AdminIndex');

    Route::put('/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');

    Route::put('/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');

    Route::get('/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');

    Route::delete('/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

    Route::put('/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
});


//roles routes

Route::middleware(['role:admin', 'auth'])->group(function(){
    Route::get('/roles', 'RoleController@index')->name('roles.index');

    Route::post('/roles/store', 'RoleController@store')->name('roles.store');

    Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');

    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

    Route::put('/roles/{role}/update', 'RoleController@update')->name('roles.update');
});

//comments routes

Route::middleware('auth')->group(function(){

    Route::get('/comment/create/{post}', [App\Http\Controllers\CommentController::class, 'create'])->name('comment.create');

    // Route::post('/{post}/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('post.store');

    Route::delete('/comment/destroy/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/comment/edit/{comment}', [App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');

    Route::patch('/comment/update/{comment}', [App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
});