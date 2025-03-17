<div class="flex flex-col space-y-4">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">Create New Role</h2>
        <a href="{{ route('roles.index') }}" class="bg-blue-600 text-white px-4 py-2 text-sm rounded hover:bg-blue-700">
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

    <form method="POST" action="{{ route('roles.store') }}" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="font-semibold block">Name:</label>
                <input type="text" name="name" placeholder="Enter role name"
                    class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="font-semibold block">Permission:</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($permission as $value)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="rounded">
                            <span>{{ $value->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-floppy-disk"></i> Submit
                </button>
            </div>
        </div>
    </form>
</div>

