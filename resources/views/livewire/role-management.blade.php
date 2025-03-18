<div>
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
        <div class="flex justify-between items-center border-b pb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Role Management</h2>
            <button wire:click="create" class="bg-green-600 text-white px-4 py-2 text-sm rounded hover:bg-green-700 transition">
                Create New Role
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 p-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Create/Edit Form -->
        @if ($isEditMode)
            <div class="mt-6">
                <h2 class="text-2xl font-semibold">{{ $roleId ? 'Edit' : 'Create' }} Role</h2>
                <form wire:submit.prevent="{{ $roleId ? 'update' : 'store' }}" class="bg-white p-6 rounded shadow-md">
                    <div class="space-y-4">
                        <div>
                            <label class="font-semibold block">Name:</label>
                            <input type="text" wire:model="name" placeholder="Enter role name"
                                class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300">
                        </div>

                        <div>
                            <label class="font-semibold block">Permission:</label>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($permissions as $value)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" wire:model="selectedPermissions" value="{{ $value->id }}" class="rounded">
                                        <span>{{ $value->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                                <i class="fa-solid fa-floppy-disk"></i> {{ $roleId ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left w-20">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left w-40">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Give Permission</th>
                        <th class="border border-gray-300 px-4 py-2 text-center w-64">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ ++$key }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $role->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @foreach ($role->permissions as $permission)
                                <span class="bg-blue-500 text-white px-2 py-1 text-sm rounded mr-1">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td class="border border-gray-300 px-4 py-2 flex justify-center items-center space-x-2">
                            <button wire:click="edit({{ $role->id }})" class="bg-yellow-500 text-white px-3 py-1 text-sm rounded hover:bg-yellow-600 transition">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <button wire:click="confirmDelete({{ $role->id }})" class="bg-red-600 text-white px-3 py-1 text-sm rounded hover:bg-red-700 transition">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   <!-- Delete Confirmation Modal -->
@if ($deleteRoleId)
<div class="fixed inset-0 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-gray-800">Delete Role</h2>
        <p class="text-gray-600 mt-2">Are you sure you want to delete the role <span class="font-bold">{{ $deleteRoleName }}</span>?</p>

        <h3 class="font-semibold mt-4">Permissions:</h3>
        <ul class="list-disc ml-5 text-gray-700">
            @foreach($deletePermissions as $permission)
                <li>{{ $permission }}</li>
            @endforeach
        </ul>

        <div class="flex justify-end space-x-2 mt-4">
            <button wire:click="$set('deleteRoleId', null)" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
            <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>
@endif
</div>
