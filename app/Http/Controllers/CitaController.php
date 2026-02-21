<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Cita::with(['mascota.cliente', 'veterinario']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha_hora', $request->fecha);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('motivo', 'like', "%{$buscar}%")
                  ->orWhereHas('mascota', function ($q2) use ($buscar) {
                      $q2->where('nombre', 'like', "%{$buscar}%");
                  })
                  ->orWhereHas('veterinario', function ($q2) use ($buscar) {
                      $q2->where('nombre', 'like', "%{$buscar}%")
                         ->orWhere('apellido', 'like', "%{$buscar}%");
                  });
            });
        }

        $citas = $query->orderBy('fecha_hora', 'desc')->paginate(10);
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $mascotas = Mascota::with('cliente')->orderBy('nombre')->get();
        $veterinarios = Veterinario::orderBy('nombre')->get();
        return view('citas.create', compact('clientes', 'mascotas', 'veterinarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mascota_id' => 'nullable|exists:mascotas,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string',
            'estado' => 'nullable|in:Pendiente,Confirmada,Completada,Cancelada',
        ]);

        // Estado por defecto es Pendiente
        $validated['estado'] = $validated['estado'] ?? 'Pendiente';

        Cita::create($validated);
        return redirect()->route('citas.index')->with('success', 'Cita registrada exitosamente.');
    }

    public function edit(Cita $cita)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $mascotas = Mascota::with('cliente')->orderBy('nombre')->get();
        $veterinarios = Veterinario::orderBy('nombre')->get();
        return view('citas.edit', compact('cita', 'clientes', 'mascotas', 'veterinarios'));
    }

    public function update(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'mascota_id' => 'nullable|exists:mascotas,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string',
            'estado' => 'required|in:Pendiente,Confirmada,Completada,Cancelada',
        ]);

        $cita->update($validated);
        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
