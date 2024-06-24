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

    <style>
        pre {
            width: 100%;
            overflow-x: auto;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        p > code{
            padding: 3px 5px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>

<!--navbar-->
<div class="border border-slate-300 border-x-0 border-t-0 ">
<?= $this->include('layout/layout-cell/reader_navbar') ?>
</div>
<!--navbar-->

        <?= $this->renderSection('text-slate')?>

            <!-- List Article -->
        <?= $this->renderSection('content') ?>
            <!-- List Article -->


<!--footer-->
<?= $this->include('layout/layout-cell/reader_footer') ?>
<!--footer-->

<script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>

</body>
</html>