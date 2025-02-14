<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'user_id', 'provincia', 'localidad', 'direccion', 'costo_productos', 'estado', 'fecha', 'hora', 'costo_envio'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linea_pedido() {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }

    public static function mostrarEstado($status) {
        $value = 'Pendiente';

        if ($status == 'confirm') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparación';
        } elseif ($status == 'ready') {
            $value = 'Preparado para enviar';
        } elseif ($status = 'sended') {
            $value = 'Enviado';
        }

        return $value;
    }

    public function productos() {
        return $this->belongsToMany(Producto::class, 'lineas_pedidos')
                        ->withPivot('unidades');
    }

    public function envio() {
        return $this->hasOne(Envio::class);
    }
}
