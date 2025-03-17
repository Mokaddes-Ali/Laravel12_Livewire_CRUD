<div>
    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-2 mb-2">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl font-bold mb-4">Manage Roles</h2>

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 mb-4">Create New Role</button>

    @if($isEdit)
        <h3 class="text-lg font-bold">Edit Role</h3>
    @else
        <h3 class="text-lg font-bold">Add New Role</h3>
    @endif

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
        <input type="text" wire:model="name" placeholder="Role Name" class="border p-2 w-full">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

        <h4 class="mt-3">Select Permissions</h4>
        @foreach($permissions as $perm)
            <label class="block">
                <input type="checkbox" wire:model="selectedPermissions" value="{{ $perm->id }}"> {{ $perm->name }}
            </label>
        @endforeach
        @error('selectedPermissions') <span class="text-red-500">{{ $message }}</span> @enderror

        <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-3">
            {{ $isEdit ? 'Update' : 'Save' }}
        </button>
    </form>

    <h3 class="text-xl font-bold mt-6">All Roles</h3>
    <table class="w-full border mt-2">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">#</th>
                <th class="p-2 border">Role Name</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $index => $role)
                <tr>
                    <td class="p-2 border">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $role->name }}</td>
                    <td class="p-2 border">
                        <button wire:click="edit({{ $role->id }})" class="bg-yellow-500 text-white px-2 py-1">Edit</button>
                        <button wire:click="delete({{ $role->id }})" class="bg-red-500 text-white px-2 py-1" onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
