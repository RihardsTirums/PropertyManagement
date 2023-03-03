<?php

namespace App\Http\Controllers;

use App\Models\LandUse;
use App\Models\Person;
use App\Models\Plot;
use App\Models\Property;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request): Factory|View|Application
    {
        $persons = Person::all();
        $properties = Property::all();
        $landUses = LandUse::all();

        $data = match ($request->input('filter')) {
            'persons_without_properties' => [
                'personsWithoutProperties' => Person::whereDoesntHave('properties')->get(),
            ],
            'properties_without_plots' => [
                'propertiesWithoutPlots' => Property::whereDoesntHave('plots')->get(),
            ],
            'plots_without_land_uses' => [
                'plotsWithoutLandUses' => Plot::whereDoesntHave('land_uses')->get(),
            ],
            default => [],
        };
        return view('filter', array_merge($data, compact('persons', 'properties', 'landUses')));
    }
}
