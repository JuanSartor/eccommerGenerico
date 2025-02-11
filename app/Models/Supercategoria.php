<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supercategoria extends Model {

    use HasFactory;

    protected $table = 'supercategoria';
    protected $fillable = ['nombre'];

    // una categoria tiene muchos productos, relacion  one to many

    public function categorias() {
        return $this->hasMany(Categoria::class, id_supercategoria);
    }
}
