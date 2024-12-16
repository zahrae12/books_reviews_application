<x-app-layout>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <main class="flex  bg-gray-50">
     
        <section class="w-1/4 bg-white p-5 rounded-lg mt-4 ">
            <div class="mb-4">
                <a href="{{ route('books.discover') }}" class="flex items-center text-amber-900 hover:text-orange-700 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Books
                </a>
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-40 h-60 object-cover rounded-md mb-4 mx-auto">
            </div>
            <div class="relative">
    @if (auth()->check())
        <button 
            class="block mt-4 w-full px-4 py-2 bg-orange-500 text-white rounded-lg" 
            onclick="toggleFavoritesModal()">
            Want to Read
        </button>

        <!-- Modal -->
        <div id="favoritesModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-5 rounded-lg w-80">
                <h2 class="text-xl font-bold mb-4">Add to Favorites</h2>
                <form action="{{ route('favorites.add') }}" method="POST" id="favoritesForm">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="status" id="favoriteStatus">
                    
                    <div class="space-y-3">
                        <button 
                            type="button" 
                            class="w-full px-4 py-2 bg-orange-300 text-white rounded-lg"
                            onclick="setFavoriteStatus('Read')">
                            Read
                        </button>
                        <button 
                            type="button" 
                            class="w-full px-4 py-2 bg-orange-500 text-white rounded-lg"
                            onclick="setFavoriteStatus('To Be Read')">
                            To Be Read
                        </button>
                        <button 
                            type="button" 
                            class="w-full px-4 py-2 bg-orange-900 text-white rounded-lg"
                            onclick="setFavoriteStatus('Currently Reading')">
                            Currently Reading
                        </button>
                    </div>
                </form>
                <button 
                    class="mt-4 w-full px-4 py-2 bg-gray-500 text-white rounded-lg"
                    onclick="toggleFavoritesModal()">
                    Cancel
                </button>
            </div>
        </div>
    @else
        <p><a href="{{ route('login') }}">Login</a> to add to favorites.</p>
    @endif
</div>

<script>
    function toggleFavoritesModal() {
        const modal = document.getElementById('favoritesModal');
        modal.classList.toggle('hidden');
    }
    function setFavoriteStatus(status) {
    const statusInput = document.getElementById('favoriteStatus');
    statusInput.value = status; // Set the value
    document.getElementById('favoritesForm').submit(); // Submit the form
}

    

</script>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif



           
        </section>

        <section class="w-3/4 p-5 space-y-5 overflow-y-auto">
            <!-- Book Information -->
            <div class="bg-white p-5 rounded-lg border border-gray-300">
                <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
                <h3 class="text-lg font-semibold text-amber-900 hover:text-orange-700">by {{ $book->author }}</h3>
                <div class="flex items-center space-x-3 mt-2">
                    <p class="text-lg font-semibold">{{ $book->rating }} <span class="text-yellow-500">★</span></p>
                    <p class="text-sm text-gray-700">{{ $book->ratings_count }} ratings · {{ $book->reviews_count }} reviews</p>
                </div>
                <div class="text-lg font-semibold text-gray-700 mt-2">
                    <p>Description: {{ $book->description }}</p>
                </div>
                <div class="text-lg font-semibold text-gray-700 mt-2">
                    <p>Genres: {{ $book->genre }}</p>
                </div>
                <div class="text-lg font-semibold text-gray-700 mt-2">
                    <p>pages:{{ $book->pages }} </p>
                </div>
                <div class="text-lg font-semibold text-gray-700 mt-2">
                    <p>Published On: {{ $book->created_at }}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-700 mt-2">Published by: {{ $user->name }}</p> <!-- Display the username -->
                </div>
            </div>

            <!-- About the Author Section -->
            <div class="bg-orange-950 shadow-2xl text-white p-5 rounded-lg border border-gray-300">
                <h2 class="text-2xl font-bold">About the Author:</h2>
                <div class="mt-4">
                    <p>{{ $book->author_bio ?? 'No biography available for this author.' }}</p> <!-- Assuming author_bio exists in Book model -->
                </div>
            </div>

            <!-- Similar Books Section -->
            <div class="bg-white p-5 rounded-lg border border-gray-300">
                <h2 class="text-2xl font-bold">Readers also enjoyed</h2>
                <div class="grid grid-cols-4 gap-6">
                    <!-- Book Card -->
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

         <!-- Reviews Section -->
              <div class="bg-white p-5 rounded-lg border border-gray-300">
                   <h2 class="text-2xl font-bold mb-4">Reviews</h2>

                        <!-- Loop through reviews -->
                  @forelse ($reviews as $review)
                   <div class="bg-white p-3 rounded-lg shadow mb-4">
                    <p class="text-sm text-gray-800">{{ $review->review }}</p>
                    <p class="text-xs text-gray-500 mt-2">- {{ $review->user->name }}</p>  <!-- Assuming user has a 'name' field -->
                    <p class="text-sm text-gray-600">{{ $review->created_at->format('F d, Y') }}</p>
                    <div class="flex space-x-1 text-amber-500 text-2xl mt-2">
                          @for ($i = 1; $i <= 5; $i++)
                             <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                         @endfor
                      </div>
                   </div>
            @empty
                   <p>No reviews yet. Be the first to write one!</p>
    @endforelse

    <!-- Add Review Button -->
    @if(Auth::check())
    <a href="{{ route('reviews.createReview', $book->id) }}" 
       class="inline-block bg-orange-500 text-white text-lg font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-opacity-75 mt-4 transition">
        Add a Review
    </a>
@else
    <a href="{{ route('login') }}" 
       class="inline-block bg-orange-500 text-white text-lg font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-opacity-75 mt-4 transition">
        Log in to Add a Review
    </a>
@endif

</div>

               
            </div>
        </section>
    </main>
</x-app-layout>
