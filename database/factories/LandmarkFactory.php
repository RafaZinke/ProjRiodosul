<?php
// --------------------------------------------------
// Factory: database/factories/LandmarkFactory.php
// --------------------------------------------------

namespace Database\Factories;

use App\Models\Landmark;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandmarkFactory extends Factory
{
    protected $model = Landmark::class;

    public function definition()
    {
        return [
            'name'        => $this->faker->company . ' Park',
            'description' => $this->faker->paragraph,
            'latitude'    => $this->faker->latitude(-27.30, -27.20),
            'longitude'   => $this->faker->longitude(-49.70, -49.60),
            'address'     => $this->faker->address,
        ];
    }
}
