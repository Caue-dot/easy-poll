<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/register', [UserController::class, 'register']);


Route::prefix('/polls')->group(function () {
    Route::get('/create', [\App\Http\Controllers\PollController::class, 'showCreatePoll']);
    Route::get('/all', [\App\Http\Controllers\PollController::class, 'showPolls']);
    Route::get('/{poll}', [\App\Http\Controllers\PollController::class, 'get']);
    Route::post('', [\App\Http\Controllers\PollController::class, 'store']);
});
Route::post('/votes/{alternative}', [\App\Http\Controllers\PollController::class, 'vote']);
