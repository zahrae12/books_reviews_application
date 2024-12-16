<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6">
                <ul class="mt-4">
                    <li><a href="{{route('dashboard')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Dashboard</a></li>
                    <li><a href="{{route('books.discover')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Discover</a></li>
                    <li><a href="{{route('books.showBooksList')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">My Books</a></li>
                    <li><a href="{{route('reviews.showReviews')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">My Reviews</a></li>
                    <li><a href="{{route('favorites.favoriteBooks')}}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Favorites</a></li>
                    <li><a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-lg">Settings</a></li>
                </ul>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center px-4 py-2 mt-2 text-red-700 hover:bg-red-200 rounded-lg">
                            Logout
                        </button>
                    </form>
                </li>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="bg-gray-300 p-6 rounded-lg flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">A Book is a gift you can open again and again!</h2>
                    <p class="text-gray-600 mt-2">Every page you turn is a step closer to understanding the world and your place within it.</p>
                    <div class="mt-4">
    <!-- Redirect to reviews.showReviews -->
    <a href="{{ route('reviews.showReviews') }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg">
        Latest Reviews
    </a>
    
    <!-- Redirect to books.discover -->
    <a href="{{ route('books.discover') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg ml-2">
        Latest Featured Books
    </a>
</div>

                </div>
            </div>

            <h3 class="text-xl font-semibold text-gray-800 mb-4">Best Popular</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @if(isset($similarBooks) && $similarBooks->isNotEmpty())
        @foreach($similarBooks as $similarBook)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                <!-- Book Image -->
                <div class="relative">
                    <img src="{{ asset('storage/' . $similarBook->image) }}" alt="{{ $similarBook->title }}"
                        class="w-full h-60 object-cover rounded-md mb-4">
                    <!-- Overlay Rating -->
                    <!-- <div class="absolute top-2 left-2 bg-orange-500 text-white text-sm px-2 py-1 rounded">
                        <span class="font-semibold"></span>
                    </div> -->
                </div>
                <!-- Book Details -->
                <h4 class="text-lg font-semibold text-gray-800 truncate">{{ $similarBook->title }}</h4>
                <p class="text-sm text-gray-500 mb-2 truncate">by: {{ $similarBook->author }}</p>
                
                <!-- Star Rating -->
                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= 4 ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                    <span class="text-sm text-gray-500 ml-2">(4.0)</span>
                </div>
                
                <!-- Read More Button -->
                <a href="{{ route('books.details', $similarBook->id) }}"
                    class="mt-4 block px-4 py-2 bg-orange-500 text-white rounded-lg text-center hover:bg-orange-600 transition duration-300">
                    Read More
                </a>
            </div>
        @endforeach
    @else
        <!-- Fallback if no books are available -->
        <div class="col-span-full text-center text-gray-500 py-8">
            <p>No popular books available at the moment. Please check back later.</p>
        </div>
    @endif
</div>

        </div>

        <!-- Sidebar (Second Sidebar) -->
        <aside class="w-80 bg-white shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Featured Book Review</h3>
<div class="bg-gray-100 rounded-lg p-4 mb-4">
    @if($randomReviews->isNotEmpty())
        @foreach($randomReviews as $review)
            <div class="mb-6">
                <!-- Book Image and Info -->
                <img src="{{ asset('storage/' . $review->book->image) }}" alt="{{ $review->book->title }}" class="w-40 h-60 object-cover rounded-md mb-4 ml-6">
                <h4 class="text-lg font-semibold text-gray-800">{{ $review->book->title }}</h4>
                <p class="text-sm text-gray-500 mb-2">by {{ $review->book->author }}</p>

                <!-- Star Rating -->
                <div class="flex items-center mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                    <span class="text-sm text-gray-500 ml-2">({{ $review->rating }}.0)</span>
                </div>

                <!-- User Review -->
                <div class="bg-white p-3 rounded-lg shadow">
                    <p class="text-sm text-gray-800">{{ $review->review }}</p>
                    <p class="text-xs text-gray-500 mt-2">- {{ $review->user->name }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">No reviews available at the moment.</p>
    @endif
</div>

        </aside>
    </div>
</x-app-layout>
