<?php

namespace Database\Factories;

use App\Models\LandUse;
use App\Models\Plot;
use App\Models\PlotLandUse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlotLandUseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PlotLandUse::class;

    public function definition(): array
    {
        $plot = Plot::factory()->create();
        $landUse = LandUse::factory()->create();

        return [
            'plot_id' => $plot->id,
            'land_use_id' => $landUse->id,
        ];
    }
}
