<?php

namespace Database\Seeders;

use App\Models\PlotLandUse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PlotLandUse::factory()->count(100)->create();
    }
}
