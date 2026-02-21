<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Cliente;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mascota::with('cliente');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('especie', 'like', "%{$buscar}%")
                  ->orWhere('raza', 'like', "%{$buscar}%")
                  ->orWhereHas('cliente', function ($q2) use ($buscar) {
                      $q2->where('nombre', 'like', "%{$buscar}%")
                         ->orWhere('apellido', 'like', "%{$buscar}%");
                  });
            });
        }

        $mascotas = $query->orderBy('nombre')->paginate(10);
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('mascotas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'peso' => 'nullable|numeric|min:0',
            'sexo' => 'required|in:M,H',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Mascota::create($validated);
        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada exitosamente.');
    }

    public function edit(Mascota $mascota)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('mascotas.edit', compact('mascota', 'clientes'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'peso' => 'nullable|numeric|min:0',
            'sexo' => 'required|in:M,H',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $mascota->update($validated);
        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada exitosamente.');
    }

    public function destroy(Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada exitosamente.');
    }
}
