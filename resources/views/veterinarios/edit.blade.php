@extends('layouts.app')
@section('title', 'Editar Veterinario')

@section('content')
<div class="mb-4">
    <a href="{{ route('veterinarios.index') }}" class="text-decoration-none" style="color:var(--vet-primary)"><i class="bi bi-arrow-left me-1"></i> Volver</a>
</div>

<div class="form-card" style="max-width:700px">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil-fill me-2" style="color:var(--vet-primary)"></i>Editar Veterinario</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:.875rem"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('veterinarios.update', $veterinario) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $veterinario->nombre) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Apellido *</label>
                <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $veterinario->apellido) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" class="form-control" value="{{ old('especialidad', $veterinario->especialidad) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Cédula Profesional *</label>
                <input type="text" name="cedula_profesional" class="form-control" value="{{ old('cedula_profesional', $veterinario->cedula_profesional) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono *</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $veterinario->telefono) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $veterinario->email) }}" required>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-vet"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
            <a href="{{ route('veterinarios.index') }}" class="btn btn-light ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
