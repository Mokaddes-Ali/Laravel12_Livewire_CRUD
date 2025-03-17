<div class="">
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

<!-- Notes -->
<div class="mt-6 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-md">
 🔹 **Notes:** Fields marked with <span class="text-red-500">*</span> are required.
</div>
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
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">
                    Image <span class="text-red-500">*</span>
                    <p class="text-gray-500 text-sm mt-1">
                        ✅ Allowed formats: JPEG, PNG, JPG
                        ✅ Max size: <strong>200KB</strong>
                        ✅ Dimensions: <strong>300x300px</strong>
                    </p>
                </label>
                <input type="file" wire:model="image" id="image"
                    class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md p-2">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if ($imagePreview)
                    <div class="mt-4 text-center">
                        <p class="text-green-500 text-sm">Image uploaded successfully!</p>
                        <img src="{{ $imagePreview }}" alt="Image Preview"
                            class="w-32 h-32 mt-2 rounded-md border border-gray-300 shadow">
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
            <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md text-center">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
</div>

