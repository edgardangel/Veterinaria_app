<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $fillable = ['nombre', 'especie', 'raza', 'fecha_nacimiento', 'peso', 'sexo', 'cliente_id'];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'peso' => 'decimal:2',
        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function historialesMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}
