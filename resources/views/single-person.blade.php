@extends('layout')
@section('title', $person->name . ' ' . $person->surname)
@section('content')
    <div class="container mx-auto pt-32">
        <div class="mb-8">
            <div>
                <a href="{{ route('properties.showCreatePropertyForm', $person) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Property
                </a>
            </div>
            <div class="flex items-center mt-2 mb-2">
                <div class="flex items-center justify-center w-19 h-19 rounded {{ $person->type === 'Legal' ? 'bg-blue-500' : '' }}" style="background-color: {{ $person->type === 'Physical' ? '#1f8038' : '' }}; color: white; font-weight: bold; ">{{ $person->type }}</div>
                <h1 class="text-3xl font-bold" >{{ $person->name }} {{ $person->surname }}</h1>
            </div>
            <div class="text-gray-500">
                @if ($person->type === 'Legal')
                    <div>Company name: {{ $person->title }}</div>
                    <div>Registration number: {{ $person->registration_number }}</div>
                @elseif ($person->type === 'Physical')
                    <div>Personal code: {{ $person->personal_code }}</div>
                @endif
            </div>
        </div>
    </div>
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nr.</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cadastral Number</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total area</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Show Plots</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Edit Property</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($person->properties as $index => $property)
                        <tr class="cursor-pointer hover:bg-gray-100">
                            <td class="px-5 py-5 border-b border-gray-200">{{ $index + 1 }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->title }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->status }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->cadastre_number }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->plots->sum('total_area') }}m²</td>
                            <td class="px-5 py-5 border-b border-gray-200"><a href="{{ route('properties.showPropertyPlots', $property) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">List of Property Plots</a></td>
                            <td class="px-5 py-5 border-b border-gray-200"><a href="{{ route('properties.showEditPropertyForm', $property) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Edit Property</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
