{{-- resources/views/properties/step1.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Step 1: Identify your property
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('properties.storeStep1') }}" method="POST">
                @csrf

                <!-- Property Type Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Property type</label>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(['House', 'Apartment', 'Tiny Home', 'Cabin', 'Tent', 'Camper Van', 'Beds & Breakfast'] as $type)
                        <div>
                            <input type="radio" name="property_type" id="property_type_{{ Str::slug($type) }}" 
                                   value="{{ $type }}" class="hidden peer" 
                                   @if(old('property_type') == $type) checked @endif>
                            <label for="property_type_{{ Str::slug($type) }}" 
                                   class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:text-indigo-700 cursor-pointer">
                                {{ $type }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('property_type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <div class="mt-1">
                        <input id="location" name="location" type="text" required 
                               value="{{ old('location') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacity -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                    <div class="mt-1">
                        <input id="capacity" name="capacity" type="number" min="1" required
                               value="{{ old('capacity') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    @error('capacity')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between">
                    <a href="{{ url()->previous() }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add visual feedback when property type is selected
    const propertyTypeInputs = document.querySelectorAll('input[name="property_type"]');
    propertyTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Remove all selected styles first
            document.querySelectorAll('label[for^="property_type_"]').forEach(label => {
                label.classList.remove('peer-checked:border-indigo-500', 'peer-checked:bg-indigo-50', 'peer-checked:text-indigo-700');
            });
            
            // Add to the selected one
            if (this.checked) {
                const label = document.querySelector(`label[for="${this.id}"]`);
                label.classList.add('peer-checked:border-indigo-500', 'peer-checked:bg-indigo-50', 'peer-checked:text-indigo-700');
            }
        });
    });
});
</script>
@endsection
