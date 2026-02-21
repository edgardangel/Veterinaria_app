@extends('layouts.app')
@section('title', 'Editar Cliente')

@section('content')
<div class="mb-4">
    <a href="{{ route('clientes.index') }}" class="text-decoration-none" style="color:var(--vet-primary)">
        <i class="bi bi-arrow-left me-1"></i> Volver a Clientes
    </a>
</div>

<div class="form-card" style="max-width:700px">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil-fill me-2" style="color:var(--vet-primary)"></i>Editar Cliente</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:.875rem">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('clientes.update', $cliente) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Apellido *</label>
                <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $cliente->apellido) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono *</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Dirección</label>
                <textarea name="direccion" class="form-control" rows="2">{{ old('direccion', $cliente->direccion) }}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-vet"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-light ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
