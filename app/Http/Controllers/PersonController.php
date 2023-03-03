<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function showPersons(): Factory|View|Application
    {
        $persons = Person::with(['properties.plots.land_uses'])->get();

        $persons->each(function ($person) {
            $total_area = 0;
            $land_uses = [];
            foreach ($person->properties as $property) {
                foreach ($property->plots as $plot) {
                    $total_area += $plot->total_area;
                    foreach ($plot->land_uses as $land_use) {
                        if (!isset($land_uses[$land_use->type])) {
                            $land_uses[$land_use->type] = 0;
                        }
                        $land_uses[$land_use->type] += $land_use->pivot->area;
                    }
                }
            }
            $person->total_area = $total_area;
            $person->land_uses = $land_uses;
        });

        return view('persons', compact('persons'));
    }

    public function personsSummary(Person $person): Factory|View|Application
    {
        $person->load('properties.plots.land_uses');
        return view('summary', compact('person'));
    }

    public function showCreatePersonForm(): Factory|View|Application
    {
        return view('create-person');
    }

    public function storePerson(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|in:Legal,Physical',
            'name' => 'required|string',
            'surname' => 'required|string',
            'title' => $request->input('type') === 'Legal' ? 'required|string' : 'nullable',
            'registration_number' => $request->input('type') === 'Legal' ? 'required|string|unique:persons,registration_number' : 'nullable',
            'personal_code' => $request->input('type') === 'Physical' ? 'required|string|max:12|unique:persons,personal_code' : 'nullable',
        ]);

        $person = new Person([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'type' => $request->input('type'),
            'title' => $request->input('type') === 'Legal' ? $request->input('title') : null,
            'personal_code' => $request->input('type') === 'Physical' ? $request->input('personal_code') : null,
            'registration_number' => $request->input('type') === 'Legal' ? $request->input('registration_number') : null,
        ]);
        $person->save();

        return redirect()->route('persons.showSinglePerson', $person);
    }

    public function showSinglePerson(Person $person): Factory|View|Application
    {
        $person->load('properties.plots.land_uses');

        return view('single-person', compact('person'));
    }

    public function editPerson(Person $person): Factory|View|Application
    {
        return view('persons-edit', compact('person'));
    }

    public function updatePerson(Request $request, Person $person): RedirectResponse
    {
        $validatedData = $request->validate([
            'type' => 'required|in:Legal,Physical',
            'name' => 'required|string',
            'surname' => 'required|string',
            'title' => $request->input('type') === 'Legal' ? 'required|string' : 'nullable',
            'registration_number' => $request->input('type') === 'Legal' ? 'required|string|unique:persons,registration_number,' . $person->id : 'nullable',
            'personal_code' => $request->input('type') === 'Physical' ? 'required|string|max:12|unique:persons,personal_code,' . $person->id : 'nullable',
        ]);

        $person->name = $validatedData['name'];
        $person->surname = $validatedData['surname'];
        $person->type = $validatedData['type'];

        if ($validatedData['type'] === 'Legal') {
            $person->title = $validatedData['title'];
            $person->registration_number = $validatedData['registration_number'];
            $person->personal_code = null;
        } else {
            $person->title = null;
            $person->registration_number = null;
            $person->personal_code = $validatedData['personal_code'];
        }
        $person->save();

        return redirect()->route('persons.personsSummary', $person);
    }
}

