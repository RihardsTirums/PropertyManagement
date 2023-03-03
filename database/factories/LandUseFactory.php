<?php

namespace Database\Factories;

use App\Enums\LandUseEnum;
use App\Models\LandUse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandUse>
 */
class LandUseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = LandUse::class;

    public function definition(): array
    {
        $landUses = LandUseEnum::getLandUseOptions();
        $type = $this->faker->randomElement(array_keys($landUses));

        return [
            'type' => $type,
        ];
    }
}
