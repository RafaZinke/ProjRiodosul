<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Landmark;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
            'landmark_id' => Landmark::factory(),
            'url'         => $this->faker->imageUrl(800, 600, 'landmark', true),
            'caption'     => $this->faker->optional()->sentence,
        ];
    }
}
