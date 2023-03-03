<?php

namespace Database\Factories;

use App\Models\Plot;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plot>
 */
class PlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Plot::class;

    public function definition(): array
    {
        return [
            'cadastral_sign' => $this->faker->unique()->numerify('###########'),
            'total_area' => $this->faker->randomFloat(2, 1, 100),
            'date_of_survey' => $this->faker->date(),
            'property_id' => function () {
                return Property::factory()->create()->id;
            }
        ];
    }
}
