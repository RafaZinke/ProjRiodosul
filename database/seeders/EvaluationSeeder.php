<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    public function run()
    {
        Evaluation::factory()->count(50)->create();
    }
}