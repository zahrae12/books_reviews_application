<!-- resources/views/reviews/showReviews.blade.php -->

<x-app-layout>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="flex bg-white">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md min-h-screen">
            <div class="p-6">
                <ul class="mt-8">
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
                        <a href="{{route('reviews.showReviews')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Reviews
                        </a>
                    </li>
                    <li>
                        <a href="{{route('favorites.favoriteBooks')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
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
    <h2 class="text-2xl font-bold text-center mb-6">My Reviews</h2>

    @forelse($reviews as $review)
        <div class="bg-white p-4 rounded-lg shadow-md mb-4 flex items-center">
            <!-- Review Content (Text) on the left side -->
            <div class="flex-1 pr-6">
                <h3 class="text-xl font-semibold">{{ $review->book->title }}</h3>
                <p class="text-sm text-gray-500">by {{ $review->book->author }}</p>
                <p class="text-gray-700 mt-2">{{ $review->review }}</p>
                <p class="text-yellow-500 mt-2">
                    @for($i = 0; $i < $review->rating; $i++)
                        &#9733;
                    @endfor
                    @for($i = $review->rating; $i < 5; $i++)
                        &#9734;
                    @endfor
                </p>

                <!-- Edit and Delete buttons -->
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('reviews.editReview', $review->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg">Edit</a>
                    <form method="POST" action="{{ route('reviews.destroy', $review->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Book Image on the right side -->
            <div class="w-24 h-32 flex-shrink-0">
                <img src="{{ asset('storage/' . $review->book->image) }}" class="w-full h-full object-cover rounded-md" alt="{{ $review->book->title }}">
            </div>
        </div>
    @empty
        <p>You haven't posted any reviews yet.</p>
    @endforelse

    @if($reviews->isNotEmpty())
        <div class="mt-4">
            {{$reviews->links('vendor.pagination.tailwind')}}
        </div>
    @endif
</div>

    </div>

</x-app-layout>
