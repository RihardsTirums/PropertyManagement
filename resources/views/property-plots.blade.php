@extends('layout')
@section('title', $property->title . ' Property Plots')
@section('content')
    <div class="container mx-auto pt-32">
        <h1 class="text-3xl font-bold mb-8">{{ $property->title }} Property Plots</h1>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="location.href='{{ route('plots.create', $property) }}'">
            Add Plot
        </button>
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nr.</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cadastral Sign</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Area</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Land Use</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"></th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date of Survey</th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Edit Plot</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($property->plots as $index => $plot)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $index + 1 }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $plot->cadastral_sign }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $plot->total_area }}m²</td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                @foreach($plot->land_uses as $land_use)
                                    {{ $land_use->type }}<br>
                                @endforeach
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                @foreach($plot->land_uses as $land_use)
                                    {{ $land_use->pivot->area }}<br>
                                @endforeach
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200">{{ $plot->date_of_survey }}</td>
                            <td class="px-5 py-5 border-b border-gray-200">
                                <a href="{{ route('plots.showEditPlotForm', $plot) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
