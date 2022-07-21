<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::create([
            'name' => 'Body Combat',
            'description' => 'Esta clase combina ejercicios típicos de los deportes de contacto y las artes marciales. Recuerda mucho al boxeo, pero siempre guiado a través de una coreografía que pone en marcha ese efecto cardiovascular, que ayuda a quemar calorías.'
        ]);

        Lesson::create([
            'name' => 'Body Pump',
            'description' => 'El Body Pump es quizás la clase colectiva más socorrida y famosa de los gimnasios españoles. La idea es trabajar con pesas todo el cuerpo, dividiendo la sesión en grupos musculares.'
        ]);

        Lesson::create([
            'name' => 'Spinning',
            'description' => ' Una bicicleta estática especial sirve como elemento indispensable para desarrollar la sesión deportiva. Unos 45 minutos de duración y el resultado es muy positivo'
        ]);

        Lesson::create([
            'name' => 'Yoga',
            'description' => 'Cada instructor de Yoga ofrece su sabiduría de forma diferente. Los beneficios del Yoga son interesantes.'
        ]);
    }
}
