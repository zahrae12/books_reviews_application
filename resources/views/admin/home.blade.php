<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        <!-- Main Content Area -->
        <div class="container flex-1 ml-6">
            <h1 class="text-3xl font-semibold mb-6">ReadIT Statistics</h1>

            <!-- Dashboard Charts Grid (all equal size) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Stats Cards -->
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                    <h2 class="text-xl font-semibold text-gray-700">Total Books</h2>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalBooks }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                    <h2 class="text-xl font-semibold text-gray-700">Total Users</h2>
                    <p class="text-3xl font-bold text-green-500">{{ $totalUsers }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                    <h2 class="text-xl font-semibold text-gray-700">Total Reviews</h2>
                    <p class="text-3xl font-bold text-purple-500">{{ $totalReviews }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                    <h2 class="text-xl font-semibold text-gray-700">Published Books</h2>
                    <p class="text-3xl font-bold text-orange-500">{{ $publishedBooks }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center">
                    <h2 class="text-xl font-semibold text-gray-700">Unpublished Books</h2>
                    <p class="text-3xl font-bold text-red-500">{{ $unpublishedBooks }}</p>
                </div>
            </div>

            <!-- Dashboard Charts -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <!-- Books by Gender Chart -->
                <div class="col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Users by Gender</h3>
                    <canvas id="booksByGenderChart"></canvas>
                </div>

                <!-- Books by Genre Chart -->
                <div class="col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Books by Genre</h3>
                    <canvas id="booksByGenreChart"></canvas>
                </div>

                <!-- Published vs Unpublished Books Chart -->
                <div class="col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Published vs Unpublished Books</h3>
                    <canvas id="booksStatusChart"></canvas>
                </div>

                <!-- Gender vs Genre Ratings Chart -->
                <div class="col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Gender vs Genre Rating</h3>
                    <canvas id="genderGenreChart"></canvas>
                </div>

                <!-- Users by Age Category Chart -->
                <div class="col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Users by Age Category</h3>
                    <canvas id="usersByAgeCategoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data for charts
        var totalReviews = {{ $totalReviews }};
        var publishedBooks = {{ $publishedBooks }};
        var unpublishedBooks = {{ $unpublishedBooks }};

        // Data for Books by Gender
        var booksByGender = @json($booksByGender);
        var genderLabels = booksByGender.map(function (item) { return item.gender; });
        var genderData = booksByGender.map(function (item) { return item.total; });

        // Data for Books by Genre
        var booksByGenre = @json($booksByGenre);
        var genreLabels = booksByGenre.map(function (item) { return item.genre; });
        var genreData = booksByGenre.map(function (item) { return item.total; });

        // Books by Gender Chart
        var ctxBooksByGender = document.getElementById('booksByGenderChart').getContext('2d');
        var booksByGenderChart = new Chart(ctxBooksByGender, {
            type: 'bar',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Books by Gender',
                    data: genderData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });

        // Books by Genre Chart
        var ctxBooksByGenre = document.getElementById('booksByGenreChart').getContext('2d');
        var booksByGenreChart = new Chart(ctxBooksByGenre, {
            type: 'bar',
            data: {
                labels: genreLabels,
                datasets: [{
                    label: 'Books by Genre',
                    data: genreData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });

        // Published vs Unpublished Books Chart
        var ctxBooksStatus = document.getElementById('booksStatusChart').getContext('2d');
        var booksStatusChart = new Chart(ctxBooksStatus, {
            type: 'pie',
            data: {
                labels: ['Published', 'Unpublished'],
                datasets: [{
                    data: [publishedBooks, unpublishedBooks],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    hoverBackgroundColor: ['#36A2EB', '#FF6384']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Gender vs Genre Ratings Chart
        var ctxGenderGenre = document.getElementById('genderGenreChart').getContext('2d');
        var chartData = @json($chartData);
        var genderGenreChart = new Chart(ctxGenderGenre, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Male',
                        data: chartData.male,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: chartData.female,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true, max: 5 }
                }
            }
        });

        // Users by Age Category Chart
        var ageCategories = @json($ageCategories);
        var categoryLabels = ageCategories.map(function (item) { return item.age_category; });
        var categoryData = ageCategories.map(function (item) { return item.total; });

        var ctxAgeCategory = document.getElementById('usersByAgeCategoryChart').getContext('2d');
        var usersByAgeCategoryChart = new Chart(ctxAgeCategory, {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: 'Users by Age Category',
                    data: categoryData,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

    </script>

</x-app-layout>
