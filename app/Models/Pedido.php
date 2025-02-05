<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'user_id', 'provincia', 'localidad', 'direccion', 'coste', 'estado', 'fecha', 'hora'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linea_pedido() {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }
}
