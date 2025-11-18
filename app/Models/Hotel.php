<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'tranfer_hotel';
    protected $primaryKey = 'id_hotel';
    public $timestamps = false;

    protected $fillable = [
        'id_zona',
        'Comision',
        'usuario',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'id_zona', 'id_zona');
    }

    public function precios()
    {
        return $this->hasMany(Precio::class, 'id_hotel', 'id_hotel');
    }

    public function reservasRealizadas()
    {
        return $this->hasMany(Reserva::class, 'id_hotel', 'id_hotel');
    }

    public function reservasDestino()
    {
        return $this->hasMany(Reserva::class, 'id_destino', 'id_hotel');
    }
}
