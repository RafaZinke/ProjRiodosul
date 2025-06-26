<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Landmark;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'landmark_id' => Landmark::factory(),
            'user_id'     => $this->faker->boolean(20) ? null : User::factory(),
            'content'     => $this->faker->sentence(10),
        ];
    }
}