<?php

use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rota da página inicial
Route::get('/', [BibliotecaController::class, 'index'])->name('dashboard');

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logar', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/users', [UserController::class, 'create'])->name('users.form');
Route::post('/users', [UserController::class, 'store'])->name('users.store');



Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/book/cadastro', [BibliotecaController::class, 'create'])->name('book.create');
    Route::post('/book/cadastro', [BibliotecaController::class, 'store'])->name('book.store');
    Route::get('/book/delete/{id}', [BibliotecaController::class, 'destroy'])->name('book.delete');
    Route::get('/book/delete', [BibliotecaController::class, 'modalDelete'])->name('book.modal.delete');
    Route::get('/book/edit/{id}', [BibliotecaController::class, 'edit'])->name('book.edit');
    Route::put('/book/update', [BibliotecaController::class, 'update'])->name('book.update');
    Route::get('/book/show/{id}', [BibliotecaController::class, 'show'])->name('book.show');
    Route::get('/book/categoria/{id}', [BibliotecaController::class, 'categoria'])->name('book.categoria');
    Route::get('/books/categorias', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/book/categorias/form', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::post('/book/categorias/update', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::get('/book/categorias/delete/{id}', [CategoriaController::class, 'destroy'])->name('categoria.delete');
    Route::get('/book/categorias/delete', [CategoriaController::class, 'modalDelete'])->name('categoria.modal.delete');

    
    Route::get('/logout/modal', [LoginController::class, 'modal'])->name('login.modal');
});
