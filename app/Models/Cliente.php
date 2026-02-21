<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'apellido', 'telefono', 'email', 'direccion', 'user_id'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
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
