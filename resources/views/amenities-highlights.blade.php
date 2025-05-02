{{-- resources/views/properties/step3-amenities.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2">AirBnBreeze</h1>
            <h2 class="text-xl font-semibold text-gray-900">Step 2: Add highlights</h2>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Description Section -->
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Annotation</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pickdown</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Select an option</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Amenities Sections -->
            <div class="p-6 space-y-8">
                <!-- Basic Amenities -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Identify basic amenities</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['Wifi', 'Walnut', 'Television', 'Kitchen', 'Reliving', 'Air Conditioning', 'Workplace'] as $amenity)
                            <div class="amenity-item" data-amenity="{{ strtolower(str_replace(' ', '_', $amenity)) }}">
                                <input type="checkbox" id="basic_{{ strtolower(str_replace(' ', '_', $amenity)) }}" 
                                       class="hidden peer" {{ $amenity == 'Walnut' || $amenity == 'Reliving' || $amenity == 'Air Conditioning' || $amenity == 'Workplace' ? 'checked' : '' }}>
                                <label for="basic_{{ strtolower(str_replace(' ', '_', $amenity)) }}" 
                                       class="block px-4 py-2 border rounded-md text-sm font-medium text-center cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-300 peer-checked:text-green-800 hover:bg-gray-50">
                                    {{ $amenity }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Standout Amenities -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Identify standout amenities</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['Pool', 'Gym', 'Beach Area', 'Shower', 'Outdoor Dining', 'Line Access', 'Billards', 'BBC Call', 'Pails'] as $amenity)
                            <div class="amenity-item" data-amenity="{{ strtolower(str_replace(' ', '_', $amenity)) }}">
                                <input type="checkbox" id="standout_{{ strtolower(str_replace(' ', '_', $amenity)) }}" 
                                       class="hidden peer" {{ $amenity != 'Pool' ? 'checked' : '' }}>
                                <label for="standout_{{ strtolower(str_replace(' ', '_', $amenity)) }}" 
                                       class="block px-4 py-2 border rounded-md text-sm font-medium text-center cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-300 peer-checked:text-green-800 hover:bg-gray-50">
                                    {{ $amenity }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Safety Items -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Identify safety items</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['Smoke Alarms', 'First Aid Kit', 'Fire Extinguisher'] as $amenity)
                            <div class="amenity-item" data-amenity="{{ strtolower(str_replace(' ', '_', $amenity)) }}">
                                <input type="checkbox" id="safety_{{ strtolower(str_replace(' ', '_', $amenity)) }}" 
                                       class="hidden peer" checked>
                                <label for="safety_{{ strtolower(str_replace(' ', '_', $amenity)) }}" 
                                       class="block px-4 py-2 border rounded-md text-sm font-medium text-center cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-300 peer-checked:text-green-800 hover:bg-gray-50">
                                    {{ $amenity }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Other Amenities -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Other amenities</h3>
                    <div class="flex items-center space-x-2 mb-3">
                        <input type="text" id="custom_amenity" 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               placeholder="Enter custom amenity">
                        <button type="button" onclick="addCustomAmenity()" 
                                class="px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add
                        </button>
                    </div>
                    <div id="custom_amenities_list" class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <div class="amenity-item" data-amenity="stockify_products">
                            <input type="checkbox" id="other_stockify" class="hidden peer" checked>
                            <label for="other_stockify" 
                                   class="block px-4 py-2 border rounded-md text-sm font-medium text-center cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-300 peer-checked:text-green-800 hover:bg-gray-50">
                                Stockify products
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between">
                <button type="button" onclick="window.location.href='{{ route('properties.highlights') }}'" 
                        class="back-btn">
                    Back
                </button>
                <div class="flex space-x-3">
                    <button type="button" onclick="cancelChanges()" 
                            class="cancel-btn">
                        Cancel
                    </button>
                    <button type="button" onclick="saveAndExit()" 
                            class="save-exit-btn">
                        Save & Exit
                    </button>
                    <button type="button" onclick="saveAndContinue()" 
                            class="next-btn">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add custom amenity
    function addCustomAmenity() {
        const input = document.getElementById('custom_amenity');
        const value = input.value.trim();
        
        if (value) {
            const id = 'custom_' + value.toLowerCase().replace(/[^a-z0-9]+/g, '_');
            
            const amenityItem = document.createElement('div');
            amenityItem.className = 'amenity-item';
            amenityItem.dataset.amenity = id;
            amenityItem.innerHTML = `
                <input type="checkbox" id="${id}" class="hidden peer" checked>
                <label for="${id}" 
                       class="block px-4 py-2 border rounded-md text-sm font-medium text-center cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-300 peer-checked:text-green-800 hover:bg-gray-50">
                    ${value}
                </label>
            `;
            
            document.getElementById('custom_amenities_list').appendChild(amenityItem);
            input.value = '';
        }
    }

    // Cancel changes
    function cancelChanges() {
        if (confirm('Are you sure you want to cancel? All changes will be lost.')) {
            // Uncheck all amenities except the default checked ones
            document.querySelectorAll('.amenity-item input[type="checkbox"]').forEach(checkbox => {
                const defaultChecked = ['walnut', 'reliving', 'air_conditioning', 'workplace', 
                                       'gym', 'beach_area', 'shower', 'outdoor_dining', 
                                       'line_access', 'billards', 'bbc_call', 'pails',
                                       'smoke_alarms', 'first_aid_kit', 'fire_extinguisher',
                                       'stockify_products'].includes(checkbox.id.split('_').slice(1).join('_'));
                
                checkbox.checked = defaultChecked;
                
                // Trigger change event to update UI
                const event = new Event('change');
                checkbox.dispatchEvent(event);
            });
            
            // Clear custom amenities
            document.getElementById('custom_amenities_list').innerHTML = `
                <div class="amenity-item" data-amenity="stockify_products">
                    <input type="checkbox" id="other_stockify" class="hidden peer" checked>
                    <label for="other_stockify" 
                           class="block px-4 py-2 border rounded-md text-sm font-medium text-center cursor-pointer peer-checked:bg-green-100 peer-checked:border-green-300 peer-checked:text-green-800 hover:bg-gray-50">
                        Stockify products
                    </label>
                </div>
            `;
        }
    }

    // Save and exit
    function saveAndExit() {
        if (saveData()) {
            alert('Your changes have been saved!');
            window.location.href = '/'; // Redirect to home
        }
    }

    // Save and continue
    function saveAndContinue() {
        if (saveData()) {
            window.location.href = '{{ route("properties.step4") }}'; // Next step
        }
    }

    // Save data
    function saveData() {
        const amenities = {
            basic: [],
            standout: [],
            safety: [],
            other: []
        };

        // Collect all selected amenities
        document.querySelectorAll('.amenity-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            if (checkbox.checked) {
                const category = checkbox.id.split('_')[0];
                const amenityName = item.dataset.amenity;
                
                if (category === 'basic') amenities.basic.push(amenityName);
                else if (category === 'standout') amenities.standout.push(amenityName);
                else if (category === 'safety') amenities.safety.push(amenityName);
                else amenities.other.push(amenityName);
            }
        });

        console.log('Saving amenities:', amenities);
    /
        
        return true;
    }
</script>

<style>
    .amenity-item input:checked + label {
        @apply bg-green-100 border-green-300 text-green-800;
    }
    .back-btn {
        @apply inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
    }
    .cancel-btn {
        @apply inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500;
    }
    .save-exit-btn {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
    }
    .next-btn {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500;
    }
</style>
@endsection
