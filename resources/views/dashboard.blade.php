@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#d1fae5; color:#065f46;"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-number">{{ $stats['clientes'] }}</div>
                <div class="stat-label">Clientes</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#fef3c7; color:#92400e;"><i class="bi bi-heart-pulse-fill"></i></div>
            <div>
                <div class="stat-number">{{ $stats['mascotas'] }}</div>
                <div class="stat-label">Mascotas</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#dbeafe; color:#1e40af;"><i class="bi bi-clipboard2-pulse-fill"></i></div>
            <div>
                <div class="stat-number">{{ $stats['veterinarios'] }}</div>
                <div class="stat-label">Veterinarios</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#fce7f3; color:#9d174d;"><i class="bi bi-calendar-check-fill"></i></div>
            <div>
                <div class="stat-number">{{ $stats['citas_pendientes'] }}</div>
                <div class="stat-label">Citas Pendientes</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#e0e7ff; color:#3730a3;"><i class="bi bi-calendar-day-fill"></i></div>
            <div>
                <div class="stat-number">{{ $stats['citas_hoy'] }}</div>
                <div class="stat-label">Citas Hoy</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#f3e8ff; color:#6b21a8;"><i class="bi bi-shield-lock-fill"></i></div>
            <div>
                <div class="stat-number">{{ $stats['usuarios'] }}</div>
                <div class="stat-label">Usuarios</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Appointments -->
<div class="table-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2"></i>Últimas Citas</span>
        <a href="{{ route('citas.index') }}" class="btn btn-sm btn-vet-outline">Ver todas</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Mascota</th>
                    <th>Dueño</th>
                    <th>Veterinario</th>
                    <th>Fecha / Hora</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimasCitas as $cita)
                <tr>
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
                    <td>
                        <span class="badge badge-{{ strtolower($cita->estado) }} rounded-pill px-3 py-1">
                            {{ $cita->estado }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                        No hay citas registradas aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
