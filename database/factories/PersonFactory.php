<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Person::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['Legal', 'Physical']);

        $personalCode = $type === 'Physical'
            ? $this->faker->unique()->numerify('######-#####')
            : null;

        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'type' => $type,
            'personal_code' => $personalCode,
            'title' => $type === 'Legal' ? $this->faker->jobTitle : null,
            'registration_number' => $type === 'Legal' ? $this->faker->unique()->numberBetween(10000000, 99999999) : null,
        ];
    }
}
