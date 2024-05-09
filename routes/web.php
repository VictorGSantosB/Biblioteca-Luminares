<?php

use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BibliotecaController::class, 'index'])->name('dashboard');




Route::resource('users', UserController::class);

Route::get('/login', [LoginController::class, 'index'])->name('login.form');
Route::post('/logar', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logar', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/register', [LoginController::class, 'register'])->name('login.register');


Route::get('/modal', [LoginController::class, 'modal'])->name('login.modal');



Route::get('/teste', [BibliotecaController::class, 'form'])->name('teste');
Route::post('/cad', [BibliotecaController::class, 'store'])->name('storeTeste');