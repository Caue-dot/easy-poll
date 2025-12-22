<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::prefix('/polls')->group(function () {
    Route::get('/create', [\App\Http\Controllers\PollController::class, 'showCreatePoll']);
    Route::get('/all', [\App\Http\Controllers\PollController::class, 'showPolls']);
    Route::get('/{poll}', [\App\Http\Controllers\PollController::class, 'get']);
    Route::post('', [\App\Http\Controllers\PollController::class, 'store']);
});
Route::post('/votes/{alternative}', [\App\Http\Controllers\PollController::class, 'vote']);
