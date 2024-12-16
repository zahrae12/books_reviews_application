<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-lg text-center">
        <h1 class="text-2xl font-semibold text-red-500">Unauthorized Access</h1>
        <p class="text-gray-600 mt-4">{{ session('message') ?? 'You do not have permission to access this page.' }}</p>
        <a href="{{ route('welcome') }}" class="text-blue-500 mt-4 block">Go to Home</a>
    </div>
</body>
</html>
