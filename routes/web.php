<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login',[AuthManager::class, 'login'] )->name('login');

Route::get('/register',[AuthManager::class, 'register'] )->name('register');
Route::get('/logout', [AuthManager::class , 'logout'])->name('logout');
// 'test' is the name of the function in the controller
// in the code we will use the name e.g: 'info' here
Route::get('/test',[AuthManager::class, 'test'] )->name('info');
Route::post('/registrationPost',[AuthManager::class, 'registrationPost'] )->name('registrationPost');
Route::post('/loginPost',[AuthManager::class, 'loginPost'] )->name('loginPost');
Route::post('/logoutPost',[AuthManager::class, 'logoutPost'] )->name('logoutPost');
Route::get('/admin/home',[AuthManager::class, 'adminView'] )->name('admin.home');
