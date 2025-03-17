<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
    <div class="flex justify-between items-center border-b pb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Users Management</h2>
        @can('product-edit')
            <a href="{{ route('users.create') }}"
                class="bg-green-600 text-white px-4 py-2 text-sm rounded hover:bg-green-700 transition">
                <i class="fa fa-plus"></i> Add New User
            </a>
        @endcan
    </div>

    @session('success')
        <div class="bg-green-100 text-green-700 p-3 rounded relative">
            {{ $value }}
        </div>
    @endsession

    <table class="w-full border border-gray-200 shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Roles</th>
                <th class="py-2 px-4 border-b w-56">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ ++$key }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $role)
                                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded">
                                    {{ $role }}
                                </span>
                            @endforeach
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <a href="{{ route('users.show', $user->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 text-xs rounded hover:bg-blue-600 transition">
                            <i class="fa-solid fa-list"></i> Show
                        </a>
                        @can('role-edit')
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 text-xs rounded hover:bg-yellow-600 transition">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                        @endcan
                        @can('role-edit')
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600 transition">
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
