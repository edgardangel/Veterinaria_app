<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Mascota;
use App\Models\Veterinario;
use App\Models\Cita;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'clientes' => Cliente::count(),
            'mascotas' => Mascota::count(),
            'veterinarios' => Veterinario::count(),
            'citas_pendientes' => Cita::where('estado', 'Pendiente')->count(),
            'citas_hoy' => Cita::whereDate('fecha_hora', today())->count(),
            'usuarios' => User::count(),
        ];

        $ultimasCitas = Cita::with(['mascota.cliente', 'veterinario'])
            ->orderBy('fecha_hora', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'ultimasCitas'));
    }
}
