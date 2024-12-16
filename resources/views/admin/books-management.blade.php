<x-app-layout>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<div class="flex min-h-screen bg-gray-100 p-6">
    <!-- Sidebar Navigation -->
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
    <main class="flex-1 p-6 space-y-6 bg-gray-100">
        @if(session('message'))
            <div class="bg-green-200 border border-green-300 text-green-700 px-4 py-2 rounded-md relative" role="alert">
                <span>{{ session('message') }}</span>
                <button type="button" onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 mt-1 mr-1">×</button>
            </div>
        @endif

        <header class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Manage Books</h1>
        </header>

        <!-- Add Book Form -->
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Book Title</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="block text-gray-700">Author</label>
                <input type="text" id="author" name="author" placeholder="Enter author name" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="biography" class="block text-gray-700">Author Biography</label>
                <textarea id="biography" name="biography" placeholder="Enter author biography" rows="3"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"></textarea>
                @error('biography')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" placeholder="Enter book description" rows="4" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-gray-700">Genre</label>
                <input type="text" id="genre" name="genre" placeholder="Enter genre" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                @error('genre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="pages" class="block text-gray-700">Number of Pages</label>
                <input type="number" id="pages" name="pages" placeholder="Enter number of pages" min="1" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                @error('pages')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Book Cover</label>
                <input type="file" id="image" name="image" accept="image/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">
                    Add Book
                </button>
            </div>
        </form>
        <!-- Book Management Table -->
        <h2 class="text-xl font-semibold mt-10">Books List</h2>
<table class="min-w-full bg-white rounded-lg shadow-lg mt-4 table-auto">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b text-left">Title</th>
            <th class="py-2 px-4 border-b text-left">Author</th>
            <th class="py-2 px-4 border-b text-left">Status</th>
            <th class="py-2 px-4 border-b text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr>
                <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                <td class="py-2 px-4 border-b">
                    @if ($book->status == 1)
                        Active
                    @else
                        block
                    @endif
                </td>
                <td class="py-2 px-4 border-b flex items-center space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('admin.edit', $book->id) }}" class="bg-orange-500 text-white px-2 py-1 rounded">
                        Edit
                    </a>

                    <!-- Deactivate/Activate Button -->
                    <!-- @if($book->status !== 0)
                        <form action="" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                Deactivate
                            </button>
                        </form>
                    @else
                        <form action="" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                                Activate
                            </button>
                        </form>
                    @endif -->

                    <!-- Delete Button -->
                    <a href="javascript:void(0);" onClick="confirmDelete({{ $book->id }})" class="bg-amber-700 text-white px-3 py-1 rounded-md hover:bg-amber-600">
                                                 <i class="fa-regular fa-pen-to-square text-sm"></i> Delete
                                                 </a>

                                                <script>
   
                            function confirmDelete(id) {
                                 // Ask the user for confirmation
                                  if (confirm('Are you sure you want to delete this book?')) {
            // Send the delete request
                                           $.ajax({
                                            url: '/bookss/' + id,  // Use the URL with the book ID
                                            type: 'DELETE',
                                        data: {
                                              _token: '{{ csrf_token() }}',  // Add CSRF token for security
                                                 },
                                        success: function(response) {
                                         if (response.status) {
                                         alert(response.message);  // Show success message
                                          location.reload();  // Reload the page after deletion
                                           } else {
                                          alert(response.message);  // Show error message
                                            }
                                      },
                                       error: function() {
                                       alert('Something went wrong, please try again!');
                                          }
                                           });
                                        }
                                       }
                                               </script>


                                           
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    </main>
    
</div>

</x-app-layout>
