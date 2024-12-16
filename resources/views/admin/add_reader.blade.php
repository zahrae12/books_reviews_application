<x-app-layout>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Dashboard Container -->
    <div class="flex min-h-screen bg-gray-100 p-6">
        <!-- Sidebar Navigation (left) -->
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
        
        <main class="flex-1 p-6 space-y-6 bg-gray-100">
        @if(session('message'))
            <div class="bg-green-200 border border-green-300 text-green-700 px-4 py-2 rounded-md relative" role="alert">
              <span>{{ session('message') }}</span>
              <button type="button" onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 mt-1 mr-1">×</button>
              </div>
          @endif


            <header class="flex justify-between items-center mb-6">

                <h1 class="text-2xl font-semibold">Manage Users</h1>
            </header>
         
            <!-- Add User Form -->
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf

    <!-- Username -->
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Username</label>
        <input type="text" id="name" name="name" placeholder="Write a username" required
            autocomplete="off"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" placeholder="Write an email" required
            autocomplete="off"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Age -->
    <div class="mb-4">
        <label for="age" class="block text-gray-700">Age</label>
        <input type="number" id="age" name="age" placeholder="Write your age" required
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
        @error('age')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Gender -->
    <div class="mb-4">
        <label for="gender" class="block text-gray-700">Gender</label>
        <select id="gender" name="gender" required
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        @error('gender')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Image Upload -->
    <div class="mb-4">
        <label for="image" class="block text-gray-700">Reader Image</label>
        <input type="file" id="image" name="image" accept="image/*"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
        @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter a password" required
            autocomplete="new-password"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between">
        <button type="submit"
            class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600">Add user</button>
    </div>
</form>

            <!-- add readers to the table -->
            <h2 class="text-xl font-semibold mt-10">Users List</h2>
            <table class="min-w-full bg-white rounded-lg shadow-lg mt-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->status }}</td>
                            <td class="py-2 px-4 border-b space-x-2">
                                <!-- Delete Button -->
                                <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reader?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-orange-900 text-white px-2 py-1 rounded">Delete</button>
                                </form>
                                <!-- Ban Button -->
                                @if($user->status !== 'banned')
                                    <form action="" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-orange-500 text-white px-2 py-1 rounded">Ban</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Banned</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>

</x-app-layout>