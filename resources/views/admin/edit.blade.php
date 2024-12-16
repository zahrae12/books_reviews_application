<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex min-h-screen bg-gray-100 p-6">
        <!-- Sidebar Navigation (left) -->
        <aside class="w-64 bg-white rounded-lg shadow-md p-6 space-y-4">
            <nav class="space-y-6">
                <ul>
                    <li><a href="{{route('dashboard')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Admin Dashboard</a></li>
                    <li><a href="{{route('user.create')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Users Management</a></li>
                    <li><a href="{{route('admin.books-management')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Books Management</a></li>
                    <li><a href="{{route('admin.reviews-management')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Reviews Management</a></li>
                    <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="material-icons mr-4">settings</span> 
                    </a>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 mt-2 text-red-700 hover:bg-gray-200 rounded-lg">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 container mx-auto p-6">
            <h2 class="text-xl font-semibold mb-6">Edit Book</h2>

            <!-- Display any error or success messages -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-500 text-white p-4 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Book Edit Form -->
            <form action="{{ route('admin.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Book Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Book Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                    @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Book Author -->
                <div class="mb-4">
                    <label for="author" class="block text-gray-700">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                    @error('author')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Book Status -->
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-medium mb-1">Status</label>
                    <select id="status" name="status" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="1" {{ $book->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $book->status == 0 ? 'selected' : '' }}>Block</option>
                    </select>
                </div>

                <!-- Update Button -->
                <div class="mb-4">
                    <button type="submit" class="bg-orange-600 text-white font-bold py-2 px-4 rounded hover:bg-orange-200 rounded-md">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
