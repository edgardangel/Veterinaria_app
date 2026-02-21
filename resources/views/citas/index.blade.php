@extends('layouts.app')
@section('title', 'Citas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-calendar-check-fill me-2" style="color:var(--vet-primary)"></i>Gestión de Citas</h4>
        <p class="text-muted mb-0" style="font-size:.875rem">Administra las citas veterinarias</p>
    </div>
    <a href="{{ route('citas.create') }}" class="btn btn-vet"><i class="bi bi-plus-lg me-1"></i> Nueva Cita</a>
</div>

<div class="table-card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar..." value="{{ request('buscar') }}" style="max-width:200px">
            <select name="estado" class="form-select form-select-sm" style="max-width:160px">
                <option value="">Todos los estados</option>
                @foreach(['Pendiente','Confirmada','Completada','Cancelada'] as $e)
                    <option value="{{ $e }}" {{ request('estado') == $e ? 'selected' : '' }}>{{ $e }}</option>
                @endforeach
            </select>
            <input type="date" name="fecha" class="form-control form-control-sm" value="{{ request('fecha') }}" style="max-width:160px">
            <button class="btn btn-sm btn-vet-outline"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr><th>#</th><th>Mascota</th><th>Dueño</th><th>Veterinario</th><th>Fecha / Hora</th><th>Motivo</th><th>Estado</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td class="fw-semibold">
                        @if($cita->mascota)
                            {{ $cita->mascota->nombre }}
                        @else
                            <span class="text-muted">Sin mascota</span>
                        @endif
                    </td>
                    <td>
                        @if($cita->mascota && $cita->mascota->cliente)
                            {{ $cita->mascota->cliente->nombre_completo }}
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>Dr(a). {{ $cita->veterinario->nombre_completo }}</td>
                    <td>{{ $cita->fecha_hora->format('d/m/Y H:i') }}</td>
                    <td style="max-width:200px" class="text-truncate">{{ $cita->motivo }}</td>
                    <td><span class="badge badge-{{ strtolower($cita->estado) }} rounded-pill px-3 py-1">{{ $cita->estado }}</span></td>
                    <td>
                        <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-vet-outline me-1"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('citas.destroy', $cita) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta cita?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                    No hay citas registradas.
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($citas->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $citas->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
