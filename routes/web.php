<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [CustomAuthController::class, 'login']);
Route::get('/login', [CustomAuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::get('/registration', [CustomAuthController::class, 'registration'])->middleware('alreadyLoggedIn');
Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/dashboard', [CustomAuthController::class, 'showDashboard'])->middleware('isLoggedIn');
Route::get('/logout', [CustomAuthController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'showFileNames'])->middleware('isLoggedIn');
//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('isLoggedIn');
Route::post('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
