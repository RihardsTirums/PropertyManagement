@extends('layout')
@section('title', 'Create Persons')
@section('content')
    <div class="container mx-auto pt-32">
        <h1 class="text-4xl font-bold mb-4">Create a Person</h1>
        <form action="{{ route('persons.storePerson') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-bold mb-2">Type:</label>
                <select name="type" id="type" class="border border-gray-400 p-2 rounded w-full">
                    <option value="Legal">Legal</option>
                    <option value="Physical">Physical</option>
                </select>
            </div>
            <div id="legal-fields">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                    <input type="text" name="title" id="title" class="border border-gray-400 p-2 rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="registration_number" class="block text-gray-700 font-bold mb-2">Registration Number:</label>
                    <input type="text" name="registration_number" id="registration_number" class="border border-gray-400 p-2 rounded w-full">
                </div>
            </div>
            <div id="physical-fields" style="display:none;">
                <div class="mb-4">
                    <label for="personal_code" class="block text-gray-700 font-bold mb-2">Personal Code:</label>
                    <input type="text" name="personal_code" id="personal_code" class="border border-gray-400 p-2 rounded w-full">
                </div>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" name="name" id="name" class="border border-gray-400 p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="surname" class="block text-gray-700 font-bold mb-2">Surname:</label>
                <input type="text" name="surname" id="surname" class="border border-gray-400 p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-600">Create Person</button>
            </div>
            @if ($errors->any())
                <div class="text-red-500 mb-4">
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
        const typeSelect = document.querySelector('#type');
        const legalFields = document.querySelector('#legal-fields');
        const physicalFields = document.querySelector('#physical-fields');

        function updateFields() {
            if (typeSelect.value === 'Legal') {
                legalFields.style.display = 'block';
                physicalFields.style.display = 'none';
                document.querySelectorAll('input[name]').forEach(input => {
                    input.removeAttribute('required');
                });
                document.querySelectorAll('#legal-fields input[name]').forEach(input => {
                    input.setAttribute('required', 'required');
                });
            } else if (typeSelect.value === 'Physical') {
                legalFields.style.display = 'none';
                physicalFields.style.display = 'block';
                document.querySelectorAll('input[name]').forEach(input => {
                    input.removeAttribute('required');
                });
                document.querySelectorAll('#physical-fields input[name]').forEach(input => {
                    input.setAttribute('required', 'required');
                });
            }
        }
        typeSelect.addEventListener('change', updateFields);
        updateFields();
    </script>
@endsection



