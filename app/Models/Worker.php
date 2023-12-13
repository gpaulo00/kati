<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'clave',
        'telefono',
        'correo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'clave',
    ];

    public function nombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function toUpperCase()
    {
        $this->nombre = strtoupper($this->nombre);
        $this->apellido = strtoupper($this->apellido);
    }
}
