<?php

namespace App\Http\Controllers;

use App\Models\LandUse;
use App\Models\Plot;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Property;

class LandPlotController extends Controller
{
    public function showCreatePlotForm(Property $property): Factory|View|Application
    {
        return view('create-plot', compact('property'));
    }

    public function storePlot(Request $request): RedirectResponse
    {
        $request->validate([
            'cadastral_sign' => 'required|string|size:11|unique:plots,cadastral_sign',
            'total_area' => 'required|numeric',
            'survey_date' => 'required|date',
            'property_id' => 'required|exists:properties,id',
            'land_use' => 'required|string',
        ]);

        $property = Property::find($request->input('property_id'));

        if (!$property) {
            return redirect()->back()->withErrors(['Property not found.']);
        }

        $landUse = LandUse::firstOrCreate(['type' => ucwords(str_replace('_', ' ', $request->input('land_use')))]);

        $plot = new Plot([
            'cadastral_sign' => $request->input('cadastral_sign'),
            'total_area' => $request->input('total_area'),
            'date_of_survey' => $request->input('survey_date'),
            'property_id' => $request->input('property_id'),
            'land_use_id' => $landUse->id,
        ]);

        $plot->save();
        $plot->land_uses()->attach($landUse, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('properties.showPropertyPlots', ['property' => $plot->property_id]);
    }

    public function showEditPlotForm(Plot $plot): Factory|View|Application|RedirectResponse
    {
        $landUse = $plot->land_uses->first();

        if (!$landUse) {
            return redirect()->back()->with('error', 'No land use found for this plot.');
        }

        return view('plots-edit', compact('plot', 'landUse'));
    }

    public function updatePlot(Request $request, Plot $plot): RedirectResponse
    {
        $validatedData = $request->validate([
            'cadastral_sign' => 'required|string|max:11|unique:plots,cadastral_sign,' . $plot->id,
            'total_area' => 'required|numeric|min:0',
            'land_use' => 'required|string|exists:land_uses,type',
            'date_of_survey' => 'required|date',
        ]);

        $land_use = LandUse::where('type', $validatedData['land_use'])->firstOrFail();
        $plot->fill($validatedData);
        $plot->updated_at = now();
        $plot->save();

        $plot->land_uses()->sync([$land_use->id => ['updated_at' => now(), 'created_at' => now()]]);

        return redirect()->route('properties.showPropertyPlots', ['property' => $plot->property_id]);
    }

    public function showPropertyPlots(Property $property): Factory|View|Application
    {
        $property->load('plots.land_uses');
        return view('property-plots', compact('property'));
    }
}

