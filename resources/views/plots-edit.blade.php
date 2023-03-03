@extends('layout')
@section('title', 'Edit Plot')
@section('content')
    <div class="w-full max-w-md mx-auto pt-32">
        <div class="bg-gray-200 border-l-4 border-gray-500 text-gray-700 p-4 mb-4" role="alert">
            <p class="font-bold mb-2">Editing Plot:</p>
            <p class="mb-2"><strong>Cadastral Sign:</strong> {{ $plot->cadastral_sign }}</p>
            <p class="mb-2"><strong>Total Area:</strong> {{ $plot->total_area }}</p>
            <p class="mb-2"><strong>Land Use:</strong> {{ $landUse->type }}</p>
            <p class="mb-2"><strong>Date of Survey:</strong> {{ $plot->date_of_survey }}</p>
        </div>
        <form action="{{ route('plots.updatePlot', $plot) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="cadastral_sign">Cadastral Sign:</label>
                <input type="text" name="cadastral_sign" id="cadastral_sign" class="border border-gray-400 p-2 rounded w-full" value="{{ $plot->cadastral_sign }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="total_area">Total Area (m²):</label>
                <input type="number" step=".01" name="total_area" id="total_area" class="border border-gray-400 p-2 rounded w-full" value="{{ $plot->total_area }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="land_use">Land Use:</label>
                <select class="border border-gray-400 p-2 rounded w-full" id="land_use" name="land_use">
                    @if ($landUse)
                        <option value="{{ $plot->land_use }}"></option>
                    @endif
                    @foreach(\App\Enums\LandUseEnum::getLandUseOptions() as $value => $label)
                        @if ($value != $plot->land_use)
                            <option value="{{ $value }}" {{ $value == old('land_use', $plot->land_use) ? 'selected' : '' }}>{{ $label }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="date_of_survey">Date of Survey:</label>
                <input type="date" name="date_of_survey" id="date_of_survey" class="border border-gray-400 p-2 rounded w-full" value="{{ $plot->date_of_survey }}">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-600">Update Plot</button>
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
@endsection
