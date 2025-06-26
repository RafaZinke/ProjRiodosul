<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Garante que existam eventos mesmo se não gerados via landmarks
        Event::factory()->count(20)->create();
    }
}