<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — VetClinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #064e3b 0%, #0d9488 50%, #5eead4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .login-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-brand .icon {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, #0d9488, #065f46);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(13, 148, 136, 0.3);
        }
        .login-brand .icon i { font-size: 2rem; color: #fff; }
        .login-brand h3 { font-weight: 700; color: #064e3b; margin: 0; }
        .login-brand p { color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0; }
        .form-floating .form-control {
            border-radius: 10px;
            border: 1.5px solid #d1d5db;
            padding: 1rem 0.75rem;
        }
        .form-floating .form-control:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.12);
        }
        .btn-login {
            background: linear-gradient(135deg, #0d9488, #065f46);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 148, 136, 0.35);
            color: #fff;
        }
        .floating-shapes {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }
        .floating-shapes span {
            position: absolute;
            display: block;
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            animation: float 15s infinite;
        }
        .floating-shapes span:nth-child(1) { left: 10%; width: 80px; height: 80px; animation-delay: 0s; animation-duration: 18s; }
        .floating-shapes span:nth-child(2) { left: 25%; width: 40px; height: 40px; animation-delay: 2s; animation-duration: 12s; }
        .floating-shapes span:nth-child(3) { left: 55%; width: 60px; height: 60px; animation-delay: 4s; }
        .floating-shapes span:nth-child(4) { left: 75%; width: 90px; height: 90px; animation-delay: 1s; animation-duration: 20s; }
        .floating-shapes span:nth-child(5) { left: 90%; width: 50px; height: 50px; animation-delay: 3s; animation-duration: 14s; }
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="login-card" style="position:relative; z-index:1;">
        <div class="login-brand">
            <div class="icon"><i class="bi bi-heart-pulse-fill"></i></div>
            <h3>VetClinic</h3>
            <p>Sistema de Gestión Veterinaria</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 px-3" style="border-radius:10px; font-size:.875rem;">
                <i class="bi bi-exclamation-circle-fill me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus>
                <label for="email"><i class="bi bi-envelope me-1"></i> Correo electrónico</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                <label for="password"><i class="bi bi-lock me-1"></i> Contraseña</label>
            </div>
            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </form>
    </div>
</body>
</html>
