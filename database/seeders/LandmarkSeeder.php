<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Landmark;

class LandmarkSeeder extends Seeder
{
    public function run()
    {
        // Cria 10 landmarks com eventos e fotos relacionados
        Landmark::factory()
            ->count(10)
            ->hasEvents(3)
            ->hasPhotos(2)
            ->create();
    }
}