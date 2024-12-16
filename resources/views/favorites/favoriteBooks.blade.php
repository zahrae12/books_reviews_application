<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
   
    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md min-h-screen">
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
        <div class="flex-1 p-6 bg-white-50">
            <h1 class="text-3xl font-bold text-center mb-6">My Books shelf</h1>
            
            @foreach (['Read', 'Currently Reading', 'To Be Read'] as $category)
                <section class="mb-12">
                    <h2 class="text-2xl font-bold text-red-900 mb-6 border-b-2 border-gray-300">
                        {{ $category }}:
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($favorites->where('status', $category) as $favorite)
                        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                        <div class="w-full h-60 flex justify-center items-center mb-4">
                            <img src="{{ asset('storage/' . $favorite->book->image) }}" 
                            alt="{{ $favorite->book->title }}" 
                               class="w-40 h-60 object-cover rounded-md">
    </div>
                                <h4 class="text-lg font-semibold text-gray-800 truncate">
                                    {{ $favorite->book->title }}
                                </h4>
                                <p class="text-sm text-gray-500 mb-2 truncate">
                                    by {{ $favorite->book->author }}
                                </p>
                                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= 4 ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                    <span class="text-sm text-gray-500 ml-2">(4.0)</span>
                </div>
                                <div class="flex space-x-2 w-full justify-center mt-2">
                                    <a href="{{ route('books.details', $favorite->book->id) }}" 
                                       class="px-4 py-2 bg-amber-900 hover:bg-orange-600 text-white rounded-lg text-center w-full">
                                        Read More
                                    </a>
                                    <!-- Remove from Favorites Button -->
                                    <form action="{{ route('favorites.remove', $favorite->book->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-center w-full">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center col-span-full">
                                No books found in this category.
                            </p>
                        @endforelse
                    </div>
                </section>
            @endforeach
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $favorites->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
