<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthManager::class, 'login'] )->name('login');

Route::get('/register',[AuthManager::class, 'register'] )->name('register');

// 'test' is the name of the function in the controller
// in the code we will use the name e.g: 'info' here
Route::get('/test',[AuthManager::class, 'test'] )->name('info');

Route::post('/registrationPost',[AuthManager::class, 'registrationPost'] )->name('registrationPost');
Route::post('/loginPost',[AuthManager::class, 'loginPost'] )->name('loginPost');
Route::post('/logoutPost',[AuthManager::class, 'logoutPost'] )->name('logoutPost');
