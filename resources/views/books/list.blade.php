<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 shadow-md">
            <div class="p-6">
                <ul class="mt-4">
                    <li>
                        <a href="{{route('dashboard')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('books.discover')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
                            Discover
                        </a>
                    </li>
                    <li>
                        <a href="{{route('books.showBooksList')}}" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-indigo-100 rounded-lg">
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

        <!-- Main content -->
        <div class="flex-1 p-6 bg-white">
            <div class="border-0 shadow-lg bg-white rounded-lg h-full pb-6">
                <div class="card-header bg-amber-900 text-white p-4 rounded-t-lg">
                   My Books
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between items-center mb-4">
                        <a href="{{route('books.createBooks')}}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                            Add a Book
                        </a>
                       
                        <form action="{{ route('books.showBooksList') }}" method="get" class="flex items-center space-x-2 mt-4">
                            <input 
                            type="text" 
                                name="keyword" 
                                class="form-input w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                                placeholder="Search by keyword" 
                                value="{{ request()->get('keyword') }}"
                                  />
                                <button 
                               type="submit" 
                                class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                                 >
                                  Search
                              </button>
                             <a href="{{ route('books.showBooksList') }}" class="bg-gray-300 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Clear</a>
                        </form>

                    </div>
                    
                    <table class="table w-full mt-4 bg-gray-100 shadow rounded-t-lg">
                        <thead class="bg-amber-900 text-white p-4 rounded-t-lg">
                            <tr>
                                <th class="p-2 text-center">Title</th>
                                <th class="p-2 text-center">Author</th>
                                <th class="p-2 text-center">Rating</th>
                                <th class="p-2 text-center">Status</th>
                                <th class="p-2 text-center" width="250">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($books->isNotEmpty())
                                @foreach ($books as $book)
                                    <tr class="border-t">
                                        <td class="p-2 text-center">{{$book->title}}</td>
                                        <td class="p-2 text-center">{{$book->author}}</td>
                                        <td class="p-2 text-center">3.0 (3 Reviews)</td>
                                        <td class="p-2 text-center">
                                            @if ($book->status == 1)
                                                <span class="text-green-500">Active</span>
                                            @else
                                                <span class="text-red-500">Block</span>
                                            @endif
                                        </td>
                                        <td class="p-2 text-center space-x-2">
                                           
                                            <a href="{{route('books.editBooks',$book->id)}}" class="bg-red-900 text-white px-3 py-1 rounded-md hover:bg-red-600">
                                                <i class="fa-regular fa-pen-to-square text-sm"></i>
                                            </a>
                                            <a href="javascript:void(0);" onClick="confirmDelete({{ $book->id }})" class="bg-amber-700 text-white px-3 py-1 rounded-md hover:bg-amber-600">
                                                 <i class="fa-regular fa-pen-to-square text-sm"></i> Delete
                                                 </a>

                                                <script>
   
                            function confirmDelete(id) {
                                 // Ask the user for confirmation
                                  if (confirm('Are you sure you want to delete this book?')) {
            // Send the delete request
                                           $.ajax({
                                            url: '/books/' + id,  // Use the URL with the book ID
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


                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Books not found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                    @if($books->isNotEmpty())
                        <div class="mt-4">
                            {{$books->links('vendor.pagination.tailwind')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
