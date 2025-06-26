<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Primeiro criamos os landmarks, que por factory já geram events e photos
            LandmarkSeeder::class,

            // Caso queira garantir eventos adicionais
            EventSeeder::class,

            // Fotos extras (caso não tenha sido gerado via LandmarkSeeder)
            PhotoSeeder::class,

            // Comentários
            CommentSeeder::class,

            // Avaliações
            EvaluationSeeder::class,
        ]);
    }
}
