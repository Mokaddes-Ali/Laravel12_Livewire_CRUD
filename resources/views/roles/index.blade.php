<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
    <div class="flex justify-between items-center border-b pb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Role Management</h2>
        @can('role-create')
            <a href="{{ route('roles.create') }}"
                class="bg-green-600 text-white px-4 py-2 text-sm rounded hover:bg-green-700 transition">
                <i class="fa fa-plus"></i> Create New Role
            </a>
        @endcan
    </div>

    @session('success')
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ $value }}
        </div>
    @endsession

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left w-20">No</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center w-64">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key => $role)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ ++$key }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $role->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex justify-center space-x-2">
                        <a href="{{ route('roles.show', $role->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600 transition">
                            <i class="fa-solid fa-list"></i> Show
                        </a>
                        @can('role-edit')
                            <a href="{{ route('roles.edit', $role->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 text-sm rounded hover:bg-yellow-600 transition">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                        @endcan
                        @can('role-delete')
                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 text-sm rounded hover:bg-red-700 transition">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
