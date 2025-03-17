<div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
    <div class="flex justify-between items-center border-b pb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Edit User</h2>
        @can('product-create')
            <a href="{{ route('users.index') }}"
                class="bg-gray-600 text-white px-4 py-2 text-sm rounded hover:bg-gray-700 transition">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        @endcan
    </div>

    <!-- Error Messages -->
    @if (count($errors) > 0)
        <div class="bg-red-100 text-red-700 p-3 rounded relative">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mt-2 list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter user's name"
                value="{{ old('name', $user->name) }}"
                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter email address"
                value="{{ old('email', $user->email) }}"
                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
            <input type="password" name="password" id="password" placeholder="Leave blank if you don't want to change"
                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label for="roles" class="block text-sm font-medium text-gray-700">Role:</label>
            <select name="roles[]" id="roles" multiple
                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @if(in_array($role, old('roles', $userRoles))) selected @endif>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded text-sm hover:bg-green-700 transition">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
        </div>
    </form>
</div>
