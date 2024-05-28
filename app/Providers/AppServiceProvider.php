<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Categoria;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {  
        $categoriasMenu = Categoria::all();
        view()->share('categorias', $categoriasMenu);
    }
}
