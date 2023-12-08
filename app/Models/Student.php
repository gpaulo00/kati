<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'fecha_nacimiento',
        'fecha_inscripcion',
        'nivel_educacion',
        'telefono',
        'correo',
        'direccion',
        'extranjero',
        'cedula',
        'tipo_educacion',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'clave',
    ];

    /**
     * Get the medicalData associated
     */
    public function medicalData(): HasOne
    {
        return $this->hasOne(StudentMedicalData::class);
    }

    public function nombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function cedulaCompleto()
    {
        return ($this->extranjero ? 'E' : 'V') . $this->cedula;
    }

    public function toUpperCase()
    {
        $this->nombre = strtoupper($this->nombre);
        $this->apellido = strtoupper($this->apellido);
    }
}
