@extends('layouts.app')
@section('title', 'Editar Cita')

@section('content')
<div class="mb-4">
    <a href="{{ route('citas.index') }}" class="text-decoration-none" style="color:var(--vet-primary)"><i class="bi bi-arrow-left me-1"></i> Volver</a>
</div>

<div class="form-card" style="max-width:700px">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil-fill me-2" style="color:var(--vet-primary)"></i>Editar Cita</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:.875rem"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <!-- Formulario rápido de cliente (colapsado) -->
    <div id="quickClientForm" class="alert alert-info" style="display: none;">
        <h6 class="fw-bold mb-3"><i class="bi bi-person-plus-fill me-2"></i>Agregar Cliente Rápido</h6>
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" id="quick_nombre" class="form-control form-control-sm" placeholder="Nombre *" required>
            </div>
            <div class="col-md-4">
                <input type="text" id="quick_apellido" class="form-control form-control-sm" placeholder="Apellido *" required>
            </div>
            <div class="col-md-4">
                <input type="text" id="quick_telefono" class="form-control form-control-sm" placeholder="Teléfono *" required>
            </div>
        </div>
        <div class="mt-3 d-flex gap-2">
            <button type="button" class="btn btn-sm btn-success" id="saveQuickClient">
                <i class="bi bi-check-lg me-1"></i>Guardar Cliente
            </button>
            <button type="button" class="btn btn-sm btn-secondary" id="cancelQuickClient">
                <i class="bi bi-x-lg me-1"></i>Cancelar
            </button>
        </div>
        <div id="quickClientError" class="alert alert-danger alert-sm mt-2" style="display: none;"></div>
    </div>

    <form method="POST" action="{{ route('citas.update', $cita) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Cliente *</label>
                <div class="input-group">
                    <input type="text" id="searchCliente" class="form-control" placeholder="Buscar cliente..." autocomplete="off">
                    <button type="button" class="btn btn-outline-secondary" id="showQuickClientForm" title="Agregar cliente nuevo">
                        <i class="bi bi-person-plus-fill"></i>
                    </button>
                </div>
                <select id="cliente_id" class="form-select mt-2" size="5" required style="display: none;">
                    <option value="">Seleccionar cliente...</option>
                    @foreach($clientes as $c)
                        <option value="{{ $c->id }}" {{ old('cliente_id', $cita->mascota ? $cita->mascota->cliente_id : '') == $c->id ? 'selected' : '' }}>{{ $c->nombre_completo }}</option>
                    @endforeach
                </select>
                <div id="clienteSelectedDisplay" class="mt-2 p-2 bg-light rounded" style="{{ ($cita->mascota && $cita->mascota->cliente) ? '' : 'display: none;' }}">
                    <strong>Cliente seleccionado:</strong> <span id="clienteSelectedName">{{ $cita->mascota && $cita->mascota->cliente ? $cita->mascota->cliente->nombre_completo : '' }}</span>
                    <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-2" id="clearCliente">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mascota <small class="text-muted">(Opcional)</small></label>
                <select name="mascota_id" id="mascota_id" class="form-select" {{ $cita->mascota ? '' : 'disabled' }}>
                    <option value="">{{ $cita->mascota ? 'Sin mascota asignada' : 'Primero selecciona un cliente...' }}</option>
                    @foreach($mascotas as $m)
                        <option value="{{ $m->id }}" data-cliente="{{ $m->cliente_id }}" {{ old('mascota_id', $cita->mascota_id) == $m->id ? 'selected' : '' }} style="display:none">{{ $m->nombre }} - {{ $m->especie }} ({{ $m->raza ?? 'N/A' }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Veterinario *</label>
                <select name="veterinario_id" class="form-select" required>
                    @foreach($veterinarios as $v)
                        <option value="{{ $v->id }}" {{ old('veterinario_id', $cita->veterinario_id) == $v->id ? 'selected' : '' }}>Dr(a). {{ $v->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Fecha y Hora *</label>
                <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora', $cita->fecha_hora->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Estado *</label>
                <select name="estado" class="form-select" required>
                    @foreach(['Pendiente','Confirmada','Completada','Cancelada'] as $e)
                        <option value="{{ $e }}" {{ old('estado', $cita->estado) == $e ? 'selected' : '' }}>{{ $e }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Motivo *</label>
                <textarea name="motivo" class="form-control" rows="3" required>{{ old('motivo', $cita->motivo) }}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-vet"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
            <a href="{{ route('citas.index') }}" class="btn btn-light ms-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const clienteSelect = document.getElementById('cliente_id');
    const mascotaSelect = document.getElementById('mascota_id');
    const allMascotaOptions = Array.from(mascotaSelect.querySelectorAll('option[data-cliente]'));
    const searchInput = document.getElementById('searchCliente');
    const clienteSelectedDisplay = document.getElementById('clienteSelectedDisplay');
    const clienteSelectedName = document.getElementById('clienteSelectedName');
    const clearClienteBtn = document.getElementById('clearCliente');
    const quickClientForm = document.getElementById('quickClientForm');
    const showQuickClientBtn = document.getElementById('showQuickClientForm');
    const saveQuickClientBtn = document.getElementById('saveQuickClient');
    const cancelQuickClientBtn = document.getElementById('cancelQuickClient');
    const quickClientError = document.getElementById('quickClientError');

    let allClientes = Array.from(clienteSelect.options).slice(1);
    let selectedClienteId = clienteSelect.value || null;

    // Ocultar campo de búsqueda si ya hay un cliente seleccionado
    if (selectedClienteId) {
        searchInput.style.display = 'none';
        showQuickClientBtn.style.display = 'none';
        updateMascotasDisplay(selectedClienteId);
    }

    // Búsqueda de clientes en tiempo real
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        if (searchTerm.length === 0) {
            clienteSelect.style.display = 'none';
            return;
        }

        // Filtrar clientes
        const filteredClientes = allClientes.filter(option => 
            option.textContent.toLowerCase().includes(searchTerm)
        );

        // Limpiar y repoblar el select
        clienteSelect.innerHTML = '<option value="">Seleccionar cliente...</option>';
        filteredClientes.forEach(option => {
            clienteSelect.appendChild(option.cloneNode(true));
        });

        clienteSelect.style.display = filteredClientes.length > 0 ? 'block' : 'none';
    });

    // Selección de cliente desde el listado
    clienteSelect.addEventListener('change', function() {
        if (this.value) {
            selectedClienteId = this.value;
            const selectedOption = this.options[this.selectedIndex];
            clienteSelectedName.textContent = selectedOption.textContent;
            
            // Ocultar búsqueda y mostrar seleccionado
            searchInput.style.display = 'none';
            clienteSelect.style.display = 'none';
            clienteSelectedDisplay.style.display = 'block';
            showQuickClientBtn.style.display = 'none';
            
            // Actualizar mascotas
            updateMascotasDisplay(selectedClienteId);
        }
    });

    // Limpiar selección de cliente
    clearClienteBtn.addEventListener('click', function() {
        selectedClienteId = null;
        clienteSelect.value = '';
        searchInput.value = '';
        searchInput.style.display = 'block';
        clienteSelect.style.display = 'none';
        clienteSelectedDisplay.style.display = 'none';
        showQuickClientBtn.style.display = 'inline-block';
        
        // Deshabilitar mascotas
        mascotaSelect.value = '';
        allMascotaOptions.forEach(opt => opt.style.display = 'none');
        mascotaSelect.disabled = true;
        mascotaSelect.querySelector('option:first-child').textContent = 'Primero selecciona un cliente...';
    });

    // Mostrar formulario de cliente rápido
    showQuickClientBtn.addEventListener('click', function() {
        quickClientForm.style.display = 'block';
        quickClientError.style.display = 'none';
        searchInput.value = '';
        clienteSelect.style.display = 'none';
    });

    // Cancelar formulario rápido
    cancelQuickClientBtn.addEventListener('click', function() {
        quickClientForm.style.display = 'none';
        document.getElementById('quick_nombre').value = '';
        document.getElementById('quick_apellido').value = '';
        document.getElementById('quick_telefono').value = '';
        quickClientError.style.display = 'none';
    });

    // Guardar cliente rápido (AJAX)
    saveQuickClientBtn.addEventListener('click', async function() {
        const nombre = document.getElementById('quick_nombre').value.trim();
        const apellido = document.getElementById('quick_apellido').value.trim();
        const telefono = document.getElementById('quick_telefono').value.trim();

        if (!nombre || !apellido || !telefono) {
            quickClientError.textContent = 'Por favor completa todos los campos.';
            quickClientError.style.display = 'block';
            return;
        }

        saveQuickClientBtn.disabled = true;
        saveQuickClientBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Guardando...';

        try {
            const response = await fetch('{{ route('clientes.quick-store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ nombre, apellido, telefono })
            });

            const data = await response.json();

            if (data.success) {
                const newOption = document.createElement('option');
                newOption.value = data.cliente.id;
                newOption.textContent = data.cliente.nombre_completo;
                clienteSelect.appendChild(newOption);
                allClientes.push(newOption);

                selectedClienteId = data.cliente.id;
                clienteSelectedName.textContent = data.cliente.nombre_completo;
                
                quickClientForm.style.display = 'none';
                searchInput.style.display = 'none';
                clienteSelectedDisplay.style.display = 'block';
                showQuickClientBtn.style.display = 'none';
                
                document.getElementById('quick_nombre').value = '';
                document.getElementById('quick_apellido').value = '';
                document.getElementById('quick_telefono').value = '';
                
                updateMascotasDisplay(selectedClienteId);
                
                // Mostrar notificación de éxito
                showToast('Cliente "' + data.cliente.nombre_completo + '" creado exitosamente', 'success', '¡Cliente Registrado!');
            } else {
                quickClientError.textContent = 'Error al guardar el cliente.';
                quickClientError.style.display = 'block';
                showToast('No se pudo guardar el cliente. Intenta de nuevo.', 'error');
            }
        } catch (error) {
            quickClientError.textContent = 'Error de conexión. Por favor intenta de nuevo.';
            quickClientError.style.display = 'block';
            showToast('Error de conexión. Verifica tu internet.', 'error');
        } finally {
            saveQuickClientBtn.disabled = false;
            saveQuickClientBtn.innerHTML = '<i class="bi bi-check-lg me-1"></i>Guardar Cliente';
        }
    });

    function updateMascotasDisplay(clienteId) {
        allMascotaOptions.forEach(opt => opt.style.display = 'none');
        mascotaSelect.value = '';
        
        if (clienteId) {
            mascotaSelect.disabled = false;
            const mascotasCliente = allMascotaOptions.filter(opt => opt.dataset.cliente == clienteId);
            
            if (mascotasCliente.length > 0) {
                mascotasCliente.forEach(opt => opt.style.display = 'block');
                mascotaSelect.querySelector('option:first-child').textContent = 'Sin mascota asignada';
            } else {
                mascotaSelect.querySelector('option:first-child').textContent = 'Este cliente no tiene mascotas';
            }
        } else {
            mascotaSelect.disabled = true;
            mascotaSelect.querySelector('option:first-child').textContent = 'Primero selecciona un cliente...';
        }
    }

    // Validación antes de enviar
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!selectedClienteId) {
            e.preventDefault();
            alert('Por favor selecciona un cliente.');
            return false;
        }
    });
</script>
@endsection
