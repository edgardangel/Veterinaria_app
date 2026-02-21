@extends('layouts.app')
@section('title', 'Nuevo Registro Médico')

@section('content')
<div class="mb-4">
    <a href="{{ route('historiales.index') }}" class="text-decoration-none" style="color:var(--vet-primary)"><i class="bi bi-arrow-left me-1"></i> Volver</a>
</div>

<div class="form-card" style="max-width:700px">
    <h5 class="fw-bold mb-4"><i class="bi bi-journal-medical me-2" style="color:var(--vet-primary)"></i>Nuevo Registro Médico</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:.875rem"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('historiales.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Mascota *</label>
                <select name="mascota_id" class="form-select" required>
                    <option value="">Seleccionar mascota...</option>
                    @foreach($mascotas as $m)
                        <option value="{{ $m->id }}" {{ old('mascota_id') == $m->id ? 'selected' : '' }}>{{ $m->nombre }} ({{ $m->cliente->nombre_completo }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Veterinario *</label>
                <select name="veterinario_id" class="form-select" required>
                    <option value="">Seleccionar veterinario...</option>
                    @foreach($veterinarios as $v)
                        <option value="{{ $v->id }}" {{ old('veterinario_id') == $v->id ? 'selected' : '' }}>Dr(a). {{ $v->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Fecha *</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Diagnóstico *</label>
                <textarea name="diagnostico" class="form-control" rows="3" required>{{ old('diagnostico') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Tratamiento *</label>
                <textarea name="tratamiento" class="form-control" rows="3" required>{{ old('tratamiento') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control" rows="2">{{ old('observaciones') }}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-vet"><i class="bi bi-check-lg me-1"></i> Guardar</button>
            <a href="{{ route('historiales.index') }}" class="btn btn-light ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
