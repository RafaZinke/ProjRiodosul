<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Landmark;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'landmark_id' => Landmark::factory(),
            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'event_date'  => $this->faker->dateTimeBetween('-1 month', '+3 months'),
        ];
    }
}
