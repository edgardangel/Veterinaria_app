@extends('layouts.app')
@section('title', 'Mascotas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-heart-pulse-fill me-2" style="color:var(--vet-primary)"></i>Gestión de Mascotas</h4>
        <p class="text-muted mb-0" style="font-size:.875rem">Administra las mascotas registradas</p>
    </div>
    <a href="{{ route('mascotas.create') }}" class="btn btn-vet">
        <i class="bi bi-plus-lg me-1"></i> Nueva Mascota
    </a>
</div>

<div class="table-card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2" style="max-width:400px">
            <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar mascota..." value="{{ request('buscar') }}">
            <button class="btn btn-sm btn-vet-outline"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Sexo</th>
                    <th>Dueño</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mascotas as $mascota)
                <tr>
                    <td>{{ $mascota->id }}</td>
                    <td class="fw-semibold">{{ $mascota->nombre }}</td>
                    <td>{{ $mascota->especie }}</td>
                    <td>{{ $mascota->raza ?? '—' }}</td>
                    <td>{{ $mascota->sexo === 'M' ? 'Macho' : 'Hembra' }}</td>
                    <td>{{ $mascota->cliente->nombre_completo }}</td>
                    <td>
                        <a href="{{ route('mascotas.edit', $mascota) }}" class="btn btn-sm btn-vet-outline me-1"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('mascotas.destroy', $mascota) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta mascota?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No hay mascotas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($mascotas->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $mascotas->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
