<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="description" id="meta-description-value" content="">
    <meta name="keywords" id="meta-tag-value" content="">
    <meta name="author" id="meta-author-value" content="">
    <link rel="icon" href="<?=base_url('/images/resource/icon.ico')?>" type="ico">

    <title>
        <?= $this->renderSection('title') ?>
    </title>
</head>
<body class="">

<!--navbar-->
<?= $this->include('layout/layout-cell/reader_navbar') ?>
<!--navbar-->

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <?= $this->renderSection('text-slate')?>

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