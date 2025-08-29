<?php

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExampleController::class, 'homepage']);

Route::get('/about', [ExampleController::class, 'aboutPage']);

Route::get('/post', [ExampleController::class, 'post']);
Route::post('/register', [UserController::class, 'register']);
