<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Mascota;
use App\Models\Veterinario;
use App\Models\Cita;
use App\Models\HistorialMedico;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DataSeeder extends Seeder
{
    public function run(): void
    {
        // ── Usuarios adicionales ──────────────────────────────────
        $recepRole = Role::where('name', 'Recepcionista')->first();
        $vetRole   = Role::where('name', 'Veterinario')->first();

        $userRecep1 = User::create([
            'name' => 'María López', 'email' => 'maria.lopez@veterinaria.com',
            'password' => Hash::make('admin'), 'role_id' => $recepRole->id,
            'phone' => '5551234567', 'status' => 'activo',
        ]);
        $userRecep2 = User::create([
            'name' => 'Laura Martínez', 'email' => 'laura.martinez@veterinaria.com',
            'password' => Hash::make('admin'), 'role_id' => $recepRole->id,
            'phone' => '5559876543', 'status' => 'activo',
        ]);
        $userVet1 = User::create([
            'name' => 'Dr. Carlos Ramírez', 'email' => 'carlos.ramirez@veterinaria.com',
            'password' => Hash::make('admin'), 'role_id' => $vetRole->id,
            'phone' => '5552345678', 'status' => 'activo',
        ]);
        $userVet2 = User::create([
            'name' => 'Dra. Ana Torres', 'email' => 'ana.torres@veterinaria.com',
            'password' => Hash::make('admin'), 'role_id' => $vetRole->id,
            'phone' => '5553456789', 'status' => 'activo',
        ]);
        $userVet3 = User::create([
            'name' => 'Dr. Roberto Sánchez', 'email' => 'roberto.sanchez@veterinaria.com',
            'password' => Hash::make('admin'), 'role_id' => $vetRole->id,
            'phone' => '5554567890', 'status' => 'activo',
        ]);

        // ── Veterinarios ──────────────────────────────────────────
        $vet1 = Veterinario::create([
            'nombre' => 'Carlos', 'apellido' => 'Ramírez', 'especialidad' => 'Cirugía General',
            'telefono' => '5552345678', 'email' => 'carlos.ramirez@veterinaria.com',
            'cedula_profesional' => 'VET-2019-001', 'user_id' => $userVet1->id,
        ]);
        $vet2 = Veterinario::create([
            'nombre' => 'Ana', 'apellido' => 'Torres', 'especialidad' => 'Dermatología',
            'telefono' => '5553456789', 'email' => 'ana.torres@veterinaria.com',
            'cedula_profesional' => 'VET-2020-002', 'user_id' => $userVet2->id,
        ]);
        $vet3 = Veterinario::create([
            'nombre' => 'Roberto', 'apellido' => 'Sánchez', 'especialidad' => 'Cardiología',
            'telefono' => '5554567890', 'email' => 'roberto.sanchez@veterinaria.com',
            'cedula_profesional' => 'VET-2018-003', 'user_id' => $userVet3->id,
        ]);
        $vet4 = Veterinario::create([
            'nombre' => 'Patricia', 'apellido' => 'Hernández', 'especialidad' => 'Oftalmología',
            'telefono' => '5555678901', 'email' => 'patricia.hernandez@veterinaria.com',
            'cedula_profesional' => 'VET-2021-004',
        ]);
        $vet5 = Veterinario::create([
            'nombre' => 'Miguel', 'apellido' => 'García', 'especialidad' => 'Traumatología',
            'telefono' => '5556789012', 'email' => 'miguel.garcia@veterinaria.com',
            'cedula_profesional' => 'VET-2017-005',
        ]);
        $vet6 = Veterinario::create([
            'nombre' => 'Sofía', 'apellido' => 'Díaz', 'especialidad' => 'Medicina Interna',
            'telefono' => '5557890123', 'email' => 'sofia.diaz@veterinaria.com',
            'cedula_profesional' => 'VET-2022-006',
        ]);

        $vets = [$vet1, $vet2, $vet3, $vet4, $vet5, $vet6];

        // ── Clientes ──────────────────────────────────────────────
        $clientesData = [
            ['nombre'=>'Juan','apellido'=>'Pérez','telefono'=>'5551001001','email'=>'juan.perez@gmail.com','direccion'=>'Av. Reforma 234, Col. Centro, CDMX'],
            ['nombre'=>'María','apellido'=>'González','telefono'=>'5551002002','email'=>'maria.gonzalez@hotmail.com','direccion'=>'Calle Hidalgo 56, Col. Juárez, CDMX'],
            ['nombre'=>'Pedro','apellido'=>'Rodríguez','telefono'=>'5551003003','email'=>'pedro.rodriguez@yahoo.com','direccion'=>'Blvd. Miguel Ángel 78, Col. Roma, CDMX'],
            ['nombre'=>'Ana','apellido'=>'Martínez','telefono'=>'5551004004','email'=>'ana.martinez@gmail.com','direccion'=>'Calle Morelos 12, Col. Condesa, CDMX'],
            ['nombre'=>'Luis','apellido'=>'Hernández','telefono'=>'5551005005','email'=>'luis.hernandez@outlook.com','direccion'=>'Av. Insurgentes Sur 890, Col. Del Valle, CDMX'],
            ['nombre'=>'Carmen','apellido'=>'López','telefono'=>'5551006006','email'=>'carmen.lopez@gmail.com','direccion'=>'Calle Madero 45, Col. Polanco, CDMX'],
            ['nombre'=>'Roberto','apellido'=>'Díaz','telefono'=>'5551007007','email'=>'roberto.diaz@hotmail.com','direccion'=>'Av. Universidad 123, Col. Narvarte, CDMX'],
            ['nombre'=>'Sofía','apellido'=>'Morales','telefono'=>'5551008008','email'=>'sofia.morales@gmail.com','direccion'=>'Calle Durango 67, Col. Roma Norte, CDMX'],
            ['nombre'=>'Fernando','apellido'=>'Ruiz','telefono'=>'5551009009','email'=>'fernando.ruiz@yahoo.com','direccion'=>'Bulevar Ávila Camacho 234, Naucalpan, Edo. Méx.'],
            ['nombre'=>'Isabella','apellido'=>'Torres','telefono'=>'5551010010','email'=>'isabella.torres@gmail.com','direccion'=>'Calle Palmas 89, Col. Lomas, CDMX'],
            ['nombre'=>'Diego','apellido'=>'Jiménez','telefono'=>'5551011011','email'=>'diego.jimenez@outlook.com','direccion'=>'Av. Chapultepec 456, Col. Americana, GDL'],
            ['nombre'=>'Valentina','apellido'=>'Castro','telefono'=>'5551012012','email'=>'valentina.castro@gmail.com','direccion'=>'Calle Revolución 78, Col. Mixcoac, CDMX'],
            ['nombre'=>'Andrés','apellido'=>'Vargas','telefono'=>'5551013013','email'=>'andres.vargas@hotmail.com','direccion'=>'Av. Patriotismo 321, Col. San Juan, CDMX'],
            ['nombre'=>'Gabriela','apellido'=>'Mendoza','telefono'=>'5551014014','email'=>'gabriela.mendoza@gmail.com','direccion'=>'Calle Orizaba 45, Col. Roma Sur, CDMX'],
            ['nombre'=>'Alejandro','apellido'=>'Flores','telefono'=>'5551015015','email'=>'alejandro.flores@yahoo.com','direccion'=>'Av. Coyoacán 678, Col. Del Valle Sur, CDMX'],
            ['nombre'=>'Lucía','apellido'=>'Navarro','telefono'=>'5551016016','email'=>'lucia.navarro@gmail.com','direccion'=>'Calle Tamaulipas 23, Col. Condesa, CDMX'],
            ['nombre'=>'Emilio','apellido'=>'Romero','telefono'=>'5551017017','email'=>'emilio.romero@outlook.com','direccion'=>'Av. Revolución 901, Col. San Ángel, CDMX'],
            ['nombre'=>'Daniela','apellido'=>'Aguilar','telefono'=>'5551018018','email'=>'daniela.aguilar@gmail.com','direccion'=>'Calle Liverpool 56, Col. Juárez, CDMX'],
            ['nombre'=>'Miguel','apellido'=>'Reyes','telefono'=>'5551019019','email'=>'miguel.reyes@hotmail.com','direccion'=>'Blvd. Adolfo López Mateos 234, Tlalnepantla'],
            ['nombre'=>'Camila','apellido'=>'Ortega','telefono'=>'5551020020','email'=>'camila.ortega@gmail.com','direccion'=>'Calle Sonora 78, Col. Condesa, CDMX'],
        ];

        $clientes = [];
        foreach ($clientesData as $d) {
            $clientes[] = Cliente::create($d);
        }

        // ── Mascotas (múltiples mascotas por cliente) ─────────────
        $mascotasData = [
            // Juan Pérez: 2 mascotas
            ['nombre'=>'Max','especie'=>'Perro','raza'=>'Golden Retriever','fecha_nacimiento'=>'2021-03-15','peso'=>32.5,'sexo'=>'M','cliente_id'=>$clientes[0]->id],
            ['nombre'=>'Luna','especie'=>'Gato','raza'=>'Siamés','fecha_nacimiento'=>'2022-06-20','peso'=>4.2,'sexo'=>'H','cliente_id'=>$clientes[0]->id],
            // María González: 3 mascotas
            ['nombre'=>'Rocky','especie'=>'Perro','raza'=>'Bulldog Francés','fecha_nacimiento'=>'2020-11-08','peso'=>12.3,'sexo'=>'M','cliente_id'=>$clientes[1]->id],
            ['nombre'=>'Mia','especie'=>'Gato','raza'=>'Persa','fecha_nacimiento'=>'2021-09-14','peso'=>5.1,'sexo'=>'H','cliente_id'=>$clientes[1]->id],
            ['nombre'=>'Coco','especie'=>'Perro','raza'=>'Chihuahua','fecha_nacimiento'=>'2023-01-25','peso'=>2.8,'sexo'=>'M','cliente_id'=>$clientes[1]->id],
            // Pedro Rodríguez
            ['nombre'=>'Toby','especie'=>'Perro','raza'=>'Labrador','fecha_nacimiento'=>'2019-07-03','peso'=>28.7,'sexo'=>'M','cliente_id'=>$clientes[2]->id],
            ['nombre'=>'Nala','especie'=>'Gato','raza'=>'Maine Coon','fecha_nacimiento'=>'2022-02-18','peso'=>6.8,'sexo'=>'H','cliente_id'=>$clientes[2]->id],
            // Ana Martínez: 2 mascotas
            ['nombre'=>'Bella','especie'=>'Perro','raza'=>'Poodle','fecha_nacimiento'=>'2021-12-01','peso'=>8.5,'sexo'=>'H','cliente_id'=>$clientes[3]->id],
            ['nombre'=>'Simba','especie'=>'Gato','raza'=>'Bengalí','fecha_nacimiento'=>'2023-04-10','peso'=>5.6,'sexo'=>'M','cliente_id'=>$clientes[3]->id],
            // Luis Hernández
            ['nombre'=>'Thor','especie'=>'Perro','raza'=>'Pastor Alemán','fecha_nacimiento'=>'2020-05-22','peso'=>35.2,'sexo'=>'M','cliente_id'=>$clientes[4]->id],
            ['nombre'=>'Kira','especie'=>'Perro','raza'=>'Husky Siberiano','fecha_nacimiento'=>'2021-08-30','peso'=>24.1,'sexo'=>'H','cliente_id'=>$clientes[4]->id],
            // Carmen López: 1 mascota
            ['nombre'=>'Pelusa','especie'=>'Gato','raza'=>'Angora','fecha_nacimiento'=>'2022-10-05','peso'=>3.9,'sexo'=>'H','cliente_id'=>$clientes[5]->id],
            // Roberto Díaz: 2 mascotas
            ['nombre'=>'Duke','especie'=>'Perro','raza'=>'Rottweiler','fecha_nacimiento'=>'2019-09-12','peso'=>42.0,'sexo'=>'M','cliente_id'=>$clientes[6]->id],
            ['nombre'=>'Paco','especie'=>'Ave','raza'=>'Periquito Australiano','fecha_nacimiento'=>'2023-03-01','peso'=>0.04,'sexo'=>'M','cliente_id'=>$clientes[6]->id],
            // Sofía Morales: 2 mascotas
            ['nombre'=>'Canela','especie'=>'Perro','raza'=>'Cocker Spaniel','fecha_nacimiento'=>'2022-01-17','peso'=>13.6,'sexo'=>'H','cliente_id'=>$clientes[7]->id],
            ['nombre'=>'Michi','especie'=>'Gato','raza'=>'Ragdoll','fecha_nacimiento'=>'2023-07-22','peso'=>4.5,'sexo'=>'M','cliente_id'=>$clientes[7]->id],
            // Fernando Ruiz
            ['nombre'=>'Rex','especie'=>'Perro','raza'=>'Dóberman','fecha_nacimiento'=>'2020-02-28','peso'=>38.0,'sexo'=>'M','cliente_id'=>$clientes[8]->id],
            // Isabella Torres: 3 mascotas
            ['nombre'=>'Princesa','especie'=>'Gato','raza'=>'Scottish Fold','fecha_nacimiento'=>'2021-11-09','peso'=>4.0,'sexo'=>'H','cliente_id'=>$clientes[9]->id],
            ['nombre'=>'Bruno','especie'=>'Perro','raza'=>'Boxer','fecha_nacimiento'=>'2020-06-15','peso'=>28.3,'sexo'=>'M','cliente_id'=>$clientes[9]->id],
            ['nombre'=>'Polly','especie'=>'Ave','raza'=>'Cacatúa','fecha_nacimiento'=>'2022-08-20','peso'=>0.35,'sexo'=>'H','cliente_id'=>$clientes[9]->id],
            // Diego Jiménez
            ['nombre'=>'Firulais','especie'=>'Perro','raza'=>'Mestizo','fecha_nacimiento'=>'2019-04-11','peso'=>18.5,'sexo'=>'M','cliente_id'=>$clientes[10]->id],
            ['nombre'=>'Bigotes','especie'=>'Gato','raza'=>'Común Europeo','fecha_nacimiento'=>'2023-02-14','peso'=>4.7,'sexo'=>'M','cliente_id'=>$clientes[10]->id],
            // Valentina Castro
            ['nombre'=>'Lola','especie'=>'Perro','raza'=>'Schnauzer','fecha_nacimiento'=>'2021-05-30','peso'=>7.2,'sexo'=>'H','cliente_id'=>$clientes[11]->id],
            // Andrés Vargas: 2 mascotas
            ['nombre'=>'Zeus','especie'=>'Perro','raza'=>'Gran Danés','fecha_nacimiento'=>'2020-10-18','peso'=>55.0,'sexo'=>'M','cliente_id'=>$clientes[12]->id],
            ['nombre'=>'Pantera','especie'=>'Gato','raza'=>'Bombay','fecha_nacimiento'=>'2022-12-25','peso'=>4.3,'sexo'=>'H','cliente_id'=>$clientes[12]->id],
            // Gabriela Mendoza
            ['nombre'=>'Chispas','especie'=>'Perro','raza'=>'Dálmata','fecha_nacimiento'=>'2021-07-07','peso'=>24.8,'sexo'=>'M','cliente_id'=>$clientes[13]->id],
            ['nombre'=>'Nina','especie'=>'Gato','raza'=>'Abisinio','fecha_nacimiento'=>'2023-05-19','peso'=>3.8,'sexo'=>'H','cliente_id'=>$clientes[13]->id],
            // Alejandro Flores
            ['nombre'=>'Apolo','especie'=>'Perro','raza'=>'Akita Inu','fecha_nacimiento'=>'2020-08-24','peso'=>33.5,'sexo'=>'M','cliente_id'=>$clientes[14]->id],
            // Lucía Navarro: 2 mascotas
            ['nombre'=>'Copito','especie'=>'Gato','raza'=>'Persa Blanco','fecha_nacimiento'=>'2022-04-02','peso'=>5.0,'sexo'=>'M','cliente_id'=>$clientes[15]->id],
            ['nombre'=>'Daisy','especie'=>'Perro','raza'=>'Beagle','fecha_nacimiento'=>'2021-09-16','peso'=>11.2,'sexo'=>'H','cliente_id'=>$clientes[15]->id],
            // Emilio Romero
            ['nombre'=>'Spike','especie'=>'Reptil','raza'=>'Iguana Verde','fecha_nacimiento'=>'2022-06-13','peso'=>2.1,'sexo'=>'M','cliente_id'=>$clientes[16]->id],
            ['nombre'=>'Rambo','especie'=>'Perro','raza'=>'Pitbull','fecha_nacimiento'=>'2020-03-08','peso'=>30.5,'sexo'=>'M','cliente_id'=>$clientes[16]->id],
            // Daniela Aguilar
            ['nombre'=>'Mila','especie'=>'Perro','raza'=>'Yorkshire Terrier','fecha_nacimiento'=>'2023-01-12','peso'=>3.1,'sexo'=>'H','cliente_id'=>$clientes[17]->id],
            // Miguel Reyes
            ['nombre'=>'Hércules','especie'=>'Perro','raza'=>'San Bernardo','fecha_nacimiento'=>'2019-12-05','peso'=>62.0,'sexo'=>'M','cliente_id'=>$clientes[18]->id],
            ['nombre'=>'Manchas','especie'=>'Gato','raza'=>'Tricolor','fecha_nacimiento'=>'2023-08-30','peso'=>3.5,'sexo'=>'H','cliente_id'=>$clientes[18]->id],
            // Camila Ortega: 2 mascotas
            ['nombre'=>'Cleo','especie'=>'Gato','raza'=>'Sphynx','fecha_nacimiento'=>'2022-09-20','peso'=>3.7,'sexo'=>'H','cliente_id'=>$clientes[19]->id],
            ['nombre'=>'Oso','especie'=>'Perro','raza'=>'Chow Chow','fecha_nacimiento'=>'2021-04-18','peso'=>27.0,'sexo'=>'M','cliente_id'=>$clientes[19]->id],
        ];

        $mascotas = [];
        foreach ($mascotasData as $d) {
            $mascotas[] = Mascota::create($d);
        }

        // ── Citas (variedad de estados y fechas) ──────────────────
        $citasData = [
            // Citas pasadas completadas
            ['mascota_id'=>$mascotas[0]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2025-11-10 09:00:00','motivo'=>'Vacunación anual contra rabia y parvovirus','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[1]->id,'veterinario_id'=>$vet2->id,'fecha_hora'=>'2025-11-12 10:30:00','motivo'=>'Revisión dermatológica por pérdida de pelo','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[2]->id,'veterinario_id'=>$vet3->id,'fecha_hora'=>'2025-11-15 11:00:00','motivo'=>'Examen cardiológico de rutina','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[5]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2025-11-18 09:30:00','motivo'=>'Esterilización programada','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[7]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2025-11-20 14:00:00','motivo'=>'Consulta general: decaimiento e inapetencia','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[9]->id,'veterinario_id'=>$vet5->id,'fecha_hora'=>'2025-11-25 10:00:00','motivo'=>'Cojera en pata trasera derecha','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[12]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2025-12-01 09:00:00','motivo'=>'Limpieza dental profunda bajo anestesia','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[3]->id,'veterinario_id'=>$vet2->id,'fecha_hora'=>'2025-12-03 11:30:00','motivo'=>'Alergia cutánea severa con rascado excesivo','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[10]->id,'veterinario_id'=>$vet3->id,'fecha_hora'=>'2025-12-05 15:00:00','motivo'=>'Soplo cardíaco detectado anteriormente, control','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[15]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2025-12-08 09:30:00','motivo'=>'Vómitos frecuentes desde hace 3 días','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[16]->id,'veterinario_id'=>$vet5->id,'fecha_hora'=>'2025-12-10 10:00:00','motivo'=>'Fractura en pata delantera, evaluación','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[20]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2025-12-12 11:00:00','motivo'=>'Desparasitación interna y externa','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[22]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2025-12-15 14:30:00','motivo'=>'Control post-esterilización','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[25]->id,'veterinario_id'=>$vet2->id,'fecha_hora'=>'2025-12-18 09:00:00','motivo'=>'Revisión de oídos por otitis','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[27]->id,'veterinario_id'=>$vet4->id,'fecha_hora'=>'2025-12-20 10:30:00','motivo'=>'Revisión oftalmológica - ojo irritado','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[30]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-01-05 11:00:00','motivo'=>'Revisión de metabolismo y peso para iguana','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[31]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2026-01-08 09:00:00','motivo'=>'Vacunación múltiple anual','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[33]->id,'veterinario_id'=>$vet3->id,'fecha_hora'=>'2026-01-12 10:00:00','motivo'=>'Dificultad respiratoria nocturna','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[4]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-01-15 14:00:00','motivo'=>'Diarrea persistente hace 5 días','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[8]->id,'veterinario_id'=>$vet2->id,'fecha_hora'=>'2026-01-18 09:30:00','motivo'=>'Granitos en la piel del abdomen','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[11]->id,'veterinario_id'=>$vet4->id,'fecha_hora'=>'2026-01-20 11:00:00','motivo'=>'Secreción en ojo izquierdo','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[14]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-01-22 15:00:00','motivo'=>'Consulta nutricional - sobrepeso','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[17]->id,'veterinario_id'=>$vet3->id,'fecha_hora'=>'2026-01-25 10:30:00','motivo'=>'Evaluación cardíaca pre-quirúrgica','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[23]->id,'veterinario_id'=>$vet5->id,'fecha_hora'=>'2026-01-28 09:00:00','motivo'=>'Displasia de cadera, evaluación','estado'=>'Completada'],
            ['mascota_id'=>$mascotas[28]->id,'veterinario_id'=>$vet4->id,'fecha_hora'=>'2026-02-01 10:00:00','motivo'=>'Catarata en etapa temprana','estado'=>'Completada'],
            // Citas recientes confirmadas
            ['mascota_id'=>$mascotas[0]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2026-02-10 09:00:00','motivo'=>'Control post-vacunación y revisión de peso','estado'=>'Confirmada'],
            ['mascota_id'=>$mascotas[6]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-02-10 11:00:00','motivo'=>'Inapetencia y letargia desde hace 2 días','estado'=>'Confirmada'],
            ['mascota_id'=>$mascotas[13]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-02-11 09:30:00','motivo'=>'Revisión de plumas y estado general del periquito','estado'=>'Confirmada'],
            // Citas pendientes (futuras)
            ['mascota_id'=>$mascotas[2]->id,'veterinario_id'=>$vet3->id,'fecha_hora'=>'2026-02-14 10:00:00','motivo'=>'Seguimiento cardiológico semestral','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[9]->id,'veterinario_id'=>$vet5->id,'fecha_hora'=>'2026-02-14 11:30:00','motivo'=>'Control radiográfico de pata trasera','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[18]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2026-02-15 09:00:00','motivo'=>'Vacunación de refuerzo','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[24]->id,'veterinario_id'=>$vet2->id,'fecha_hora'=>'2026-02-15 14:00:00','motivo'=>'Revisión dermatológica - posible alergia alimentaria','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[29]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-02-17 10:00:00','motivo'=>'Consulta general y desparasitación','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[32]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-02-18 09:30:00','motivo'=>'Primer chequeo integral de cachorra','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[35]->id,'veterinario_id'=>$vet4->id,'fecha_hora'=>'2026-02-18 11:00:00','motivo'=>'Revisión ocular de gata Sphynx','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[36]->id,'veterinario_id'=>$vet2->id,'fecha_hora'=>'2026-02-19 14:30:00','motivo'=>'Problema de piel seca recurrente','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[21]->id,'veterinario_id'=>$vet6->id,'fecha_hora'=>'2026-02-20 10:00:00','motivo'=>'Estornudos frecuentes y secreción nasal','estado'=>'Pendiente'],
            ['mascota_id'=>$mascotas[26]->id,'veterinario_id'=>$vet5->id,'fecha_hora'=>'2026-02-21 09:00:00','motivo'=>'Evaluación articular por rigidez matutina','estado'=>'Pendiente'],
            // Citas canceladas
            ['mascota_id'=>$mascotas[19]->id,'veterinario_id'=>$vet1->id,'fecha_hora'=>'2025-12-22 09:00:00','motivo'=>'Vacunación de refuerzo','estado'=>'Cancelada'],
            ['mascota_id'=>$mascotas[34]->id,'veterinario_id'=>$vet3->id,'fecha_hora'=>'2026-01-30 10:30:00','motivo'=>'Evaluación cardíaca','estado'=>'Cancelada'],
        ];

        foreach ($citasData as $d) {
            Cita::create($d);
        }

        // ── Historiales Médicos ────────────────────────────────────
        $historialesData = [
            ['mascota_id'=>$mascotas[0]->id,'veterinario_id'=>$vet1->id,'fecha'=>'2025-11-10',
             'diagnostico'=>'Paciente sano. Se aplica vacuna antirrábica y polivalente (parvovirus, moquillo, hepatitis).',
             'tratamiento'=>'Vacuna antirrábica 1ml IM y polivalente 1ml SC. Desparasitante oral (Praziquantel 50mg + Pirantel 144mg).',
             'observaciones'=>'Próxima vacunación en 12 meses. Peso estable en 32.5 kg. Buen estado general.'],
            ['mascota_id'=>$mascotas[1]->id,'veterinario_id'=>$vet2->id,'fecha'=>'2025-11-12',
             'diagnostico'=>'Dermatitis alérgica por contacto en zona abdominal. Pérdida de pelo localizada sin signos de infección.',
             'tratamiento'=>'Shampoo medicado con Clorhexidina 2% cada 5 días por 3 semanas. Antihistamínico (Cetirizina 5mg) cada 12 horas por 10 días.',
             'observaciones'=>'Revisar posible alérgeno en el ambiente del hogar. Control en 3 semanas.'],
            ['mascota_id'=>$mascotas[2]->id,'veterinario_id'=>$vet3->id,'fecha'=>'2025-11-15',
             'diagnostico'=>'Examen cardiológico normal. Electrocardiograma sin arritmias. Frecuencia cardíaca 120 bpm (normal para la raza).',
             'tratamiento'=>'No requiere tratamiento. Se recomienda mantener actividad física moderada y dieta baja en sodio.',
             'observaciones'=>'Control cardiológico en 6 meses. Raza propensa a problemas cardíacos.'],
            ['mascota_id'=>$mascotas[5]->id,'veterinario_id'=>$vet1->id,'fecha'=>'2025-11-18',
             'diagnostico'=>'Paciente apto para esterilización. Exámenes prequirúrgicos dentro de parámetros normales. Hemograma y química sanguínea sin alteraciones.',
             'tratamiento'=>'Ovariohisterectomía realizada bajo anestesia general con Propofol e Isoflurano. Suturas intradérmicas con material absorbible.',
             'observaciones'=>'Reposo absoluto por 10 días. Collar isabelino. Analgésico Meloxicam 0.2mg/kg cada 24h por 5 días. Control en 10 días para retiro de puntos.'],
            ['mascota_id'=>$mascotas[7]->id,'veterinario_id'=>$vet6->id,'fecha'=>'2025-11-20',
             'diagnostico'=>'Gastroenteritis leve. Posible ingesta de alimento inadecuado. Deshidratación leve (5%).',
             'tratamiento'=>'Fluidoterapia SC (100ml Ringer Lactato). Metoclopramida 0.3mg/kg cada 8h por 3 días. Dieta blanda (pollo hervido y arroz) por 5 días.',
             'observaciones'=>'Si persisten los síntomas después de 48h, realizar estudios complementarios.'],
            ['mascota_id'=>$mascotas[9]->id,'veterinario_id'=>$vet5->id,'fecha'=>'2025-11-25',
             'diagnostico'=>'Esguince de ligamento cruzado anterior en pata trasera derecha. Radiografía sin evidencia de fractura. Inflamación moderada.',
             'tratamiento'=>'Reposo estricto por 4 semanas. Antiinflamatorio Carprofeno 4mg/kg cada 24h por 14 días. Compresas frías 3 veces al día.',
             'observaciones'=>'Control radiográfico en 4 semanas. Si no mejora, considerar cirugía artroscópica.'],
            ['mascota_id'=>$mascotas[12]->id,'veterinario_id'=>$vet1->id,'fecha'=>'2025-12-01',
             'diagnostico'=>'Enfermedad periodontal grado II. Acumulación de sarro en molares superiores e inferiores. Gingivitis moderada.',
             'tratamiento'=>'Limpieza dental ultrasónica bajo anestesia. Extracción de 2 premolares con movilidad grado 3. Antibiótico Amoxicilina/Clavulánico 20mg/kg cada 12h por 7 días.',
             'observaciones'=>'Iniciar higiene dental domiciliaria con cepillado 3 veces por semana. Control en 15 días.'],
            ['mascota_id'=>$mascotas[3]->id,'veterinario_id'=>$vet2->id,'fecha'=>'2025-12-03',
             'diagnostico'=>'Dermatitis atópica felina. Prurito intenso en cabeza, cuello y extremidades. Lesiones por rascado autoinducido.',
             'tratamiento'=>'Prednisolona 1mg/kg cada 24h por 7 días, luego reducir a 0.5mg/kg. Ácidos grasos omega-3 (EPA/DHA) suplemento diario.',
             'observaciones'=>'Evaluar dieta hipoalergénica. Test de alergias en próxima consulta si no mejora.'],
            ['mascota_id'=>$mascotas[10]->id,'veterinario_id'=>$vet3->id,'fecha'=>'2025-12-05',
             'diagnostico'=>'Soplo cardíaco sistólico grado III/VI. Ecocardiograma muestra dilatación leve de atrio izquierdo. Función sistólica conservada.',
             'tratamiento'=>'Enalapril 0.5mg/kg cada 12h de forma indefinida. Dieta cardíaca baja en sodio. Restricción de ejercicio intenso.',
             'observaciones'=>'Control ecocardiográfico en 3 meses. Monitorear signos de insuficiencia cardíaca: tos, intolerancia al ejercicio, disnea.'],
            ['mascota_id'=>$mascotas[15]->id,'veterinario_id'=>$vet6->id,'fecha'=>'2025-12-08',
             'diagnostico'=>'Gastritis aguda. Radiografía abdominal sin obstrucción. Palpación abdominal con dolor en epigastrio.',
             'tratamiento'=>'Omeprazol 1mg/kg cada 24h por 10 días. Sucralfato 0.5g cada 8h por 7 días. Ayuno de 12 horas, luego dieta blanda fraccionada.',
             'observaciones'=>'Mejoría esperada en 48-72h. Si hay hematemesis o melena, acudir de urgencia.'],
            ['mascota_id'=>$mascotas[16]->id,'veterinario_id'=>$vet5->id,'fecha'=>'2025-12-10',
             'diagnostico'=>'Fractura diafisaria simple de radio-cúbito en miembro anterior izquierdo. Sin compromiso vascular ni neurológico.',
             'tratamiento'=>'Osteosíntesis con placa y tornillos bajo anestesia general. Vendaje Robert-Jones postoperatorio. Tramadol 3mg/kg cada 8h por 7 días.',
             'observaciones'=>'Reposo absoluto 6 semanas. Control radiográfico a las 3 y 6 semanas. Retiro de placa en 4-6 meses si hay consolidación completa.'],
            ['mascota_id'=>$mascotas[20]->id,'veterinario_id'=>$vet1->id,'fecha'=>'2025-12-12',
             'diagnostico'=>'Parasitosis intestinal por Ancylostoma y Dipylidium. Examen coprológico positivo. Estado general bueno.',
             'tratamiento'=>'Desparasitante oral triple (Praziquantel + Pirantel + Febantel) dosis según peso. Pipeta antipulgas/garrapatas (Fipronil + Metopreno).',
             'observaciones'=>'Repetir desparasitación en 15 días. Control coprológico en 30 días. Desparasitar cada 3 meses.'],
            ['mascota_id'=>$mascotas[22]->id,'veterinario_id'=>$vet6->id,'fecha'=>'2025-12-15',
             'diagnostico'=>'Post-operatorio de esterilización día 10. Herida quirúrgica con buena cicatrización. Sin signos de infección.',
             'tratamiento'=>'Retiro de puntos. Alta médica. Reanudar actividad física gradualmente en 5 días.',
             'observaciones'=>'Esterilización exitosa. Ajustar dieta calórica en un 15% para prevenir obesidad post-esterilización.'],
            ['mascota_id'=>$mascotas[25]->id,'veterinario_id'=>$vet2->id,'fecha'=>'2025-12-18',
             'diagnostico'=>'Otitis externa bilateral por Malassezia. Conductos auditivos eritematosos con secreción ceruminosa abundante.',
             'tratamiento'=>'Solución ótica con Clotrimazol y Gentamicina, 5 gotas cada 12h por 14 días. Limpieza auricular con solución salina antes de cada aplicación.',
             'observaciones'=>'Control en 2 semanas. Si es recurrente, evaluar posible alergia alimentaria como causa subyacente.'],
            ['mascota_id'=>$mascotas[27]->id,'veterinario_id'=>$vet4->id,'fecha'=>'2025-12-20',
             'diagnostico'=>'Conjuntivitis alérgica ojo derecho. Edema palpebral leve. Sin úlcera corneal (test de fluoresceína negativo).',
             'tratamiento'=>'Colirio con Tobramicina 0.3% + Dexametasona 0.1%, 1 gota cada 6h por 10 días. Lágrimas artificiales cada 4h.',
             'observaciones'=>'Control en 10 días. Si hay empeoramiento o aparece secreción purulenta, acudir antes.'],
            ['mascota_id'=>$mascotas[30]->id,'veterinario_id'=>$vet6->id,'fecha'=>'2026-01-05',
             'diagnostico'=>'Iguana en buen estado general. Peso adecuado para la edad. Piel con buena coloración. Sin signos de enfermedad metabólica ósea.',
             'tratamiento'=>'Suplemento de calcio con vitamina D3 espolvoreado en alimento 3 veces por semana. Asegurar exposición a UV-B 12 horas diarias.',
             'observaciones'=>'Verificar temperatura del terrario (28-32°C día, 22-25°C noche). Dieta: 80% vegetales verdes, 10% frutas, 10% insectos.'],
            ['mascota_id'=>$mascotas[31]->id,'veterinario_id'=>$vet1->id,'fecha'=>'2026-01-08',
             'diagnostico'=>'Paciente sano. Se aplican vacunas múltiples: polivalente, parainfluenza y Bordetella.',
             'tratamiento'=>'Vacuna polivalente 2ml SC. Vacuna Bordetella intranasal. Desparasitante oral.',
             'observaciones'=>'Puede presentar letargia leve y dolor en sitio de inyección por 24-48h. Próxima vacunación en 12 meses.'],
            ['mascota_id'=>$mascotas[33]->id,'veterinario_id'=>$vet3->id,'fecha'=>'2026-01-12',
             'diagnostico'=>'Insuficiencia cardíaca congestiva leve (clase II ISACHC). Derrame pleural mínimo. Tos nocturna probablemente de origen cardíaco.',
             'tratamiento'=>'Furosemida 2mg/kg cada 12h. Enalapril 0.5mg/kg cada 12h. Pimobendan 0.25mg/kg cada 12h. Restricción de ejercicio y sodio.',
             'observaciones'=>'Control ecocardiográfico y radiográfico en 2 semanas para evaluar respuesta al tratamiento. Monitorear frecuencia respiratoria en reposo.'],
            ['mascota_id'=>$mascotas[4]->id,'veterinario_id'=>$vet6->id,'fecha'=>'2026-01-15',
             'diagnostico'=>'Enteritis infecciosa. Coprológico positivo para Giardia. Deshidratación moderada (7%).',
             'tratamiento'=>'Metronidazol 25mg/kg cada 12h por 7 días. Fluidoterapia SC (50ml Ringer Lactato, 2 veces al día por 2 días). Probióticos por 14 días.',
             'observaciones'=>'Desinfectar ambiente donde habita. Tratar todas las mascotas del hogar. Control coprológico en 14 días.'],
            ['mascota_id'=>$mascotas[8]->id,'veterinario_id'=>$vet2->id,'fecha'=>'2026-01-18',
             'diagnostico'=>'Acné felino en mentón. Comedones y pápulas en zona mentoniana. Sin infección secundaria.',
             'tratamiento'=>'Limpieza local con clorhexidina 0.5% cada 12h. Cambiar comedero de plástico por acero inoxidable o cerámica.',
             'observaciones'=>'Si hay infección bacteriana secundaria, iniciar antibiótico tópico. Control en 3 semanas.'],
            ['mascota_id'=>$mascotas[11]->id,'veterinario_id'=>$vet4->id,'fecha'=>'2026-01-20',
             'diagnostico'=>'Queratitis superficial ojo izquierdo. Úlcera corneal superficial detectada con fluoresceína. Probable causa traumática.',
             'tratamiento'=>'Colirio antibiótico Tobramicina 0.3% cada 4h por 7 días. Colirio ciclopléjico Atropina 1% cada 12h por 5 días. Collar isabelino obligatorio.',
             'observaciones'=>'Control con fluoresceína en 5 días. NO usar corticoides oculares. Si empeora acudir de inmediato.'],
            ['mascota_id'=>$mascotas[14]->id,'veterinario_id'=>$vet6->id,'fecha'=>'2026-01-22',
             'diagnostico'=>'Obesidad grado II. Peso actual 13.6 kg (ideal 10-11 kg para la raza). Índice de condición corporal 8/9.',
             'tratamiento'=>'Dieta hipocalórica comercial (reducción 25% de calorías). Ejercicio gradual: caminatas de 20 min 2 veces al día, incrementar semanalmente.',
             'observaciones'=>'Meta: perder 0.5-1% de peso corporal por semana. Control de peso mensual. Eliminar snacks y comida de mesa.'],
            ['mascota_id'=>$mascotas[17]->id,'veterinario_id'=>$vet3->id,'fecha'=>'2026-01-25',
             'diagnostico'=>'Evaluación pre-quirúrgica para extracción de masa subcutánea en flanco derecho. Ecocardiograma normal. Riesgo anestésico ASA II.',
             'tratamiento'=>'Paciente apto para cirugía. Programar extracción quirúrgica de masa en 1 semana. Ayuno de 8 horas previo a cirugía.',
             'observaciones'=>'Enviar muestra a histopatología. Hemograma y química sanguínea dentro de límites normales.'],
            ['mascota_id'=>$mascotas[23]->id,'veterinario_id'=>$vet5->id,'fecha'=>'2026-01-28',
             'diagnostico'=>'Displasia de cadera bilateral moderada (grado C OFA). Crepitación articular bilateral. Dolor a la extensión de caderas.',
             'tratamiento'=>'Condroprotector (Glucosamina + Condroitina) diario de por vida. Carprofeno 4mg/kg cada 24h cuando hay dolor. Fisioterapia acuática 2 veces por semana.',
             'observaciones'=>'Control radiográfico en 6 meses. Mantener peso ideal estricto. Superficie de descanso acolchada. Evitar pisos resbaladizos.'],
            ['mascota_id'=>$mascotas[28]->id,'veterinario_id'=>$vet4->id,'fecha'=>'2026-02-01',
             'diagnostico'=>'Catarata incipiente bilateral. Opacidad del cristalino menor al 15% en ambos ojos. Visión conservada.',
             'tratamiento'=>'Colirio antioxidante (N-acetilcarnosina) cada 12h de forma indefinida para retardar progresión. Control trimestral.',
             'observaciones'=>'Si progresión supera 50% de opacidad, evaluar cirugía de facoemulsificación. Monitorear por uveítis secundaria.'],
        ];

        foreach ($historialesData as $d) {
            HistorialMedico::create($d);
        }
    }
}
