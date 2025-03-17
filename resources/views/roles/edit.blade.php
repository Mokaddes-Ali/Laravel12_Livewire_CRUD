<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
    <div class="flex justify-between items-center border-b pb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Role</h2>
        <a href="{{ route('roles.index') }}"
            class="bg-blue-600 text-white px-4 py-2 text-sm rounded hover:bg-blue-700 transition">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ $message }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <!-- Name Field -->
            <div>
                <label class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" name="name" value="{{ $role->name }}" placeholder="Enter role name"
                    class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300">
            </div>

            <!-- Permissions -->
            <div>
                <label class="block text-gray-700 font-semibold">Permissions:</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                    @foreach($permission as $value)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}"
                                class="rounded text-blue-600 focus:ring-blue-500"
                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            <span class="text-gray-800">{{ $value->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Update Role
                </button>
            </div>
        </div>
    </form>
</div>
