@extends('layout')
@section('title', 'Edit Property')
@section('content')
    <div class="w-full max-w-md mx-auto pt-32">
        <div class="bg-gray-200 border-l-4 border-gray-500 text-gray-700 p-4 mb-4" role="alert">
            <p class="font-bold mb-2">Editing Property:</p>
            <p class="mb-2"><strong>Name:</strong> {{ $property->title }}</p>
            <p class="mb-2"><strong>Cadastre Number:</strong> {{ $property->cadastre_number }}</p>
            <p class="mb-2"><strong>Status:</strong> {{ $property->status }}</p>
        </div>
        <form action="{{ route('properties.updateProperty', $property) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="title">Name:</label>
                <input type="text" name="title" id="title" class="border border-gray-400 p-2 rounded w-full" value="{{ old('title', $property->title) }}">
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="cadastre_number">Cadastre Number:</label>
                <input type="text" name="cadastre_number" id="cadastre_number" class="border border-gray-400 p-2 rounded w-full" value="{{ old('cadastre_number', $property->cadastre_number) }}">
                @error('cadastre_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="status">Status:</label>
                <select name="status" id="status" class="border border-gray-400 p-2 rounded w-full">
                    @foreach(App\Enums\PropertyStatusEnum::getStatusOptions() as $value => $label)
                        <option value="{{ $value }}" {{ $property->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
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
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-600">Update Property</button>
            </div>
        </form>
    </div>
@endsection
