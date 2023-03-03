@extends('layout')
@section('title', 'Edit Persons')
@section('content')
    <div class="w-full max-w-md mx-auto pt-32">
        <div class="mb-8">
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
        <form action="{{ route('persons.updatePerson', $person) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="type">Type:</label>
                <select name="type" id="type" class="border border-gray-400 p-2 rounded w-full">
                    <option value="Physical" {{ $person->type === 'Physical' ? 'selected' : '' }}>Physical</option>
                    <option value="Legal" {{ $person->type === 'Legal' ? 'selected' : '' }}>Legal</option>
                </select>
            </div>
            <div id="physical-fields" class="mb-4" style="{{ $person->type === 'Physical' ? 'display: block;' : 'display: none;' }}">
                <label class="block text-gray-700 font-bold mb-2" for="personal_code">Personal Code:</label>
                <input type="text" name="personal_code" id="personal_code" class="border border-gray-400 p-2 rounded w-full" value="{{ $person->personal_code }}">
            </div>
            <div id="legal-fields" class="mb-4" style="{{ $person->type === 'Legal' ? 'display: block;' : 'display: none;' }}">
                <label class="block text-gray-700 font-bold mb-2" for="registration_number">Registration Number:</label>
                <input type="text" name="registration_number" id="registration_number" class="border border-gray-400 p-2 rounded w-full" value="{{ $person->registration_number }}">

                <label class="block text-gray-700 font-bold mb-2" for="title">Title:</label>
                <input type="text" name="title" id="title" class="border border-gray-400 p-2 rounded w-full" value="{{ $person->title }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">Name:</label>
                <input type="text" name="name" id="name" class="border border-gray-400 p-2 rounded w-full" value="{{ $person->name }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" class="border border-gray-400 p-2 rounded w-full" value="{{ $person->surname }}">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-600">Update Information</button>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <strong>Validation errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
    <script>
        const typeSelect = document.getElementById('type');
        const physicalFields = document.getElementById('physical-fields');
        const legalFields = document.getElementById('legal-fields');

        typeSelect.addEventListener('change', function () {
            if (this.value === 'Physical') {
                physicalFields.style.display = 'block';
                legalFields.style.display = 'none';
            } else if (this.value === 'Legal') {
                physicalFields.style.display = 'none';
                legalFields.style.display = 'block';
            }
        });
    </script>
@endsection


