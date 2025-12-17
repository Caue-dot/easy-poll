<?php


use Illuminate\Support\Facades\Route;

Route::post('/polls', [\App\Http\Controllers\PollController::class, 'store']);
Route::post('/vote/{alternative}', [\App\Http\Controllers\PollController::class, 'vote']);
