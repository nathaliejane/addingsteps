{{-- resources/views/properties/step4-photos.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2">AirBnBreeze</h1>
            <h2 class="text-xl font-semibold text-gray-900">Step 2: Add highlights</h2>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Production Section -->
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">PRODUCTION</h3>
                <div class="space-y-2">
                    <p class="text-sm text-gray-600">COMPUTER</p>
                    <p class="text-sm text-gray-600">REPORT</p>
                </div>
            </div>

            <!-- Photo Upload Section -->
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Add some photos of your house</h3>
                
                <!-- Photo Upload Area -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div class="mt-2 text-sm text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                            <span>Upload photos</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple accept="image/*">
                        </label>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>

                <!-- Photo Thumbnails -->
                <div id="photo-thumbnails" class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <!-- Thumbnails will appear here -->
                </div>

                <!-- Sidebar Photo Note -->
                <p class="mt-4 text-sm text-gray-500">
                    Add Sidebar to start a photo. On page 201, you're not free and up.
                </p>
            </div>

            <!-- Blade Section -->
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Blade</h3>
                <p class="text-sm text-gray-600">Titula</p>
            </div>

            <!-- Navigation Buttons -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between">
                <button type="button" onclick="window.location.href='{{ route('properties.amenities') }}'" 
                        class="back-btn">
                    Back
                </button>
                <div class="flex space-x-3">
                    <button type="button" onclick="cancelUploads()" 
                            class="cancel-btn">
                        Cancel
                    </button>
                    <button type="button" onclick="saveAndExit()" 
                            class="save-exit-btn">
                        Save & Exit
                    </button>
                    <button type="button" onclick="finishListing()" 
                            class="finish-btn">
                        Finish
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Store uploaded photos
    let uploadedPhotos = [];

    // Handle file upload
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const files = e.target.files;
        const thumbnailsContainer = document.getElementById('photo-thumbnails');
        
        // Clear existing thumbnails
        thumbnailsContainer.innerHTML = '';
        uploadedPhotos = [];
        
        // Process each file
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            // Validate file type
            if (!file.type.match('image.*')) {
                continue;
            }
            
            // Add to uploaded photos array
            uploadedPhotos.push(file);
            
            // Create thumbnail preview
            const reader = new FileReader();
            reader.onload = function(event) {
                const thumbnail = document.createElement('div');
                thumbnail.className = 'relative group';
                thumbnail.innerHTML = `
                    <img src="${event.target.result}" class="w-full h-32 object-cover rounded-lg">
                    <button type="button" onclick="removePhoto(${i})" class="absolute top-1 right-1 bg-white rounded-full p-1 opacity-0 group-hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                `;
                thumbnailsContainer.appendChild(thumbnail);
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove photo
    function removePhoto(index) {
        uploadedPhotos.splice(index, 1);
        renderThumbnails();
    }

    // Render all thumbnails
    function renderThumbnails() {
        const thumbnailsContainer = document.getElementById('photo-thumbnails');
        thumbnailsContainer.innerHTML = '';
        
        uploadedPhotos.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const thumbnail = document.createElement('div');
                thumbnail.className = 'relative group';
                thumbnail.innerHTML = `
                    <img src="${event.target.result}" class="w-full h-32 object-cover rounded-lg">
                    <button type="button" onclick="removePhoto(${index})" class="absolute top-1 right-1 bg-white rounded-full p-1 opacity-0 group-hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                `;
                thumbnailsContainer.appendChild(thumbnail);
            };
            reader.readAsDataURL(file);
        });
    }

    // Cancel uploads
    function cancelUploads() {
        if (confirm('Are you sure you want to cancel? All uploaded photos will be lost.')) {
            uploadedPhotos = [];
            document.getElementById('photo-thumbnails').innerHTML = '';
            document.getElementById('file-upload').value = '';
        }
    }

    // Save and exit
    function saveAndExit() {
        if (uploadedPhotos.length === 0) {
            alert('Please upload at least one photo');
            return;
        }
        
        savePhotos();
        alert('Your photos have been saved!');
        window.location.href = '/'; // Redirect to home
    }

    // Finish listing
    function finishListing() {
        if (uploadedPhotos.length === 0) {
            alert('Please upload at least one photo');
            return;
        }
        
        savePhotos();
        alert('Your property listing has been created successfully!');
        window.location.href = '/'; // Redirect to home or dashboard
    }

    // Save photos (would be replaced with actual form submission)
    function savePhotos() {
        console.log('Saving photos:', uploadedPhotos);
     
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
    .finish-btn {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500;
    }
    #photo-thumbnails img {
        transition: transform 0.2s;
    }
    #photo-thumbnails img:hover {
        transform: scale(1.02);
    }
</style>
@endsection
