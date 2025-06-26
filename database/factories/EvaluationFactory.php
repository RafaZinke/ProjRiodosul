<?php

namespace Database\Factories;

use App\Models\Evaluation;
use App\Models\Landmark;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationFactory extends Factory
{
    protected $model = Evaluation::class;

    public function definition()
    {
        return [
            'landmark_id' => Landmark::factory(),
            'user_id'     => $this->faker->boolean(20) ? null : User::factory(),
            'rating'      => $this->faker->numberBetween(1, 5),
        ];
    }
}