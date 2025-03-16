<div class="">
    <div class="w-full">
        <table class="w-full table-auto border-collapse border-1 border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Author</th>
                    <th class="px-4 py-2">Published Date</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td class="border px-4 py-2">{{ $article->id }}</td>
                        <td class="border px-4 py-2">
                            <img src="{{ asset('storage/' . $article->image) }}"
                                 alt="{{ Str::limit($article->image, 20, '...') }}"
                                 class="w-20 h-20 object-cover object-center" />
                        </td>
                        <td class="border px-4 py-2">
                            {{ Str::limit($article->title, 40, '...') }}
                        </td>
                        <td class="border px-4 py-2">{{ $article->author }}</td>
                        <td class="border px-4 py-2">{{ $article->formatted_date}}</td>
                        <td class="border px-4 py-2">
                            @if($article->status == 1)
                                <span class="bg-green-500 text-white py-1 px-3 rounded-full text-xs">Published</span>
                            @else
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs">Unpublished</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 flex items-center space-x-2">
                            <button wire:click="edit({{ $article->id }})" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">Edit</button>
                            <button wire:click="delete({{ $article->id }})" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Livewire Pagination Links -->
        {{ $articles->links() }}
    </div>
</div>


