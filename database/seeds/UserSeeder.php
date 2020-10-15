<?php

use App\Municipio;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => "Administrador",
            'apellido' => "Senasoft",
            'genero' => "Masculino",
            'rh' => "O+",
            'fecha_nacimiento' => "1989-09-03",
            'tipo_documento' => "Cédula de Ciudadanía",
            'documento' => "1057582244",
            'fecha_expedicion' => "2007-11-13",
            'municipio_id' => Municipio::whereNombre("Sogamoso")->first()->id,
            'telefono_movil' => "3118864151",
            'telefono_ip' => "82145",
            'email' => "dojedam@sena.edu.co",
            'password' => "89090352505",
            'avatar' => "default.jpg",
            'estado' => "Activo",
            'email_verified_at' => today(),
        ]);


        //factory( User::class, 50)->create();
//        foreach (EsigaHelper::ReadFileCVS('UsersMinero.csv', ',') as $offset => $record) {
//            //User::create($record);
//            User::create([
//                'nombre' => $record['nombre'],
//                'apellido' => $record['apellido'],
//                'tipo_documento' => $record['tipo_documento'],
//                'documento' => $record['documento'],
//                'municipio_id' => Municipio::whereNombre($record['municipio_id'])->first()->id,
//                'fecha_expedicion' => Carbon::parse(request($record['fecha_expedicion']))->format('Y-m-d'),
//                'genero' => $record['genero'],
//                'rh' => $record['rh'],
//                'fecha_nacimiento' => Carbon::parse(request($record['fecha_nacimiento']))->format('Y-m-d'),
//                'telefono_movil' => $record['telefono_movil'],
//                'telefono_ip' => $record['telefono_ip'],
//                'avatar' => $record['avatar'],
//                'email' => $record['email'],
//                'password' => Hash::make($record['password']),
//                'estado' => $record['estado'],
//            ]);
//        }
//
//        foreach (EsigaHelper::ReadFileCVS('UsersCIMM.csv', ',') as $offset => $record) {
//            //User::create($record);
//            User::create([
//                'nombre' => $record['nombre'],
//                'apellido' => $record['apellido'],
//                'tipo_documento' => $record['tipo_documento'],
//                'documento' => $record['documento'],
//                'municipio_id' => $record['municipio_id'],
//                'fecha_expedicion' => Carbon::parse(request($record['fecha_expedicion']))->format('Y-m-d'),
//                'genero' => $record['genero'],
//                'rh' => $record['rh'],
//                'fecha_nacimiento' => $record['fecha_nacimiento'],
//                'telefono_movil' => $record['telefono_movil'],
//                'telefono_ip' => $record['telefono_ip'],
//                'avatar' => $record['avatar'],
//                'email' => $record['email'],
//                'password' => Hash::make($record['password']),
//                'estado' => $record['estado'],
//            ]);
//        }

    }
}
