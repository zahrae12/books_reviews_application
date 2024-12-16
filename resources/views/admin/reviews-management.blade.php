<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Dashboard Container -->
    <div class="flex min-h-screen bg-gray-100 p-6">
        <!-- Sidebar Navigation (left) -->
        <aside class="w-64 bg-white rounded-lg shadow-md p-6 space-y-6">
            <nav class="space-y-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                            Admin Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.create') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                            Users Management
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.books-management') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                            Books Management
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews-management') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                            Reviews Management
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.show') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                            Settings
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center px-4 py-2 text-red-700 hover:bg-gray-200 rounded-lg">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-6 bg-gray-100">
            @if(session('message'))
                <div class="bg-green-200 border border-green-300 text-green-700 px-4 py-2 rounded-md relative" role="alert">
                    <span>{{ session('message') }}</span>
                    <button type="button" onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 mt-1 mr-1">×</button>
                </div>
            @endif

            <header class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Manage Reviews</h1>
            </header>

            <!-- Section: Reviews Management -->
            <section class="bg-white shadow-md rounded-lg p-6">
                
                <!-- Form for Adding a Review -->
                 @foreach ($books as $book)
                <form method="POST" action="{{ route('rev.store', $book->id) }}">
                    @endforeach
                    @csrf
                    <div class="mb-4">
                        <label for="book_id" class="block text-gray-700 font-bold mb-2">Book Title</label>
                        <select name="book_id" id="book_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                            <option value="" disabled selected>Select a Book</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                        @error('book_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="review" class="block text-gray-700 font-bold mb-2">Review</label>
                        <textarea name="review" id="review" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"></textarea>
                        @error('review') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700 font-bold mb-2">Rating</label>
                        <input type="number" name="rating" id="rating" min="1" max="5" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">
                        Add Review
                    </button>
                </form>
            </section>

            <!-- Section: Reviews List -->
            <section class="bg-white shadow-md rounded-lg p-6 mt-8">
                <h2 class="text-xl font-semibold mb-4 text-black-600">Reviews List</h2>
                <!-- Reviews Table -->
                <table class="min-w-full bg-white rounded-lg shadow-lg mt-4 table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">Book Title</th>
                            <th class="px-4 py-2 text-left text-gray-700">Review</th>
                            <th class="px-4 py-2 text-left text-gray-700">Rating</th>
                            <th class="px-4 py-2 text-center text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($reviews as $review)
    <tr>
        <td>{{ $review->book->title }}</td>
        <td>{{ $review->review }}</td>
        <td>{{ $review->rating }}</td>
        <td>
            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</x-app-layout>