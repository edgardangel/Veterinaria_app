<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    protected $table = 'historiales_medicos';

    protected $fillable = ['mascota_id', 'veterinario_id', 'fecha', 'diagnostico', 'tratamiento', 'observaciones'];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class);
    }
}
