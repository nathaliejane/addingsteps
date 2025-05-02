{{-- resources/views/properties/step1-capacity.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2">AirBnBreeze</h1>
            <h2 class="text-xl font-semibold text-gray-900">Step 1: Identify your property</h2>
            <p class="mt-2 text-sm text-gray-600">Property price • Location • Capacity</p>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Capacity Configuration -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Configure property capacity</h3>
                
                <!-- Backrooms Counter -->
                <div class="flex items-center justify-between py-3">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700">Backrooms</h4>
                    </div>
                    <div class="flex items-center">
                        <button type="button" onclick="decrement('backrooms')" class="counter-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span id="backrooms" class="mx-4 text-lg font-medium w-8 text-center">0</span>
                        <button type="button" onclick="increment('backrooms')" class="counter-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Guests Counter -->
                <div class="flex items-center justify-between py-3 border-t border-gray-200">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700">Guests</h4>
                    </div>
                    <div class="flex items-center">
                        <button type="button" onclick="decrement('guests')" class="counter-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span id="guests" class="mx-4 text-lg font-medium w-8 text-center">0</span>
                        <button type="button" onclick="increment('guests')" class="counter-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Bathrooms Counter -->
                <div class="flex items-center justify-between py-3 border-t border-gray-200">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700">Bathrooms</h4>
                    </div>
                    <div class="flex items-center">
                        <button type="button" onclick="decrement('bathrooms')" class="counter-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span id="bathrooms" class="mx-4 text-lg font-medium w-8 text-center">0</span>
                        <button type="button" onclick="increment('bathrooms')" class="counter-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0">
                <button type="button" onclick="window.location.href='{{ route('properties.step1') }}'" class="back-btn">
                    Back
                </button>
                <div class="flex space-x-3">
                    <button type="button" onclick="cancelChanges()" class="cancel-btn">
                        Cancel
                    </button>
                    <button type="button" onclick="saveAndExit()" class="save-exit-btn">
                        Save & Exit
                    </button>
                    <button type="button" onclick="saveAndContinue()" class="next-btn">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize counters
    const counters = {
        backrooms: 0,
        guests: 0,
        bathrooms: 0
    };

    // Update counter display
    function updateCounter(id) {
        document.getElementById(id).textContent = counters[id];
    }

    // Increment counter
    function increment(id) {
        counters[id]++;
        updateCounter(id);
    }

    // Decrement counter (minimum 0)
    function decrement(id) {
        if (counters[id] > 0) {
            counters[id]--;
            updateCounter(id);
        }
    }

    // Cancel changes
    function cancelChanges() {
        if (confirm('Are you sure you want to cancel? All changes will be lost.')) {
            // Reset all counters
            for (const key in counters) {
                counters[key] = 0;
                updateCounter(key);
            }
        }
    }

    // Save and exit
    function saveAndExit() {
        saveData();
        alert('Your changes have been saved!');
        window.location.href = '/'; // Redirect to home
    }

    // Save and continue
    function saveAndContinue() {
        saveData();
        window.location.href = '{{ route("properties.step2") }}';
    }

    function saveData() {
        console.log('Saving data:', counters);
      
    }
</script>

<style>
    .counter-btn {
        @apply h-8 w-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500;
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
