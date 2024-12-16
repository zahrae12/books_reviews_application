<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 shadow-md">
            <div class="p-6">
                <ul class="mt-4">
                    <li>
                        <a href="{{route('dashboard')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('books.discover')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Discover
                        </a>
                    </li>
                    <!-- Other links -->
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-100 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 p-6 bg-white bg-cover bg-center flex justify-center items-center min-h-screen">
            <div class="bg-gray-100 shadow-lg rounded-lg p-6 w-full mx-auto">
                <div class="bg-amber-900 text-white text-lg font-semibold p-4 rounded-t-lg">
                    Edit Book
                </div>
                <div class="p-4">
                    <form action="{{ route('books.updateBooks', $book->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-medium mb-1">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" placeholder="Title" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="author" class="block text-gray-700 font-medium mb-1">Author</label>
                            <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" placeholder="Author" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('author') is-invalid @enderror">
                            @error('author')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
                            <textarea id="description" name="description" placeholder="Description" rows="5" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="genre" class="block text-gray-700 font-medium mb-1">genre</label>
                            <textarea id="genre" name="genre" placeholder="genre" rows="5" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('genre') is-invalid @enderror">{{ old('genre', $book->genre) }}</textarea>
                            @error('genre')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium mb-1">Pages</label>
                            <textarea id="pages" name="pages" placeholder="pages" rows="5" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('pages') is-invalid @enderror">{{ old('pages', $book->pages) }}</textarea>
                            @error('pages')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium mb-1">Author's biography</label>
                            <textarea id="author_bio" name="author_bio" placeholder="author_bio" rows="5" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('authot_bio') is-invalid @enderror">{{ old('author_bio', $book->author_bio) }}</textarea>
                            @error('author_bio')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 font-medium mb-1">Image</label>
                            <input type="file" id="image" name="image" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500 @error('image') is-invalid @enderror">
                            @error('image')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                            @if(!empty($book->image))
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Uploaded Image" class="mt-2 w-25 h-48 object-cover">
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 font-medium mb-1">Status</label>
                            <select id="status" name="status" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="1" {{ $book->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $book->status == 0 ? 'selected' : '' }}>Block</option>
                            </select>
                        </div>

                        <button class="w-full bg-amber-600 text-white py-2 rounded-lg font-medium hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 mt-2">
                            Update
                        </button>
                    </form>

                    {{-- Display success message and image after upload --}}
                    @if (session('success'))
                        <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('image'))
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Uploaded Image:</h3>
                            <img src="{{ asset('storage/' . session('image')) }}" alt="Uploaded Image" class="mt-2 w-48 h-48 object-cover">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
