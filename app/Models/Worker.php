<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Authenticatable
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
        'telefono',
        'correo',
        'cargo',
        'turno',
        'cedula',
        'sexo',
        'direccion',
        'fecha_nacimiento',
        'fecha_ingreso',
    ];

    public function nombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function cedulaCompleto()
    {
        return 'V' . $this->cedula;
    }

    public function horario()
    {
        if ($this->turno == 'MAÑANA') { return '8:00am a 12:00pm'; }
        if ($this->turno == 'TARDE') { return '12:00pm a 5:00pm'; }
        return '5:00pm a 9:00pm';
    }

    public function toUpperCase()
    {
        $this->nombre = strtoupper($this->nombre);
        $this->apellido = strtoupper($this->apellido);
    }
}
