# Sistema de Gestión Veterinaria

Sistema web para la administración de una clínica veterinaria, que permite gestionar clientes, mascotas, citas, veterinarios e historiales médicos.

## Características

- Gestión de clientes y sus datos personales
- Registro y seguimiento de mascotas
- Administración de veterinarios
- Sistema de citas médicas
- Historiales médicos completos
- Sistema de usuarios con roles y permisos
- Dashboard con información relevante

## Tecnologías

- Laravel 11
- PHP 8.2+
- MySQL
- Bootstrap 5
- Blade Templates

## Requisitos

- PHP >= 8.2
- Composer
- MySQL
- Node.js y NPM

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/edgardangel/Veterinaria_app.git
cd Veterinaria_app
```

2. Instalar dependencias:
```bash
composer install
npm install
```

3. Copiar el archivo de configuración:
```bash
cp .env.example .env
```

4. Generar la clave de la aplicación:
```bash
php artisan key:generate
```

5. Configurar la base de datos en el archivo `.env`

6. Ejecutar las migraciones y seeders:
```bash
php artisan migrate --seed
```

7. Compilar los assets:
```bash
npm run dev
```

8. Iniciar el servidor:
```bash
php artisan serve
```

## Módulos

- **Clientes**: Gestión de información de los dueños de mascotas
- **Mascotas**: Registro de animales con sus datos específicos
- **Veterinarios**: Administración del personal médico
- **Citas**: Sistema de agendamiento de consultas
- **Historiales Médicos**: Registro detallado de tratamientos y consultas
- **Usuarios**: Control de acceso con roles (Admin, Veterinario, Recepcionista)

## Licencia

Este proyecto es de código abierto bajo la licencia MIT.
