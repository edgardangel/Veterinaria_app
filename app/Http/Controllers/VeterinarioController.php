<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Veterinario::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('apellido', 'like', "%{$buscar}%")
                  ->orWhere('especialidad', 'like', "%{$buscar}%")
                  ->orWhere('cedula_profesional', 'like', "%{$buscar}%");
            });
        }

        $veterinarios = $query->orderBy('nombre')->paginate(10);
        return view('veterinarios.index', compact('veterinarios'));
    }

    public function create()
    {
        return view('veterinarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad' => 'nullable|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cedula_profesional' => 'required|string|max:255|unique:veterinarios',
        ]);

        Veterinario::create($validated);
        return redirect()->route('veterinarios.index')->with('success', 'Veterinario registrado exitosamente.');
    }

    public function edit(Veterinario $veterinario)
    {
        return view('veterinarios.edit', compact('veterinario'));
    }

    public function update(Request $request, Veterinario $veterinario)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad' => 'nullable|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cedula_profesional' => 'required|string|max:255|unique:veterinarios,cedula_profesional,' . $veterinario->id,
        ]);

        $veterinario->update($validated);
        return redirect()->route('veterinarios.index')->with('success', 'Veterinario actualizado exitosamente.');
    }

    public function destroy(Veterinario $veterinario)
    {
        $veterinario->delete();
        return redirect()->route('veterinarios.index')->with('success', 'Veterinario eliminado exitosamente.');
    }
}
