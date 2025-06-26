<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        // Fotos adicionais
        Photo::factory()->count(30)->create();
    }
}
