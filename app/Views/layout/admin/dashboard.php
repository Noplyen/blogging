<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout with Tailwind CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex">
<!-- Sidebar -->
<aside class="w-64 bg-blue-800 text-white flex flex-col">
    <div class="p-4 text-2xl font-bold">Sidebar</div>
    <nav class="flex flex-col p-4 space-y-2">
        <a href="#" class="p-2 hover:bg-blue-700 rounded focus:outline-none focus:bg-blue-700">Home</a>
        <a href="#" class="p-2 hover:bg-blue-700 rounded focus:outline-none focus:bg-blue-700">Profile</a>
        <a href="#" class="p-2 hover:bg-blue-700 rounded focus:outline-none focus:bg-blue-700">Settings</a>
        <a href="#" class="p-2 hover:bg-blue-700 rounded focus:outline-none focus:bg-blue-700">Logout</a>
    </nav>
</aside>

<!-- Main Content -->
<div class="flex-1 p-6">
    <header class="flex justify-between items-center py-4">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <button class="px-4 py-2 bg-blue-600 text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-600">Button</button>
    </header>

    <main class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Main Content</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
    </main>

</div>
</body>
</html>
