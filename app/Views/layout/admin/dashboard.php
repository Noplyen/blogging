<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="icon" href="<?=base_url('/images/resource/icon.ico')?>" type="ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!--    ckeditor style-->
    <style>
        #container-texteditor {
            /*width: 300px;*/
            margin: 20px auto;
        }
        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            height: 300px;
            overflow-y: auto;
        }
        .ck-content .image {
            /* Block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <!--    ckeditor style-->


</head>
<body class="bg-gray-100 min-h-screen max-h-min flex">
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
