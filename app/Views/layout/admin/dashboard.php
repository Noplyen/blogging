<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="icon" href="<?=base_url('/images/resource/icon.ico')?>" type="ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex">
<!-- Sidebar -->
<aside class="w-64 bg-blue-800 text-white flex flex-col">
    <div class="p-4 text-2xl font-bold">Sidebar</div>

    <!--navbar-->
    <?= $this->include('layout/admin/navbar') ?>
    <!--navbar-->

</aside>

<!-- Main Content -->
<div class="flex-1 p-6">
    <header class="flex justify-between items-center py-4">
        <h1 class="text-3xl font-bold">Dashboard</h1>

        <!--message-->
        <?= $this->include('layout/layout-cell/message') ?>
        <!--message-->

    </header>

    <main class="bg-white p-6 rounded-lg shadow-md">

        <?= $this->renderSection('content') ?>

    </main>

</div>
</body>
</html>
