<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

    use HasFactory;

    protected $table = 'pedidos';

    // quedaste aca en seguir configurando esta entidad y relacion, el video es el 359 seccion  85


    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linea_pedido() {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }
}
