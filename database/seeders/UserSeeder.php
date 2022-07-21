<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Jose Fernando Ramirez',
            'phone' => '+57 0000000000',
            'address' => 'Calle #100',
            'emergency_phone' => '+57 0000000000',
            'emergency_person' => 'Fernanda Ramirez',
            'address' => 'Calle #100',
            'user_type' => 'Profesor',
            'img_avatar' => 'Jose_Fernando_avatar.jpg',
            'status' => 1,
            'email' => 'josefernando@mail.com',
            'password' => '$2y$10$5P5bUVfRobhNX/dSamJXU.9b2j00xJowPY0Q602GcNCAjEaognO32'
            //JoseFernando.*
        ]);
        User::create([
            'name' => 'Andrea Ramirez',
            'phone' => '+57 0000000000',
            'address' => 'Calle #100',
            'emergency_phone' => '+57 0000000000',
            'emergency_person' => 'Andres Ramirez',
            'address' => 'Calle #100',
            'user_type' => 'Estudiante',
            'img_avatar' => 'Andrea_Ramirez_avatar.jpg',
            'status' => 1,
            'email' => 'andrea@mail.com',
            'password' => '$2y$10$bh0zlUtMCW0JiiZWATZqJertOxKEjw69jBCIZrXgrKdMx/TlYxL7a'
            //AndreaRamirez.*
        ]);
        User::create([
            'name' => 'Carlos Ramirez',
            'phone' => '+57 0000000000',
            'address' => 'Calle #100',
            'emergency_phone' => '+57 0000000000',
            'emergency_person' => 'Sofia Ramirez',
            'address' => 'Calle #100',
            'user_type' => 'Administrador',
            'img_avatar' => 'Carlos_avatar.jpg',
            'status' => 1,
            'email' => 'Carlos@mail.com',
            'password' => '$2y$10$gi7JQQJrdvg1kdzq/q835O7BhohWQ6CX7WAXTeLLj4P4vCnYiwkWm'
            //CarlosRamirez.*
        ]);
    }
}
