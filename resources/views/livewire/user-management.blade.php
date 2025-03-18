<div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">


    <!-- Create Button -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">User Management</h2>
        <button wire:click="create" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fa fa-plus"></i> Create New User
        </button>
    </div>
    <!-- Search Bar -->
<div class="mb-6 flex items-center space-x-2">
    <input type="text" wire:model.live="search"
        placeholder="Search by name or email"
        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">

    <!-- Cancel Button -->
    <button wire:click="clearSearch"
        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
        Clear
    </button>
</div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-6">
            {{ session('message') }}
        </div>
    @endif

    <!-- User Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Roles</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @foreach ($user->roles as $role)
                                <span class="bg-blue-500 text-white px-2 py-1 text-sm rounded mr-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <button wire:click="delete({{ $user->id }})" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 ml-2">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>

    <!-- Create/Edit Form -->
    @if ($isEditMode)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ $userId ? 'Edit' : 'Create' }} User</h2>
            <form wire:submit.prevent="{{ $userId ? 'update' : 'store' }}" class="bg-white p-6 rounded-lg shadow-md">
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label class="font-semibold block">Name:</label>
                        <input type="text" wire:model="name" placeholder="Enter name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="font-semibold block">Email:</label>
                        <input type="email" wire:model="email" placeholder="Enter email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="font-semibold block">Password:</label>
                        <input type="password" wire:model="password" placeholder="Enter password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Roles -->
                    <div>
                        <label class="font-semibold block">Roles:</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($roles as $roleName => $roleDisplayName)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="selectedRoles" value="{{ $roleName }}" class="rounded">
                                    <span>{{ $roleDisplayName }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('selectedRoles') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit and Reset Buttons -->
                    <div class="flex justify-center space-x-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            <i class="fa-solid fa-floppy-disk"></i> {{ $userId ? 'Update' : 'Submit' }}
                        </button>
                        <button type="button" wire:click="resetInputFields" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>
