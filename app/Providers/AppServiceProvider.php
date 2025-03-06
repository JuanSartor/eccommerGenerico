<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Supercategoria;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        // me permite utilizar categoria en todas las vistas
        View::composer('*', function ($view) {

            $supercategorias = Supercategoria::whereHas('categorias.productos', function ($query) {
                        $query->where('eliminado', 0)->where('stock', '>', 0);
                    })->with(['categorias' => function ($query) {
                            $query->whereHas('productos', function ($q) {
                                $q->where('eliminado', 0);
                            });
                        }])->get();

            $view->with('supercategorias', $supercategorias);
        });
    }
}
