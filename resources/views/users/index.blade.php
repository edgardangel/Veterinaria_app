@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-shield-lock-fill me-2" style="color:var(--vet-primary)"></i>Gestión de Usuarios</h4>
        <p class="text-muted mb-0" style="font-size:.875rem">Administra los usuarios del sistema</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-vet"><i class="bi bi-plus-lg me-1"></i> Nuevo Usuario</a>
</div>

<div class="table-card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2" style="max-width:400px">
            <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar usuario..." value="{{ request('buscar') }}">
            <button class="btn btn-sm btn-vet-outline"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr><th>#</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Teléfono</th><th>Estado</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td class="fw-semibold">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge bg-primary rounded-pill px-3">{{ $u->role->name ?? '—' }}</span></td>
                    <td>{{ $u->phone ?? '—' }}</td>
                    <td><span class="badge badge-{{ $u->status }} rounded-pill px-3 py-1">{{ ucfirst($u->status) }}</span></td>
                    <td>
                        <a href="{{ route('users.edit', $u) }}" class="btn btn-sm btn-vet-outline me-1"><i class="bi bi-pencil-fill"></i></a>
                        @if($u->id !== auth()->id())
                        <form action="{{ route('users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No hay usuarios registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($users->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
