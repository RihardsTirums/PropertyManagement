<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Person;

class PropertyController extends Controller
{
    public function showCreatePropertyForm($personId): Factory|View|Application
    {
        $person = Person::findOrFail($personId);

        return view('create-property', ['person' => $person]);
    }

    public function updateProperty(Request $request, Property $property): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'cadastre_number' => 'required|string|size:11|unique:properties,cadastre_number,'.$property->id,
            'status' => 'required|string',
        ]);

        $property->title = $validatedData['title'];
        $property->cadastre_number = $validatedData['cadastre_number'];
        $property->status = $validatedData['status'];

        $property->save();

        return redirect()->route('persons.showSinglePerson', $property->persons_id);
    }

    public function storeProperty(Request $request, $personId): RedirectResponse
    {
        $person = Person::find($personId);

        if (!$person) {
            return redirect()->back()->withErrors(['Person not found.']);
        }

        $request->validate([
            'title' => 'required|string',
            'cadastre_number' => 'required|string|size:11|unique:properties,cadastre_number',
            'status' => 'required|in:Purchase Contract,Paid,Registered in the Land Book,Sold',
        ]);

        $property = new Property([
            'title' => $request->input('title'),
            'cadastre_number' => $request->input('cadastre_number'),
            'status' => $request->input('status'),
        ]);

        $property->persons_id = $personId;
        $property->save();

        return redirect()->route('persons.showSinglePerson', $person);
    }

    public function showEditPropertyForm(Property $property): Factory|View|Application
    {
        return view('property-edit', compact('property'));
    }
}

