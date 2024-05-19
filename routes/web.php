<?php

use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rota da página inicial
Route::get('/', [BibliotecaController::class, 'index'])->name('dashboard');

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'index'])->name('login.form');
Route::post('/logar', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register.form');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    // Rotas relacionadas aos livros
    Route::get('/book', [BibliotecaController::class, 'create'])->name('book.form');
    Route::post('/book/cadastro', [BibliotecaController::class, 'store'])->name('book.store');
    Route::get('/book/delete/{id}', [BibliotecaController::class, 'destroy'])->name('book.delete');
    Route::get('/book/edit/{id}', [BibliotecaController::class, 'edit'])->name('book.edit');
    Route::put('/book/update/{id}', [BibliotecaController::class, 'update'])->name('book.update');

    // Rotas relacionadas aos usuários
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
});
