<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

// User authentication related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreatePostForm'])->middleware('mustBeLoggedIn');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');
Route::get('/post/{id}', [PostController::class, 'viewSinglePost']);
Route::delete('/post/{id}', [PostController::class, 'delete']);
//Route::delete('/post/{id}', [PostController::class, 'delete'])->middleware('can:delete,post');
Route::get('/post/{id}/edit', [PostController::class, 'showEditForm']);
Route::put('/post/{id}/update', [PostController::class, 'updatePost']);

//profile related routes
Route::get('profile/{username}', [UserController::class, 'profile'])->middleware('mustBeLoggedIn');
