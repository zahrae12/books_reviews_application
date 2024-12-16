<!-- resources/views/reviews/create.blade.php -->
<x-app-layout>

<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.tailwindcss.com"></script>

    <div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('/images/liberarybg.jpg');">
        <div class="max-w-lg mx-auto p-6 bg-white bg-opacity-90 shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold mb-4 text-center">Write a Review for "{{ $book->title }}"</h2>

            <!-- Display validation errors if any -->
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Review Form -->
            <form action="{{ route('reviews.storeReview', $book->id) }}" method="POST">

            @csrf
           <input type="hidden" name="book_id" value="{{ $book->id }}"> <!-- Add this line -->
    
            <div class="mb-4">
          <label for="review" class="block text-gray-700 font-semibold">Review</label>
         <textarea name="review" id="review" rows="4" class="w-full border border-gray-300 rounded-lg p-2" required>{{ old('review') }}</textarea>
            </div>
                
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 font-semibold">Rating</label>
                    <select name="rating" id="rating" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="">Select a rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Star(s)</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="w-full bg-amber-900 text-white p-2 rounded-lg">Submit Review</button>
            </form>
               @if (session('success'))
              <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
             {{ session('success') }}
    </div>
@endif
        </div>
    </div>
</x-app-layout>
