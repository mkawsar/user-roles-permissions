<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AuthController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    if (!Auth::check()) {
        return view('login');
    }
    return redirect()->route('home');
})->name('login');

Route::post('post/login', [AuthController::class, 'login'])->name('post.login');


