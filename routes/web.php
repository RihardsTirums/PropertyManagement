<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\LandPlotController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $persons = App\Models\Person::all();
    return view('persons', ['persons' => $persons]);
});
Route::get('/persons', [PersonController::class, 'showPersons']);
Route::get('/persons/{person}', [PersonController::class, 'showSinglePerson'])->name('persons.showSinglePerson');
Route::get('/persons/{person}/summary', [PersonController::class, 'personsSummary'])->name('persons.personsSummary');
Route::get('/person/create', [PersonController::class, 'showCreatePersonForm'])->name('persons.showCreatePersonForm');
Route::get('/persons/{person}/edit', [PersonController::class, 'editPerson'])->name('persons.editPerson');
Route::post('/persons', [PersonController::class, 'storePerson'])->name('persons.storePerson');
Route::put('/persons/{person}/update', [PersonController::class, 'updatePerson'])->name("persons.updatePerson");
Route::get('/properties/{property}/edit', [PropertyController::class, 'showEditPropertyForm'])->name('properties.showEditPropertyForm');
Route::get('/persons/{person}/properties/create', [PropertyController::class, 'showCreatePropertyForm'])->name('properties.showCreatePropertyForm');
Route::post('/persons/{person}/properties', [PropertyController::class, 'storeProperty'])->name('properties.storeProperty');
Route::put('/properties/{property}', [PropertyController::class, 'updateProperty'])->name('properties.updateProperty');
Route::get('/properties/{property}/plots', [LandPlotController::class, 'showPropertyPlots'])->name('properties.showPropertyPlots');
Route::get('/properties/{property}/plots/create', [LandPlotController::class, 'showCreatePlotForm'])->name('plots.create');
Route::get('/plots/{plot}/edit', [LandPlotController::class, 'showEditPlotForm'])->name('plots.showEditPlotForm');
Route::post('/plots', [LandPlotController::class, 'storePlot'])->name('plots.storePlot');
Route::put('/plots/{plot}', [LandPlotController::class, 'updatePlot'])->name('plots.updatePlot');
Route::get('/filter', [FilterController::class, 'filter'])->name('filter');















