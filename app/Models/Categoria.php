<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

    use HasFactory;

    protected $table = 'categorias';

    // una categoria tiene muchos productos, relacion  one to many

    public function productos() {
        return $this->hasMany(Producto::class);
    }
}
