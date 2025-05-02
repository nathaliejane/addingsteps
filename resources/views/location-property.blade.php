{{-- resources/views/properties/step1-address.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Step 1: Identify your property</h1>
        
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Address Section -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Add the address of the property</h2>
                
                <form id="addressForm">
                    <div class="grid grid-cols-1 gap-y-4 gap-x-6 sm:grid-cols-6">
                        <!-- Sweet Address -->
                        <div class="sm:col-span-6">
                            <label for="street_address" class="block text-sm font-medium text-gray-700">Street Address</label>
                            <input type="text" name="street_address" id="street_address" autocomplete="street-address"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- City/Municipality -->
                        <div class="sm:col-span-3">
                            <label for="city" class="block text-sm font-medium text-gray-700">City/Municipality</label>
                            <input type="text" name="city" id="city" autocomplete="address-level2"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- ZIP Code -->
                        <div class="sm:col-span-2">
                            <label for="zip_code" class="block text-sm font-medium text-gray-700">ZIP Code</label>
                            <input type="text" name="zip_code" id="zip_code" autocomplete="postal-code"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Province -->
                        <div class="sm:col-span-3">
                            <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                            <input type="text" name="province" id="province" autocomplete="address-level1"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Location Pinning Section -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Pin the location</h2>
                
                <!-- Location Search -->
                <div class="mb-4">
                    <label for="location_search" class="block text-sm font-medium text-gray-700">Search Location</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" id="location_search" name="location_search"
                               class="block w-full pr-10 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                               placeholder="Search for a location...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Suggested Locations -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suggested Locations</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach(['Auckland', 'Kalamazoo', 'Ghana', 'Phoenix', 'Cuba City', 'Tunisia', 'Northern', 'Hamura'] as $location)
                            <button type="button" class="location-suggestion text-xs px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50"
                                    data-location="{{ $location }}">
                                {{ $location }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Google Map Container -->
                <div id="map-container" class="h-64 w-full rounded-md overflow-hidden border border-gray-300">
                    <div id="map" class="h-full w-full"></div>
                </div>

                <!-- Location Privacy Notice -->
                <p class="mt-4 text-xs text-gray-500">
                    Check location is only shared with guests after they've made a reservation.
                </p>
            </div>

            <!-- Navigation -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between">
                <a href="{{ route('properties.step1') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back
                </a>
                <button type="button" id="saveLocationBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save and Continue
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initMap" async defer></script>

<script>
    let map;
    let marker;
    let autocomplete;
    let geocoder;

    function initMap() {
        geocoder = new google.maps.Geocoder();
        
        // Initialize map
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });

        // Initialize marker
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        // Initialize autocomplete for location search
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("location_search"),
            { types: ["geocode"] }
        );

        // When place is selected from autocomplete
        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

            // Center map on selected location
            map.setCenter(place.geometry.location);
            map.setZoom(15);
            
            // Place marker
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            // Fill address fields
            fillInAddress(place);
        });

        // When marker is dragged
        marker.addListener("dragend", () => {
            geocodePosition(marker.getPosition());
        });

        // When map is clicked
        map.addListener("click", (event) => {
            marker.setPosition(event.latLng);
            geocodePosition(event.latLng);
        });
    }

    function fillInAddress(place) {
        // Get each component of the address from the place details
        for (const component of place.address_components) {
            const componentType = component.types[0];
            
            switch (componentType) {
                case "street_number":
                    document.getElementById("street_address").value = `${component.long_name} ${document.getElementById("street_address").value}`;
                    break;
                case "route":
                    document.getElementById("street_address").value += component.long_name;
                    break;
                case "locality":
                    document.getElementById("city").value = component.long_name;
                    break;
                case "administrative_area_level_1":
                    document.getElementById("province").value = component.long_name;
                    break;
                case "postal_code":
                    document.getElementById("zip_code").value = component.long_name;
                    break;
            }
        }
    }

    function geocodePosition(pos) {
        geocoder.geocode({ location: pos }, (results, status) => {
            if (status === "OK" && results[0]) {
                fillInAddress(results[0]);
            }
        });
    }

    // Handle suggested location clicks
    document.querySelectorAll('.location-suggestion').forEach(button => {
        button.addEventListener('click', function() {
            const location = this.getAttribute('data-location');
            document.getElementById('location_search').value = location;
            
            // Trigger geocode for this location
            geocoder.geocode({ address: location }, (results, status) => {
                if (status === "OK" && results[0]) {
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(12);
                    marker.setPosition(results[0].geometry.location);
                    marker.setVisible(true);
                    fillInAddress(results[0]);
                }
            });
        });
    });

    // Handle form submission
    document.getElementById('saveLocationBtn').addEventListener('click', function() {
        // Here you would typically submit the form data to your backend
        const formData = {
            street_address: document.getElementById('street_address').value,
            city: document.getElementById('city').value,
            zip_code: document.getElementById('zip_code').value,
            province: document.getElementById('province').value,
            lat: marker.getPosition().lat(),
            lng: marker.getPosition().lng()
        };
        
        console.log('Form data to submit:', formData);
        // In a real app, you would use fetch() or axios to send this to your backend
        alert('Location saved! Proceeding to next step...');
    });
</script>

<style>
    .location-suggestion {
        transition: all 0.2s ease;
    }
    .location-suggestion:hover {
        background-color: #f3f4f6;
    }
</style>
@endsection
