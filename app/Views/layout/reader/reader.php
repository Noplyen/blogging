<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!--navbar-->
<?= $this->include('layout/layout-cell/reader_navbar') ?>
<!--navbar-->

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0 py-3">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">From the blog</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Learn how to grow your business with our expert advice.</p>
        </div>
        <hr class="mx-auto my-3" >

            <!-- List Article -->
        <?= $this->renderSection('content') ?>
            <!-- List Article -->

    </div>

<!--footer-->
<?= $this->include('layout/layout-cell/reader_footer') ?>
<!--footer-->

<script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>

</body>
</html>