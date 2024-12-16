<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Review App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-3xl mt-2">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-2xl font-serif text-amber-950">ReadIT</a>
            <nav class="space-x-4">
                <a href="/" class="text-gray-600 hover:text-gray-800">Home</a>
                <a href="{{route('reviews.showReviews')}}" class="text-gray-600 hover:text-gray-800">Reviews</a>
                <a href="{{route('books.discover')}}" class="text-gray-600 hover:text-gray-800">Books</a>
               
                <a href="{{route('login')}}" class="text-amber-900 hover:text-amber-900">Login</a>
                <a href="{{route('register')}}" class="text-amber-900 hover:text-amber-900">Register</a>
            </nav>
        </div>
    </header>

    <!-- Library Image Section -->
    <section class="relative w-full h-screen">
    <img src="images/flow.jpeg" alt="Library Image" class="absolute inset-0 w-full h-full object-cover">
    <div class="relative z-10 flex flex-col items-center justify-center h-full bg-black bg-opacity-30">
        <h3 class="text-4xl font-semibold text-white">The More you Read, the More you Learn</h3>
        <h1 class="text-xl font-semibold text-amber-500">The More you Read, the More Places You'll Go!</h1>
        
        <!-- Smaller Search Bar -->
        <div class="mt-6 flex items-center w-3/4 md:w-1/2"> 
    <form action="{{ route('books.discover') }}" method="get" class="w-full flex items-center"> 
           <input 
           type="text" 
            name="keyword" 
            class="w-full p-2 text-sm rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600" 
            placeholder="Search by keyword" 
            value="{{ request()->get('keyword') }}"
        />
        <button 
            type="submit"
            class="bg-amber-950 text-white p-2 rounded-r-lg hover:bg-red-500 transition flex items-center justify-center"
            aria-label="Search Books"
        >
            <!-- Search Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.42-1.42l3.39 3.39a1 1 0 11-1.42 1.42l-3.39-3.39zm-5.9-1.32a5 5 0 100-10 5 5 0 000 10z" clip-rule="evenodd" />
            </svg>
        </button>
    </form>
</div>



</section>


</body>
</html>



   <!-- Welcome Section -->
<section class="bg-white py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold text-gray-700">Welcome to Book Review App</h2>
        <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
            A monthly book review publication dedicated to helping readers discover new books through trusted reviews.
        </p>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Trending Book Reviews Section -->
            <div>
                <div class="flex justify-center items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Feather on Book icon -->
                        <path d="M19 2H9a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2zm-3 14H9v-2h7v2zm0-4H9v-2h7v2zm3-7H9V4h10v1z"/>
                        <path d="M4 6v16h2V6H4z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700">Trending Book Reviews</h3>
                </div>
                <p class="text-gray-600 mt-2">Discover the latest popular books and reviews.</p>
            </div>

            <!-- Featured Top Picks Section -->
            <div>
                <div class="flex justify-center items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Badge icon for Top Picks -->
                        <path d="M12 2l2.16 4.36L19 7.64l-3 2.92.7 4.13L12 13.77l-3.71 1.92.7-4.13-3-2.92 4.84-.28L12 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700">Featured Top Picks</h3>
                </div>
                <p class="text-gray-600 mt-2">Our editors' favorite books of the month.</p>
            </div>

            <!-- Books This Month Section -->
            <div>
                <div class="flex justify-center items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Open Book icon -->
                        <path d="M21 4H13a3 3 0 00-3 3v13a1 1 0 001 1h8a3 3 0 003-3V7a3 3 0 00-3-3zM4 4h8a3 3 0 013 3v13H5a3 3 0 01-3-3V7a3 3 0 013-3z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700">Books Of This Month</h3>
                </div>
                <p class="text-gray-600 mt-2">Books everyone is reading this month.</p>
            </div>
        </div>
    </div>
</section>


    <!-- Featured Books Section -->
    <section class="bg-rose-950 shadow-2xl">
        <div class="container mx-auto px-6 py-6">
            <h2 class="text-4xl font-semibold text-white text-center">Featured Book</h2>
            <div class="mt-8 flex flex-col md:flex-row items-center mt-4">
                <div class="md:w-1/2 ml-10">
                    <h3 class="text-2xl font-semibold text-gray-50">{{ $featuredBooks[0]->title ?? 'Featured Book Title' }}</h3>
                    <p class="text-slate-100 mt-2">{{ $featuredBooks[0]->description ?? 'Description of the featured book' }}</p>
                    <p class="text-lg font-semibold text-amber-500 mt-4"></p>
                    <div class="mt-6 flex space-x-4">
                    <button class="px-4 py-2 bg-amber-600 text-white font-semibold rounded hover:bg-orange-500">
                 <a href="{{ route('books.discover') }}" class="text-white">See More</a>
                      </button>
                    </div>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0 flex space-x-4">
                    @foreach ($featuredBooks as $book)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class=" mt-4 w-24 h-36 mt-10 rounded shadow-md">
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews -->
    <section class="bg-white py-10">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold mb-8 text-center">Latest Reviews</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($latestReviews as $review)
            <!-- Wrap the entire review card in a link -->
            <a href="{{ route('books.details',$book->id) }}" class="flex items-start bg-white shadow-lg rounded-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out">
                <!-- Display the cover image of the book associated with the review -->
                <img src="{{ asset('storage/' . $review->book->image) }}" class="w-24 h-32 object-cover rounded-md mr-4">
                <div>
                    <p class="text-xl font-semibold">{{ $review->book->title }}</p>
                    <p class="text-gray-500">by {{ $review->book->author }}</p>
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= 4 ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                        @endfor
                        <span class="text-sm text-gray-500 ml-2">(4.0)</span>
                    </div>
                    <p class="text-gray-700 mt-2">{{ Str::limit($review->review, 100) }}</p>
                </div>
            </a>
        @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('books.discover') }}" class="mt-6 px-6 py-2 bg-amber-600 text-white font-semibold rounded hover:bg-orange-500">
                See More Reviews
            </a>
        </div>
    </div>
</section>

      <!-- join our community -->
      <section class="bg-white py-10">
  <div class="container mx-auto px-4">
    <!-- Join our Community Heading -->
    <h2 class="text-3xl font-semibold mb-8 text-center">Join our Community</h2>

    <!-- Email Signup Section -->
    <div class="flex flex-col md:flex-row items-center justify-center mb-10 space-x-0 md:space-x-4 space-y-4 md:space-y-0">
      <!-- Call-to-Action Image -->
      <div class="w-full md:w-1/3 flex justify-center">
        <img src="images/kindle.jpg" alt="Join our Community" class="w-48 h-48 object-cover rounded-lg">
      </div>

      <!-- Email Input and Button -->
      <div class="flex items-center w-1/2 md:w-2/3">
        <input type="email" placeholder="Enter your email" class="w-1/2 p-3 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600">
        <a href="{{ route('register') }}" class="bg-amber-600 text-white p-3 rounded-r-lg hover:bg-red-700 transition">
          <!-- Arrow Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 17.293a1 1 0 010-1.414L15.586 13H4a1 1 0 110-2h11.586l-3.293-2.879a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      </div>
    </div>

    <!-- Community Stats Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      <!-- Active Readers -->
      <div>
        <p class="text-3xl font-bold text-gray-700">80k+</p>
        <p class="text-gray-700">Active Readers</p>
      </div>
      
      <!-- Total Books -->
      <div>
        <p class="text-3xl font-bold text-gray-700">3k+</p>
        <p class="text-gray-700">Total Books</p>
      </div>
      
      <!-- Cups of Coffee -->
      <div>
        <p class="text-3xl font-bold text-gray-700">283</p>
        <p class="text-gray-700">Cups of Coffee</p>
      </div>
      
      <!-- Facebook Fans -->
      <div>
        <p class="text-3xl font-bold text-gray-700">14k</p>
        <p class="text-gray-700">Facebook Fans</p>
      </div>
    </div>
  </div>
</section>




    <!-- Footer -->
    <footer class="bg-white text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="text-amber-950">&copy; 2024 Book Review App. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
