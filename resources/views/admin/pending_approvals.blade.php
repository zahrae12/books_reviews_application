<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mx-auto p-6">

        <!-- Page Heading -->
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Pending Approvals</h2>

        <!-- Empty state message -->
        @if($pendingRequests->isEmpty())
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <p class="text-lg text-gray-600">No users are awaiting approval.</p>
            </div>
        @else
            <!-- Table -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600">
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRequests as $user)
                            <tr class="border-t">
                                <td class="py-3 px-4">{{ $user->name }}</td>
                                <td class="py-3 px-4">{{ $user->email }}</td>
                                <td class="py-3 px-4">
                                    <!-- Button to approve the user -->
                                    <form action="{{ route('admin.approve', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">Approve</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
