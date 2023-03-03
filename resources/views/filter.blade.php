@extends('layout')
@section('title', 'Filter')
@section('content')
    <div class="mt-16">
        <div class="mx-auto w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 flex flex-col justify-center h-full">
            <form action="{{ route('filter') }}" method="get"
                  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="filter">
                        Filter:
                    </label>
                    <select name="filter" id="filter"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select filter</option>
                        <option value="persons_without_properties">Persons without properties</option>
                        <option value="properties_without_plots">Propertieas without plots of land</option>
                        <option value="plots_without_land_uses">Plots of land without land uses</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                            <path d="M11 8v3l4-3-4-3v3H3v2h8z"/>
                        </svg>
                    </div>
                </div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded flex justify-end">
                    Filter
                </button>
            </form>
            @if (isset($personsWithoutProperties) && request('filter') === 'persons_without_properties')
                <div class="mb-4">
                    <h2 class="text-2xl font-bold mb-2">Persons without properties:</h2>
                    @if (count($personsWithoutProperties) > 0)
                        <table class="table-auto w-full">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Nr</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Surname</th>
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Title or Personal Code</th>
                                <th class="px-4 py-2">Registration Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($personsWithoutProperties as $index => $person)
                                <tr>
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $person->name }}</td>
                                    <td class="border px-4 py-2">{{ $person->surname }}</td>
                                     <td class="border px-4 py-2 {{ $person->type == 'Legal' ? 'text-blue-500' : 'text-green-500' }}">
                                        {{ $person->type }}
                                    </td>
                                    <td class="border px-4 py-2">{{ $person->type == 'Legal' ? $person->title : $person->personal_code }}</td>
                                    <td class="border px-4 py-2">{{ $person->registration_number }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No persons without properties found.</p>
                    @endif
                </div>
            @endif
            @if (isset($propertiesWithoutPlots) && request('filter') === 'properties_without_plots')
                <div class="mb-4">
                    <h2 class="text-2xl font-bold mb-2">Properties without plots of land:</h2>
                    @if (count($propertiesWithoutPlots) > 0)
                        <table class="w-full border-collapse">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Nr</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Cadastre Number</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($propertiesWithoutPlots as $index => $property)
                                <tr class="bg-white border-b-2 border-gray-200 hover:bg-gray-100">
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $property->title }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $property->cadastre_number }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $property->status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No properties without plots of land found.</p>
                    @endif
                </div>
            @endif
            @if (isset($plotsWithoutLandUses) && request('filter') === 'plots_without_land_uses')
                <div class="mb-4">
                    <h2 class="text-2xl font-bold mb-2">Plots of land without land uses:</h2>
                    @if (count($plotsWithoutLandUses) > 0)
                        <table class="w-full border-collapse">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Nr</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Cadastral Sign</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Area</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Date of survey</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($plotsWithoutLandUses as $index => $plot)
                                <tr class="bg-white border-b-2 border-gray-200 hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $plot->cadastral_sign }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $plot->total_area }} m<sup>2</sup></td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 border-r border-gray-200">{{ $plot->date_of_survey }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No plots of land without land uses found.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
