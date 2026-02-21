@extends('layouts.app')
@section('title', 'Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-people-fill me-2" style="color:var(--vet-primary)"></i>Gestión de Clientes</h4>
        <p class="text-muted mb-0" style="font-size:.875rem">Administra los dueños de mascotas</p>
    </div>
    <a href="{{ route('clientes.create') }}" class="btn btn-vet">
        <i class="bi bi-plus-lg me-1"></i> Nuevo Cliente
    </a>
</div>

<div class="table-card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2" style="max-width:400px">
            <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar cliente..." value="{{ request('buscar') }}">
            <button class="btn btn-sm btn-vet-outline"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Mascotas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td class="fw-semibold">{{ $cliente->nombre_completo }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email ?? '—' }}</td>
                    <td><span class="badge bg-info rounded-pill">{{ $cliente->mascotas_count }}</span></td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-vet-outline me-1" title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cliente?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No hay clientes registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($clientes->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $clientes->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
