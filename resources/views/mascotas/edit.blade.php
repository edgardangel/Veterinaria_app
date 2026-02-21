@extends('layouts.app')
@section('title', 'Editar Mascota')

@section('content')
<div class="mb-4">
    <a href="{{ route('mascotas.index') }}" class="text-decoration-none" style="color:var(--vet-primary)">
        <i class="bi bi-arrow-left me-1"></i> Volver a Mascotas
    </a>
</div>

<div class="form-card" style="max-width:700px">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil-fill me-2" style="color:var(--vet-primary)"></i>Editar Mascota</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:.875rem">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('mascotas.update', $mascota) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $mascota->nombre) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Dueño *</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Seleccionar dueño...</option>
                    @foreach($clientes as $c)
                        <option value="{{ $c->id }}" {{ old('cliente_id', $mascota->cliente_id) == $c->id ? 'selected' : '' }}>{{ $c->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Especie *</label>
                <select name="especie" class="form-select" required>
                    <option value="Perro" {{ old('especie', $mascota->especie) == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ old('especie', $mascota->especie) == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ old('especie', $mascota->especie) == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Reptil" {{ old('especie', $mascota->especie) == 'Reptil' ? 'selected' : '' }}>Reptil</option>
                    <option value="Otro" {{ old('especie', $mascota->especie) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Raza</label>
                <input type="text" name="raza" class="form-control" value="{{ old('raza', $mascota->raza) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sexo *</label>
                <select name="sexo" class="form-select" required>
                    <option value="M" {{ old('sexo', $mascota->sexo) == 'M' ? 'selected' : '' }}>Macho</option>
                    <option value="H" {{ old('sexo', $mascota->sexo) == 'H' ? 'selected' : '' }}>Hembra</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $mascota->fecha_nacimiento?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" name="peso" class="form-control" value="{{ old('peso', $mascota->peso) }}">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-vet"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
            <a href="{{ route('mascotas.index') }}" class="btn btn-light ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
