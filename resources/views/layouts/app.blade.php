<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VetClinic') — Sistema Veterinario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --vet-primary: #0d9488;
            --vet-primary-dark: #0f766e;
            --vet-primary-light: #99f6e4;
            --vet-secondary: #065f46;
            --vet-accent: #f59e0b;
            --vet-bg: #f0fdf4;
            --vet-sidebar: #064e3b;
            --vet-sidebar-hover: #065f46;
            --vet-card-shadow: 0 4px 24px rgba(13, 148, 136, 0.10);
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: var(--vet-bg); min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--vet-sidebar) 0%, #022c22 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1040;
            transition: transform 0.3s;
        }
        .sidebar .brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar .brand h4 {
            color: var(--vet-primary-light);
            font-weight: 700;
            margin: 0;
        }
        .sidebar .brand small { color: rgba(255,255,255,0.5); font-size: .75rem; }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 0.7rem 1.25rem;
            border-radius: 8px;
            margin: 2px 12px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--vet-sidebar-hover);
            color: var(--vet-primary-light);
        }
        .sidebar .nav-link i { width: 24px; text-align: center; margin-right: 10px; }

        /* Main */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* Top bar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .topbar .page-title { font-weight: 600; color: #1f2937; font-size: 1.15rem; }
        .topbar .user-info { display: flex; align-items: center; gap: 12px; }
        .topbar .user-avatar {
            width: 36px; height: 36px;
            background: var(--vet-primary);
            color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 0.85rem;
        }

        .content-wrapper { padding: 1.5rem; }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: var(--vet-card-shadow);
            border: 1px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(13, 148, 136, 0.15);
        }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .stat-card .stat-number { font-size: 1.75rem; font-weight: 700; color: #1f2937; }
        .stat-card .stat-label { font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; }

        /* Table */
        .table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--vet-card-shadow);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        .table-card .card-header {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }
        .table thead th {
            background: #f9fafb;
            color: #6b7280;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
        }
        .table td { padding: 0.75rem 1rem; vertical-align: middle; color: #374151; font-size: 0.9rem; }
        .table tbody tr { transition: background 0.15s; }
        .table tbody tr:hover { background: #f0fdf4; }

        /* Buttons */
        .btn-vet {
            background: var(--vet-primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            transition: all 0.2s;
        }
        .btn-vet:hover { background: var(--vet-primary-dark); color: #fff; transform: translateY(-1px); }
        .btn-vet-outline {
            background: transparent;
            color: var(--vet-primary);
            border: 1.5px solid var(--vet-primary);
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            transition: all 0.2s;
        }
        .btn-vet-outline:hover { background: var(--vet-primary); color: #fff; }

        /* Status badges */
        .badge-pendiente { background: #fef3c7; color: #92400e; }
        .badge-confirmada { background: #dbeafe; color: #1e40af; }
        .badge-completada { background: #d1fae5; color: #065f46; }
        .badge-cancelada { background: #fee2e2; color: #991b1b; }
        .badge-activo { background: #d1fae5; color: #065f46; }
        .badge-inactivo { background: #fee2e2; color: #991b1b; }

        /* Form */
        .form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--vet-card-shadow);
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
        }
        .form-label { font-weight: 500; color: #374151; font-size: 0.875rem; }
        .form-control:focus, .form-select:focus {
            border-color: var(--vet-primary);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }

        /* Animations */
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

        /* Pagination */
        .pagination {
            margin: 0;
        }
        .pagination .page-link {
            color: var(--vet-primary);
            border: 1px solid #e5e7eb;
            padding: 0.5rem 0.75rem;
            margin: 0 2px;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .pagination .page-link:hover {
            background: var(--vet-bg);
            border-color: var(--vet-primary);
            color: var(--vet-primary-dark);
        }
        .pagination .page-item.active .page-link {
            background: var(--vet-primary);
            border-color: var(--vet-primary);
            color: #fff;
        }
        .pagination .page-item.disabled .page-link {
            color: #9ca3af;
            background: #f9fafb;
        }

        /* Toast Notifications */
        .toast {
            min-width: 300px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12), 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: slideInRight 0.3s ease-out;
        }
        .toast-header {
            border-radius: 12px 12px 0 0;
            border-bottom: none;
            font-weight: 600;
            padding: 0.75rem 1rem;
        }
        .toast-body {
            background: #fff;
            border-radius: 0 0 12px 12px;
            padding: 1rem;
            color: #374151;
            font-size: 0.9rem;
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .toast.show {
            animation: slideInRight 0.3s ease-out;
        }
        .toast.hide {
            animation: slideOutRight 0.3s ease-out;
        }
        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <h4><i class="bi bi-heart-pulse-fill"></i> VetClinic</h4>
            <small>Sistema de Gestión Veterinaria</small>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            @if(auth()->user()->hasAnyRole(['Administrador', 'Recepcionista']))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                    <i class="bi bi-people-fill"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('mascotas.*') ? 'active' : '' }}" href="{{ route('mascotas.index') }}">
                    <i class="bi bi-github"></i> Mascotas
                </a>
            </li>
            @endif
            @if(auth()->user()->hasRole('Administrador'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('veterinarios.*') ? 'active' : '' }}" href="{{ route('veterinarios.index') }}">
                    <i class="bi bi-clipboard2-pulse-fill"></i> Veterinarios
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('citas.*') ? 'active' : '' }}" href="{{ route('citas.index') }}">
                    <i class="bi bi-calendar-check-fill"></i> Citas
                </a>
            </li>
            @if(auth()->user()->hasAnyRole(['Administrador', 'Veterinario']))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('historiales.*') ? 'active' : '' }}" href="{{ route('historiales.index') }}">
                    <i class="bi bi-journal-medical"></i> Historial Médico
                </a>
            </li>
            @endif
            @if(auth()->user()->hasRole('Administrador'))
            <li class="nav-item mt-2" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 8px;">
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-shield-lock-fill"></i> Usuarios
                </a>
            </li>
            @endif
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top bar -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <span class="page-title">@yield('title', 'Dashboard')</span>
            </div>
            <div class="user-info">
                <div>
                    <div class="fw-semibold" style="font-size:.875rem; color:#1f2937;">{{ auth()->user()->name }}</div>
                    <div style="font-size:.75rem; color:#6b7280;">{{ auth()->user()->role->name ?? 'Sin rol' }}</div>
                </div>
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Cerrar Sesión">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper fade-in">
            @yield('content')
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header" id="toastHeader">
                <i class="bi me-2" id="toastIcon"></i>
                <strong class="me-auto" id="toastTitle">Notificación</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">
                Mensaje de notificación
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Función global para mostrar notificaciones toast
        function showToast(message, type = 'success', title = null) {
            const toastEl = document.getElementById('notificationToast');
            const toastHeader = document.getElementById('toastHeader');
            const toastIcon = document.getElementById('toastIcon');
            const toastTitle = document.getElementById('toastTitle');
            const toastBody = document.getElementById('toastBody');
            
            // Configurar colores e iconos según el tipo
            const config = {
                success: {
                    bgColor: '#d1fae5',
                    textColor: '#065f46',
                    icon: 'bi-check-circle-fill',
                    title: title || 'Éxito'
                },
                error: {
                    bgColor: '#fee2e2',
                    textColor: '#991b1b',
                    icon: 'bi-exclamation-triangle-fill',
                    title: title || 'Error'
                },
                info: {
                    bgColor: '#dbeafe',
                    textColor: '#1e40af',
                    icon: 'bi-info-circle-fill',
                    title: title || 'Información'
                },
                warning: {
                    bgColor: '#fef3c7',
                    textColor: '#92400e',
                    icon: 'bi-exclamation-circle-fill',
                    title: title || 'Advertencia'
                }
            };
            
            const selectedConfig = config[type] || config.success;
            
            // Aplicar estilos
            toastHeader.style.backgroundColor = selectedConfig.bgColor;
            toastHeader.style.color = selectedConfig.textColor;
            toastIcon.className = 'bi me-2 ' + selectedConfig.icon;
            toastTitle.textContent = selectedConfig.title;
            toastBody.textContent = message;
            
            // Mostrar el toast
            const toast = new bootstrap.Toast(toastEl, {
                animation: true,
                autohide: true,
                delay: 4000
            });
            toast.show();
        }

        // Mostrar toasts para mensajes flash de Laravel
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        @endif
        
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        @endif
        
        @if(session('info'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('info') }}', 'info');
            });
        @endif
        
        @if(session('warning'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('warning') }}', 'warning');
            });
        @endif
    </script>
    
    @yield('scripts')
</body>
</html>
