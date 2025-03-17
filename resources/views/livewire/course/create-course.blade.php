<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg px-10 py-6 w-full md:w-1/2 lg:w-4/5">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">{{ $isEdit ? 'Edit Course' : 'Create Course' }}</h2>
         <!-- Success/Error Messages -->
         @if (session()->has('message'))
         <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
             ✅ {{ session('message') }}
         </div>
     @endif

     @if (session()->has('error'))
         <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
             ❌ {{ session('error') }}
         </div>
     @endif
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-lg font-semibold text-gray-700">Name <span class="text-red-500">*</span></label>
                <input type="text" wire:model="name" id="name" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-lg font-semibold text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="description" id="description" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Image Upload and Preview (Row) -->
            <div class="flex space-x-4">
                <!-- Image Upload -->
                <div class="w-2/3">
                    <label for="image" class="block text-lg font-semibold text-gray-700">Image <span class="text-red-500">*</span></label>
                    <p class="text-gray-500 text-md mt-1">✅ Allowed formats: JPEG, PNG, JPG ✅ Max size: <strong>200KB</strong> ✅ Dimensions: <strong>300x300px</strong></p>
                    <label for="image" class="mt-2 flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-400 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex flex-col p-2 items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v8zM16 21v-4m-4 4v-4m-4 4v-4m8-10h.01M12 11l-4 4m0 0l-4-4m4 4V3" />
                            </svg>
                            <p class="text-gray-600 text-sm">Click to upload or drag & drop</p>
                        </div>
                        <input type="file" wire:model="image" id="image" class="hidden" />
                    </label>

                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Image Preview -->
                <div class="w-1/3">
                    @if ($imagePreview)
                        <div class="mt-20 ml-20 text-center">
                            <img src="{{ $imagePreview }}" alt="Image Preview" class="w-36 h-auto rounded-md border border-gray-300 shadow-md">
                        </div>
                    @elseif($oldImage && !$imagePreview)
                        <div class="mt-4 text-center">
                            <img src="{{ asset('storage/' . $oldImage) }}" alt="Old Image" class="w-24 h-24 rounded-md border border-gray-300 shadow-md">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Price and Status (Row) -->
            <div class="flex space-x-4">
                <!-- Price -->
                <div class="w-1/2">
                    <label for="price" class="block text-lg font-semibold text-gray-700">Price <span class="text-red-500">*</span></label>
                    <input type="number" wire:model="price" id="price" step="0.01" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

              <!-- Status -->
<div class="w-1/2 ml-20">
    <p class="block text-lg font-semibold text-gray-800 mb-4">Status</p>
    <div class="flex items-center space-x-8">
        <div class="flex items-center">
            <input
                id="default-radio-1"
                type="radio"
                value="1"
                wire:model="is_active"
                name="status"
                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
        </div>
        <div class="flex items-center">
            <input
                id="default-radio-2"
                type="radio"
                value="0"
                wire:model="is_active"
                name="status"
                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inactive</label>
        </div>
    </div>
</div>

            </div>


            <div class=" flex justify-center items-center">
            <!-- Submit Button -->
            <button type="submit" class="w-1/4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md transition">
                {{ $isEdit ? 'Update' : 'Save' }}
            </button>
        </div>
        </form>
    </div>
</div>
