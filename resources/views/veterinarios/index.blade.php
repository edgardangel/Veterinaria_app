@extends('layouts.app')
@section('title', 'Veterinarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-clipboard2-pulse-fill me-2" style="color:var(--vet-primary)"></i>Gestión de Veterinarios</h4>
        <p class="text-muted mb-0" style="font-size:.875rem">Administra el equipo veterinario</p>
    </div>
    <a href="{{ route('veterinarios.create') }}" class="btn btn-vet"><i class="bi bi-plus-lg me-1"></i> Nuevo Veterinario</a>
</div>

<div class="table-card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2" style="max-width:400px">
            <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar veterinario..." value="{{ request('buscar') }}">
            <button class="btn btn-sm btn-vet-outline"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr><th>#</th><th>Nombre</th><th>Especialidad</th><th>Teléfono</th><th>Email</th><th>Cédula</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($veterinarios as $vet)
                <tr>
                    <td>{{ $vet->id }}</td>
                    <td class="fw-semibold">Dr(a). {{ $vet->nombre_completo }}</td>
                    <td>{{ $vet->especialidad ?? '—' }}</td>
                    <td>{{ $vet->telefono }}</td>
                    <td>{{ $vet->email }}</td>
                    <td><code>{{ $vet->cedula_profesional }}</code></td>
                    <td>
                        <a href="{{ route('veterinarios.edit', $vet) }}" class="btn btn-sm btn-vet-outline me-1"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('veterinarios.destroy', $vet) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este veterinario?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No hay veterinarios registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($veterinarios->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $veterinarios->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
