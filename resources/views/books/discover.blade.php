<!-- resources/views/books/discover.blade.php -->

<x-app-layout>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.tailwindcss.com"></script>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('/images/liberarybg.jpg');">
    <div class="container mx-auto p-6">
    <a href="{{ route('dashboard') }}" class="text-white text-lg font-semibold mb-4 flex items-center hover:text-gray-400">
            <i class="fas fa-arrow-left mr-2 mt-2"></i> Back to Dashboard
        </a>
        <h1 class="text-3xl text-white font-bold mb-6 text-center">Discover Books</h1>

        <!-- Search Form -->
        <form action="{{ route('books.discover') }}" method="get" class="flex items-center space-x-2 mt-4">
            <input 
                type="text" 
                name="keyword" 
                class="form-input w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                placeholder="Search by keyword" 
                value="{{ request()->get('keyword') }}"
            />
            <button 
                type="submit" 
                class="bg-amber-900 text-white px-4 py-2 rounded-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
            >
                Search
            </button>
            <a href="{{ route('books.discover') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Clear</a>
        </form>

        <!-- Books Section -->
        <div class="grid grid-cols-6 gap-6 mt-6">
            @if($books->isNotEmpty())

            @foreach ($books as $book)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                @if($book->image != '')
                <div class="relative">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"  class="w-full h-60 object-cover rounded-md mb-4">
</div>
                    @else
                    <div class="relative">
                    <img src="https://placehold.co/600x400" alt="{{ $book->title }}"  class="w-full h-60 object-cover rounded-md mb-4">
</div>
                    @endif
                    <h4 class="text-lg font-semibold text-gray-800 truncate">{{ $book->title }}</h4>
                    <p class="text-sm text-gray-500 mb-2 truncate">by {{ $book->author }}</p>
                    <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= 4 ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                    <span class="text-sm text-gray-500 ml-2">(4.0)</span>
                </div>
                
                <a href="{{ route('books.details', $book->id) }}"
                    class="mt-4 block px-4 py-2 bg-orange-500 text-white rounded-lg text-center hover:bg-orange-600 transition duration-300">
                    Read More
                </a>
                </div>
         
                
            @endforeach
            @endif
            @if($books->isNotEmpty())
                        <div class="mt-4">
                            {{$books->links('vendor.pagination.tailwind')}}
                        </div>
             @endif
        </div>
    </div>
</div>
</x-app-layout>
