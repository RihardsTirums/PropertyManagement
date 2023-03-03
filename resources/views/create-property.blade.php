@extends('layout')
@section('title', 'Create Property')
@section('content')
    <div class="container mx-auto pt-32">
        <h1 class="text-4xl font-bold mb-4">Create a Property</h1>
        <form action="{{ route('properties.storeProperty', $person) }}" method="POST">
        @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="border border-gray-400 p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="cadastre_number" class="block text-gray-700 font-bold mb-2">Cadastre Number:</label>
                <input type="text" name="cadastre_number" id="cadastre_number" class="border border-gray-400 p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
                <select name="status" id="status" class="border border-gray-400 p-2 rounded w-full">
                    <option value="Purchase Contract">Purchase Contract</option>
                    <option value="Paid">Paid</option>
                    <option value="Registered in the Land Book">Registered in the Land Book</option>
                    <option value="Sold">Sold</option>
                </select>
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-600">Create Property</button>
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
@endsection
