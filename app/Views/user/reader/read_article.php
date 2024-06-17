<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('title') ?>
<?php if (!empty($article)) : ?>
    <?= (!empty($article['title'])?$article['title']:" ")?>
<?php endif;?>
<?= $this->endSection('title') ?>


<?= $this->section('content') ?>
<div class="md:container md:mx-auto md:my-5 h-screen">

    <?php if (!empty($article)) : ?>

    <!--  title  -->
    <h2 class="text-4xl font-extrabold dark:text-white mt-3"
    ><?= $article['title'] ?></h2>

    <div class="my-2">

        <!--  author  -->
        <a href="#" >
            <span class="font-medium text-gray-400">
                <span>author : </span>
                <span><?= $article['user_name'] ?></span>
            </span>
        </a>
        <br>

        <!--  category  -->
        <a href="#">
            <span class="font-medium text-gray-400">
                <span>category : </span>
                <span><?= $article['category_name'] ?></span>
            </span>
        </a>
    </div>
    <hr>

    <!--  content  -->
    <section class="my-4">
        <span class="font-normal">
            <?= $article['content'] ?>
        </span>
    </section>

    <?php endif;?>

</div>

<?php if (!empty($article)){
    $metaDescription    =   $article['meta_description'];
    $metaTag            =   $article['meta_tag'];
    $metaAuthor         =   $article['user_name'];

    echo <<<script
        <script>
            var valueDescription = "{$metaDescription}";
            var valueTag = "{$metaTag}";
            var valueAuthor = "{$metaAuthor}";
            document.getElementById("meta-description-value").setAttribute("content", valueDescription);
            document.getElementById("meta-tag-value").setAttribute("content",valueTag);
            document.getElementById("meta-author-value").setAttribute("content",valueAuthor);
        </script>
     script;
} ?>
<?= $this->endSection('content') ?>
