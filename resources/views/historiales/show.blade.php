@extends('layouts.app')
@section('title', 'Detalle del Historial Médico')

@section('content')
<div class="mb-4">
    <a href="{{ route('historiales.index') }}" class="text-decoration-none" style="color:var(--vet-primary)"><i class="bi bi-arrow-left me-1"></i> Volver</a>
</div>

<div class="form-card" style="max-width:800px">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <h5 class="fw-bold mb-0"><i class="bi bi-journal-medical me-2" style="color:var(--vet-primary)"></i>Registro Médico #{{ $historiale->id }}</h5>
        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $historiale->fecha->format('d/m/Y') }}</span>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="p-3 rounded" style="background:#f0fdf4">
                <div class="text-muted mb-1" style="font-size:.8rem; text-transform:uppercase; letter-spacing:.05em">Mascota</div>
                <div class="fw-semibold">{{ $historiale->mascota->nombre }}</div>
                <div class="text-muted" style="font-size:.875rem">{{ $historiale->mascota->especie }} — {{ $historiale->mascota->raza ?? 'Sin raza' }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 rounded" style="background:#f0fdf4">
                <div class="text-muted mb-1" style="font-size:.8rem; text-transform:uppercase; letter-spacing:.05em">Dueño</div>
                <div class="fw-semibold">{{ $historiale->mascota->cliente->nombre_completo }}</div>
                <div class="text-muted" style="font-size:.875rem">{{ $historiale->mascota->cliente->telefono }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 rounded" style="background:#eff6ff">
                <div class="text-muted mb-1" style="font-size:.8rem; text-transform:uppercase; letter-spacing:.05em">Veterinario</div>
                <div class="fw-semibold">Dr(a). {{ $historiale->veterinario->nombre_completo }}</div>
                <div class="text-muted" style="font-size:.875rem">{{ $historiale->veterinario->especialidad ?? 'General' }}</div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="mb-4">
        <h6 class="fw-bold text-uppercase" style="font-size:.8rem; color:#6b7280; letter-spacing:.05em">Diagnóstico</h6>
        <p class="mb-0">{{ $historiale->diagnostico }}</p>
    </div>
    <div class="mb-4">
        <h6 class="fw-bold text-uppercase" style="font-size:.8rem; color:#6b7280; letter-spacing:.05em">Tratamiento</h6>
        <p class="mb-0">{{ $historiale->tratamiento }}</p>
    </div>
    @if($historiale->observaciones)
    <div class="mb-0">
        <h6 class="fw-bold text-uppercase" style="font-size:.8rem; color:#6b7280; letter-spacing:.05em">Observaciones</h6>
        <p class="mb-0">{{ $historiale->observaciones }}</p>
    </div>
    @endif
</div>
@endsection
