<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('title') ?>
<?php echo getenv('websiteName')?>
<?= $this->endSection('title') ?>

<?= $this->section('content') ?>


<?php if (!empty($article)) : ?>

    <div class="read-container">
        <h1><span class="title"><?= $article['title'] ?></span></h1>

        <div class="read-author">
            <img class="image-author"
                 src="<?= $article['url_picture'] ?>" alt="author">
            <div class="detail">
                <span class="author-name"><?= $article['user_name'] ?></span>
                <span class="date"><?= $article['date_create'] ?></span>
            </div>
        </div>

        <hr>

        <div class="read-content">
            <span>
                <?= $article['content'] ?>
            </span>
        </div>

    </div>

<?php endif;?>

<?php if (!empty($article)){
    $metaDescription    =   $article['meta_description'];
    $metaTag            =   $article['meta_tag'];
    $metaAuthor         =   $article['user_name'];
    $url                =   base_url(uri_string().'?more='.request()->getGet('more'));
    $title              =   uri_string();

    echo <<<script
        <script>
            var valueDescription = "{$metaDescription}";
            var valueTag = "{$metaTag}";
            var valueAuthor = "{$metaAuthor}";
            var valueUrl = "{$url}";
            var valueTitle = "{$title}";
            
            document.getElementById("meta-description-value").setAttribute("content", valueDescription);
            document.getElementById("meta-url-value-og").setAttribute("content", valueUrl);
            document.getElementById("meta-description-value-og").setAttribute("content", valueDescription);
            document.getElementById("meta-title-value-og").setAttribute("content", valueTitle);
            document.getElementById("meta-tag-value").setAttribute("content",valueTag);
            document.getElementById("meta-author-value").setAttribute("content",valueAuthor);
        </script>
     script;
} ?>

<?= $this->endSection('content') ?>
