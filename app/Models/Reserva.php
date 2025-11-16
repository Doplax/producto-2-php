<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'transfer_reservas';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;

    protected $fillable = [
        'localizador',
        'id_hotel',
        'id_tipo_reserva',
        'email_cliente',
        'fecha_reserva',
        'fecha_modificacion',
        'id_destino',
        'fecha_entrada',
        'hora_entrada',
        'numero_vuelo_entrada',
        'origen_vuelo_entrada',
        'hora_vuelo_salida',
        'fecha_vuelo_salida',
        'num_viajeros',
        'id_vehiculo',
    ];

    protected $casts = [
        'fecha_reserva' => 'datetime',
        'fecha_modificacion' => 'datetime',
        'fecha_entrada' => 'date',
        'fecha_vuelo_salida' => 'date',
        'hora_entrada' => 'datetime',
        'hora_vuelo_salida' => 'datetime',
    ];

    public function hotelOrigen()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function hotelDestino()
    {
        return $this->belongsTo(Hotel::class, 'id_destino', 'id_hotel');
    }

    public function tipoReserva()
    {
        return $this->belongsTo(TipoReserva::class, 'id_tipo_reserva', 'id_tipo_reserva');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
}
