{{-- resources/views/properties/step2-highlights.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2">AirBnBreeze</h1>
            <h2 class="text-xl font-semibold text-gray-900">Step 2: Add highlights</h2>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Highlights Form -->
            <form id="highlightsForm" class="px-6 py-4">
                @csrf

                <!-- Title Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Add title to your property</label>
                    <div class="mt-1">
                        <input type="text" id="property_title" name="property_title" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Beautiful beachfront villa with pool">
                    </div>
                </div>

                <!-- Description Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Add brief description</label>
                    <div class="mt-1">
                        <textarea id="property_description" name="property_description" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                  placeholder="Describe what makes your property special..."></textarea>
                    </div>
                </div>

                <!-- Save List Checkbox -->
                <div class="flex items-center mb-6">
                    <input id="save_list" name="save_list" type="checkbox" 
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="save_list" class="ml-2 block text-sm text-gray-700">
                        Save a list
                    </label>
                </div>
            </form>

            <!-- Navigation Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0">
                <button type="button" onclick="window.location.href='{{ route('properties.step1') }}'" 
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
    // Cancel changes
    function cancelChanges() {
        if (confirm('Are you sure you want to cancel? All changes will be lost.')) {
            document.getElementById('highlightsForm').reset();
        }
    }

    // Save and exit
    function saveAndExit() {
        if (saveData()) {
            alert('Your changes have been saved!');
            window.location.href = '/'; // Redirect to home
        }
    }

    // Save and continue to amenities
    function saveAndContinue() {
        if (saveData()) {
            window.location.href = '{{ route("properties.step3-amenities") }}';
        }
    }

    // Save data (would be replaced with actual form submission)
    function saveData() {
        const formData = {
            title: document.getElementById('property_title').value,
            description: document.getElementById('property_description').value,
            save_list: document.getElementById('save_list').checked
        };

        if (!formData.title) {
            alert('Please add a property title');
            return false;
        }

        if (!formData.description) {
            alert('Please add a property description');
            return false;
        }

        console.log('Saving data:', formData);
       
        
        return true;
    }
</script>

<style>
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
