<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function index(Request $request)
    {
        $query = HistorialMedico::with(['mascota.cliente', 'veterinario']);

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('diagnostico', 'like', "%{$buscar}%")
                  ->orWhere('tratamiento', 'like', "%{$buscar}%")
                  ->orWhereHas('mascota', function ($q2) use ($buscar) {
                      $q2->where('nombre', 'like', "%{$buscar}%");
                  });
            });
        }

        $historiales = $query->orderBy('fecha', 'desc')->paginate(10);
        return view('historiales.index', compact('historiales'));
    }

    public function create()
    {
        $mascotas = Mascota::with('cliente')->orderBy('nombre')->get();
        $veterinarios = Veterinario::orderBy('nombre')->get();
        return view('historiales.create', compact('mascotas', 'veterinarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha' => 'required|date',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        HistorialMedico::create($validated);
        return redirect()->route('historiales.index')->with('success', 'Historial médico registrado exitosamente.');
    }

    public function show(HistorialMedico $historiale)
    {
        $historiale->load(['mascota.cliente', 'veterinario']);
        return view('historiales.show', compact('historiale'));
    }
}
