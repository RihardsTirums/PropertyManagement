@extends('layout')
@section('title', $property->title . ' Property Plots')
@section('content')
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Add Plot</p>
                    <div class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <form id="createPlotForm" method="POST" action="{{ route('plots.storePlot') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="cadastral_sign">
                            Cadastral Sign:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cadastral_sign" name="cadastral_sign" type="text" placeholder="Cadastral Sign">
                        @if ($errors->has('cadastral_sign'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('cadastral_sign') }}</p>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="total_area">
                            Total Area:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="total_area" name="total_area" type="text" placeholder="Total Area">
                        @if ($errors->has('total_area'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('total_area') }}</p>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="land_use">
                            Land Use:
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="land_use" name="land_use">
                            <option value="">-- Select Land Use --</option>
                            @foreach(\App\Enums\LandUseEnum::getLandUseOptions() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('land_use'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('land_use') }}</p>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="survey_date">
                            Date of Survey:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="survey_date" name="survey_date" type="date" placeholder="Date of Survey">
                        @if ($errors->has('date_of_survey'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('date_of_survey') }}</p>
                        @endif
                    </div>
                    <div class="flex justify-end pt-2">
                        <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" type="button" data-dismiss="modal">Cancel</button>
                        <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
