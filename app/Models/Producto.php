<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model {

    use HasFactory;

    protected $table = 'productos';

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    //este metodo sirve para saber cuantas veces fue pedido si lo multiplicamos por la cantidad
    public function lineasPedidos() {
        return $this->hasMany(LineaPedido::class, 'producto_id');
    }
}
