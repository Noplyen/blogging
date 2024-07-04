<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" id="meta-description-value" content="">
    <meta name="keywords" id="meta-tag-value" content="">
    <meta name="author" id="meta-author-value" content="">

    <title><?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/reader/footer.css')?>" >
    <link rel="stylesheet" href="<?= base_url('/css/reader/profile.css')?>" >
    <link rel="stylesheet" href="<?= base_url('/css/reader/read-article.css')?>" >
    <link rel="stylesheet" href="<?= base_url('/css/reader/main.css')?>" >
    <link rel="stylesheet" href="<?= base_url('/css/reader/navbar.css')?>" >
    <link rel="stylesheet" href="<?= base_url('/css/reader/home.css')?>">
    <link rel="icon" href="<?=base_url('/images/resource/logo/company.ico')?>" type="ico">
    <link rel="icon" href="<?=base_url('/images/resource/logo/company.ico')?>" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('/images/resource/logo/apple-touch-icon.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('/images/resource/logo/favicon-32x32.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('/images/resource/logo/favicon-16x16.png')?>">
    <link rel="manifest" href="<?=base_url('/images/resource/logo/site.webmanifest')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" />
    <script src="https://cdn.jsdelivr.net/npm/prismjs"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism-themes/1.9.0/prism-gruvbox-light.min.css" integrity="sha512-ZP5uPnDWewejdBhPqjBb4THKZ0djZMHLBUL9BG8sSKN7ng0YxWShmlHX+oyi6f72a0L62MMQgCwZwKpTOhABaQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>

<?= $this->include('layout/layout-cell/reader_navbar') ?>


<article>

    <?= $this->renderSection('content') ?>

</article>


<footer>
    <?= $this->include('layout/layout-cell/reader_footer') ?>
</footer>

<script src="<?= base_url('/js/reader-home.js')?>"></script>
<script src="<?= base_url('/js/read-article.js')?>"></script>

</body>
</html>

