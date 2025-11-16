<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Viajero extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'transfer_viajeros';
    protected $primaryKey = 'id_viajero';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'direccion',
        'codigoPostal',
        'ciudad',
        'pais',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function isProfileComplete()
    {
        return !empty(trim($this->apellido1)) &&
               !empty(trim($this->direccion)) &&
               !empty(trim($this->ciudad)) &&
               !empty(trim($this->pais));
    }

    public function isActive()
    {
        return $this->status === 'activo';
    }
}
