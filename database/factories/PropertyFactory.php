<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $landTypes = [
            'Forest land',
            'Agricultural land',
            'Construction land',
            'Meadow land',
            'Water area',
            'Protected area',
            'Other'
        ];
        $statuses = ['Purchase Contract', 'Paid', 'Registered in the land book', 'Sold'];

        return [
            'title' => $this->faker->randomElement($landTypes),
            'cadastre_number' => $this->faker->unique()->numerify('###########'),
            'status' => $this->faker->randomElement($statuses),
            'persons_id' => Person::factory(),
        ];
    }
}
