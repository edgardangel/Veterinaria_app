<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    protected $fillable = ['nombre', 'apellido', 'especialidad', 'telefono', 'email', 'cedula_profesional', 'user_id'];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function historialesMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
