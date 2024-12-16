<!-- resources/views/reviews/editReview.blade.php -->

<x-app-layout>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex bg-white">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 shadow-md min-h-screen">
            <div class="p-6">
                <ul class="mt-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('books.discover') }}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Discover
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('books.showBooksList') }}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            My Books
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reviews.showReviews') }}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Reviews
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Favorites
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Settings
                        </a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-100 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Edit Review</h2>

            <form method="POST" action="{{ route('reviews.update', $review->id) }}">
                @csrf
                @method('PUT')

                <!-- Book Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Book Title</label>
                    <input type="text" id="title" name="title" class="w-full p-2 mt-2 border rounded-lg" value="{{ old('title', $review->book->title) }}" disabled>
                </div>

                <!-- Review Text -->
                <div class="mb-4">
                    <label for="review" class="block text-gray-700">Review</label>
                    <textarea id="review" name="review" class="w-full p-2 mt-2 border rounded-lg" rows="4">{{ old('review', $review->review) }}</textarea>
                </div>

                <!-- Rating -->
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700">Rating</label>
                    <select id="rating" name="rating" class="w-full p-2 mt-2 border rounded-lg">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Update Button -->
                <div class="flex ml-2">
                    <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg">Update Review</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
