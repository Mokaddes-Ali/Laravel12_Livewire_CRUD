<div class="">
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full md:w-1/2 lg:w-4/5">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Product Upload</h2>

        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="name" id="name"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea wire:model="description" id="description"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">
                    Image <span class="text-red-500">*</span>
                </label>
                <p class="text-gray-500 text-sm mt-1">
                    ✅ Allowed formats: JPEG, PNG, JPG
                    ✅ Max size: <strong>200KB</strong>
                    ✅ Dimensions: <strong>300x300px</strong>
                </p>

                <label for="image"
                    class="mt-2 flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-400 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex flex-col items-center">
                        <!-- Upload Icon -->
                        <svg class="w-12 h-12 text-gray-400 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v8zM16 21v-4m-4 4v-4m-4 4v-4m8-10h.01M12 11l-4 4m0 0l-4-4m4 4V3" />
                        </svg>
                        <p class="text-gray-600 text-sm">Click to upload or drag & drop</p>
                    </div>
                    <input type="file" wire:model="image" id="image" class="hidden" />
                </label>

                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                @if ($imagePreview)
                    <div class="mt-4 text-center">
                        <img src="{{ $imagePreview }}" alt="Image Preview"
                            class="w-24 h-24 rounded-md border border-gray-300 shadow-md">
                    </div>
                @endif
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">
                    Price <span class="text-red-500">*</span>
                </label>
                <input type="number" wire:model="price" id="price" step="0.01"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md transition">
                Save
            </button>
        </form>

       <!-- Success Message -->
 @if (session()->has('message'))
 <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
     ✅ {{ session('message') }}
 </div>
@endif

<!-- Error Message -->
@if (session()->has('error'))
 <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
     ❌ {{ session('error') }}
 </div>
@endif
    </div>
</div>
</div>

