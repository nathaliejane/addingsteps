{{-- resources/views/properties/step3-price.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2">AirBnBreeze</h1>
            <h2 class="text-xl font-semibold text-gray-900">Step 3: Set your price</h2>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-1">Price</h3>
                <p class="text-sm text-gray-600 mb-6">Set price for the property</p>

                <form id="priceForm" action="{{ route('properties.storePrice') }}" method="POST">
                    @csrf

                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">₱</span>
                        </div>
                        <input type="number" name="price" id="price" 
                               value="{{ old('price', session('property.price', 1780)) }}"
                               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-8 pr-12 py-4 sm:text-lg border-gray-300 rounded-md"
                               placeholder="0.00"
                               min="1"
                               step="1">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">rate per night</span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-between">
                <div class="flex space-x-2">
                    <button onclick="window.location.href='{{ route('properties.step2') }}'" 
                            class="back-btn">
                        Back
                    </button>
                    <button onclick="cancelChanges()" 
                            class="cancel-btn">
                        Cancel
                    </button>
                </div>
                <div class="flex space-x-2">
                    <button onclick="saveAndExit()" 
                            class="save-exit-btn">
                        Save & Exit
                    </button>
                    <button type="submit" form="priceForm" 
                            class="finish-btn">
                        Finish
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function cancelChanges() {
        if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
            window.location.href = "{{ route('dashboard') }}"; // Redirect to dashboard/home
        }
    }

    function saveAndExit() {
        
        const form = document.getElementById('priceForm');
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = "{{ route('dashboard') }}"; // Redirect after save
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
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
        @apply inline-flex items-center px-4 py-2 border border-indigo-300 shadow-sm text-sm font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
    }
    .finish-btn {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500;
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection
