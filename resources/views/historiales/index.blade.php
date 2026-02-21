@extends('layouts.app')
@section('title', 'Historial Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-journal-medical me-2" style="color:var(--vet-primary)"></i>Historial Médico</h4>
        <p class="text-muted mb-0" style="font-size:.875rem">Registros médicos de las mascotas</p>
    </div>
    <a href="{{ route('historiales.create') }}" class="btn btn-vet"><i class="bi bi-plus-lg me-1"></i> Nuevo Registro</a>
</div>

<div class="table-card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2" style="max-width:400px">
            <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar..." value="{{ request('buscar') }}">
            <button class="btn btn-sm btn-vet-outline"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr><th>#</th><th>Fecha</th><th>Mascota</th><th>Dueño</th><th>Veterinario</th><th>Diagnóstico</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($historiales as $h)
                <tr>
                    <td>{{ $h->id }}</td>
                    <td>{{ $h->fecha->format('d/m/Y') }}</td>
                    <td class="fw-semibold">{{ $h->mascota->nombre }}</td>
                    <td>{{ $h->mascota->cliente->nombre_completo }}</td>
                    <td>Dr(a). {{ $h->veterinario->nombre_completo }}</td>
                    <td style="max-width:250px" class="text-truncate">{{ $h->diagnostico }}</td>
                    <td>
                        <a href="{{ route('historiales.show', $h) }}" class="btn btn-sm btn-vet-outline"><i class="bi bi-eye-fill"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No hay registros médicos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if($historiales->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $historiales->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
