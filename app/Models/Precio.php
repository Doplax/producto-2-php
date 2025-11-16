<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $table = 'transfer_precios';
    protected $primaryKey = 'id_precios';
    public $timestamps = false;

    protected $fillable = [
        'id_vehiculo',
        'id_hotel',
        'Precio',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }
}
