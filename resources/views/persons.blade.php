@extends('layout')
@section('title', 'Persons')
@section('content')
    <div class="container mx-auto pt-32">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nr</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Surname</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title/Personal Code</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Registration Number</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total area of properties</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Properties</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Summary</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($persons as $person)
                        <tr class="cursor-pointer hover:bg-gray-100">
                            <td class="px-5 py-5 border-b border-gray-200">{{ $person->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $person->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $person->surname }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">
                            <span class="{{ $person->type == 'Legal' ? 'text-blue-500' : 'text-green-500' }}">
                                {{ $person->type }}
                            </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                {{ $person->type == 'Legal' ? $person->title : $person->personal_code }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                {{ $person->type == 'Legal' ? $person->registration_number : '' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                {{ number_format($person->total_area / 10000, 3) }} ha
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                <a href="{{ route('persons.showSinglePerson', $person) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Properties</a>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                <a href="{{ route('persons.personsSummary', $person) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Summary</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
