@extends('layout')
@section('title', 'Summary')
@section('content')
    <div class="container mx-auto pt-32">
        <div class="mb-8">
            <a href="{{ route('persons.editPerson', $person) }}" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-600">Edit Person</a>
            <div class="flex items-center mt-2 mb-2">
                <div class="flex items-center justify-center w-19 h-19 rounded {{ $person->type === 'Legal' ? 'bg-blue-500' : '' }}" style="background-color: {{ $person->type === 'Physical' ? '#1f8038' : '' }}; color: white; font-weight: bold; ">{{ $person->type }}</div>
                <h1 class="text-3xl font-bold" >{{ $person->name }} {{ $person->surname }} Summary</h1>
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
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Property</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cadastral Sign</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Area</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Land Use Areas</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($person->properties as $property)
                        <tr class="cursor-pointer hover:bg-gray-100">
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->title }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->cadastre_number }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->status }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $property->plots->sum('total_area') }}m²</td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                @foreach($property->plots as $plot)
                                    @foreach($plot->land_uses as $land_use)
                                        {{ $land_use->type }} {{ $land_use->pivot->area }}<br>
                                    @endforeach
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
